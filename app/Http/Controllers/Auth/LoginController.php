<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm() : View
    {
        return view('auth.login');
    }

    /**
     * Try to login the user
     */
    public function login() : View
    {
        throw new \Exception('Not Implemented');
    }
}
