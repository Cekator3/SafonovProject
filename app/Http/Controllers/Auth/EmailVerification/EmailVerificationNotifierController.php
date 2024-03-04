<?php

namespace App\Http\Controllers\Auth\EmailVerification;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class EmailVerificationNotifierController extends Controller
{
    /**
     * Prompts the user to validate his email.
     */
    public function showEmailVerificationNotifier() : View
    {
        return view('auth.verify-email');
    }
}
