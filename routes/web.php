<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Forms;
use App\Livewire\ApegoEticoStatistics;

Route::get('/', function () {
    return view('home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/apego-etico-statistics', ApegoEticoStatistics::class)->name('apego-etico-statistics');
});

// Route for areas view without authentication
Route::get('/forms', Forms::class)->name('forms.view');