<?php

namespace App\Services\Auth\PasswordReset;
use App\Models\User;
use App\Errors\UserInputErrors;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Services\UserCredentialsValidation\FormatValidation\EmailFormatValidationService;
use App\Services\UserCredentialsValidation\FormatValidation\PasswordFormatValidationService;

class PasswordResetService
{
    private static function validateToken(string $token, UserInputErrors $errors) : void
    {
        if ($token === '')
        {
            $errMessage = __('validation.required', ['attribute' => 'token']);
            $errors->addError('token', $errMessage);
        }
    }

    private static function validateUserInput(string $token, 
                                              string $email, 
                                              string $password, 
                                              string $passwordConfirmation, 
                                              UserInputErrors $errors) : void
    {
        static::validateToken($token, $errors);
        EmailFormatValidationService::validateEmail($email, $errors);
        PasswordFormatValidationService::validatePassword($password, 
                                                          $errors, 
                                                          $passwordConfirmation, 
                                                          true
        );
    }

    public static function changeUserPassword(User $user, string $newPassword) : void
    {
    }

    /**
     * Resets user's password.
     * 
     * @param string $token The user's password reset token.
     * @param string $email The user's email address.
     * @param string $password The user's new password.
     * @param string $passwordConfirmation The user's new password confirmation.
     * @param UserInputErrors $errors An object for storing validation errors.
     */
    public static function resetPassword(string $token, 
                                         string $email, 
                                         string $password,
                                         string $passwordConfirmation,
                                         UserInputErrors $errors) : void
    {
        static::validateUserInput($token, $email, $password, $passwordConfirmation, $errors);
        if ($errors->hasAny())
            return;

        $userCredentials = [
            'token' => $token,
            'email' => $email,
            'password' => $password,
        ];
        $status = Password::Reset($userCredentials, function (User $user, string $password) 
        {
            UserRepository::changeUserPassword($user, $password);

            event(new PasswordReset($user));
        });
        if ($status !== Password::PASSWORD_RESET)
            $errors->addError('status', __($status));
    }
}
