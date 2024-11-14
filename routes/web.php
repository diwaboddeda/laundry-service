<?php
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', \App\Http\Livewire\Dashboard::class);
    Route::get('/services', \App\Http\Livewire\Services::class);  // Make sure this exists as a Livewire component
    Route::get('/transactions', \App\Http\Livewire\Transactions::class);
    Route::get('/progress', \App\Http\Livewire\Progress::class);
    Route::get('/payments', \App\Http\Livewire\Payments::class);
});

// Admin-only routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/employees', \App\Http\Livewire\Employees::class);
});
