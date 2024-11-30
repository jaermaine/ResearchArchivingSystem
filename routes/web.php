<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\DashboardController; // Add this line to import the controller
use App\Http\Controllers\SessionController; // Add this line to import the controller
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\FacultyListController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DepartmentListController;


Route::get('/dashboard', [DashboardController::class, 'index']) // Update this line to use the controller
    ->middleware(['auth'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/debug-session', function () {
    Session::put('test', 'value');
    return Session::get('test');
});

Route::view('/', 'welcome')->name('home');

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

Route::post('logout', [SessionsController::class, 'destroy'])
    ->name('logout');

Route::get('/', [FacultyListController::class, 'fetchFaculties']);

//Route::get('/fetch-departments', [DepartmentListController::class, 'fetchDepartments']);

Route::post('/submit-document', [DocumentController::class, 'submit_document'])
->name('submit-document');

require __DIR__ . '/auth.php';
