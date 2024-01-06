<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PupilModel;
use App\Models\User;
use App\Models\ClassroomModel;
use App\Models\MasterListModel;
use App\Models\SchoolModel;
use App\Models\SchoolYearModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\UserHistoryModel;
use Illuminate\Database\QueryException;


class PupilController extends Controller
{
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
                'headerMessage2' => "The Learner Reference Number (LRN) serves as the primary identifier. 
                You may only add a pupil who does not currently exist in the system. 
                If the pupil is already present in the system or a transferee from other schools, kindly proceed to the 'Add Pupil to Master List' sub-tab.",
                'headerFilter1' => "Filter Pupils",
                'headerTable1' => "Pupils",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $pupilModel = app(PupilModel::class);
            $classroomModel = app(ClassroomModel::class);
            $schoolModel = app(SchoolModel::class);
            $schoolYearModel = app(SchoolYearModel::class);
            $masterListModel = app(MasterListModel::class);

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

            // Get records from the users table
            $data['getRecord'] = $pupilModel->getPupilRecords();
            
            // Get lists of medical officers from users table
            $dataPupils['getList'] = $pupilModel->getPupils();

            $activeSchoolYear['getRecord'] = $schoolYearModel->getLastActiveSchoolYearPhase();

            // Set the permitted value based on whether the class adviser is assigned to a classroom
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            // Retrieve pupil data based on LRN
            $pupilData['getList'] = $masterListModel->getPupilIfExist();

