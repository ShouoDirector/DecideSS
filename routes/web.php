<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchivedController;
use App\Http\Controllers\DangerController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'Login'])->name('home');
Route::post('login', [AuthController::class, 'AuthLogin'])->name('login');
Route::get('logout', [AuthController::class, 'Logout'])->name('logout');
Route::get('forgot-password', [AuthController::class, 'ForgotPassword'])->name('password.forgot.form');
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword'])->name('password.forgot');
Route::get('reset/{token}', [AuthController::class, 'Reset'])->name('password.reset.form');
Route::post('reset/{token}', [AuthController::class, 'PostReset'])->name('password.reset');


// ==============================Middleware Group =================================

// =========================== Admin Middleware =============================
Route::group(['middleware' => 'admin'], function(){
    // Dashboard Tab
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Admin List Tab
    Route::get('admin/admin/list', [AdminController::class, 'list'])->name('admin.admin.list');
    Route::post('admin/admin/list', [AdminController::class, 'insert'])->name('admin.admin.insert');
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.admin.edit');
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.admin.delete');

    // Constants Tab
    Route::get('admin/constants/districts', [DangerController::class, 'districts'])->name('admin.constants.districts');
    Route::get('admin/constants/schools', [DangerController::class, 'schools'])->name('admin.constants.schools');
    Route::post('admin/constants/constants/district-add', [DangerController::class, 'insertDistrictArea'])->name('district.add');
    Route::post('admin/constants/constants/school-add', [DangerController::class, 'insertSchoolArea'])->name('school.add');
    Route::get('admin/constants/school-edit/{id}', [DangerController::class, 'school_edit'])->name('admin.constants.school-edit');
    Route::post('admin/constants/school-edit/{id}', [DangerController::class, 'school_update'])->name('admin.constants.school-update');
    Route::get('admin/constants/district-edit/{id}', [DangerController::class, 'district_edit'])->name('admin.constants.district-edit');
    Route::post('admin/constants/district-edit/{id}', [DangerController::class, 'district_update'])->name('admin.constants.district-update');
    Route::get('admin/constants/school-delete/{id}', [DangerController::class, 'school_delete'])->name('admin.constants.school-delete');
    Route::get('admin/constants/district-delete/{id}', [DangerController::class, 'district_delete'])->name('admin.constants.district-delete');

    // Archive Tab
    Route::get('admin/archives/accounts_archive', [ArchivedController::class, 'accountsArchive'])->name('admin.archives.accounts_archive');
    Route::get('admin/archives/recover/{id}', [ArchivedController::class, 'recover'])->name('admin.archives.recover');
    Route::get('admin/archives/schools_archive', [ArchivedController::class, 'schoolsArchive'])->name('admin.archives.schools_archive');
    Route::get('admin/archives/school_archive/{id}', [ArchivedController::class, 'schoolRecover'])->name('admin.archives.school_recover');
    Route::get('admin/archives/district_archive', [ArchivedController::class, 'districtsArchive'])->name('admin.archives.districts_archive');
    Route::get('admin/archives/district_archive/{id}', [ArchivedController::class, 'districtRecover'])->name('admin.archives.district_recover');

    //Profile Settings Tab
    Route::get('admin/profile/settings', [ProfileController::class, 'settings'])->name('admin.profile.settings');
    Route::post('admin/profile/settings', [ProfileController::class, 'saveSettings'])->name('admin.profile.saveSettings');
    Route::post('admin/profile/update-details', [ProfileController::class, 'updateDetails'])->name('admin.profile.updateDetails');
});

// =========================== Medical Officer Middleware =====================
Route::group(['middleware' => 'medical_officer'], function(){
    Route::get('medical_officer/dashboard', [DashboardController::class, 'dashboard'])->name('medical_officer.dashboard');
});

// =========================== School Nurse Middleware ========================
Route::group(['middleware' => 'school_nurse'], function(){
    Route::get('school_nurse/dashboard', [DashboardController::class, 'dashboard'])->name('school_nurse.dashboard');
});

// =========================== Class Adviser Middleware ========================
Route::group(['middleware' => 'class_adviser'], function(){
    Route::get('class_adviser/dashboard', [DashboardController::class, 'dashboard'])->name('class_adviser.dashboard');
});

