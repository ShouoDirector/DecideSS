<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        if(Auth::user()->user_type == 1){
            $head['header_title'] = "Admin Dashboard";
            return view('admin.dashboard', compact('head'));
        }
        else if(Auth::user()->user_type == 2){
            $head['header_title'] = "Medical Officer Dashboard";
            return view('medical_officer.dashboard', compact('head'));
        }
        else if(Auth::user()->user_type == 3){
            $head['header_title'] = "School Nurse Dashboard";
            return view('school_nurse.dashboard', compact('head'));
        }
        else if(Auth::user()->user_type == 4){
            $head['header_title'] = "Class Adviser Dashboard";
            return view('class_adviser.dashboard', compact('head'));
        }
    }
}
