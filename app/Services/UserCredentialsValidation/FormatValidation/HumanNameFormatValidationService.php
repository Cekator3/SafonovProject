<?php

namespace App\Services\UserCredentialsValidation\FormatValidation;

use App\Services\UserInputErrors;
use Illuminate\Support\Facades\Config;

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
        $maxLen = Config::get('users.credentials.max_human_name_length');
        if ($len > $maxLen)
        {
            $errors->addError('name', __('validation.max.string', ['attribute' => 'name', 'max' => $maxLen]));
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
