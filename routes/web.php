<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\FacultyListController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DepartmentListController;
use App\Http\Controllers\DocumentStudentController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DocumentStudentController::class, 'setTable'])->name('faculty-dashboard');
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

Route::post('/submit-document', [DocumentController::class, 'submit_document'])->name('submit-document');

require __DIR__ . '/auth.php';
