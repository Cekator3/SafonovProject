<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict();
        static::logDatabaseQueries();
    }

    private function logDatabaseQueries() : void
    {
        DB::listen(function ($query) {
            Log::info($query->sql);     // the query being executed
            Log::info($query->time);    // query time in milliseconds
        });
    }
}
