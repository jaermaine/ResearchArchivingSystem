<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdviserListController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DepartmentListController;
use App\Http\Controllers\DocumentStudentController;
use App\Livewire\DocumentStatusController;
use App\Http\Controllers\SearchDocumentsController;
use App\Http\Controllers\DocumentInformationPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminController;

Route::get('/profile', [ProfileController::class, 'show'])->name('profile');


Route::get('/search-documents', [SearchDocumentsController::class, 'search_document'])->name('search.documents');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DocumentStudentController::class, 'setTable'])->name('adviser-dashboard');
    Route::get('/documents/download/{id}', [DocumentStatusController::class, 'download'])->name('download-document');
    Route::get('/documents/approve/{id}', [DocumentStatusController::class, 'approve'])->name('approve-documents');
    Route::get('/documents/reject/{id}', [DocumentStatusController::class, 'reject'])->name('reject-documents');
    Route::get('/documents/edit/{id}', [DocumentStatusController::class, 'edit'])->name('edit-documents');
});

Route::get('/search-document/{search_input?}', [SearchDocumentsController::class, 'search_document'])->name('search-document');

Route::get('document/info/{id?}', [SearchDocumentsController::class, 'document_info'])->name('document-info');

Route::view('/', 'welcome')->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/debug-session', function () {
    Session::put('test', 'value');
    return Session::get('test');
});

Route::view('/login', 'pages.auth.login')->name('login');

Route::post('logout', [SessionsController::class, 'destroy'])
    ->name('logout');

Route::post('/submit-document', [DocumentController::class, 'submit_document'])->name('submit-document');

Route::get('/settings', function () {
    return view('layouts.settings');
})->name('settings');

Route::post('/settings/update', [SettingsController::class, 'updateSettings'])->name('settings.updateSettings');

Route::post('/settings/update-password', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword');

Route::post('/settings/add-contact', [SettingsController::class, 'addContact'])->name('settings.addContact');

Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

Route::post('/settings/update-name', [SettingsController::class, 'updateName'])->name('settings.updateName');

Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::post('/settings/update-profile-picture', [SettingsController::class, 'updateProfilePicture'])->name('settings.updateProfilePicture');

Route::get('/admin', [AdminController::class, 'setTableForAdmin'])->name('admin.dashboard');

Route::put('/admin/edit/{id}', action: [DocumentStatusController::class, 'admin_edit'])->name('admin-edit');

Route::delete('/admin/delete/{id}', action: [DocumentStatusController::class, 'admin_delete'])->name('admin-delete');

require __DIR__ . '/auth.php';
