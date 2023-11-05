<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PupilModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;


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
                'headerTitle' => "MasterList",
                'headerTitle1' => "Add Pupil",
                'headerMessage1' => "Warning: You are about to add a pupil. 
                                    Please ensure that you understand the implications of this action, 
                                    as it may affect existing data and overall statistics. 
                                    Confirm only if you are certain about your decision.",
                'headerFilter1' => "Filter Pupils",
                'headerTable1' => "MasterList",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $pupilModel = app(PupilModel::class);

            // Get records from the users table
            $data['getRecord'] = $pupilModel->getPupilRecords();
            
            // Get lists of medical officers from users table
            $dataPupils['getList'] = $pupilModel->getPupils();

            if (empty($data['getRecord'])) {
                return abort(404);
            }

            return view('class_adviser.class_adviser.pupils', 
                compact('data', 'head', 'dataPupils'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Handle the request to insert a new district area.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insertPupils(Request $request)
    {
        try {
            // Set the default timezone
            date_default_timezone_set('Asia/Manila');

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

            // Save the district to the database
            $pupil->save();

            // Redirect with success message
            return redirect('class_adviser/class_adviser/pupils')->with('success', $pupil->first_name . $pupil->last_name . ' District successfully added');
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

    /**
     * Update the information of a specific district.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePupil($id, Request $request)
    {
        try {
            // Retrieve the district record with the given ID
            $pupil = PupilModel::where('id', $id)->first();

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

            // Redirect to the masterList page with a success message
            return redirect('class_adviser/class_adviser/pupils')->with('success', "{$pupil->last_name}, {$pupil->first_name} is successfully updated");
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
    
            // Redirect back with a generic error message if an exception occurs
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete a pupil record by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletePupil($id)
    {
        try {
            // Find the district record by ID
            $pupil = PupilModel::findOrFail($id);

            // Mark the district as deleted
            $pupil->is_deleted = '1';
            $pupil->save();

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
