<?php

namespace App\Modules\Website\Providers;

use Illuminate\Support\ServiceProvider;

class WebsiteServiceProvider extends ServiceProvider{
    public function register(){

    }

    public function boot(){
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'website');
    }

}