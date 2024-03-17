<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Errors\UserInputErrors;
use Illuminate\Support\Facades\Config;

/**
 * Subsystem for checking whether an e-mail address can exist.
 * 
 * This is useful to avoid even trying to send mail to a 
 * non-existent email address.
 */
class EmailFormatValidationService
{
    private static function validateLength(string $email, UserInputErrors $errors) : void
    {
        $len = strlen($email);
        if ($len == 0) 
        {
            $errMessage = __('validation.required', ['attribute' => 'email']);
            $errors->addError('email', $errMessage);
            return;
        }
        $maxLen = Config::get('users.credentials.max_email_length');
        if ($len > $maxLen)
        {
            $errMessage = __('validation.max.string', ['attribute' => 'email', 
                                                       'max' => $maxLen]);
            $errors->addError('email', $errMessage);
            return;
        }
    }

    private static function isFormatValid(string $email) : bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private static function validateFormat(string $email, UserInputErrors $errors) : void
    {
        if (static::isFormatValid($email))
            return;
        $errMessage = __('validation.email', ['attribute' => 'email']);
        $errors->addError('email', $errMessage);
    }

    /**
     * Seeks errors in the e-mail address.
     *
     * @param UserInputErrors $errors 
     * Data structure, where discovered errors will be stored.
     */
    public static function validateEmail(string $email, UserInputErrors $errors) : void
    {
        static::validateLength($email, $errors);
        if ($errors->hasAnyForInput('email'))
            return;
        static::validateFormat($email, $errors);
    }
}
