<?php

namespace App\Modules\Cart\Providers;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider{
    public function register(){

    }

    public function boot(){
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cart');
    }

}