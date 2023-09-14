<?php

use App\Modules\Slider\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])
    ->resource('/admin/sliders', SliderController::class);
