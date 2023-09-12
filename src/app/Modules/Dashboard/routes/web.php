<?php
use App\Modules\Dashboard\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [DashboardController::class, 'index']);