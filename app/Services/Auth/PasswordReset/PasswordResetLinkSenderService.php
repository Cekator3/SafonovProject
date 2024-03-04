<?php

namespace App\Services\Auth\PasswordReset;
use App\Errors\UserInputErrors;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Password;
use App\Services\UserCredentialsValidation\FormatValidation\EmailFormatValidationService;

class PasswordResetLinkSenderService
{
    /**
     * Sends a reset password link to a registered user's email.
     */
    public static function sendResetLinkToEmail(string $email, UserInputErrors $errors) : void
    {
        EmailFormatValidationService::validateEmail($email, $errors);
        if ($errors->hasAny())
            return;
        $normEmail = UserRepository::normalizeEmail($email);
        $status = Password::sendResetLink(['email' => $normEmail]);
        if ($status !== Password::RESET_LINK_SENT)
            $errors->addError('status', __($status));
    }
}
