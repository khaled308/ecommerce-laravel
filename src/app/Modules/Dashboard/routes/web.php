<?php
use App\Modules\Dashboard\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])
    ->get('/admin', [DashboardController::class, 'index'])
    ->name('dashboard');