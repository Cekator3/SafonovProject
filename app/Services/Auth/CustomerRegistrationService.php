<?php

namespace App\Services\Auth;

use App\Errors\UserInputErrors;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\ViewModels\CustomerViewModel;
use App\Errors\UsersCredentialsUniquenessErrors;
use App\Services\UserCredentialsValidation\FormatValidation\EmailFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\LoginFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\PasswordFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\HumanNameFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\PhoneNumberFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\HumanSurnameFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\HumanPatronymicFormatValidationService;

/**
 * A subsystem that registers new customers in the application.
 */
class CustomerRegistrationService
{
    private static function validateCustomerCredentials(CustomerViewModel $user,
                                                        UserInputErrors $errors) : void
    {
        LoginFormatValidationService::validateLogin($user->login, $errors);
        EmailFormatValidationService::validateEmail($user->email, $errors);
        PhoneNumberFormatValidationService::validatePhoneNumber($user->phoneNumber, $errors);
        HumanNameFormatValidationService::validateName($user->name, $errors);
        HumanPatronymicFormatValidationService::validatePatronymic($user->patronymic, $errors);
        HumanSurnameFormatValidationService::validateSurname($user->surname, $errors);
        PasswordFormatValidationService::validatePassword($user->password, 
                                                          $errors, 
                                                          $user->password_confirmation, 
                                                          true);
    }

    private static function saveNewCustomerDataInRepository(CustomerViewModel $customer, 
                                                            UserInputErrors $errors,
                                                            mixed &$customerId) : void
    {
        $e = new UsersCredentialsUniquenessErrors();
        UserRepository::addCustomer($customer, $e, $customerId);
        if ($e->isLoginInUse())
            $errors->addError('login', __('validation.unique', ['attribute' => 'login']));
        if ($e->isPhoneNumberInUse())
            $errors->addError('phone_number', __('validation.unique', ['attribute' => 'phone_number']));
        if ($e->isEmailInUse())
            $errors->addError('email', __('validation.unique', ['attribute' => 'email']));
    }

    /**
     * Registers the new customer.
     * 
     * @param CustomerViewModel $user The customer's data.
     * @param UserInputErrors $errors An object for storing validation errors.
     * @return void
     */
    public static function registerCustomer(CustomerViewModel $user, 
                                            UserInputErrors $errors) : void
    {
        static::validateCustomerCredentials($user, $errors);
        if ($errors->hasAny())
            return;
        $customerId = 0;
        static::saveNewCustomerDataInRepository($user, $errors, $customerId);
        if ($errors->hasAny())
            return;
        Auth::loginUsingId($customerId);
    }
}
