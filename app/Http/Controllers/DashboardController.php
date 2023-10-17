<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        if(Auth::user()->user_type == 1){
            $head['headerTitle'] = "Admin Dashboard";
            return view('admin.dashboard', compact('head'));
        }
        else if(Auth::user()->user_type == 2){
            $head['headerTitle'] = "Medical Officer Dashboard";
            return view('medical_officer.dashboard', compact('head'));
        }
        else if(Auth::user()->user_type == 3){
            $head['headerTitle'] = "School Nurse Dashboard";
            return view('school_nurse.dashboard', compact('head'));
        }
        else if(Auth::user()->user_type == 4){
            $head['headerTitle'] = "Class Adviser Dashboard";
            return view('class_adviser.dashboard', compact('head'));
        }
    }
}
