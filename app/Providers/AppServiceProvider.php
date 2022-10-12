<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contract\UserRepositoryInterface', 
            'App\Repositories\Eloquent\UserRepository',
        );

        $this->app->bind(
            'Modules\Dashboard\Repositories\Contract\UserRepositoryInterface', 
            'Modules\Dashboard\Repositories\Eloquent\UserRepository',
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
