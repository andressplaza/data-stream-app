<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Mantén la ruta existente  
Route::get('/', function () {
    return view('welcome');
});

// Agregar rutas de autenticación  
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/user'); // Redirigir al panel de usuario  
    }
    return redirect('/user/login'); // Redirigir al login del panel de usuario  
})->name('login');

Route::get('/register', function () {
    return redirect('/user/register'); // Redirigir al registro del panel de usuario  
})->name('register');
