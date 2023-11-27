<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminHistoryModel;
use App\Models\UserHistoryModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HistoryController extends Controller{

    public function adminHistory(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Admin Logs",
                'headerFilter' => "Filter Admin Log",
            ];

            // Use dependency injection to create instances
            $historyModel = app(AdminHistoryModel::class);

            // Get records from the users table
            $data['getAdminHistory'] = $historyModel->getAdminHistories();

            return view('admin.histories.admin-histories', 
                compact('data', 'head'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function userHistory(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Logs",
                'headerFilter' => "Filter Admin Log",
            ];

            $currentUser = Auth::user()->user_type;

            $role = '';

            // Map user types to roles
            $rolesMapping = [
                2 => 'medical_officer',
                3 => 'school_nurse',
                4 => 'class_adviser'
            ];

            // Validate if the user type is in the mapping
            if (array_key_exists($currentUser, $rolesMapping)) {
                $role = $rolesMapping[$currentUser];
            } else {
                abort(404, 'Page not found');
            }

            // Use dependency injection to create instances
            $historyModel = app(UserHistoryModel::class);

            // Get records from the users table
            $data['getUserHistory'] = $historyModel->getUserHistories();

            return view($role . '.histories.histories', compact('data', 'head'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function userAllHistory()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "User Logs",
                'headerFilter' => "Filter User Log",
            ];

            $currentUser = Auth::user()->user_type;
            $userModel = app(User::class);

            // Validate if the user type is in the mapping
            if ($currentUser != '1') {
                abort(404, 'Page not found');
            }

            // Use dependency injection to create instances
            $historyModel = app(UserHistoryModel::class);

            $dataUsers['getList'] = $userModel->getUserRecords();

            // Get records from the users table with user names
            $data['getUserHistory'] = $historyModel->getAllUserHistories();

            $userNames = collect($dataUsers['getList'])->pluck('name', 'id')->toArray();

            $userUniqueId = collect($dataUsers['getList'])->pluck('unique_id', 'id')->toArray();

            return view('admin.histories.histories', compact('data', 'head', 'userNames', 'userUniqueId'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
