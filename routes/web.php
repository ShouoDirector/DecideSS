<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
;

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

Route::get('/', [AuthController::class, 'Login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'Logout']);
Route::get('forgot-password', [AuthController::class, 'ForgotPassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'Reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);




// ==============================Middleware Group =================================<||||||||||||||
//
//===========================Admin Middleware===================
    Route::group(['middleware' => 'admin'], function(){
        Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
        Route::get('admin/admin/list', [AdminController::class, 'list']);
        Route::post('admin/admin/list', [AdminController::class, 'insert']);
    });

//===========================Medical Officer Middleware=========
    Route::group(['middleware' => 'medical_officer'], function(){
        Route::get('medical_officer/dashboard', [DashboardController::class, 'dashboard']);
    });

//===========================School Nurse Middleware============
    Route::group(['middleware' => 'school_nurse'], function(){
        Route::get('school_nurse/dashboard', [DashboardController::class, 'dashboard']);
    });

//===========================Class Adviser Middleware===========
    Route::group(['middleware' => 'class_adviser'], function(){
        Route::get('class_adviser/dashboard', [DashboardController::class, 'dashboard']);
    });
