<?php

use App\Http\Controllers\ConductoreController;
use App\Http\Controllers\MapaConductoresController;
use Illuminate\Support\Facades\Route;

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

    Route::resource('Conductore', ConductoreController::class);

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/mapa-conductores', [MapaConductoresController::class, 'index'])
            ->name('mapa-conductores.index');
    });
});
