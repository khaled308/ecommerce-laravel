<?php

namespace App\Modules\Checkout\Providers;

use Illuminate\Support\ServiceProvider;

class CheckoutServiceProvider extends ServiceProvider{
    public function register(){

    }

    public function boot(){
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'checkout');
    }

}