<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\DashboardController; // Add this line to import the controller

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']) // Update this line to use the controller
        ->middleware(['auth'])
        ->name('dashboard');

    Route::view('faculty/dashboard', 'faculty.dashboard')
        ->middleware('role:faculty')
        ->name('faculty-dashboard');

    Route::view('student/dashboard', 'student.dashboard')
        ->middleware('role:student')
        ->name('student-dashboard');
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

Route::view('/login', 'pages.auth.login')->name('login');

require __DIR__.'/auth.php';