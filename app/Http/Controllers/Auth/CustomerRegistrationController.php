<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\DTOs\UserAuthDTO;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Errors\UserInputErrors;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ViewModels\CustomerViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
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

    private function retrieveDataFromRegistrationForm(Request $request) : CustomerViewModel
    {
        $user = new CustomerViewModel();
        $user->login        = $request->string('login', '');
        $user->email        = $request->string('email', '');
        $user->phoneNumber  = $request->string('phone_number', '');
        $user->name         = $request->string('name', '');
        $user->surname      = $request->string('surname', '');
        $user->patronymic   = $request->string('patronymic', '');
        $user->password     = $request->string('password', '');
        $user->passwordConfirmation = $request->string('password_confirmation', '');
        $user->rememberUser = $request->boolean('remember_me', false);
        return $user;
    }

    private function loginUserViaCookies(UserAuthDTO $dataForAuth, bool $rememberUser) : void
    {
        Auth::login($dataForAuth->getObjectForCookieAuthentication(), $rememberUser);
        event(new Registered($dataForAuth->getObjectForCookieAuthentication()));
    }

    /**
     * Tries to register a customer
     */
    public function registerCustomer(Request $request) : RedirectResponse
    {
        $newUser = $this->retrieveDataFromRegistrationForm($request);
        $dataForAuth = null;
        $errors = new UserInputErrors();

        CustomerRegistrationService::registerCustomer($newUser, $dataForAuth, $errors);

        if ($errors->hasAny()) {
            return redirect(route('register'))
                ->withErrors($errors->getAllErrors())
                ->withInput();
        }

        if ($dataForAuth === null)
            throw new Exception("Authentication data does not exist, but no errors have occurred");
        $this->loginUserViaCookies($dataForAuth, $newUser->rememberUser);

        return redirect(RouteServiceProvider::HOME);
    }
}
