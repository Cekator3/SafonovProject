<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\VarDumper;
use App\Services\Auth\UserRegistrationService;
use App\Services\Auth\UserRegistrationServiceWithValidator;

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
    public function register(Request $request)
    {
        $start = microtime(true);
        $login = $request->string('login', '');
        $email = $request->string('email', '');
        $phone_number = $request->string('phone_number', '');
        $name = $request->string('name', '');
        $surname = $request->string('surname', '');
        $patronymic = $request->string('patronymic', '');
        $password = $request->string('password', '');
        $password_confirmation = $request->string('password_confirmation', '');
        $errors = [];

        UserRegistrationService::registerUser($login, 
                                              $email, 
                                              $phone_number, 
                                              $name, 
                                              $surname, 
                                              $patronymic, 
                                              $password, 
                                              $password_confirmation, 
                                              $errors
        );
        $exec_time = microtime(true) - $start;
        echo 'Execution time: '. $exec_time. '<br>';
        dump($errors);
    }
}
