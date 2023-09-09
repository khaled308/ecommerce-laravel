<?php
use App\Modules\Website\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');