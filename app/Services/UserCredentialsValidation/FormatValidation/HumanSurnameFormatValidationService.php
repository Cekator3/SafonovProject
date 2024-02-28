<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Services\UserInputErrors;

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
        if ($len > $_ENV['MAX_HUMAN_SURNAME_LENGTH'])
        {
            $errors->addError('surname', __('validation.max.string', ['attribute' =>'surname', 'max' => $_ENV['MAX_HUMAN_SURNAME_LENGTH']]));
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
