<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Vinkla\Hashids\Facades\Hashids;

class HashidsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('hashids', function ($app) {
            return new Hashids(env('HASHIDS_SALT', 'qwerty12345uiopasdfghjklzxcvbnm6798'), 10);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
