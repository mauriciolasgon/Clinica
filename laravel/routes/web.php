<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Mail\MyEmail;

Route::get('/', function () {
    
    return Inertia::render('LandingPage');

});


Route::get('/testroute', function (){
    $name = "Gabriel";

    Mail::to('gabrieltlopes22@gmail.com') -> send(new MyEmail($name));
    return 'Email sent!';
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
});

require __DIR__.'/auth.php';
