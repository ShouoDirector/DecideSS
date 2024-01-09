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
use App\Models\MasterListModel;

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

    //Sections
    Route::get('admin/constants/sections', [DangerController::class, 'sections'])->name('admin.constants.sections');
    Route::post('admin/constants/sections/sections-add', [DangerController::class, 'insertSectionArea'])->name('sections.add');
    Route::get('admin/constants/manage_sections', [DangerController::class, 'manageSections'])->name('admin.constants.manage_sections');
    Route::get('admin/constants/section_edit/{id}', [DangerController::class, 'section_edit'])->name('admin.constants.section_edit');
    Route::post('admin/constants/section_edit/{id}', [DangerController::class, 'section_update'])->name('admin.constants.section_update');
    Route::get('admin/constants/section_delete/{id}', [DangerController::class, 'section_delete'])->name('admin.constants.section_delete');

    //Classroom Tab
    Route::get('admin/constants/classroom', [ClassroomController::class, 'classroom'])->name('admin.constants.classroom');
    Route::post('admin/constants/classroom', [ClassroomController::class, 'insertClassroom'])->name('classroom.add');
    Route::get('admin/constants/classroom_edit/{id}', [ClassroomController::class, 'editClassroom'])->name('admin.constants.classroom_edit');
    Route::post('admin/constants/classroom_edit/{id}', [ClassroomController::class, 'updateClassroom'])->name('admin.constants.classroom_update');
    Route::get('admin/constants/classroom_delete/{id}', [ClassroomController::class, 'deleteClassroom'])->name('admin.constants.classroom-delete');

    //Class Assign
    Route::get('admin/constants/class_assignment', [DangerController::class, 'classAssign'])->name('admin.constants.class_assignment');
    Route::post('admin/constants/class_assignment', [DangerController::class, 'insertClassAssignment'])->name('assign_ca.add');

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
    Route::get('admin/archives/sections_archive', [ArchivedController::class, 'sectionsArchive'])->name('admin.archives.sections_archive');
    Route::get('admin/archives/section_archive/{id}', [ArchivedController::class, 'sectionRecover'])->name('admin.archives.section_recover');

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

    Route::get('medical_officer/medical_officer_dashboard', [DashboardController::class, 'medicalOfficerDashboard'])->name('medical_officer.medical_officer_dashboard');

    Route::get('medical_officer/medical_officer/cnsr_main', [StatusReportController::class, 'cnsrMain'])->name('medical_officer.medical_officer.cnsr_main');
    Route::get('medical_officer/medical_officer/healthcare', [StatusReportController::class, 'healthCare'])->name('medical_officer.medical_officer.healthcare');
    Route::get('medical_officer/medical_officer/schools', [StatusReportController::class, 'schools'])->name('medical_officer.medical_officer.schools');
    Route::get('medical_officer/medical_officer/view_healthcare', [StatusReportController::class, 'viewHealthCare'])->name('medical_officer.medical_officer.view_healthcare');

    Route::post('medical_officer/medical_officer/cnsr_to_consolidate', [StatusReportController::class, 'insertCNSR'])->name('cnsr.add');

    Route::get('medical_officer/medical_officer/consolidatedCNSR', [StatusReportController::class, 'consolidatedCNSR'])->name('medical_officer.medical_officer.consolidatedCNSR');
    Route::get('medical_officer/medical_officer/consolidatedCNSRByGrade', [StatusReportController::class, 'consolidatedCNSRByGrade'])->name('medical_officer.medical_officer.consolidatedCNSRByGrade');

    Route::get('medical_officer/profile/settings', [ProfileController::class, 'userSettings'])->name('medical_officer.profile.settings');
    Route::post('medical_officer/profile/settings', [ProfileController::class, 'userSaveSettings'])->name('medical_officer.profile.saveSettings');
    Route::post('medical_officer/profile/update-details', [ProfileController::class, 'userUpdateDetails'])->name('medical_officer.profile.updateDetails');

    Route::get('medical_officer/medical_officer/search_pupil', [MasterListController::class, 'searchPupilByMedicalOfficer'])->name('medical_officer.medical_officer.search_pupil');

});

