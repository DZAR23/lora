<?php

use App\Http\Controllers\ConductoreController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SendMessageController;
use App\Http\Controllers\MapaConductoresController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarifarioController;

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

        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
            
        Route::get('/send-message', [SendMessageController::class, 'create'])->name('messages.create');
        Route::post('/send-message', [SendMessageController::class, 'store'])->name('messages.store');

        Route::middleware(['auth:sanctum', 'verified'])->group(function () {
            Route::resource('tarifario', TarifarioController::class);
        });
    });
});
