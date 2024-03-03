<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Errors\UserInputErrors;
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
            $errMessage = __('validation.required', ['attribute' =>'surname']);
            $errors->addError('surname', $errMessage);
            return;
        }
        $maxLen = Config::get('users.credentials.max_human_surname_length');
        if ($len > $maxLen)
        {
            $errMessage = __('validation.max.string', ['attribute' =>'surname', 
                                                       'max' => $maxLen]);
            $errors->addError('surname', $errMessage);
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
