<?php

namespace App\Http\Controllers;

use App\Models\ClassroomModel;
use App\Models\MasterListModel;
use App\Models\SchoolModel;
use App\Models\PupilModel;
use App\Models\SchoolYearModel;
use App\Models\UserHistoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MasterListController extends Controller{

    public function masterList()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "MasterList",
                'headerTitle1' => "Add Pupil To Classroom",
                'headerMessage1' => "Warning: You are about to add a pupil to the masterlist. 
                                    Please ensure that you understand the implications of this action, 
                                    as it may affect existing data and overall statistics. 
                                    Confirm only if you are certain about your decision.",
                'headerFilter1' => "Filter MasterList",
                'headerTable1' => "Current Pupils In MasterList",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $masterListModel = app(MasterListModel::class);
            $classroomModel = app(ClassroomModel::class);
            $schoolModel = app(SchoolModel::class);
            $schoolYearModel = app(SchoolYearModel::class);
            $pupilModel = app(PupilModel::class);

            // Get records from the users table
            $data['getRecord'] = $masterListModel->getMasterList();

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
            $pupilData['getRecord'] = $masterListModel->getMasterList();

            // Get lists of medical officers from users table
            $dataPupil['getRecord'] = $pupilModel->getPupilRecords();

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataPupilLRNs = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();

            // Corresponding classroom names to class IDs
            $dataClassNames = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();

            $SchoolYear['getRecord'] = $schoolYearModel->getSchoolYearPhase();

            $dataSchoolYearPhaseNames = collect($SchoolYear['getRecord'])->map(function ($syPhase) {
                // Combine school year and phase name
                $syPhase['full_name'] = trim("{$syPhase['school_year']} {$syPhase['phase']}");
                return $syPhase;
            })->pluck('full_name', 'id')->toArray();

            return view('class_adviser.class_adviser.masterlist', compact('data', 'head', 'permitted', 'filteredRecords', 
                'schoolName', 'pupilData', 'activeSchoolYear', 'dataPupilNames', 'dataPupilLRNs', 'dataClassNames', 'dataSchoolYearPhaseNames'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function pupil_to_masterlist()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Add Pupil To MasterList",
                'headerTitle1' => "Add Pupil To MasterList",
                'headerMessage1' => "Warning: You are about to add a pupil to the masterlist. 
                                    Please ensure that you understand the implications of this action, 
                                    as it may affect existing data and overall statistics. 
                                    Confirm only if you are certain about your decision.",
                'headerFilter1' => "Filter MasterList",
                'headerTable1' => "MasterList",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $masterListModel = app(MasterListModel::class);
            $classroomModel = app(ClassroomModel::class);
            $schoolModel = app(SchoolModel::class);
            $schoolYearModel = app(SchoolYearModel::class);

            // Get records from the users table
            $data['getRecord'] = $masterListModel->getMasterList();

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

            // Set the permitted value based on whether the class adviser is assigned to a classroom
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            // Retrieve pupil data based on LRN
            $pupilData['getList'] = $masterListModel->getPupilRecord();

            $activeSchoolYear['getRecord'] = $schoolYearModel->getLastActiveSchoolYearPhase();

            return view('class_adviser.class_adviser.pupil_to_masterlist', compact('data', 'head', 'permitted', 
            'filteredRecords', 'schoolName', 'pupilData', 'activeSchoolYear'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function insertPupilToMasterList(Request $request)
    {
        try {
            // Set the default timezone
            date_default_timezone_set('Asia/Manila');

            $userId = Auth::user()->id;

            // Create a new school instance and populate its data
            $masterList = new MasterListModel();
            $masterList->pupil_id = $request->pupil_id;
            $masterList->classadviser_id = $request->classadviser_id;
            $masterList->class_id = $request->class_id;
            $masterList->schoolyear_id = $request->schoolyear_id;

            $lrn = $request->lrn;

            // Save the school to the database
            $masterList->save();

            // Create an associative array of school details
            $masterListDetails = [
                'Pupil LRN' => $lrn,
                'Class' => $masterList->class_id,
                'SchoolYear' => $masterList->schoolyear_id,
            ];

            // Create a history record before saving the school
            UserHistoryModel::create([
                'action' => 'Create',
                'old_value' => null, // For create operation, old_value is null
                'new_value' => implode(', ', array_map(fn ($key, $value) => "$key: $value", array_keys($masterListDetails), $masterListDetails)),
                'table_name' => 'Pupil To Masterlist',
                'user_id' => $userId,
            ]);

            // Redirect with success message
            return redirect('class_adviser/class_adviser/pupil_to_masterlist')->with('success', ' Pupil successfully added to your masterlist');
        } catch (\Exception $e) {
            // Log other exceptions for debugging purposes
            Log::error($e->getMessage());

            // Return a generic error response
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
