<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Errors\UserInputErrors;
use Illuminate\Support\Facades\Config;

/**
 * Subsystem for checking whether an user password can exist.
 */
class PasswordFormatValidationService
{
    private static function validateLength(string $password, UserInputErrors &$errors) : void
    {
        $len = mb_strlen($password, 'UTF-8');
        if ($len == 0)
        {
            $errMessage = __('validation.required', ['attribute' => 'password']);
            $errors->addError('password', $errMessage);
            return;
        }
        $maxLen = Config::get('users.credentials.max_password_length');
        if ($len > $maxLen)
        {
            $errMessage = __('validation.max.string', ['attribute' => 'password', 
                                                       'max' => $maxLen]);
            $errors->addError('password', $errMessage);
            return;
        }
    }

    private static function validatePasswordConfirmation(string $password, 
                                                         string $password_confirmation, 
                                                         UserInputErrors $errors) : void
    {
        if ($password === $password_confirmation)
            return;
        $errMessage = __('validation.confirmed', ['attribute' => 'password']);
        $errors->addError('password', $errMessage);
    }

    /**
     * Seeks errors in the user's password.
     *
     * @param UserInputErrors $errors 
     * Data structure, where discovered errors will be stored.
     */
    public static function validatePassword(string $password, 
                                            UserInputErrors $errors, 
                                            string $password_confirmation = '', 
                                            bool $isPasswordConfirmationRequired = false) : void
    {
        static::validateLength($password, $errors);
        if ($errors->hasAnyForInput('password'))
            return;
        if ($isPasswordConfirmationRequired)
            static::validatePasswordConfirmation($password, $password_confirmation, $errors);
    }
}
