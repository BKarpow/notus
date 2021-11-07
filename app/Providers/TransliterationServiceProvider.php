<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TransliterationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('transliterationString', 'App\Lib\TransliterationString');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
