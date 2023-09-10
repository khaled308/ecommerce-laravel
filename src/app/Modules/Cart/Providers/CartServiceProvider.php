<?php

namespace App\Modules\Cart\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class CartServiceProvider extends ServiceProvider{
    public function register(){
        $this->app->bind('cart', function($app){
            return new \App\Modules\Cart\Repository\CartRepository();
        });
    }

    public function boot(){
        Route::middleware('web')
                ->group(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cart');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        View::composer('website::*', CartDataComposer::class);
    }

}