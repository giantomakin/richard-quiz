<?php

namespace App\Providers;

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
        //
        $this->app->bind(
        	'App\Repositories\QuizRepository',
        	'App\Repositories\CountableRepository',
        	'App\Repositories\QuizInterface',
        	'App\Repositories\CountableInterface',
        	'App\Repositories\AdsRepository',
        	'App\Repositories\AdsInterface'
        	);
    }
}
