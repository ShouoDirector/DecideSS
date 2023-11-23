<?php

namespace App\Http\Controllers;

use App\Models\AdminHistoryModel;
use Illuminate\Http\Request;
use App\Models\ClassroomModel;
use App\Models\SchoolModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class ClassroomController extends Controller
{
    /**
     * Display the list of accounts for the admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function classroom()
    {
        try {
            // Set the default timezone to Asia/Manila
            date_default_timezone_set('Asia/Manila');

            // Set headers and associate messages
            $head['headerTitle'] = "Classrooms";
            $head['headerTitle1'] = "Add Classroom";
            $head['headerTable1'] = "Classrooms";
            $head['headerMessage1'] = "Warning: You are about to add a classroom for your school. 
            Please ensure that you understand the implications of this action, 
            as it may affect existing data and overall statistics. 
            Confirm only if you are certain about your decision";
            $head['FilterName'] = "Filter Classroom";

            // Retrieve user records from the User Model through getUsers() function and save to the array
            $userModel = new User();
            $classroomModel = new ClassroomModel();
            $schoolModel = new SchoolModel(); 

            $data['getRecord'] = $classroomModel->getClassroomRecords();

            // Get lists of medical officers and school nurses from users table
            $dataClassroom['getList'] = $classroomModel->getClassrooms();

            // Get lists of medical officers from users table
            $dataClassAdvisers['getList'] = $userModel->getClassAdvisers();

            // Corresponding emails to medical officer IDs
            $classAdvisersEmails = collect($dataClassAdvisers['getList'])->pluck('email', 'id')->toArray();

            // Select and assign available medical officers
            $assignedClassAdviserIds = $dataClassroom['getList']->pluck('classadviser_id');
            $availableClassAdvisers = $dataClassAdvisers['getList']->reject(function ($classadviser) 
                use ($assignedClassAdviserIds) {
                return $assignedClassAdviserIds->contains($classadviser['id']);
            });

            // Fetch schools using SchoolModel
            $dataSchools['getList'] = $schoolModel->getSchoolRecords();

            // Corresponding emails to medical officer IDs
            $schoolNames = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Render the admin list view with data and header information
            return view('admin.constants.classroom', compact('data', 'head', 'dataClassroom', 'classAdvisersEmails', 
            'availableClassAdvisers', 'dataSchools', 'schoolNames'));
        } catch (\Exception $e) {

            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with a generic error message if an exception occurs
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
    /**
     * Handle the request to insert a new district area.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insertClassroom(Request $request)
    {
        try {

            // Set the default timezone
            date_default_timezone_set('Asia/Manila');

            // Create a new district instance and populate its data
            $classroom = new ClassroomModel();

            $classroom->section = $request->section;
            $classroom->school_id = $request->school_id;
            $classroom->classadviser_id = $request->classadviser_id;
            $classroom->grade_level = $request->grade_level;

            // Create a history record before saving the district
            AdminHistoryModel::create([
                'action' => 'Create',
                'old_value' => null, // For create operation, old_value is null
                'new_value' => $classroom->school_id . ',' . $classroom->section . ', ' . $classroom->school_id . 
                ', ' . $classroom->classadviser_id . ', ' . $classroom->grade_level,
                'table_name' => 'classroom',
            ]);

            // Save the district to the database
            $classroom->save();

            // Redirect with success message
            return redirect('admin/constants/classroom')->with('success', $classroom->section . ' classroom successfully added');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Duplicate entry error, return custom error message
                return redirect()->back()->with('error', 'Class Adviser has already assigned to a classroom.');
            } else {
                // Log other database exceptions for debugging purposes
                Log::error($e->getMessage());
                return redirect()->back()->with('error', $e->getMessage());
            }
        } catch (\Exception $e) {
            // Log other exceptions for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the edit view for a specific district.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function editClassroom($id) {
        try {
            // Set the default timezone to Asia/Manila
            date_default_timezone_set('Asia/Manila');
    
            // Set the headers and messages
            $head = [
                'headerTitle' => "Edit Classroom",
                'headerCaption' => "You will edit this classroom? Please be aware of the changes you will make",
            ];
    
            // Use dependency injection for models
            $userModel = app(User::class);
            $classroomModel = app(ClassroomModel::class);
            $schoolModel = new SchoolModel();

            $data['getRecord'] = $classroomModel->findOrFail($id);

            // Get lists of medical officers and school nurses from users table
            $dataClassroom['getList'] = $classroomModel->getClassrooms();

            // Get lists of medical officers from users table
            $dataClassAdvisers['getList'] = $userModel->getClassAdvisers();

            // Select and assign available medical officers
            $assignedClassAdviserIds = $dataClassroom['getList']->pluck('classadviser_id');
            $availableClassAdvisers = $dataClassAdvisers['getList']->reject(function ($classadviser) 
                use ($assignedClassAdviserIds) {
                return $assignedClassAdviserIds->contains($classadviser['id']);
            });

            $dataSchools['getList'] = $schoolModel->getSchoolRecords();
    
            return view('admin.constants.classroom_edit', compact('head', 'data', 'dataClassroom', 'dataClassAdvisers', 
            'availableClassAdvisers', 'dataSchools'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
    
            // Redirect back with a generic error message if an exception occurs
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the information of a specific classroom.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateClassroom($id, Request $request)
    {
        try {
            // Retrieve the classroom record with the given ID
            $classroom = ClassroomModel::where('id', $id)->first();

            // Get the old values from the database
            $oldValues = [
                'section' => $classroom->section,
                'classadviser_id' => $classroom->classadviser_id,
                'grade_level' => $classroom->grade_level,
            ];

            // Update classroom information based on the request data
            $classroom->section = trim($request->section);
            $classroom->classadviser_id = (int)$request->classadviser_id;
            $classroom->grade_level = trim($request->grade_level);

            // Save the updated classroom to the database
            $classroom->save();

            // Construct old and new value strings for changed fields only
            $changedValues = [];
            foreach ($oldValues as $field => $oldValue) {
                $newValue = $classroom->$field;
                if ($newValue !== $oldValue) {
                    $changedValues[] = "$newValue";
                }
            }

            // Add a record to admin_logs table for the 'Update' action
            AdminHistoryModel::create([
                'action' => 'Update',
                'old_value' => implode(', ', $oldValues),
                'new_value' => implode(', ', $changedValues),
                'table_name' => 'classroom',
            ]);

            // Redirect to the classroom page with a success message
            return redirect('admin/constants/classroom')->with('success', "{$classroom->section} District is successfully updated");
        } catch (QueryException $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Check if the exception is a duplicate key violation
            if ($e->errorInfo[1] == 1062) {
                $errorSpecialMessage = 'Duplicates of Section Names are not allowed by the system.';
            } else {
                $errorMessage = $e->getMessage();
            }

            // Redirect back with input data and a custom error message
            return redirect()->back()->withInput()->with(['error' => $errorMessage, 'errorSpecialMessage' => $errorSpecialMessage]);
        }
    }

    /**
     * Delete a district record by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteClassroom($id)
    {
        try {
            // Find the classroom record by ID
            $classroom = ClassroomModel::findOrFail($id);

            // Get the details of the classroom before deletion
            $classroomDetails = "{$classroom->section}, {$classroom->classadviser_id}, {$classroom->grade_level}";

            // Add a record to admin_logs table for the 'Delete' action
            AdminHistoryModel::create([
                'action' => 'Delete',
                'old_value' => $classroomDetails,
                'new_value' => null,
                'table_name' => 'classroom',
            ]);

            // Mark the district as deleted
            $classroom->is_deleted = '1';
            $classroom->save();

            // Redirect with success message
            return redirect()->route('admin.constants.classroom')->with('success', $classroom->section . ' classroom is successfully deleted');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with an error message if an exception occurs
            return redirect()->back()->with('error', 'Failed to delete district: ' . $e->getMessage());
        }
    }
}
