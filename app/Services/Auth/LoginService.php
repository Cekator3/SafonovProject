<?php

namespace App\Services\Auth;
use App\DTOs\UserAuthDTO;
use App\Errors\UserInputErrors;
use App\Repositories\UserRepository;
use App\Services\UserCredentialsValidation\FormatValidation\LoginFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\PasswordFormatValidationService;

/**
 * A subsystem that attempts to login the user.
 */
class LoginService
{
    private static function validateUserCredentials(string $login, 
                                                    string $password, 
                                                    UserInputErrors $errors) : void
    {
        LoginFormatValidationService::validateLogin($login, $errors);
        PasswordFormatValidationService::validatePassword($password, $errors);
    }

    /**
     * Logs the user in.
     * 
     * @param string $login The user's login.
     * @param string $password The user's password.
     * @param UserAuthDTO|null $dataForAuth It will contain data required for 
     * authentication on the interface side (Web, API, etc.) if no errors occur.
     * @param UserInputErrors $errors An object for storing validation errors.
     */
    public static function loginUser(string $login, 
                                     string $password, 
                                     UserAuthDTO|null &$dataForAuth, 
                                     UserInputErrors $errors) : void
    {
        static::validateUserCredentials($login, $password, $errors);
        
        if ($errors->hasAny())
            return;

        $dataForAuth = null;
        UserRepository::findUserByLoginAndPassword($login, $password, $dataForAuth);
        if ($dataForAuth === null)
        {
            $errMessage = __('auth.failed');
            $errors->addError('login', $errMessage);
            return;
        }
    }
}
