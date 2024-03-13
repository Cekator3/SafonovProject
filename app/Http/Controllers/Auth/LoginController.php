<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\DTOs\UserAuthDTO;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use App\Services\Auth\LoginService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

    private function loginUserViaCookies(UserAuthDTO $dataForAuth, bool $rememberUser) : void
    {
        $cookieAuthData = $dataForAuth->getObjectForCookieAuthentication();
        Auth::login($cookieAuthData, $rememberUser);
    }

    /**
     * Tries to login the user
     */
    public function login(Request $request) : RedirectResponse
    {
        $login = $request->string('login', '');
        $password = $request->string('password','');
        $rememberUser = $request->boolean('remember_user', false);
        $dataForAuth = null;
        $errors = new UserInputErrors();

        LoginService::loginUser($login, $password, $dataForAuth, $errors);

        if ($errors->hasAny()) {
            return redirect(route('login'))
                ->withErrors($errors->getAllErrors())
                ->withInput();
        }

        if ($dataForAuth === null)
            throw new Exception("Authentication data does not exist, but no errors have occurred");
        $this->loginUserViaCookies($dataForAuth, $rememberUser);

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
