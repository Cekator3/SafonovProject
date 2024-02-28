<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Services\UserInputErrors;
use libphonenumber\PhoneNumberUtil;

/**
 * Subsystem for checking whether an user password can exist.
 * 
 * This is useful to avoid even trying to send sms to a 
 * non-existent phone number.
 */
class PhoneNumberFormatValidationService
{
    private static function validatePhoneNumberLength(string $phoneNumber, UserInputErrors $errors) : void
    {
        $len = strlen($phoneNumber);
        if ($len > $_ENV['MAX_PHONE_NUMBER_LENGTH'])
        {
            $errors->addError('phone_number', __('validation.max.string', ['attribute' => 'phone_number', 'max' => $_ENV['MAX_PHONE_NUMBER_LENGTH']]));
            return;
        }
        if ($len === 0)
        {
            $errors->addError('phone_number', __('validation.required', ['attribute' => 'phone_number']));
            return;
        }
    }

    /**
     * Seeks errors in the phone number.
     *
     * @param UserInputErrors $errors 
     * Data structure, where discovered errors will be stored.
     */
    public static function validatePhoneNumber(string $phoneNumber, UserInputErrors $errors) : void
    {
        static::validatePhoneNumberLength($phoneNumber, $errors);
        if ($errors->hasAny('phone_number'))
            return;
        $phoneNumberUtil = PhoneNumberUtil::getInstance();
        if (! $phoneNumberUtil->isPossibleNumber($phoneNumber, 'RU'))
            $errors->addError('phone_number', __('validation.phone_number', ['attribute' => 'phone_number']));
    }
}
