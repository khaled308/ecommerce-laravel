<?php

namespace App\Modules\Slider\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SliderServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        Route::middleware('web')
                ->group(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'slider');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

}
