<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home');

Route::inertia('/login', 'Login');

Route::inertia('admin/dashboard', 'Backend/Dashboard');
