<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('guest')->group(function () {
    Route::inertia('/', 'Home')->name('home');
    Route::inertia('/login', 'Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('admin/dashboard', function () {
        return Inertia::render('Backend/Dashboard');
    })->name('dashboard');
    Route::get('/admin/users', [UserController::class, 'index'])->name('users');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/admin/user/store', [UserController::class, 'store']);

});
