<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Channel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \View::composer(['threads.create','layouts.app'], function($view){
            $view->with('channels', \App\Channel::all());  // instead of an array of views we can simply add '*' to pass this data to all views.
        });
        // or easiest way is:

        //   \View::share('channels', Channel::all());


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
