<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchivedController;
use App\Http\Controllers\DangerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PupilController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\NutritionalAssessmentController;
use App\Http\Controllers\StatusReportController;
use App\Http\Controllers\MasterListController;

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
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update'])->name('admin.admin.update');
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.admin.delete');

    //District
    Route::get('admin/constants/districts', [DangerController::class, 'districts'])->name('admin.constants.districts');
    Route::post('admin/constants/constants/district-add', [DangerController::class, 'insertDistrictArea'])->name('district.add');
    Route::get('admin/constants/district-edit/{id}', [DangerController::class, 'district_edit'])->name('admin.constants.district-edit');
    Route::post('admin/constants/district-edit/{id}', [DangerController::class, 'district_update'])->name('admin.constants.district-update');
    Route::get('admin/constants/district-delete/{id}', [DangerController::class, 'district_delete'])->name('admin.constants.district-delete');

    //School
    Route::get('admin/constants/schools', [DangerController::class, 'schools'])->name('admin.constants.schools');
    Route::post('admin/constants/constants/school-add', [DangerController::class, 'insertSchoolArea'])->name('school.add');
    Route::get('admin/constants/school-edit/{id}', [DangerController::class, 'school_edit'])->name('admin.constants.school-edit');
    Route::post('admin/constants/school-edit/{id}', [DangerController::class, 'school_update'])->name('admin.constants.school-update');
    Route::get('admin/constants/school-delete/{id}', [DangerController::class, 'school_delete'])->name('admin.constants.school-delete');

    //Classroom Tab
    Route::get('admin/constants/classroom', [ClassroomController::class, 'classroom'])->name('admin.constants.classroom');
    Route::post('admin/constants/classroom', [ClassroomController::class, 'insertClassroom'])->name('classroom.add');
    Route::get('admin/constants/classroom_edit/{id}', [ClassroomController::class, 'editClassroom'])->name('admin.constants.classroom_edit');
    Route::post('admin/constants/classroom_edit/{id}', [ClassroomController::class, 'updateClassroom'])->name('admin.constants.classroom_update');
    Route::get('admin/constants/classroom_delete/{id}', [ClassroomController::class, 'deleteClassroom'])->name('admin.constants.classroom-delete');

    //School Year Tab
    Route::get('admin/constants/school_year', [DangerController::class, 'schoolYear'])->name('admin.constants.school_year');
    Route::post('admin/constants/school_year/school_year_add', [DangerController::class, 'insertSchoolYear'])->name('school_year.add');
    Route::get('admin/constants/school_year_edit/{id}', [DangerController::class, 'schoolYearEdit'])->name('admin.constants.school_year_edit');
    Route::post('admin/constants/school_year_edit/{id}', [DangerController::class, 'schoolYearUpdate'])->name('admin.constants.school_year_update');
    Route::get('admin/constants/school_year_delete/{id}', [DangerController::class, 'schoolYearDelete'])->name('admin.constants.school_year_delete');

    // Archive Tab
    Route::get('admin/archives/accounts_archive', [ArchivedController::class, 'accountsArchive'])->name('admin.archives.accounts_archive');
    Route::get('admin/archives/recover/{id}', [ArchivedController::class, 'recover'])->name('admin.archives.recover');
    Route::get('admin/archives/schools_archive', [ArchivedController::class, 'schoolsArchive'])->name('admin.archives.schools_archive');
    Route::get('admin/archives/school_archive/{id}', [ArchivedController::class, 'schoolRecover'])->name('admin.archives.school_recover');
    Route::get('admin/archives/districts_archive', [ArchivedController::class, 'districtsArchive'])->name('admin.archives.districts_archive');
    Route::get('admin/archives/district_archive/{id}', [ArchivedController::class, 'districtRecover'])->name('admin.archives.district_recover');
    Route::get('admin/archives/classroom_archive', [ArchivedController::class, 'classroomArchive'])->name('admin.archives.classroom_archive');
    Route::get('admin/archives/classroom_recover/{id}', [ArchivedController::class, 'classroomRecover'])->name('admin.archives.classroom_recover');
    Route::get('admin/archives/school_year_archive', [ArchivedController::class, 'schoolYearArchive'])->name('admin.archives.school_year_archive');
    Route::get('admin/archives/school_year_archive/{id}', [ArchivedController::class, 'schoolYearRecover'])->name('admin.archives.school_year_recover');

    //Profile Settings Tab
    Route::get('admin/profile/settings', [ProfileController::class, 'settings'])->name('admin.profile.settings');
    Route::post('admin/profile/settings', [ProfileController::class, 'saveSettings'])->name('admin.profile.saveSettings');
    Route::post('admin/profile/update-details', [ProfileController::class, 'updateDetails'])->name('admin.profile.updateDetails');

    //History Tab
    Route::get('admin/histories/admin-histories', [HistoryController::class, 'adminHistory'])->name('admin.histories.admin-histories');
    Route::get('admin/histories/histories', [HistoryController::class, 'userAllHistory'])->name('admin.histories.histories');
});

