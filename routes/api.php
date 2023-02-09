<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// User routes
Route::prefix('user')->group(
    function () {
        Route::post('/register', [UserController::class, 'store']);
        Route::post('/login', [UserController::class, 'login']);
        Route::post('/logout', [UserController::class, 'logout']);
    }
);
