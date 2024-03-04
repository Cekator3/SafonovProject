<?php

namespace App\Services\Auth;
use App\Errors\UserInputErrors;
use Illuminate\Support\Facades\Auth;
use App\Services\UserCredentialsValidation\FormatValidation\LoginFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\PasswordFormatValidationService;

/**
 * A subsystem that attempts to login the user.
 */
class LoginService
{
    private static function 
    validateUserCredentials(string $login, string $password, UserInputErrors $errors) : void
    {
        LoginFormatValidationService::validateLogin($login, $errors);
        PasswordFormatValidationService::validatePassword($password, $errors);
    }

    /**
     * Logs the user in.
     * 
     * @param string $login The user's login.
     * @param string $password The user's password.
     * @param UserInputErrors $errors An object for storing validation errors.
     * @return void
     */
    public static function 
    loginUser(string $login, string $password, UserInputErrors $errors) : void
    {
        static::validateUserCredentials($login, $password, $errors);
        
        if ($errors->hasAny())
            return;

        if(! Auth::attempt(['login' => $login, 'password' => $password]))
        {
            $errMessage = __('auth.failed');
            $errors->addError('login', $errMessage);
            return;
        }
    }
}
