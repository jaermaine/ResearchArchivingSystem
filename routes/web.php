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
use App\Http\Controllers\UserController;
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

Route::get('/welcome', function (){
    Session::forget('selectedCategory');
    return view('welcome');
}
)->name('welcome');

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

Route::get('/admin-dashboard', [AdminController::class, 'fetchStudents'])->name('admin-dashboard');

Route::put('/admin/edit/{id}', action: [DocumentStatusController::class, 'admin_edit'])->name('admin-edit');
Route::delete('/admin/delete/{id}', action: [DocumentStatusController::class, 'admin_delete'])->name('admin-delete');
Route::put('/update-student', [DocumentStudentController::class, 'updateStudent'])->name('update-student');
Route::put('/update-adviser', [DocumentStudentController::class, 'updateAdviser'])->name('update-adviser');
Route::get('/filter-programs', [DocumentStudentController::class, 'filterProgram'])->name('filter-programs');

Route::post('/colleges/add', [DocumentStudentController::class, 'storeCollege'])->name('add-college');
Route::put('/colleges/update', [DocumentStudentController::class, 'updateCollege'])->name('update-college');
Route::delete('/colleges/{id}/delete', [DocumentStudentController::class, 'destroyCollege'])->name('delete-college');

Route::post('/programs/add', [DocumentStudentController::class, 'storeProgram'])->name('add-program');
Route::put('/programs/update', [DocumentStudentController::class, 'updateProgram'])->name('update-program');
Route::delete('/programs/{id}/delete', [DocumentStudentController::class, 'destroyProgram'])->name('delete-program');

Route::post('/students/add', [DocumentStudentController::class, 'storeStudent'])->name('add-student');
Route::delete('/students/{id}/delete', [DocumentStudentController::class, 'destroyStudent'])->name('delete-student');

Route::post('/advisers/add', [DocumentStudentController::class, 'storeAdviser'])->name('add-adviser');
Route::delete('/advisers/{id}/delete', [DocumentStudentController::class, 'destroyAdviser'])->name('delete-adviser');

Route::get('settings/edit-academic', [SettingsController::class, 'edit_academic'])->name('edit_academic');
Route::post('settings/update-academic', [SettingsController::class, 'update_academic'])->name('update_academic');
Route::get('settings/back', [SettingsController::class, 'back'])->name('back');

Route::get('settings/edit-profile', [SettingsController::class, 'edit_profile'])->name('edit_profile');
Route::post('settings/update-profile', [SettingsController::class, 'update_profile'])->name('update_profile');

Route::get('settings/edit-password', [SettingsController::class, 'edit_password'])->name('edit_password');
Route::post('settings/update-password', [SettingsController::class, 'update_password'])->name('update_password');

require __DIR__ . '/auth.php';