// =========================== School Nurse Middleware ========================
Route::group(['middleware' => 'school_nurse'], function(){
    Route::get('school_nurse/dashboard', [DashboardController::class, 'dashboard'])->name('school_nurse.dashboard');

    Route::get('school_nurse/school_nurse_dashboard', [DashboardController::class, 'schoolNurseDashboard'])->name('school_nurse.school_nurse_dashboard');

    Route::get('school_nurse/school_nurse/cnsr', [StatusReportController::class, 'cnsr'])->name('school_nurse.school_nurse.cnsr');
    Route::get('school_nurse/school_nurse/cnsr_fragment', [StatusReportController::class, 'cnsrFragment'])->name('school_nurse.school_nurse.cnsr_fragment');
    
    Route::post('school_nurse/school_nurse/nsr_to_consolidate', [StatusReportController::class, 'insertNSR'])->name('nsr.add');

    Route::get('school_nurse/school_nurse/consolidated', [StatusReportController::class, 'consolidatedNSR'])->name('school_nurse.school_nurse.consolidated');

    Route::get('school_nurse/school_nurse/list_of_masterlist', [StatusReportController::class, 'listOfMasterlists'])->name('school_nurse.school_nurse.list_of_masterlist');
    Route::get('school_nurse/school_nurse/view_a_masterlist', [StatusReportController::class, 'viewAMasterList'])->name('school_nurse.school_nurse.view_a_masterlist');

    Route::get('school_nurse/school_nurse/list_of_beneficiaries', [StatusReportController::class, 'listOfBeneficiaries'])->name('school_nurse.school_nurse.list_of_beneficiaries');
    Route::get('school_nurse/school_nurse/final_list_of_beneficiaries', [StatusReportController::class, 'finalListOfBeneficiaries'])->name('school_nurse.school_nurse.final_list_of_beneficiaries');
    Route::get('school_nurse/school_nurse/final_list_of_beneficiaries_program', [StatusReportController::class, 'finalListOfBeneficiariesProgram'])->name('school_nurse.school_nurse.final_list_of_beneficiaries_program');

    Route::get('school_nurse/school_nurse/healthcare_services_report', [StatusReportController::class, 'healthcareServicesReport'])->name('school_nurse.school_nurse.healthcare_services_report');
    Route::get('school_nurse/school_nurse/malnutrition_report', [StatusReportController::class, 'malnutritionReport'])->name('school_nurse.school_nurse.malnutrition_report');

    Route::get('school_nurse/school_nurse/enlist_new', [StatusReportController::class, 'enlistNew'])->name('school_nurse.school_nurse.enlist_new');
    Route::post('school_nurse/school_nurse/enlist_new', [StatusReportController::class, 'enlistNewPost'])->name('enlist_new.add');

    Route::get('school_nurse/profile/settings', [ProfileController::class, 'userSettings'])->name('school_nurse.profile.settings');
    Route::post('school_nurse/profile/settings', [ProfileController::class, 'userSaveSettings'])->name('school_nurse.profile.saveSettings');
    Route::post('school_nurse/profile/update-details', [ProfileController::class, 'userUpdateDetails'])->name('school_nurse.profile.updateDetails');

    Route::get('school_nurse/school_nurse/referrals', [MasterListController::class, 'schoolNurseReferrals'])->name('school_nurse.school_nurse.referrals');
    Route::get('school_nurse/school_nurse/referral_delete/{id}', [MasterListController::class, 'deleteReferral'])->name('school_nurse.school_nurse.referral_delete');

    Route::get('school_nurse/school_nurse/referrals_archive', [MasterListController::class, 'referralsArchive'])->name('school_nurse.school_nurse.referrals_archive');
    Route::get('school_nurse/school_nurse/referrals_archive/{id}', [MasterListController::class, 'recoverReferral'])->name('school_nurse.school_nurse.referrals_recover');

    //Search Pupil
    Route::get('school_nurse/school_nurse/search_pupil', [MasterListController::class, 'searchPupil'])->name('school_nurse.school_nurse.search_pupil');
});

