<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Services\UserInputErrors;

/**
 * Subsystem for checking whether an human patronymic can exist.
 */
class HumanPatronymicFormatValidationService
{
    private static function validateHumanPatronymicLength(string $patronymic, UserInputErrors $errors)
    {
        $len = mb_strlen($patronymic, 'UTF-8');
        if ($len === 0)
        {
            $errors->addError('patronymic', __('validation.required', ['attribute' => 'patronymic']));
            return;
        }
        if ($len > $_ENV['MAX_HUMAN_SURNAME_LENGTH'])
        {
            $errors->addError('surname', __('validation.max.string', ['attribute' =>'surname', 'max' => $_ENV['MAX_HUMAN_SURNAME_LENGTH']]));
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
