<?php

use App\Http\Controllers\CourtAvailabilityController;
use App\Http\Controllers\CourtController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PlayerAvailabilityController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ScheduleController;

Route::controller(GuestController::class)->group(function () {
    Route::get('/', 'openWelcomePage')->name('guest.welcome');
    Route::get('/roster', 'openRosterPage')->name('guest.roster');
    Route::get('/schedules', 'openSchedulesPage')->name('guest.schedules');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {
        // berlaku untuk admin & manager
        Route::resource('players', PlayerController::class)->only(['index', 'show']);

        Route::resource('courts', CourtController::class)->only(['index', 'show']);

        Route::prefix('schedules')
            ->name('schedules.')
            ->controller(ScheduleController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('generate', 'generate')->name('generate');
                Route::get('{schedule}/edit', 'edit')->name('edit');
                Route::put('{schedule}', 'update')->name('update');
                Route::delete('{schedule}', 'destroy')->name('destroy');
            });

        Route::get('dashboard', fn() => view('dashboard'))->name('dashboard');

        Route::middleware('role:admin')->group(function () {
            Route::resource('players', PlayerController::class)->except(['index', 'show']);
            Route::resource('players.availabilities', PlayerAvailabilityController::class)
                ->only(['store', 'create', 'destroy']);
            Route::resource('courts', CourtController::class)->except(['index', 'show']);
            Route::resource('courts.availabilities', CourtAvailabilityController::class)
                ->only(['store', 'create', 'destroy']);
        });
    });


require __DIR__ . '/auth.php';