// =========================== Class Adviser Middleware ========================
Route::group(['middleware' => 'class_adviser'], function(){
    Route::get('class_adviser/dashboard', [DashboardController::class, 'dashboard'])->name('class_adviser.dashboard');

    Route::get('class_adviser/class_adviser_dashboard', [DashboardController::class, 'classAdviserDashboard'])->name('class_adviser.class_adviser_dashboard');

    //Pupil Tab
    Route::get('class_adviser/class_adviser/pupils', [PupilController::class, 'pupils'])->name('class_adviser.class_adviser.pupils');
    Route::get('class_adviser/class_adviser/pupils_records', [PupilController::class, 'pupilsRecords'])->name('class_adviser.class_adviser.pupils_records');
    Route::post('class_adviser/class_adviser/pupils', [PupilController::class, 'insertPupils'])->name('pupils.add');
    Route::get('class_adviser/class_adviser/pupil_edit/{id}', [PupilController::class, 'editPupil'])->name('class_adviser.class_adviser.pupil_edit');
    Route::post('class_adviser/class_adviser/pupil_edit/{id}', [PupilController::class, 'updatePupil'])->name('class_adviser.class_adviser.pupil_update');
    Route::get('class_adviser/class_adviser/pupil_delete/{id}', [PupilController::class, 'deletePupil'])->name('class_adviser.class_adviser.pupil_delete');

    //Nutritional Assessment Tab
    Route::get('class_adviser/class_adviser/nutritional_assessment', [NutritionalAssessmentController::class, 'nutritionalAssessment'])->name('class_adviser.class_adviser.nutritional_assessment');
    Route::post('class_adviser/class_adviser/nutritional_assessment', [NutritionalAssessmentController::class, 'insertNA'])->name('class_adviser.class_adviser.nutritional_assessment.add');
    Route::get('class_adviser/class_adviser/edit_na', [MasterListController::class, 'editNA'])->name('class_adviser.class_adviser.edit_na');
    Route::get('class_adviser/class_adviser/na_page/{id}', [MasterListController::class, 'updateNA'])->name('class_adviser.class_adviser.na_page');
    Route::post('class_adviser/class_adviser/na_page/{id}', [MasterListController::class, 'updateActionNA'])->name('class_adviser.class_adviser.na_page_update');

    //MasterList Tab
    Route::get('class_adviser/class_adviser/masterlist', [MasterListController::class, 'masterList'])->name('class_adviser.class_adviser.masterlist');
    Route::get('class_adviser/class_adviser/view_masterlist', [MasterListController::class, 'viewMasterlist'])->name('class_adviser.class_adviser.view_masterlist');

    //Pupil2MasterList Tab
    Route::get('class_adviser/class_adviser/pupil_to_masterlist', [MasterListController::class, 'pupil_to_masterlist'])->name('class_adviser.class_adviser.pupil_to_masterlist');
    Route::post('class_adviser/class_adviser/pupil_to_masterlist/pupil_masterclass_add', [MasterListController::class, 'insertPupilToMasterList'])->name('class_adviser.class_adviser.pupil_to_masterlist.pupil_masterclass_add');

    //Add Referral
    Route::get('class_adviser/class_adviser/referrals', [MasterListController::class, 'referrals'])->name('class_adviser.class_adviser.referrals');
    Route::post('class_adviser/class_adviser/referrals/add', [MasterListController::class, 'insertReferral'])->name('class_adviser.class_adviser.referrals.add');
    Route::get('class_adviser/class_adviser/referrals_list', [MasterListController::class, 'referralsList'])->name('class_adviser.class_adviser.referrals_list');

    //Approve Report
    Route::get('class_adviser/class_adviser/report_approval', [MasterListController::class, 'reportApproval'])->name('class_adviser.class_adviser.report_approval');
    Route::post('class_adviser/class_adviser/report_approval', [MasterListController::class, 'insertReport'])->name('report.add');
    Route::get('class_adviser/class_adviser/report_list', [MasterListController::class, 'reportList'])->name('class_adviser.class_adviser.report_list');
    Route::get('class_adviser/class_adviser/approved_report', [MasterListController::class, 'approvedReport'])->name('class_adviser.class_adviser.approved_report');
    Route::get('class_adviser/class_adviser/view_nsr', [MasterListController::class, 'viewNSR'])->name('class_adviser.class_adviser.view_nsr');

    //Search Pupil
    Route::get('class_adviser/class_adviser/search_pupil', [MasterListController::class, 'searchPupilByClassAdviser'])->name('class_adviser.class_adviser.search_pupil');

    //Profile
    Route::get('class_adviser/profile/settings', [ProfileController::class, 'userSettings'])->name('class_adviser.profile.settings');
    Route::post('class_adviser/profile/settings', [ProfileController::class, 'userSaveSettings'])->name('class_adviser.profile.saveSettings');
    Route::post('class_adviser/profile/update-details', [ProfileController::class, 'userUpdateDetails'])->name('class_adviser.profile.updateDetails');
});

