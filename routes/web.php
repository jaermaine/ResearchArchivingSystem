<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::view('faculty/dashboard', 'faculty.dashboard')
        ->middleware('role:faculty')
        ->name('faculty.dashboard');

    Route::view('student/dashboard', 'student.dashboard')
        ->middleware('role:student')
        ->name('student.dashboard');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/debug-session', function () {
    Session::put('test', 'value');
    return Session::get('test');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

require __DIR__.'/auth.php';