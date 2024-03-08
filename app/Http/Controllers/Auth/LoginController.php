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
        $login = $request->input('login', '');
        $password = $request->input('password','');
        $rememberUser = $request->input('remember_user', false);
        $errors = new UserInputErrors();

        LoginService::loginUser($login, $password, $rememberUser, $errors);

        if ($errors->hasAny()) {
            return redirect(route('login'))
                ->withErrors($errors->getAllErrors())
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
