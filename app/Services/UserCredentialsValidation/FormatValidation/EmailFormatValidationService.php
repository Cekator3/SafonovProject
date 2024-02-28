<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Services\UserInputErrors;

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
        if ($len > $_ENV['MAX_EMAIL_LENGTH'])
        {
            $errors->addError('email', __('validation.max.string', ['attribute' => 'email', 'max' => $_ENV['MAX_EMAIL_LENGTH']]));
            return;
        }
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
        if ($errors->hasAny('email'))
            return;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            $errors->addError('email', __('validation.email', ['attribute' => 'email']));
    }
}
