<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Protect route
Route::middleware('auth')->group(function () {
    // dashboard 
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    // show mood list 
    Route::get('/mood/list', [MoodController::class, 'mood_list'])->name('mood.list');
    // add new mood 
    Route::post('/mood/store', [MoodController::class, 'mood_store'])->name('mood.store');
    // mood soft delete 
    Route::post('/mood/destroy', [MoodController::class, 'mood_destroy'])->name('mood.destroy');
    // mood update
    Route::post('/mood/update', [MoodController::class, 'mood_update'])->name('mood.update');
    // trushed mood list 
    Route::get('/mood/trashed', [MoodController::class, 'mood_trashed'])->name('mood.trashed');
    // restore single mood
    Route::get('/mood/restore/{id}', [MoodController::class, 'mood_restore'])->name('mood.restore');
    // mood hard delete
    Route::post('/mood/hardDelete', [MoodController::class, 'mood_hardDelete'])->name('mood.hardDelete');
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



