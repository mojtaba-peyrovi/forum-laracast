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
          $channels = \Cache::rememberForever('channels', function(){
            return Channel::all();
          });
            $view->with('channels', $channels);  // instead of an array of views we can simply add '*' to pass this data to all views.
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

        if($this->app->isLocal()){
          $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }

    }
}
