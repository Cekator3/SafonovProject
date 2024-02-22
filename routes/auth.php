<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Auth\UserRegistrationController;

Route::middleware(RedirectIfAuthenticated::class)
     ->group(function ()
{
    Route::controller(UserRegistrationController::class)->group(function () 
    {
        Route::get('/signup', 'showRegistrationForm')
            ->name('register');
        Route::post('/signup', 'register');
    });


    Route::controller(LoginController::class)->group(function ()
    {
        Route::get('/login', 'showLoginForm');
        Route::post('/login', 'login');
    });
});

Route::get('/logout', [LogoutController::class, 'logout']);
