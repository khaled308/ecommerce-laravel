<?php

namespace App\Modules\Checkout\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CheckoutServiceProvider extends ServiceProvider{
    public function register(){

    }

    public function boot(){
        Route::middleware('web')
                ->group(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'checkout');
    }

}