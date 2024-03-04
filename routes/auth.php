<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordReset\NewPasswordController;
use App\Http\Controllers\Auth\PasswordReset\PasswordResetLinkController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Auth\CustomerRegistrationController;
use App\Http\Controllers\Auth\EmailVerification\EmailVerificationHandlerController;
use App\Http\Controllers\Auth\EmailVerification\EmailVerificationNotifierController;
use App\Http\Controllers\Auth\EmailVerification\EmailVerificationResenderController;

Route::middleware(RedirectIfAuthenticated::class)->group(function ()
{
    Route::controller(CustomerRegistrationController::class)->group(function () 
    {
        Route::get('/signup', 'showRegistrationForm')
            ->name('register');
        Route::post('/signup', 'register');
    });

    Route::controller(LoginController::class)->group(function ()
    {
        Route::get('/login', 'showLoginForm')
             ->name('login');
        Route::post('/login', 'login');
    });

    ////////////////////////////////////////////////////////////////
    // Password reset routes
    ////////////////////////////////////////////////////////////////
    Route::controller(PasswordResetLinkController::class)->group(function ()
    {
        Route::get('forgot-password', 'showForgotPasswordForm')
             ->name('password.request');

        Route::post('forgot-password', 'sendPasswordResetLink')
             ->name('password.email');
    });

    Route::controller(NewPasswordController::class)->group(function ()
    {
        Route::get('reset-password/{token}', 'showResetPasswordForm')
             ->name('password.reset');

        Route::post('reset-password', 'resetUserPassword')
             ->name('password.store');
    });
    ////////////////////////////////////////////////////////////////
});

Route::middleware('auth')->group(function ()
{
    ////////////////////////////////////////////////////////////////
    //Email verification routes
    ////////////////////////////////////////////////////////////////
    Route::get('/email/verify', [EmailVerificationNotifierController::class, 
                                 'showEmailVerificationNotifier'])
         ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationHandlerController::class,
                                             'handleEmailVerification'])
         ->middleware(['signed', 'throttle:6,1'])
         ->name('verification.verify');

    Route::post('/email/resend-verification', [EmailVerificationResenderController::class,
                                               'resendEmailVerification'])
         ->middleware('throttle:6,1')
         ->name('verification.send');
    ////////////////////////////////////////////////////////////////

    Route::get('/logout', [LogoutController::class, 'logout'])
        ->name('logout');
});
