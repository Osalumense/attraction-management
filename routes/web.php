<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttractionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->group(function () {
    // Route::get('/register', 'showRegistrationForm')->name('register.form');
    // Route::post('/register', 'register')->name('register');
    
    Route::get('/', 'showLoginForm')->name('home');
    Route::get('/login', 'showLoginForm')->name('login.form');
    Route::post('/login', 'login')->name('login');
    
    Route::post('/logout', 'logout')->name('logout');
});

Route::prefix('attraction')->controller(AttractionsController::class)->group(function () {
    // Admin-only routes
    Route::middleware(['auth', 'roles:admin'])->group(function () {
        Route::get('/create', 'create')->name('attractions.create');
        Route::post('/', 'store')->name('attractions.store');
        Route::get('/{attraction}/edit', 'edit')->name('attractions.edit');
        Route::put('/{attraction}', 'update')->name('attractions.update');
        Route::delete('/{attraction}', 'destroy')->name('attractions.destroy');
    });

    // Public routes (authenticated users)
    Route::middleware(['auth'])->group(function () {
        Route::get('/', 'index')->name('attractions.index');
        Route::get('/{attraction}', 'show')->name('attractions.show');
    });
    
});


