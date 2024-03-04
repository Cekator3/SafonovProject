<?php

namespace App\Http\Controllers\Auth\EmailVerification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class EmailVerificationResenderController extends Controller
{
    /**
     * Resends the email verification email to the user.
     */
    public function resendEmailVerification(Request $request) : RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with(__('verification.email_verification_sent'));
    }
}
