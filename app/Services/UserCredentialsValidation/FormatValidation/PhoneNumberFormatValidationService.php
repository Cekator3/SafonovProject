<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Services\UserInputErrors;
use libphonenumber\PhoneNumberUtil;
use Illuminate\Support\Facades\Config;

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
        if ($len === 0)
        {
            $errors->addError('phone_number', __('validation.required', ['attribute' => 'phone_number']));
            return;
        }
        $maxLen = Config::get('users.credentials.max_phone_number_length');
        if ($len > $maxLen)
        {
            $errors->addError('phone_number', __('validation.max.string', ['attribute' => 'phone_number', 'max' => $maxLen]));
            return;
        }
    }

    private static function isPhoneNumberValid(string $phoneNumber) : bool
    {
        return PhoneNumberUtil::getInstance()->isPossibleNumber($phoneNumber, 'RU');
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
        if ($errors->hasAnyForInput('phone_number'))
            return;
        if (! static::isPhoneNumberValid($phoneNumber)) 
            $errors->addError('phone_number', __('validation.phone_number', ['attribute' => 'phone_number']));
    }
}
