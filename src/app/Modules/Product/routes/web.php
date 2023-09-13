<?php

use App\Modules\Product\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])
    ->delete('/dashboard/products/delete-image/{image_id}', [ProductController::class, 'deleteProductthumbnail'])
    ->name('products.delete-image');

Route::middleware(['auth', 'role:admin'])
    ->resource('/dashboard/products', ProductController::class);
