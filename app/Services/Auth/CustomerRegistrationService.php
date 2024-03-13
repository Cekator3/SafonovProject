<?php

namespace App\Services\Auth;

use App\DTOs\UserAuthDTO;
use App\Errors\UserInputErrors;
use App\Repositories\UserRepository;
use App\ViewModels\CustomerViewModel;
use App\Errors\UserCredentialsUniquenessErrors;
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
                                                            UserAuthDTO|null &$dataForAuth,
                                                            UserInputErrors $errors) : void
    {
        $userUniquenessErrors = new UserCredentialsUniquenessErrors();

        UserRepository::addCustomer($customer, $dataForAuth, $userUniquenessErrors);

        if ($userUniquenessErrors->isLoginInUse())
        {
            $errMessage = __('validation.unique', ['attribute' => 'login']);
            $errors->addError('login', $errMessage);
        }
        if ($userUniquenessErrors->isPhoneNumberInUse())
        {
            $errMessage = __('validation.unique', ['attribute' => 'phone_number']);
            $errors->addError('phone_number', $errMessage);
        }
        if ($userUniquenessErrors->isEmailInUse())
        {
            $errMessage = __('validation.unique', ['attribute' => 'email']);
            $errors->addError('email', $errMessage);
        }
    }

    /**
     * Registers the new customer.
     * 
     * @param CustomerViewModel $customer The customer's data.
     * @param UserAuthDTO|null $dataForAuth It will contain data required for 
     * authentication * on the interface side (Web, API, etc.) if no errors occur. 
     * @param UserInputErrors $errors An object for storing validation errors.
     * @return void
     */
    public static function registerCustomer(CustomerViewModel $customer, 
                                            UserAuthDTO|null &$dataForAuth,
                                            UserInputErrors $errors) : void
    {
        static::validateCustomerCredentials($customer, $errors);
        if ($errors->hasAny())
            return;

        $dataForAuth = null;
        static::saveNewCustomerDataInRepository($customer, $dataForAuth, $errors);
    }
}
