<?php
use App\Modules\Checkout\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');