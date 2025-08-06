<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Forms;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route for areas view without authentication
Route::get('/areas', Forms::class)->name('areas.view');
