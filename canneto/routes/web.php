<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use function Pest\Laravel\get;

// Rotte per Utenti loggati e non
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    } else {
        return view('cianuro-dev');
    }
});

// ROUTE PER LA WELCOME PAGE cianuro-dev
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::post('/check-answer', [UserController::class, 'checkAnswer'])->name('check.answer');


 // Route per Privacy Policy
 Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

// Route per Termini e Condizioni
Route::get('/termini&condizioni', function () {
    return view('termini&condizioni');
})->name('termini&condizioni');

// ROUTE PROTETTE DA JETSTREAM
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route Admin di filament che va a sostituire la Dashboard di jetstream
    Route::get('/dashboard', function () {
        return redirect('/admin');
    })->name('dashboard');

    // BLOCCARE LE RICHIESTE DI REGISTRAZIONE DI JEATSTREAM
    Route::get('/register', function () {
        return redirect('/dashboard');
    });
   
});