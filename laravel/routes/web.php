<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\FichaController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AgendaController;

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Mail\MyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return Inertia::render('LandingPage');
});

Route::post('/api/contact', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    $name = $request->input('name');
    $email = $request->input('email');
    $messageContent = $request->input('message');

    Mail::to('contato@clinicasaude.com')->send(new MyEmail($name, $email, $messageContent));

    return response()->json(['message' => 'Email sent successfully!']);
});

Route::get('/login', function () {
    return Inertia::render('Login'); // Substitua pelo componente correto para esta rota
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
        Route::get('/schedule', [ScheduleController::class, 'getSchedule'])->name('getSchedule');
        Route::get('/create', [ScheduleController::class, 'create'])->name('schedule.create');
        Route::post('/', [ScheduleController::class, 'store'])->name('schedule.store');
        Route::get('/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
        Route::delete('/{schedule}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
        Route::post('/update/{schedule_id}', [ScheduleController::class, 'update'])->name('schedule.update');
        Route::get('/schedulePaciente', [ScheduleController::class, 'pacient_schedule'])->name('schedule.paciente');

    });

    Route::get('/psicologa', [PsicologaController::class, 'index']);

    Route::prefix('agendas')->group(function () {
        Route::get('/', [AgendaController::class, 'index'])->name('agendas.index');
        Route::get('/agendas/psicologa', [AgendaController::class, 'getPsicologa']);
        Route::get('/agendas', [AgendaController::class, 'teste']);
        Route::get('/create', [AgendaController::class, 'create'])->name('agendas.create');
        Route::post('/', [AgendaController::class, 'store'])->name('agendas.store');
        Route::get('/{agenda}/edit', [AgendaController::class, 'edit'])->name('agendas.edit');
        Route::patch('/{agenda}/marcar-ocupado', [AgendaController::class, 'marcarOcupado'])->name('agendas.marcar-ocupado');
    });
});

Route::get('/register-psicologa', [RegisteredUserController::class, 'createPsicologa'])->name('register.psicologa');
Route::post('/register-psicologa', [RegisteredUserController::class, 'store'])->name('register.psicologa.store');

// Ficha pacientes
Route::get('/pacientes', [FichaController::class, 'index'])->name('pacientes');
Route::get('/ficha', [FichaController::class, 'ficha'])->name('ficha');
Route::post('/attFicha', [FichaController::class, 'attFicha'])->name('atualizarFicha');



require __DIR__.'/auth.php';
