<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminHistoryModel;
use Illuminate\Support\Facades\Log;

class HistoryController extends Controller
{
    /**
     * Display the constants view with necessary data.
     *
     * @return \Illuminate\View\View
     */
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
}
