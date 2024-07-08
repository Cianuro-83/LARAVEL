<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    } else {
        return view('cianuro-dev');
    }
});

 // Route per Privacy Policy
 Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

// Route per Termini e Condizioni
Route::get('/termini&condizioni', function () {
    return view('termini&condizioni');
})->name('termini&condizioni');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // BLOCCARE LE RICHIESTE DI REGISTRAZIONE
    Route::get('/register', function () {
        return redirect('/dashboard');
    });
   
});