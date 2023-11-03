<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PupilModel;
use Illuminate\Support\Facades\Log;


class PupilController extends Controller
{
    /**
     * Display the constants view with necessary data.
     *
     * @return \Illuminate\View\View
     */
    public function pupils(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Pupils",
                'headerTitle1' => "Add Pupil",
                'headerMessage1' => "Warning: You are about to add a pupil. 
                                    Please ensure that you understand the implications of this action, 
                                    as it may affect existing data and overall statistics. 
                                    Confirm only if you are certain about your decision.",
                'headerFilter1' => "Filter Pupils",
                'headerTable1' => "Pupils",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $pupilModel = app(PupilModel::class);

            // Get records from the users table
            $data['getRecord'] = $pupilModel->getPupilRecords();
            
            // Get lists of medical officers from users table
            $dataMedicalOfficer['getList'] = $pupilModel->getPupils();

            if (empty($data['getRecord'])) {
                return abort(404);
            }

            return view('admin.constants.districts', 
                compact('data', 'head', 'dataMedicalOfficer', 'dataDistrictModel_MedicalOfficer'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
