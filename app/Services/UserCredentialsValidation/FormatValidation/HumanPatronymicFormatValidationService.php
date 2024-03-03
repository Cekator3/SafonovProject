<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Errors\UserInputErrors;
use Illuminate\Support\Facades\Config;

/**
 * Subsystem for checking whether an human patronymic can exist.
 */
class HumanPatronymicFormatValidationService
{
    private static function validateHumanPatronymicLength(string $patronymic, UserInputErrors $errors)
    {
        $len = mb_strlen($patronymic, 'UTF-8');
        $maxLen = Config::get('users.credentials.max_human_patronymic_length');
        if ($len > $maxLen)
        {
            $errMessage = __('validation.max.string', ['attribute' =>'surname', 
                                                       'max' => $maxLen]);
            $errors->addError('surname', $errMessage);
            return;
        }
    }

    /**
     * Seeks errors in the human patronymic.
     * 
     * @param UserInputErrors $errors 
     * Data structure, where discovered errors will be stored.
     */
    public static function validatePatronymic(string $patronymic, UserInputErrors $errors) : void
    {
        static::validateHumanPatronymicLength($patronymic, $errors);
    }
}
