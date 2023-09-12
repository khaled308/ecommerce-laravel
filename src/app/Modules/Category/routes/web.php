<?php
use App\Modules\Category\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])
    ->resource('/admin/categories', CategoryController::class);