<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Services\UserInputErrors;
use Illuminate\Support\Facades\Config;

/**
 * Subsystem for checking whether an user password can exist.
 */
class PasswordFormatValidationService
{
    private static function validatePasswordLength(string $password, UserInputErrors &$errors) : void
    {
        $len = mb_strlen($password, 'UTF-8');
        if ($len == 0)
        {
            $errors->addError('password', __('validation.required', ['attribute' => 'password']));
            return;
        }
        $maxLen = Config::get('users.credentials.max_password_length');
        if ($len > $maxLen)
        {
            $errors->addError('password', __('validation.max.string', ['attribute' => 'password', 'max' => $maxLen]));
            return;
        }
    }

    /**
     * Seeks errors in the user's password.
     *
     * @param UserInputErrors $errors 
     * Data structure, where discovered errors will be stored.
     */
    public static function validatePassword(string $password, UserInputErrors $errors, string $password_confirmation = '', bool $isPasswordConfirmationRequired = false) : void
    {
        static::validatePasswordLength($password, $errors);
        if ($errors->hasAnyForInput('password'))
            return;
        if ($isPasswordConfirmationRequired && ($password !== $password_confirmation))
            $errors->addError('password', __('validation.confirmed', ['attribute' => 'password']));
    }
}
