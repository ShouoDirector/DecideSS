<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DistrictModel;
use App\Models\SchoolModel;
use Illuminate\Support\Facades\Log;

class ArchivedController extends Controller{

    /**
     * Display archived user accounts.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Recover a deleted user account.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    
            // Recover the deleted user account by setting 'is_deleted' to 0
            $user->is_deleted = 0;
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

    /**
     * Display archived user accounts.
     *
     * @return \Illuminate\Http\Response
     */
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

            // Get lists of school nurses from Users table
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

    /**
     * Recover a deleted user account.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function districtRecover($id){

        try{
            // Find the deleted school with the given ID
            $district = DistrictModel::findOrFail($id);

            // If the deleted school is not found, return a 404 error
            if (!$district) {
                return abort(404);
            }

            // Recover the deleted user account by setting 'is_deleted' to 0
            $district->is_deleted = 0;
            $district->save();

            // Redirect to the archived accounts page with a success message
            return redirect('admin/archives/schools_archive')->with('success', $district->district . ' successfully recovered');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display archived user accounts.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Recover a deleted user account.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function schoolRecover($id){

        try{
            // Find the deleted school with the given ID
            $school = SchoolModel::findOrFail($id);

            // If the deleted school is not found, return a 404 error
            if (!$school) {
                return abort(404);
            }

            // Recover the deleted user account by setting 'is_deleted' to 0
            $school->is_deleted = 0;
            $school->save();

            // Redirect to the archived accounts page with a success message
            return redirect('admin/archives/schools_archive')->with('success', $school->school . ' successfully recovered');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    
}
