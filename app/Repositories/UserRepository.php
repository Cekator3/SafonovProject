<?php

namespace App\Repositories;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Hash;
use App\ViewModels\CustomerViewModel;
use App\Errors\UsersCredentialsUniquenessErrors;
use Illuminate\Database\UniqueConstraintViolationException;

/**
 * Subsystem for interacting with users data 
 * that is stored in the repository (data storage).
 */
class UserRepository
{
    private static function isLoginInUse(string $login) : bool
    {
        return User::where('login', $login)->exists();
    }

    private static function isEmailInUse(string $email) : bool
    {
        return User::where('email', $email)->exists();
    }

    private static function isPhoneNumberInUse(string $phoneNumber) : bool
    {
        return User::where('phone_number', $phoneNumber)->exists();
    }

    private static function hashPassword(string $password) : string
    {
        return Hash::make($password);
    }

    private static function normalizePhoneNumber(string $phoneNumber) : string
    {
        return preg_replace('/[^0-9]/', '', $phoneNumber);
    }

    private static function normalizeEmail(string $email) : string
    {
        return strtolower($email);
    }

    /**
     * Adds new customer's data to the repository (data storage).
     * 
     * P.S This code is not clean: repository should not return 
     * classes for interaction with the data storage 
     * (parameter $customerDbData). 
     * All interaction with the data storage should be done 
     * through repositories.
     * 
     * @param CustomerViewModel $customer New customer's data.
     * @param UsersCredentialsUniquenessErrors $errors 
     * An object for storing user's credentials uniqueness errors.
     * @param User|null $customerDbData Eloquent model of the added customer.
     */
    public static function addCustomer(CustomerViewModel $customer, 
                                       UsersCredentialsUniquenessErrors $errors,
                                       User|null &$customerDbData) : void
    {
        $phoneNumber = static::normalizePhoneNumber($customer->phoneNumber);
        $email = static::normalizeEmail($customer->email);

        // Ensure customer's credentials are not in use.
        $errors->setLoginUniqueness(static::isLoginInUse($customer->login));
        $errors->setEmailUniqueness(static::isEmailInUse($email));
        $errors->setPhoneNumberUniqueness(static::isPhoneNumberInUse($phoneNumber));
        if ($errors->hasAny())
            return;

        // Try adding a customer to the database.
        try
        {
            $user = new User();
            $user->login = $customer->login;
            $user->email = $email;
            $user->phone_number = $phoneNumber;
            $user->password = static::hashPassword($customer->password);
            $user->role = UserRole::Customer;
            $user->name = $customer->name;
            $user->surname = $customer->surname;
            $user->patronymic = $customer->patronymic;
            $user->save();

            $customerDbData = $user;
        }
        catch (UniqueConstraintViolationException $e)
        {
            $errors->setLoginUniqueness(static::isLoginInUse($customer->login));
            $errors->setEmailUniqueness(static::isEmailInUse($email));
            $errors->setPhoneNumberUniqueness(static::isPhoneNumberInUse($phoneNumber));
        }
    }
}
