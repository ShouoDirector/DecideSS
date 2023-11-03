<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $userType = Auth::user()->user_type;
        $headerTitle = $this->getHeaderTitle($userType);
        $viewPath = $this->getViewPath($userType);

        if ($headerTitle && $viewPath) {
            return view($viewPath, compact('headerTitle'));
        } else {
            abort(404);
        }
    }

    private function getHeaderTitle($userType)
    {
        return [
            '1' => 'Admin Dashboard',
            '2' => 'Medical Officer Dashboard',
            '3' => 'School Nurse Dashboard',
            '4' => 'Class Adviser Dashboard',
        ][$userType] ?? null;
    }

    private function getViewPath($userType)
    {
        return [
            '1' => 'admin.dashboard',
            '2' => 'medical_officer.dashboard',
            '3' => 'school_nurse.dashboard',
            '4' => 'class_adviser.dashboard',
        ][$userType] ?? null;
    }
}
