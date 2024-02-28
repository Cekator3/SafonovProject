<?php

namespace App\Services\Auth;

use App\Services\UserInputErrors;
use App\Services\UserCredentialsValidation\FormatValidation\EmailFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\LoginFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\PasswordFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\HumanNameFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\PhoneNumberFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\HumanSurnameFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\HumanPatronymicFormatValidationService;

/**
 * A subsystem that registers new customers in the application
 */
class CustomerRegistrationService
{
    /**
     * Registers the new customer.
     * 
     * @param UserInputErrors $errors An object for storing validation errors.
     * @return void
     */
    public static function registerCustomer(string $login,
                                            string $email,
                                            string $phoneNumber,
                                            string $name,
                                            string $surname,
                                            string $patronymic,
                                            string $password,
                                            string $password_confirmation,
                                            UserInputErrors $errors) : void
    {
        LoginFormatValidationService::validateLogin($login, $errors);
        EmailFormatValidationService::validateEmail($email, $errors);
        PhoneNumberFormatValidationService::validatePhoneNumber($phoneNumber, $errors);
        if ($name !== '')
            HumanNameFormatValidationService::validateName($name, $errors);
        if ($patronymic !== '')
            HumanPatronymicFormatValidationService::validatePatronymic($patronymic, $errors);
        HumanSurnameFormatValidationService::validateSurname($surname, $errors);
        PasswordFormatValidationService::validatePassword($password, $errors, $password_confirmation, true);
    }
}
