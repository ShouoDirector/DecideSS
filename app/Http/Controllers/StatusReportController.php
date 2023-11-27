<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusReportModel;
use Illuminate\Support\Facades\Log;

class StatusReportController extends Controller
{

    public function cnsr(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Consolidated Nutritional Status Report",
                'headerTitle1' => "Setup CNSR",
                'headerMessage1' => "Warning: You are about to set up CNSR so advisers can submit their NSRs. 
                                    Please ensure that you understand the implications of this action, 
                                    as it may affect existing data and overall statistics. 
                                    Confirm only if you are certain about your decision.",
                'headerFilter1' => "Filter CNSRs",
                'headerTable1' => "CNSRs",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $statusReportModel = app(StatusReportModel::class);

            // Get records from the table
            $data['getRecord'] = $statusReportModel->getConsolidatedNutritionalStatusReport();

            if (empty($data['getRecord'])) {
                return abort(404);
            }

            return view('school_nurse.school_nurse.cnsr', compact('data', 'head'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
