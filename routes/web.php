<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('test');
})->name('dashboard');

Route::resource('players', \App\Http\Controllers\PlayerController::class);
Route::prefix('players/{player}/availabilities')
    ->name('players.availabilities.')
    ->controller(\App\Http\Controllers\PlayerAvailabilityController::class)
    ->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::delete('/{availability}', 'destroy')->name('destroy');
    });

Route::resource('courts', \App\Http\Controllers\CourtController::class);
Route::prefix('courts/{court}/availabilities')
    ->name('courts.availabilities.')
    ->controller(\App\Http\Controllers\CourtAvailabilityController::class)
    ->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::delete('/{availability}', 'destroy')->name('destroy');
    });

Route::prefix('schedules')
    ->name('schedules.')
    ->controller(\App\Http\Controllers\ScheduleController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('generate', 'generate')->name('generate');
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
