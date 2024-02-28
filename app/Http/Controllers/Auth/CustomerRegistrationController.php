<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\UserInputErrors;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Services\Auth\CustomerRegistrationService;

class CustomerRegistrationController extends Controller
{
    /**
     * Shows user registration form
     */
    public function showRegistrationForm() : View
    {
        return view('auth.register');
    }

    /**
     * Tries to register a user
     */
    public function register(Request $request) : RedirectResponse
    {
        $login = $request->string('login', '');
        $email = $request->string('email', '');
        $phoneNumber = $request->string('phone_number', '');
        $name = $request->string('name', '');
        $surname = $request->string('surname', '');
        $patronymic = $request->string('patronymic', '');
        $password = $request->string('password', '');
        $password_confirmation = $request->string('password_confirmation', '');
        $errors = new UserInputErrors();
        CustomerRegistrationService::registerCustomer(
            $login,
            $email,
            $phoneNumber,
            $name,
            $surname,
            $patronymic,
            $password,
            $password_confirmation,
            $errors
        );

        if ($errors->hasAny()) {
            return redirect(route('register'))
                ->withErrors($errors->getAllErrors())
                ->withInput();
        }

        return redirect('/');
    }
}
