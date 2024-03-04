<?php
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


Route::middleware([Authenticate::class, EnsureEmailIsVerified::class])
     ->group(function () 
{
    Route::get('/', function () 
    {
        return view('welcome');
    });
    // Личный кабинет
    // Корзина
    // Отзывы
    //...

});

require __DIR__.'/auth.php';
