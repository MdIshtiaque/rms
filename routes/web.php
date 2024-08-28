<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::inertia('/', 'Home')->name('home');
    Route::inertia('/login', 'Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::inertia('admin/dashboard', 'Backend/Dashboard')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout']);
});