            return view('class_adviser.class_adviser.pupils', 
                compact('data', 'head', 'dataPupils', 'permitted', 'filteredRecords', 'schoolName', 'activeSchoolYear',
                'pupilData'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function pupilsRecords(){
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
            $classroomModel = app(ClassroomModel::class);
            $schoolModel = app(SchoolModel::class);
            $schoolYearModel = app(SchoolYearModel::class);

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

            // Get records from the users table
            $data['getRecord'] = $pupilModel->getPupilRecords();
            
            // Get lists of medical officers from users table
            $dataPupils['getList'] = $pupilModel->getPupils();

            $activeSchoolYear['getRecord'] = $schoolYearModel->getLastActiveSchoolYearPhase();

            // Set the permitted value based on whether the class adviser is assigned to a classroom
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            return view('class_adviser.class_adviser.pupils_records', 
                compact('data', 'head', 'dataPupils', 'permitted', 'filteredRecords', 'schoolName', 'activeSchoolYear'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function insertPupils(Request $request)
    {
        try {
            // Set the default timezone
            date_default_timezone_set('Asia/Manila');

            $userId = Auth::user()->id;

            // Create a new district instance and populate its data
            $pupil = new PupilModel();
            $pupil->lrn = $request->lrn;
            $pupil->last_name = $request->last_name;
            $pupil->first_name = $request->first_name;
            $pupil->middle_name = $request->middle_name;
            $pupil->suffix = $request->suffix;
            $pupil->date_of_birth = $request->date_of_birth;
            $pupil->gender = $request->gender;
            $pupil->barangay = $request->barangay;
            $pupil->municipality = $request->municipality;
            $pupil->province = $request->province;
            $pupil->pupil_guardian_name = $request->pupil_guardian_name;
            $pupil->pupil_guardian_contact_no = $request->pupil_guardian_contact_no;
            $pupil->added_by = $userId;

            // Save the pupil to the database
            $pupil->save();

            $data = [
                'LRN' => $pupil->lrn,
                'Name' => "{$pupil->first_name} {$pupil->middle_name} {$pupil->last_name} {$pupil->suffix}",
                'B-day' => $pupil->date_of_birth,
                'Gender' => $pupil->gender,
                'Area' => "{$pupil->barangay}, {$pupil->municipality}, {$pupil->province}",
                'Guardian' => "{$pupil->pupil_guardian_name} | {$pupil->pupil_guardian_contact_no}",
            ];
            
            $newValue = implode(', ', array_map(fn ($key, $value) => "$key: $value", array_keys($data), $data));
            
            UserHistoryModel::create([
                'action' => 'Create',
                'old_value' => null,
                'new_value' => $newValue,
                'table_name' => 'pupil',
                'user_id' => $userId,
            ]);

            // Redirect with success message
            return redirect('class_adviser/class_adviser/pupils')->with('success', $pupil->first_name . ' '. $pupil->last_name . ' successfully added');
        } catch (\Exception $e) {
            
            // Log other exceptions for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editPupil($id) {
        try {
            // Set the default timezone to Asia/Manila
            date_default_timezone_set('Asia/Manila');
    
            // Set the headers and messages
            $head = [
                'headerTitle' => "Edit Pupil",
                'headerCaption' => "You will edit this pupil? Please be aware of the changes you will make",
            ];
    
            // Use dependency injection for models
            $pupilModel = app(PupilModel::class);
    
            // Retrieve the district record with the given ID
            $data['getPupilRecord'] = $pupilModel->findOrFail($id);
    
            return view('class_adviser.class_adviser.pupil_edit', compact('head', 'data'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
    
            // Redirect back with a generic error message if an exception occurs
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updatePupil($id, Request $request)
    {
        try {

            $userId = Auth::user()->id;

            // Retrieve the record with the given ID
            $pupil = PupilModel::where('id', $id)->first();

            // Use dependency injection for models
            $pupilModel = app(PupilModel::class);
    
            // Retrieve the district record with the given ID
            $data2['getPupilRecord'] = $pupilModel->findOrFail($id);

            // Update pupil information based on the request data
            $pupil->lrn = trim($request->lrn);
            $pupil->last_name = trim($request->last_name);
            $pupil->first_name = trim($request->first_name);
            $pupil->middle_name = trim($request->middle_name);
            $pupil->suffix = trim($request->suffix);
            $pupil->date_of_birth = date($request->date_of_birth);
            $pupil->gender = trim($request->gender);
            $pupil->barangay = trim($request->barangay);
            $pupil->municipality = trim($request->municipality);
            $pupil->province = trim($request->province);
            $pupil->pupil_guardian_name = trim($request->pupil_guardian_name);
            $pupil->pupil_guardian_contact_no = trim($request->pupil_guardian_contact_no);

            // Save the updated pupil to the database
            $pupil->save();

            $data = [
                'LRN' => $pupil->lrn,
                'Name' => "{$pupil->first_name} {$pupil->middle_name} {$pupil->last_name} {$pupil->suffix}",
                'B-day' => $pupil->date_of_birth,
                'Gender' => $pupil->gender,
                'Area' => "{$pupil->barangay}, {$pupil->municipality}, {$pupil->province}",
                'Guardian' => "{$pupil->pupil_guardian_name} | {$pupil->pupil_guardian_contact_no}",
            ];

            $oldData = [
                'LRN' => $data2['getPupilRecord']->lrn,
                'Name' => "{$data2['getPupilRecord']->first_name} {$data2['getPupilRecord']->middle_name} 
                {$data2['getPupilRecord']->last_name} {$data2['getPupilRecord']->suffix}",
                'B-day' => $data2['getPupilRecord']->date_of_birth,
                'Gender' => $data2['getPupilRecord']->gender,
                'Area' => "{$data2['getPupilRecord']->barangay}, {$data2['getPupilRecord']->municipality}, {$data2['getPupilRecord']->province}",
                'Guardian' => "{$data2['getPupilRecord']->pupil_guardian_name} | {$data2['getPupilRecord']->pupil_guardian_contact_no}",
            ];
            
            $newValue = implode(', ', array_map(fn ($key, $value) => "$key: $value", array_keys($data), $data));
            $oldValue = implode(', ', array_map(fn ($key, $value) => "$key: $value", array_keys($oldData), $oldData));
            
            UserHistoryModel::create([
                'action' => 'Update',
                'old_value' => $oldValue,
                'new_value' => $newValue,
                'table_name' => 'pupil',
                'user_id' => $userId,
            ]);

            // Redirect to the masterList page with a success message
            return redirect('class_adviser/class_adviser/pupils_records')->with('success', "{$pupil->last_name}, {$pupil->first_name} is successfully updated");
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
    
            // Redirect back with a generic error message if an exception occurs
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deletePupil($id)
    {
        try {
            // Find the record by ID
            $pupil = PupilModel::findOrFail($id);

            $userId = Auth::user()->id;

            // Mark the district as deleted
            $pupil->is_deleted = '1';
            $pupil->save();

            UserHistoryModel::create([
                'action' => 'Delete',
                'old_value' => $pupil->lrn,
                'new_value' => null,
                'table_name' => 'pupil',
                'user_id' => $userId,
            ]);

            // Redirect with success message
            return redirect()->route('class_adviser.class_adviser.pupils')->with('success', "{$pupil->last_name}, {$pupil->first_name} is successfully deleted");
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with an error message if an exception occurs
            return redirect()->back()->with('error', 'Failed to delete district: ' . $e->getMessage());
        }
    }

}
