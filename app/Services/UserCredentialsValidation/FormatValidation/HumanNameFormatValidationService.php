<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Services\UserInputErrors;

/**
 * Subsystem for checking whether an human name can exist.
 */
class HumanNameFormatValidationService
{
    private static function validateHumanNameLength(string $name, UserInputErrors $errors) : void
    {
        $len = mb_strlen($name, 'UTF-8');
        if ($len === 0)
        {
            $errors->addError('name', __('validation.required', ['attribute' => 'name']));
            return;
        }
        if ($len > $_ENV['MAX_HUMAN_NAME_LENGTH'])
        {
            $errors->addError('name', __('validation.max.string', ['attribute' => 'name', 'max' => $_ENV['MAX_HUMAN_NAME_LENGTH']]));
            return;
        }
    }

    /**
     * Seeks errors in the human name.
     * 
     * @param UserInputErrors $errors 
     * Data structure, where discovered errors will be stored.
     */
    public static function validateName(string $name, UserInputErrors $errors) : void
    {
        static::validateHumanNameLength($name, $errors);
    }
}
