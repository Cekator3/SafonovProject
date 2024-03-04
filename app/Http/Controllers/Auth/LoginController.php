<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use App\Services\Auth\LoginService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    /**
     * Shows login form
     */
    public function showLoginForm() : View
    {
        return view('auth.login');
    }

    /**
     * Tries to login the user
     */
    public function login(Request $request) : RedirectResponse
    {
        $errors = new UserInputErrors();

        LoginService::loginUser($request->login, $request->password, $errors);

        if ($errors->hasAny()) {
            return redirect(route('login'))
                ->withErrors($errors->getAllErrors())
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
