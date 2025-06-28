<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Protect route
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});


// show register form 
Route::get('/register_page', [UserController::class, 'register_page'])->name('register_page');

// handle register
Route::post('/register', [UserController::class, 'register'])->name('register');

// Show login form
Route::get('/login', [UserController::class, 'login_page'])->name('login');

// Handle login submission
Route::post('/login', [UserController::class, 'login'])->name('login.submit');

// handle logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout');



