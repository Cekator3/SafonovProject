<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Errors\UserInputErrors;
use Illuminate\Support\Facades\Config;

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
            $errMessage = __('validation.required', ['attribute' => 'login']);
            $errors->addError('login', $errMessage);
            return;
        }
        $maxLen = Config::get('users.credentials.max_login_length');
        if ($len > $maxLen)
        {
            $errMessage = __('validation.max.string', ['attribute' => 'login', 'max' => $maxLen]);
            $errors->addError('login', $errMessage);
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
