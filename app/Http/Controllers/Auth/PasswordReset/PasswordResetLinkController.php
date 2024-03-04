<?php

namespace App\Http\Controllers\Auth\PasswordReset;

use App\Services\Auth\PasswordReset\PasswordResetLinkSenderService;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class PasswordResetLinkController extends Controller
{
    /**
     * Displays a form to retrieve the user's credentials (email) for password reset.
     */
    public function showForgotPasswordForm() : View
    {
        return view('auth.ResetPassword.forgot-password');
    }

    /**
     * Sends a reset link to the registered user's email address.
     */
    public function sendPasswordResetLink(Request $request) : RedirectResponse
    {
        $email = $request->input('email', '');
        $errors = new UserInputErrors();

        PasswordResetLinkSenderService::sendResetLinkToEmail($email, $errors);

        if ($errors->hasAny()) {
            return redirect()->back()
                             ->withErrors($errors->getAllErrors())
                             ->withInput();
        }

        return redirect()->back()->with('status', __('passwords.sent'));
    }
}
