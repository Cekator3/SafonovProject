<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Services\UserInputErrors;

/**
 * Subsystem for checking whether an user login can exist.
 */
class LoginFormatValidationService
{
    private static function validateLoginLength(string $login, UserInputErrors $errors) : void
    {
        $len = mb_strlen($login, 'UTF-8');
        if ($len === 0) 
        {
            $errors->addError('login', __('validation.required', ['attribute' => 'login']));
            return;
        }
        if ($len > $_ENV['MAX_LOGIN_LENGTH'])
        {
            $errors->addError('login', __('validation.max.string', ['attribute' => 'login', 'max' => $_ENV['MAX_LOGIN_LENGTH']]));
            return;
        }
    }

    /**
     * Seeks errors in the user's login.
     *
     * @param string $login 
     * @param UserInputErrors $errors 
     * Data structure, where discovered errors will be stored.
     */
    public static function validateLogin(string $login, UserInputErrors $errors) : void
    {
        static::validateLoginLength($login, $errors);
    }
}
