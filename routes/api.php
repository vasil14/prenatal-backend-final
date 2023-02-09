<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// User routes
Route::prefix('user')->group(
    function () {
        Route::post('/register', [UserController::class, 'store']);
    }
);
