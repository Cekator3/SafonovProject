<?php

namespace App\Services;

/**
 * Subsystem for storing error messages of user's inputs.
 * Errors are grouped by user's inputs. 
 * Each user input can have multiple error messages.
 */
class UserInputErrors
{
    private $errors = [];

    /**
     * Adds an error message for user's input.
     * 
     * @param string $inputName Identifier of the user input.
     * @param string $errorMessage The error message.
     */
    public function addError(string $inputName, string $message) : void
    {
        if (! array_key_exists($inputName, $this->errors)) {
            $this->errors[$inputName] = [$message];
            return;
        }
        $this->errors[$inputName][] = $message;
    }

    /**
     * Returns all error messages of specific user's input.
     * 
     * @param string $inputName Identifier of the user input.
     * @return string[] Array of error messages.
     */
    public function getErrors(string $inputName) : array
    {
        if (! array_key_exists($inputName, $this->errors))
            return [];
        return $this->errors[$inputName];
    }

    /**
     * Returns all error messages of each user's input.
     * 
     * @return string[] Array of error messages.
     */
    public function getAllErrors() : array
    {
        return $this->errors;
    }

    /**
     * Checks if any error messages exists.
     */
    public function hasAny() : bool
    {
        return $this->errors !== [];
    }

    /**
     * Checks if any error messages exists for concrete user input.
     * 
     * @param string $inputName Identifier of the user input.
     */
    public function hasAnyForInput(string $inputName) : bool
    {
        return array_key_exists($inputName, $this->errors);
    }
}
