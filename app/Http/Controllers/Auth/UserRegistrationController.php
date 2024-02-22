<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRegistrationController extends Controller
{
    /**
     * Show user registration form
     */
    public function showRegistrationForm() : View
    {
        return view('auth.register');
    }

    /**
     * Try to register a user
     */
    public function register(Request $request) : View
    {
        throw new \Exception('Not Implemented');
    }
}
