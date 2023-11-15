<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NutritionalAssessmentModel;
use Illuminate\Support\Facades\Log;

class NutritionalAssessmentController extends Controller
{
    /**
     * Display the constants view with necessary data.
     *
     * @return \Illuminate\View\View
     */
    public function nutritionalAssessment(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Pupil Nutritional Assessment",
                'headerTitle1' => "Add Pupil Nutritional Assessment",
                'headerMessage1' => "Warning: You are about to add an assessment. 
                                    Please ensure that you understand the implications of this action, 
                                    as it may affect existing data and overall statistics. 
                                    Confirm only if you are certain about your decision.",
                'headerFilter1' => "Filter Pupil Nutritional Assessments",
                'headerTable1' => "Nutritional Assessments",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $nutritionalModel = app(NutritionalAssessmentModel::class);

            // Get records from the users table
            $data['getRecord'] = $nutritionalModel->getNutritionalAssessments();

            if (empty($data['getRecord'])) {
                return abort(404);
            }

            return view('class_adviser.class_adviser.nutritional_assessment', compact('data', 'head'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
