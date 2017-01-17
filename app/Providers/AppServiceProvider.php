<?php

namespace App\Providers;

use App\Repositories\ContactRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\ContactRepositoryInterface', function ($app) {
            return new ContactRepository();
        });
    }
}
