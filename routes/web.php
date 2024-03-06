<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Middleware\EnsureIsCustomer;
use App\Http\Middleware\EnsureIsPrintMaster;
use App\Http\Middleware\EnsureIsSuperuser;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class);

Route::middleware([Authenticate::class, EnsureIsCustomer::class])
     ->group(function () 
{

    Route::middleware(EnsureEmailIsVerified::class)
         ->group(function ()
    {

    });
});

Route::middleware([Authenticate::class, EnsureIsPrintMaster::class])
     ->prefix('print-master')
     ->group(function () 
{

});

Route::middleware([Authenticate::class, EnsureIsAdmin::class])
     ->prefix('admin')
     ->group(function ()
{

});

Route::middleware([Authenticate::class, EnsureIsSuperuser::class])
     ->prefix('superuser')
     ->group(function ()
{

});

require __DIR__.'/auth.php';
