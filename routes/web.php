<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

Route::controller(GuestController::class)->group(function () {
    Route::get('/', 'openWelcomePage')->name('guest.welcome');
    Route::get('/roster', 'openRosterPage')->name('guest.roster');
    Route::get('/schedules', 'openSchedulesPage')->name('guest.schedules');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified', 'role:admin'])
    ->group(function () {
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
        })->name('dashboard');
    });

require __DIR__.'/auth.php';
