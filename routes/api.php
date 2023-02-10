<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// User routes
Route::prefix('user')->group(
    function () {
        Route::post('/register', [UserController::class, 'store']);
        Route::post('/login', [UserController::class, 'login']);
        Route::post('/logout', [UserController::class, 'logout']);
    }
);

// Product routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::get('/category/{name}', [ProductController::class, 'productCategory']);
});

// Category routes
Route::get('/category/{name}', [CategoryController::class, 'subCategories']);
