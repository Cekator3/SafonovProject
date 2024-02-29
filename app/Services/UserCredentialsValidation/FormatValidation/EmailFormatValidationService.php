<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Services\UserInputErrors;
use Illuminate\Support\Facades\Config;

/**
 * Subsystem for checking whether an e-mail address can exist.
 * 
 * This is useful to avoid even trying to send mail to a 
 * non-existent email address.
 */
class EmailFormatValidationService
{
    private static function validateEmailLength(string $email, UserInputErrors $errors) : void
    {
        $len = strlen($email);
        if ($len == 0) 
        {
            $errors->addError('email', __('validation.required', ['attribute' => 'email']));
            return;
        }
        $maxLen = Config::get('users.credentials.max_email_length');
        if ($len > $maxLen)
        {
            $errors->addError('email', __('validation.max.string', ['attribute' => 'email', 'max' => $maxLen]));
            return;
        }
    }

    private static function isEmailValid(string $email) : bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Seeks errors in the e-mail address.
     *
     * @param UserInputErrors $errors 
     * Data structure, where discovered errors will be stored.
     */
    public static function validateEmail(string $email, UserInputErrors $errors) : void
    {
        static::validateEmailLength($email, $errors);
        if ($errors->hasAnyForInput('email'))
            return;
        if (! static::isEmailValid($email)) 
            $errors->addError('email', __('validation.email', ['attribute' => 'email']));
    }
}
