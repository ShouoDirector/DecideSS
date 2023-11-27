<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NutritionalAssessmentModel;
use App\Models\ClassroomModel;
use App\Models\MasterListModel;
use App\Models\SchoolModel;
use App\Models\PupilModel;
use App\Models\SchoolYearModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NutritionalAssessmentController extends Controller{
    
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
            $classroomModel = app(ClassroomModel::class);
            $schoolModel = app(SchoolModel::class);
            $schoolYearModel = app(SchoolYearModel::class);
            $masterListModel = app(MasterListModel::class);

            // Get records from the users table
            $data['getRecord'] = $nutritionalModel->getNutritionalAssessments();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $classroomModel->getClassroomRecordsForCurrentUser();

            // Filter the collection based on the user's id in the classadviser_id column
            $filteredRecords = $dataClass['classRecords']->filter(function ($record) use ($currentUser) {
                return $record->classadviser_id == $currentUser;
            });

            // Fetch schools using SchoolModel
            $dataSchools['getList'] = $schoolModel->getSchoolRecords();

            // Corresponding emails to medical officer IDs
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Set the permitted value based on whether the user is a class adviser
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            $activeSchoolYear['getRecord'] = $schoolYearModel->getLastActiveSchoolYearPhase();

            // Retrieve pupil data based on LRN
            $pupilData['getList'] = $masterListModel->getPupilRecord();

            return view('class_adviser.class_adviser.nutritional_assessment', compact('data', 'head', 'filteredRecords', 
                'permitted', 'schoolName', 'activeSchoolYear', 'pupilData'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function insertNA(){

    }
}
