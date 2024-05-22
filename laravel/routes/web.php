<?php

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('schedule')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('schedule.index');
        Route::get('/schedule', [ScheduleController::class, 'getSchedule']);
        Route::get('/create', [ScheduleController::class, 'create'])->name('schedule.create');
        Route::post('/', [ScheduleController::class, 'store'])->name('schedule.store');
        Route::get('/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
        Route::put('/{schedule}', [ScheduleController::class, 'update'])->name('schedule.update');
        Route::delete('/{schedule}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
    });

    Route::middleware('auth')->group(function () {
        Route::prefix('agendas')->group(function () {
            Route::get('/', [AgendaController::class, 'index'])->name('agendas.index');
            Route::get('/create', [AgendaController::class, 'create'])->name('agendas.create');
            Route::post('/', [AgendaController::class, 'store'])->name('agendas.store');
            Route::get('/{agenda}/edit', [AgendaController::class, 'edit'])->name('agendas.edit');
        });
    });
    
});

Route::get('/register-psicologa', [RegisteredUserController::class, 'createPsicologa'])->name('register.psicologa');
Route::post('/register-psicologa', [RegisteredUserController::class, 'store'])->name('register.psicologa.store');

require __DIR__.'/auth.php';

