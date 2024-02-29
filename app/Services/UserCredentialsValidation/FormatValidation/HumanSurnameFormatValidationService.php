<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Services\UserInputErrors;
use Illuminate\Support\Facades\Config;

/**
 * Subsystem for checking whether an human surname can exist.
 */
class HumanSurnameFormatValidationService
{
    private static function validateHumanSurnameLength(string $surname, UserInputErrors $errors) : void
    {
        $len = mb_strlen($surname, 'UTF-8');
        if ($len == 0)
        {
            $errors->addError('surname', __('validation.required', ['attribute' =>'surname']));
            return;
        }
        $maxLen = Config::get('users.credentials.max_human_surname_length');
        if ($len > $maxLen)
        {
            $errors->addError('surname', __('validation.max.string', ['attribute' =>'surname', 'max' => $maxLen]));
            return;
        }
    }

    /**
     * Seeks errors in the human surname.
     * 
     * @param UserInputErrors $errors 
     * Data structure, where discovered errors will be stored.
     */
    public static function validateSurname(string $surname, UserInputErrors $errors) : void
    {
        static::validateHumanSurnameLength($surname, $errors);
    }
}
