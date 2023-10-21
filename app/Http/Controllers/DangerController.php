<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DistrictModel;
use App\Models\SchoolModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class DangerController extends Controller
{
    public function constants()
{
    try {
        date_default_timezone_set('Asia/Manila');

        $head['headerTitle'] = "Areas";
        $head['headerTitle1'] = "Add District";
        $head['headerTitle2'] = "Add School";
        $userModel = new User();
        $userModel2 = new User();
        $userModel3 = new User();
        $districtModel = new DistrictModel();
        $districtModel1 = new DistrictModel();
        $schoolModel = new SchoolModel();

        //Get Records of Accounts from User Table
        $data['getRecord'] = $userModel->getUsers();

        //Get list of Medical Officers from User Table
        $dataMedicalOfficer['getList'] = $userModel2->getMedicalOfficers();

        //Get list of School Nurses from User Table
        $dataSchoolNurse['getList'] = $userModel3->getSchoolNurses();

        // Get the list of medical officers from DistrictModel
        $dataDistrictModel_MedicalOfficer['getList'] = $districtModel->getMedicalOfficersList();

        // Get the list of districts from DistrictModel
        $dataDistrict['getList'] = $districtModel1->getDistrictsList();

        // Get the list of school nurses from SchoolModel
        $dataSchoolModel_SchoolNurse['getList'] = $schoolModel->getSchoolNurseList();

        if (empty($data['getRecord'])) {
            return abort(404);
        }

        return view('admin.constants.constants', 
        compact('data', 'head', 'dataMedicalOfficer', 'dataSchoolNurse', 'dataDistrict', 'dataDistrictModel_MedicalOfficer', 'dataSchoolModel_SchoolNurse'));

    } catch (\Exception $e) {
        // Log the exception for debugging purposes
        Log::error($e->getMessage());

        return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
    }
    }



    public function insertDistrictArea(Request $request)
    {
        try {
            // Set the default timezone
            date_default_timezone_set('Asia/Manila');

            // Get medical officers' emails
            $districtModel = new DistrictModel();
            $listOfMedicalOfficers = $districtModel->getDistrictRecords();

            // Check if the requested medical officer email already exists in the list
            foreach ($listOfMedicalOfficers as $medicalOfficer) {
                if ($medicalOfficer->email === $request->medical_officer_email) {
                    // If the email exists in the list, return an error response
                    return redirect()->back()->with('error', 'Medical Officer has already assigned to a district.');
                }
            }

            // If the email does not exist in the list, proceed with saving the district
            $save = new DistrictModel();
            $save->district = $request->district;
            $save->medical_officer_email = $request->medical_officer_email;
            $save->save();

            // Redirect with success message
            return redirect('admin/constants/constants')->with('success', 'District successfully added');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Duplicate entry error, return custom error message
                return redirect()->back()->with('error', 'Medical Officer has already assigned to a district.');
            } else {
                // Log other database exceptions for debugging purposes
                Log::error($e->getMessage());

                // Return a generic error response
                return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
            }
        } catch (\Exception $e) {
            // Log other exceptions for debugging purposes
            Log::error($e->getMessage());

            // Return a generic error response
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    public function insertSchoolArea(Request $request)
    {
        try {
            // Set the default timezone
            date_default_timezone_set('Asia/Manila');

            // Get school nurses' emails
            $schoolModel = new SchoolModel();
            $listOfSchoolNurses = $schoolModel->getSchoolRecords();

            // Check if the requested school nurse email already exists in the list
            foreach ($$listOfSchoolNurses as $schoolNurse) {
                if ($schoolNurse->email === $request->school_nurse_email) {
                    // If the email exists in the list, return an error response
                    return redirect()->back()->with('error', 'School Nurse has already assigned to a school.');
                }
            }

            // If the email does not exist in the list, proceed with saving the district
            $save = new SchoolModel();
            $save->school = $request->school;
            $save->school_nurse_email = $request->school_nurse_email;
            $save->save();

            // Redirect with success message
            return redirect('admin/constants/constants')->with('success', 'School successfully added');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Duplicate entry error, return custom error message
                return redirect()->back()->with('error', 'School Nurse has already assigned to a school.');
            } else {
                // Log other database exceptions for debugging purposes
                Log::error($e->getMessage());

                // Return a generic error response
                return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
            }
        } catch (\Exception $e) {
            // Log other exceptions for debugging purposes
            Log::error($e->getMessage());

            // Return a generic error response
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }



}
