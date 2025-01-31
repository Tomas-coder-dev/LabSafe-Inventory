<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Redirigir la raíz de la aplicación a la página de login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', function () {
        return view('pages.inicio');
    })->name('inicio');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
