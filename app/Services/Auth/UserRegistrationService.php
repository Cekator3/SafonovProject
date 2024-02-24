<?php
/**
 * Subsystem for registering new users
 */

namespace App\Services\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

enum UserRegistrationErrors
{
    case LOGIN_ERROR;
    case LOGIN_ALREADY_IN_USE;
    case EMAIL_ALREADY_IN_USE;
    case PHONE_NUMBER_ALREADY_IN_USE;
    case LOGIN_REQUIRED;
    case EMAIL_REQUIRED;
    case PHONE_NUMBER_REQUIRED;
    case SURNAME_REQUIRED;
    case PASSWORD_REQUIRED;
    case PASSWORD_CONFIRMATION_REQUIRED;
    case LOGIN_IS_TOO_LONG;
    case EMAIL_IS_TOO_LONG;
    case PHONE_NUMBER_IS_TOO_LONG;
    case NAME_IS_TOO_LONG;
    case SURNAME_IS_TOO_LONG;
    case PATRONYMIC_IS_TOO_LONG;
    case PASSWORD_IS_TOO_LONG;
    case EMAIL_IS_INVALID;
    case PHONE_NUMBER_IS_INVALID;
}

class UserRegistrationService
{
    private static function validateUserLogin(string &$login, array &$errors) : void
    {
        if (!isset($errors['login']))
            $errors['login'] = [];
        if (strlen($login) == 0)
            array_push($errors['login'], __('validation.required', ['attribute' => 'login']));
        else if (strlen($login) > 255)
            array_push($errors['login'], __('validation.max.string', ['attribute' => 'login', 'max' => 255]));
    }

    private static function validateEmail(string &$email, array &$errors) : void
    {
        if (!isset($errors['email']))
            $errors['email'] = [];
        if (strlen($email) == 0)
            array_push($errors['email'], __('validation.required', ['attribute' => 'email']));
        else if (strlen($email) > 255)
            array_push($errors['email'], __('validation.max.string', ['attribute' => 'email', 'max' => 255]));
        else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
            array_push($errors['email'], __('validation.email', ['attribute' => 'email']));
    }

    private static function validatePhoneNumber(string &$phone_number, array &$errors) : void
    {
        if (strlen($phone_number) == 0)
            array_push($errors, UserRegistrationErrors::PHONE_NUMBER_REQUIRED);
        else if (strlen($phone_number) > 255)
            array_push($errors, UserRegistrationErrors::PHONE_NUMBER_IS_TOO_LONG);
    }

    private static function validateName(string &$name, array &$errors) : void
    {
        if (strlen($name) > 255)
            array_push($errors, UserRegistrationErrors::NAME_IS_TOO_LONG);
    }

    private static function validateSurname(string &$surname, array &$errors) : void
    {
        if (strlen($surname) == 0)
            array_push($errors, UserRegistrationErrors::SURNAME_REQUIRED);
        else if (strlen($surname) > 255)
            array_push($errors, UserRegistrationErrors::SURNAME_IS_TOO_LONG);
    }

    private static function validatePatronymic(string &$patronymic, array &$errors) : void
    {
        if (strlen($patronymic) > 255)
            array_push($errors, UserRegistrationErrors::PATRONYMIC_IS_TOO_LONG);
    }

    private static function validatePassword(string &$password, string &$password_confirmation, array &$errors) : void
    {
        if (strlen($password) == 0)
            array_push($errors, UserRegistrationErrors::PASSWORD_REQUIRED);
        else if (strlen($password) > 255)
            array_push($errors, UserRegistrationErrors::PASSWORD_IS_TOO_LONG);
        if ($password !== $password_confirmation)
            array_push($errors, UserRegistrationErrors::PASSWORD_CONFIRMATION_REQUIRED);
    }

    /**
      * Register a new user in the application.
      * 
      * @param string $login The user's login name.
      * @param string $email The user's email address.
      * @param string $phone_number The user's phone number.
      * @param string $name The user's full name.
      * @param string $surname The user's surname.
      * @param string $patronymic The user's patronymic.
      * @param string $password The user's password.
      * @param string $password_confirmation The user's password confirmation.
      * @param array $errors An array to hold validation errors.
      * 
      * @return void
      * @throws \Illuminate\Validation\ValidationException If the user's data is invalid.
      */
    public static function registerUser(string $login, 
                                        string $email, 
                                        string $phone_number, 
                                        string $name = '', 
                                        string $surname, 
                                        string $patronymic = '', 
                                        string $password, 
                                        string $password_confirmation, 
                                        array &$errors = []) : void
    {
        static::validateUserLogin($login, $errors);
        static::validateEmail($email, $errors);
        // static::validatePhoneNumber($phone_number, $errors);
        // static::validateName($name, $errors);
        // static::validateSurname($surname, $errors);
        // static::validatePatronymic($patronymic, $errors);
        // static::validatePassword($password, $password_confirmation, $errors);
    }
}
