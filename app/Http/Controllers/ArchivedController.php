<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DistrictModel;
use App\Models\SchoolModel;
use App\Models\AdminHistoryModel;
use App\Models\SchoolYearModel;
use App\Models\ClassroomModel;
use Illuminate\Support\Facades\Log;

class ArchivedController extends Controller{

    public function accountsArchive(){
        try {
            // Set the default timezone to Asia/Manila
            date_default_timezone_set('Asia/Manila');

            // Set header titles for the archived accounts view
            $head = [
                'headerTitle' => "Accounts Archive",
                'headerTitle1' => "Deleted Accounts",
                'headerFilter' => "Filter Deleted Accounts",
                'headerInformation' => "The Accounts Archive provides a structured overview of 
                                deleted users with administrative privileges within the system. 
                                Each entry includes the user's full name, associated email address, 
                                assigned role, creation date, and last update date."
            ];

            // Retrieve deleted user accounts from the database
            $userModel = new User();
            $data['getDeletedUsers'] = $userModel->getDeletedUsers();

            // If no deleted users are found, return a 404 error
            if (empty($data['getDeletedUsers'])) {
                return abort(404);
            }

            // Render the archived accounts view with data and header information
            return view('admin.archives.accounts_archive', compact('data', 'head'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function recover($id)
    {
        try {
            // Find the deleted user account with the given ID
            $user = User::find($id);

            // If the deleted user account is not found, return a 404 error
            if (!$user) {
                return abort(404);
            }

            // Get the user's name before deletion
            $name = $user->name;

            // Create a history record before recovering
            AdminHistoryModel::create([
                'action' => 'Recover',
                'old_value' => null,
                'new_value' => implode(', ', [
                    'Name: ' . $name,
                    'Email: ' . $user->email,
                    'User Type: ' . $user->user_type,
                ]),
                'table_name' => 'users',
            ]);


            // Recover the deleted user account by setting 'is_deleted' to 0
            $user->is_deleted = '0';
            $user->save();

            // Redirect to the archived accounts page with a success message
            return redirect('admin/archives/accounts_archive')->with('success', 'User ' . $name . ' successfully recovered');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function districtsArchive(){
        try{
            date_default_timezone_set('Asia/Manila');
                // Set header titles for the archived accounts view
            $head = [
                'headerTitle' => "Districts Archive",
                'headerFilter' => "Filter Deleted Districts",
                'headerInformation' => "The Schools Archive provides a structured overview of 
                                deleted districts within the system. 
                                Each entry includes the district name, associated medical officer email address, 
                                creation date, and last update date."
            ];

            // Use dependency injection to create instances
            $userModel = app(User::class);
            $districtModel = app(DistrictModel::class);

            // Retrieve deleted schools from the database
            $data['getDeletedDistricts'] = $districtModel->getDeletedDistricts();

            // Get lists of medical officers from Users table
            $dataMedicalOfficer['getList'] = $userModel->getMedicalOfficers();

            //Get lists of districts from District table
            $dataDistrict['getList'] = $districtModel->getDistrictRecords();

            // Corresponding emails to school nurse IDs
            $districtMedicalOfficerEmails = $dataMedicalOfficer['getList']->pluck('email', 'id');

            // Render the archived schools view with data and header information
            return view('admin.archives.districts_archive', compact('data', 'head', 'districtMedicalOfficerEmails'));
            } catch (\Exception $e) {
                // Log the exception for debugging purposes
                Log::error($e->getMessage());

                // Handle any unexpected exceptions and return an error message
                return redirect()->back()->with('error', $e->getMessage());
            }
    }

    public function districtRecover($id)
    {
        try {
            // Find the deleted district with the given ID
            $district = DistrictModel::find($id);

            // If the deleted district is not found, return a 404 error
            if (!$district) {
                return abort(404);
            }

            // Get the district details before recovery
            $districtDetails = [
                'District' => $district->district,
                'Medical Officer ID' => $district->medical_officer_id,
            ];

            $districtDetailsString = implode(', ', array_map(fn ($key, $value) => "$key: $value", 
                array_keys($districtDetails), $districtDetails));

            // Recover the deleted district by setting 'is_deleted' to 0
            $district->is_deleted = '0';
            $district->save();

            // Add a record to admin_logs table for the 'Recover' action
            AdminHistoryModel::create([
                'action' => 'Recover',
                'old_value' => null, // For recover operation, old_value is null
                'new_value' => $districtDetailsString,
                'table_name' => 'districts',
            ]);


            // Redirect to the archived districts page with a success message
            return redirect('admin/archives/districts_archive')->with('success', $district->district . ' District successfully recovered');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function schoolsArchive(){

        try{
            // Set the default timezone to Asia/Manila
            date_default_timezone_set('Asia/Manila');
                // Set header titles for the archived accounts view
            $head = [
                'headerTitle' => "Schools Archive",
                'headerFilter' => "Filter Deleted Schools",
                'headerInformation' => "The Schools Archive provides a structured overview of 
                                deleted schools within the system. 
                                Each entry includes the school id, school name, associated school nurse email address, 
                                barangay address, district, creation date, and last update date."
            ];

            // Use dependency injection to create instances
            $userModel = app(User::class);
            $districtModel = app(DistrictModel::class);
            $schoolModel = app(SchoolModel::class);

            // Retrieve deleted schools from the database
            $data['getDeletedSchools'] = $schoolModel->getDeletedSchools();

            // If no deleted users are found, return a 404 error
            if (empty($data['getDeletedSchools'])) {
                return abort(404);
            }

            // Get lists of school nurses from Users table
            $dataSchoolNurse['getList'] = $userModel->getSchoolNurses();

            //Get lists of districts from District table
            $dataDistrict['getList'] = $districtModel->getDistrictRecords();

            // Corresponding emails to school nurse IDs
            $schoolNursesEmails = $dataSchoolNurse['getList']->pluck('email', 'id');

            // Corresponding names to district IDs
            $schoolDistrictNames = $dataDistrict['getList']->pluck('district', 'id');

            // Render the archived schools view with data and header information
            return view('admin.archives.schools_archive', compact('data', 'head', 'schoolNursesEmails', 'schoolDistrictNames'));
            } catch (\Exception $e) {
                // Log the exception for debugging purposes
                Log::error($e->getMessage());

                // Handle any unexpected exceptions and return an error message
                return redirect()->back()->with('error', $e->getMessage());
            }
    }

    public function schoolRecover($id)
    {
        try {
            // Find the deleted school with the given ID
            $school = SchoolModel::find($id);

            // If the deleted school is not found, return a 404 error
            if (!$school) {
                return abort(404);
            }

            // Get the school details before recovery
            $schoolDetails = [
                'School' => $school->school,
                'School ID' => $school->school_id,
                'School Nurse ID' => $school->school_nurse_id,
            ];

            $schoolDetailsString = implode(', ', array_map(fn ($key, $value) => "$key: $value", 
                array_keys($schoolDetails), $schoolDetails));

            // Recover the deleted school by setting 'is_deleted' to 0
            $school->is_deleted = '0';
            $school->save();

            // Add a record to admin_logs table for the 'Recover' action
            AdminHistoryModel::create([
                'action' => 'Recover',
                'old_value' => null,
                'new_value' => $schoolDetailsString,
                'table_name' => 'schools',
            ]);

            // Redirect to the archived schools page with a success message
            return redirect('admin/archives/schools_archive')->with('success', $school->school . ' successfully recovered');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function schoolYearArchive(){
        try{
            date_default_timezone_set('Asia/Manila');
                // Set header titles for the archived accounts view
            $head = [
                'headerTitle' => "School Year Archive",
                'headerFilter' => "Filter Deleted School Years",
                'headerInformation' => "The School Year Archive provides a structured overview of 
                                deleted school years within the system. 
                                Each entry includes the school year, phase, status, 
                                creation date, and last update date."
            ];

            // Use dependency injection to create instances
            $schoolYearModel = app(SchoolYearModel::class);

            // Retrieve deleted schools from the database
            $data['getDeletedSchoolYears'] = $schoolYearModel->getDeletedSchoolYears();

            // Render the archived schools view with data and header information
            return view('admin.archives.school_year_archive', compact('data', 'head'));
            } catch (\Exception $e) {
                // Log the exception for debugging purposes
                Log::error($e->getMessage());

                // Handle any unexpected exceptions and return an error message
                return redirect()->back()->with('error', $e->getMessage());
            }
    }

    public function schoolYearRecover($id)
    {
        try {
            // Find the deleted school with the given ID
            $schoolYear = SchoolYearModel::find($id);

            // If the deleted school is not found, return a 404 error
            if (!$schoolYear) {
                return abort(404);
            }

            // Get the school year details before recovery
            $schoolYearDetails = [
                'School Year' => $schoolYear->school_year,
                'Phase' => $schoolYear->phase,
                'Status' => $schoolYear->status,
            ];

            $schoolYearDetailsString = implode(', ', array_map(fn ($key, $value) => "$key: $value", array_keys($schoolYearDetails), $schoolYearDetails));

            // Recover the deleted school year by setting 'is_deleted' to 0
            $schoolYear->is_deleted = '0';
            $schoolYear->save();

            // Add a record to admin_logs table for the 'Recover' action
            AdminHistoryModel::create([
                'action' => 'Recover',
                'old_value' => null,
                'new_value' => $schoolYearDetailsString,
                'table_name' => 'school_years',
            ]);

            // Redirect to the archived schools page with a success message
            return redirect('admin/archives/schools_archive')->with('success', $schoolYear->school_year . ' School Year successfully recovered');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function classroomArchive(){
        try{
            date_default_timezone_set('Asia/Manila');
                // Set header titles for the archived classrooms view
            $head = [
                'headerTitle' => "Classroom Archive",
                'headerFilter' => "Filter Deleted Classrooms",
                'headerInformation' => "The Classroom Archive provides a structured overview of 
                                deleted classrooms within the system. 
                                Each entry includes the section, class adviser, grade level, 
                                creation date, and last update date."
            ];

            // Use dependency injection to create instances
            $userModel = app(User::class);
            $classroomModel = app(ClassroomModel::class);

            // Get lists of medical officers from users table
            $dataClassAdvisers['getList'] = $userModel->getClassAdvisers();

            // Corresponding emails to medical officer IDs
            $classAdvisersEmails = collect($dataClassAdvisers['getList'])->pluck('email', 'id')->toArray();

            // Retrieve deleted classroom from the database
            $data['getDeletedClassrooms'] = $classroomModel->getDeletedClassrooms();

            // Render the archived classroom view with data and header information
            return view('school_nurse.archives.classroom_archive', compact('data', 'head', 'classAdvisersEmails'));
            } catch (\Exception $e) {
                // Log the exception for debugging purposes
                Log::error($e->getMessage());

                // Handle any unexpected exceptions and return an error message
                return redirect()->back()->with('error', $e->getMessage());
            }
    }

    public function classroomRecover($id)
    {
        try {
            // Find the deleted district with the given ID
            $classroom = ClassroomModel::find($id);
            $userModel = new User();

            // If the deleted district is not found, return a 404 error
            if (!$classroom) {
                return abort(404);
            }

            // Get the classroom details before recovery
            $classroomDetails = [
                'District' => $classroom->district,
                'Class Adviser ID' => $classroom->classadviser_id,
                'Grade Level' => $classroom->grade_level,
            ];

            $classroomDetailsString = implode(', ', array_map(fn ($key, $value) => "$key: $value", array_keys($classroomDetails), $classroomDetails));

            // Recover the deleted classroom by setting 'is_deleted' to 0
            $classroom->is_deleted = '0';
            $classroom->save();

            // Add a record to admin_logs table for the 'Recover' action
            AdminHistoryModel::create([
                'action' => 'Recover',
                'old_value' => null,
                'new_value' => $classroomDetailsString,
                'table_name' => 'classrooms',
            ]);


            // Redirect to the archived districts page with a success message
            return redirect('admin/archives/classroom_archive')->with('success', $classroom->section . ' classroom successfully recovered');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