// =========================== Medical Officer Middleware =====================
Route::group(['middleware' => 'medical_officer'], function(){
    Route::get('medical_officer/dashboard', [DashboardController::class, 'dashboard'])->name('medical_officer.dashboard');

    Route::get('medical_officer/profile/settings', [ProfileController::class, 'userSettings'])->name('medical_officer.profile.settings');
    Route::post('medical_officer/profile/settings', [ProfileController::class, 'userSaveSettings'])->name('medical_officer.profile.saveSettings');
    Route::post('medical_officer/profile/update-details', [ProfileController::class, 'userUpdateDetails'])->name('medical_officer.profile.updateDetails');

    //History Tab
    Route::get('medical_officer/histories/histories', [HistoryController::class, 'userHistory'])->name('medical_officer.histories.histories');
});

// =========================== School Nurse Middleware ========================
Route::group(['middleware' => 'school_nurse'], function(){
    Route::get('school_nurse/dashboard', [DashboardController::class, 'dashboard'])->name('school_nurse.dashboard');

    Route::get('school_nurse/school_nurse/cnsr', [StatusReportController::class, 'cnsr'])->name('school_nurse.school_nurse.cnsr');

    Route::get('school_nurse/profile/settings', [ProfileController::class, 'userSettings'])->name('school_nurse.profile.settings');
    Route::post('school_nurse/profile/settings', [ProfileController::class, 'userSaveSettings'])->name('school_nurse.profile.saveSettings');
    Route::post('school_nurse/profile/update-details', [ProfileController::class, 'userUpdateDetails'])->name('school_nurse.profile.updateDetails');

    //History Tab
    Route::get('school_nurse/histories/histories', [HistoryController::class, 'userHistory'])->name('school_nurse.histories.histories');
});

// =========================== Class Adviser Middleware ========================
Route::group(['middleware' => 'class_adviser'], function(){
    Route::get('class_adviser/dashboard', [DashboardController::class, 'dashboard'])->name('class_adviser.dashboard');

    //Pupil Tab
    Route::get('class_adviser/class_adviser/pupils', [PupilController::class, 'pupils'])->name('class_adviser.class_adviser.pupils');
    Route::post('class_adviser/class_adviser/pupils', [PupilController::class, 'insertPupils'])->name('pupils.add');
    Route::get('class_adviser/class_adviser/pupil_edit/{id}', [PupilController::class, 'editPupil'])->name('class_adviser.class_adviser.pupil_edit');
    Route::post('class_adviser/class_adviser/pupil_edit/{id}', [PupilController::class, 'updatePupil'])->name('class_adviser.class_adviser.pupil_update');
    Route::get('class_adviser/class_adviser/pupil_delete/{id}', [PupilController::class, 'deletePupil'])->name('class_adviser.class_adviser.pupil_delete');

    //Nutritional Assessment Tab
    Route::get('class_adviser/class_adviser/nutritional_assessment', [NutritionalAssessmentController::class, 'nutritionalAssessment'])->name('class_adviser.class_adviser.nutritional_assessment');
    Route::post('class_adviser/class_adviser/nutritional_assessment', [NutritionalAssessmentController::class, 'insertNA'])->name('class_adviser.class_adviser.nutritional_assessment.add');

    //MasterList Tab
    Route::get('class_adviser/class_adviser/masterlist', [MasterListController::class, 'masterList'])->name('class_adviser.class_adviser.masterlist');

    //Pupil2MasterList Tab
    Route::get('class_adviser/class_adviser/pupil_to_masterlist', [MasterListController::class, 'pupil_to_masterlist'])->name('class_adviser.class_adviser.pupil_to_masterlist');
    Route::post('class_adviser/class_adviser/pupil_to_masterlist/pupil_masterclass_add', [MasterListController::class, 'insertPupilToMasterList'])->name('class_adviser.class_adviser.pupil_to_masterlist.pupil_masterclass_add');

    //Profile
    Route::get('class_adviser/profile/settings', [ProfileController::class, 'userSettings'])->name('class_adviser.profile.settings');
    Route::post('class_adviser/profile/settings', [ProfileController::class, 'userSaveSettings'])->name('class_adviser.profile.saveSettings');
    Route::post('class_adviser/profile/update-details', [ProfileController::class, 'userUpdateDetails'])->name('class_adviser.profile.updateDetails');

    //History Tab
    Route::get('class_adviser/histories/histories', [HistoryController::class, 'userHistory'])->name('class_adviser.histories.histories');
});

