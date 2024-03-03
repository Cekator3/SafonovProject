<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use Illuminate\Support\Benchmark;
use App\Http\Controllers\Controller;
use App\ViewModels\CustomerViewModel;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
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

    private static function getCustomerViewModel(Request $request) : CustomerViewModel
    {
        $user = new CustomerViewModel();
        $user->login = $request->string('login', '');
        $user->email = $request->string('email', '');
        $user->phoneNumber = $request->string('phone_number', '');
        $user->name = $request->string('name', '');
        $user->surname = $request->string('surname', '');
        $user->patronymic = $request->string('patronymic', '');
        $user->password = $request->string('password', '');
        $user->password_confirmation = $request->string('password_confirmation', '');
        return $user;
    }

    /**
     * Tries to register a user
     */
    public function register(Request $request) : RedirectResponse
    {
        $user = static::getCustomerViewModel($request);
        $errors = new UserInputErrors();

        Benchmark::dd(function () use ($user, $errors) 
        {
            CustomerRegistrationService::registerCustomer($user, $errors);
        }, 20000);

        if ($errors->hasAny()) {
            return redirect(route('register'))
                ->withErrors($errors->getAllErrors())
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect(RouteServiceProvider::HOME);
    }
}
