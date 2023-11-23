<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\DistrictModel;
use App\Models\SchoolModel;
use App\Models\SchoolYearModel;
use App\Models\AdminHistoryModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class DangerController extends Controller{

    /**
     * Display the constants view with necessary data.
     *
     * @return \Illuminate\View\View
     */
    public function districts(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Districts",
                'headerTitle1' => "Add District",
                'headerMessage1' => "Warning: You are about to add a district. 
                                    Please ensure that you understand the implications of this action, 
                                    as it may affect existing data and overall statistics. 
                                    Confirm only if you are certain about your decision.",
                'headerFilter1' => "Filter District",
                'headerTable1' => "Districts",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $userModel = app(User::class);
            $districtModel = app(DistrictModel::class);

            // Get records from the users table
            $data['getRecord'] = $userModel->getUsers();
            
            // Get lists of medical officers from users table
            $dataMedicalOfficer['getList'] = $userModel->getMedicalOfficers();
            
            // Table and filter data
            $dataDistrictModel_MedicalOfficer['getList'] = $districtModel->getMedicalOfficersList();
            
            // Get lists of districts
            $dataDistrict['getList'] = $districtModel->getDistrictRecords();

            // Select and assign available medical officers
            $assignedMedicalOfficerIds = $dataDistrict['getList']->pluck('medical_officer_id');
            $availableMedicalOfficers = $dataMedicalOfficer['getList']->reject(function ($medicalOfficer) 
                use ($assignedMedicalOfficerIds) {
                return $assignedMedicalOfficerIds->contains($medicalOfficer['id']);
            });

            // Corresponding emails to medical officer IDs
            $medicalOfficersEmails = collect($dataMedicalOfficer['getList'])->pluck('email', 'id')->toArray();

            if (empty($data['getRecord'])) {
                return abort(404);
            }

            return view('admin.constants.districts', 
                compact('data', 'head', 'dataMedicalOfficer', 'dataDistrict', 'dataDistrictModel_MedicalOfficer', 
                    'medicalOfficersEmails', 'availableMedicalOfficers'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the constants view with necessary data.
     *
     * @return \Illuminate\View\View
     */
    public function schools(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Schools",
                'headerTitle1' => "Add School",
                'headerMessage1' => "Warning: You are about to add a school. 
                                    Please ensure that you understand the implications of this action, 
                                    as it may affect existing data and overall statistics. 
                                    Confirm only if you are certain about your decision.",
                'headerFilter1' => "Filter School",
                'headerTable1' => "Districts",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $userModel = app(User::class);
            $districtModel = app(DistrictModel::class);
            $schoolModel = app(SchoolModel::class);

            // Get records from the users table
            $data['getRecord'] = $userModel->getUsers();
            
            // Get lists of medical officers and school nurses from users table
            $dataSchoolNurse['getList'] = $userModel->getSchoolNurses();
            
            // Table and filter data
            $dataSchoolModel_SchoolNurse['getList'] = $schoolModel->getSchoolNurseList();
            
            // Get lists of schools and districts
            $dataDistrict['getList'] = $districtModel->getDistrictRecords();
            $dataSchoolRecords['getList'] = $schoolModel->getSchoolRecords();
            
            // Select and assign available school nurses
            $assignedSchoolNurseIds = $dataSchoolRecords['getList']->pluck('school_nurse_id');
            $availableSchoolNurses = $dataSchoolNurse['getList']->reject(function ($schoolNurse) 
                use ($assignedSchoolNurseIds) {
                return $assignedSchoolNurseIds->contains($schoolNurse['id']);
            });

            // Corresponding emails to school nurse IDs
            $schoolNursesEmails = collect($dataSchoolNurse['getList'])->pluck('email', 'id')->toArray();

            // Corresponding names to district IDs
            $schoolDistrictNames = collect($dataDistrict['getList'])->pluck('district', 'id')->toArray();

            if (empty($data['getRecord'])) {
                return abort(404);
            }

            return view('admin.constants.schools', 
                compact('data', 'head', 'dataSchoolNurse', 'dataDistrict', 'dataSchoolRecords', 
                    'dataSchoolModel_SchoolNurse', 'schoolNursesEmails', 'schoolDistrictNames', 
                    'availableSchoolNurses'));

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
    public function insertDistrictArea(Request $request)
    {
        try {
            // Set the default timezone
            date_default_timezone_set('Asia/Manila');

            // Create a new district instance and populate its data
            $district = new DistrictModel();
            $district->district = $request->district;
            $district->medical_officer_id = $request->medical_officer_id;

            // Create a history record before saving the district
            AdminHistoryModel::create([
                'action' => 'Create',
                'old_value' => null, // For create operation, old_value is null
                'new_value' => $district->district . ', ' . $district->medical_officer_id,
                'table_name' => 'districts',
            ]);

            // Save the district to the database
            $district->save();

            // Redirect with success message
            return redirect('admin/constants/districts')->with('success', $district->district . ' District successfully added');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Duplicate entry error, return custom error message
                return redirect()->back()->with('error', 'Medical Officer has already assigned to a district.');
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
     * Handle the request to insert a new school area.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insertSchoolArea(Request $request)
    {
        try {
            // Set the default timezone
            date_default_timezone_set('Asia/Manila');

            // Create a new school instance and populate its data
            $school = new SchoolModel();
            $school->school = $request->school;
            $school->school_id = $request->school_id;
            $school->school_nurse_id = $request->school_nurse_id;
            $school->district_id = $request->district_id;

            // Check if address_barangay is set in the request, if yes, assign its value
            if (isset($request->address_barangay)) {
                $school->address_barangay = $request->address_barangay;
            }

            // Create a history record before saving the school
            AdminHistoryModel::create([
                'action' => 'Create',
                'old_value' => null, // For create operation, old_value is null
                'new_value' => $school->school . ', ' . $school->school_id . ', ' . $school->school_nurse_id,
                'table_name' => 'schools',
            ]);

            // Save the school to the database
            $school->save();

            // Redirect with success message
            return redirect('admin/constants/schools')->with('success', $school->school . ' successfully added');
        } catch (\Exception $e) {
            // Log other exceptions for debugging purposes
            Log::error($e->getMessage());

            // Return a generic error response
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the edit view for a specific school.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function school_edit($id){
        try {
            date_default_timezone_set('Asia/Manila');

            // Set the headers and messages
            $head = [
                'headerTitle' => "Edit School",
                'headerCaption' => "You will edit this school? Please be aware of the changes you will make",
            ];

            // Use dependency injection to create instances
            $userModel = app(User::class);
            $districtModel = app(DistrictModel::class);
            $schoolModel = app(SchoolModel::class);

            // Retrieve the school record with the given ID
            $data['getSchoolRecord'] = $schoolModel->findOrFail($id);

            // Get records from the Users table
            $dataUsers['getRecord'] = $userModel->getUsers();

            // Get lists of school nurses from Users table
            $dataSchoolNurse['getList'] = $userModel->getSchoolNurses();

            // Get lists of schools and districts
            $dataDistrict['getList'] = $districtModel->getDistrictRecords();
            $dataSchool['getList'] = $schoolModel->getSchoolRecords();

            // Select and assign available school nurses
            $assignedSchoolNurseIds = $dataSchool['getList']->pluck('school_nurse_id');
            $availableSchoolNurses = $dataSchoolNurse['getList']->reject(function ($schoolNurse) use ($assignedSchoolNurseIds) {
                return $assignedSchoolNurseIds->contains($schoolNurse['id']);
            });

            // Corresponding emails to school nurse IDs
            $schoolNursesEmails = $dataSchoolNurse['getList']->pluck('email', 'id');

            // Corresponding names to district IDs
            $schoolDistrictNames = $dataDistrict['getList']->pluck('district', 'id');

            // Render the edit view with the data and header information
            return view('admin.constants.school-edit', 
            compact('data', 'dataUsers', 'head', 'availableSchoolNurses', 'schoolDistrictNames', 'schoolNursesEmails'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the information of a specific school.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function school_update($id, Request $request)
    {
        try {
            // Retrieve the school record with the given ID
            $school = SchoolModel::where('id', $id)->first();

            // Get the old values from the database
            $oldValues = [
                'school_id' => $school->school_id,
                'school' => $school->school,
                'school_nurse_id' => $school->school_nurse_id,
                'district_id' => $school->district_id,
                'address_barangay' => $school->address_barangay,
            ];

            // Update school information based on the request data
            $school->school_id = (int)$request->school_id;
            $school->school = trim($request->school);
            $school->school_nurse_id = (int)$request->school_nurse_id;
            $school->district_id = (int)$request->district_id;

            // Update the barangay if provided in the request
            if (!empty($request->address_barangay)) {
                $school->address_barangay = trim($request->address_barangay);
            }

            // Save the updated school to the database
            $school->save();

            // Construct old and new value strings for changed fields only
            $changedValues = [];
            foreach ($oldValues as $field => $oldValue) {
                $newValue = $school->$field;
                if ($newValue !== $oldValue) {
                    $changedValues[] = "$newValue";
                }
            }

            // Add a record to admin_logs table for the 'Update' action
            AdminHistoryModel::create([
                'action' => 'Update',
                'old_value' => implode(', ', $oldValues),
                'new_value' => implode(', ', $changedValues),
                'table_name' => 'schools',
            ]);

            // Redirect to the admin constants page with a success message
            return redirect('admin/constants/schools')->with('success', "{$school->school} is successfully updated");
        } catch (QueryException $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Check if the exception is a duplicate key violation
            $errorMessage = ($e->errorInfo[1] == 1062)
                ? 'Duplicates of School IDs and School Names are not allowed by the system.'
                : $e->getMessage();

            // Redirect back with input data and a custom error message
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    }

    /**
     * Display the edit view for a specific district.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function district_edit($id) {
        try {
            // Set the default timezone to Asia/Manila
            date_default_timezone_set('Asia/Manila');
    
            // Set the headers and messages
            $head = [
                'headerTitle' => "Edit District",
                'headerCaption' => "You will edit this district? Please be aware of the changes you will make",
            ];
    
            // Use dependency injection for models
            $userModel = app(User::class);
            $districtModel = app(DistrictModel::class);
    
            // Retrieve the district record with the given ID
            $data['getDistrictRecord'] = $districtModel->findOrFail($id);
    
            // Get records from the users table
            $dataUsers['getRecord'] = $userModel->getUsers();
    
            // Get list of medical officers from users table
            $dataMedicalOfficer['getList'] = $userModel->getMedicalOfficers();
    
            // Get list of districts
            $dataDistrict['getList'] = $districtModel->getDistrictRecords();
    
            // Select and assign available school nurses
            $assignedMedicalOfficerIds = $dataDistrict['getList']->pluck('medical_officer_id');
            $availableMedicalOfficers = $dataMedicalOfficer['getList']->reject(function ($medicalOfficer) use ($assignedMedicalOfficerIds) {
                return $assignedMedicalOfficerIds->contains($medicalOfficer['id']);
            });
    
            return view('admin.constants.district-edit', compact('head', 'data', 'dataUsers', 'availableMedicalOfficers'));
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
    public function district_update($id, Request $request)
    {
        try {
            // Retrieve the district record with the given ID
            $district = DistrictModel::where('id', $id)->first();

            // Get the old values from the database
            $oldValues = [
                'district' => $district->district,
                'medical_officer_id' => $district->medical_officer_id,
            ];

            // Update district information based on the request data
            $district->district = trim($request->district);
            $district->medical_officer_id = (int)$request->medical_officer_id;

            // Save the updated district to the database
            $district->save();

            // Construct old and new value strings for changed fields only
            $changedValues = [];
            foreach ($oldValues as $field => $oldValue) {
                $newValue = $district->$field;
                if ($newValue !== $oldValue) {
                    $changedValues[] = "$newValue";
                }
            }

            // Add a record to admin_logs table for the 'Update' action
            AdminHistoryModel::create([
                'action' => 'Update',
                'old_value' => implode(', ', $oldValues),
                'new_value' => implode(', ', $changedValues),
                'table_name' => 'districts',
            ]);

            // Redirect to the admin constants page with a success message
            return redirect('admin/constants/districts')->with('success', "{$district->district} District is successfully updated");
        } catch (QueryException $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Check if the exception is a duplicate key violation
            if ($e->errorInfo[1] == 1062) {
                $errorSpecialMessage = 'Duplicates of Division Names are not allowed by the system.';
            } else {
                $errorMessage = $e->getMessage();
            }

            // Redirect back with input data and a custom error message
            return redirect()->back()->withInput()->with(['error' => $errorMessage, 'errorSpecialMessage' => $errorSpecialMessage]);
        }
    }

    /**
     * Delete a school record by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function school_delete($id)
    {
        try {
            // Find the school record by ID
            $school = SchoolModel::findOrFail($id);

            // Get the details of the school before deletion
            $schoolDetails = "{$school->school_id}, {$school->school}, {$school->school_nurse_id}, {$school->district_id}, {$school->address_barangay}";

            // Add a record to admin_logs table for the 'Delete' action
            AdminHistoryModel::create([
                'action' => 'Delete',
                'old_value' => $schoolDetails,
                'new_value' => null,
                'table_name' => 'schools',
            ]);

            // Mark the school as deleted
            $school->is_deleted = '1';
            $school->save();

            // Redirect with success message
            return redirect()->route('admin.constants.schools')->with('success', $school->school . ' is successfully deleted');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with an error message if an exception occurs
            return redirect()->back()->with('error', 'Failed to delete school: ' . $e->getMessage());
        }
    }

    /**
     * Delete a district record by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function district_delete($id)
    {
        try {
            // Find the district record by ID
            $district = DistrictModel::findOrFail($id);

            // Get the details of the district before deletion
            $districtDetails = "{$district->district}, {$district->medical_officer_id}";

            // Add a record to admin_logs table for the 'Delete' action
            AdminHistoryModel::create([
                'action' => 'Delete',
                'old_value' => $districtDetails,
                'new_value' => null,
                'table_name' => 'districts',
            ]);

            // Mark the district as deleted
            $district->is_deleted = '1';
            $district->save();

            // Redirect with success message
            return redirect()->route('admin.constants.districts')->with('success', $district->district . ' District is successfully deleted');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with an error message if an exception occurs
            return redirect()->back()->with('error', 'Failed to delete district: ' . $e->getMessage());
        }
    }

    /**
     * Display the constants view with necessary data.
     *
     * @return \Illuminate\View\View
     */
    public function schoolYear(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "SchoolYears",
                'headerTitle1' => "Add School Year",
                'headerMessage1' => "Warning: You are about to add a school year. 
                                    Please ensure that you understand the implications of this action, 
                                    as it may affect existing data and overall statistics. 
                                    Confirm only if you are certain about your decision. (e.g School Year: 2023-2024)",
                "headerNote" => "A school year comprises of two phases Baseline and Endline. Please add Baseline before Endline.
                (e.g School Year 2023-2024 Baseline, 
                School Year 2023-2024 Endline)",
                'headerNote1' => "Only one school year will have 'Active' status. Check table first",
                'headerFilter1' => "Filter School Year",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $schoolYearModel = app(SchoolYearModel::class);

            // Get records from the users table
            $data['getSchoolYearRecord'] = $schoolYearModel->getSchoolYears();

            $currentDate = now();

            // Determine the academic year based on the current date
            $startYear = $currentDate->month >= 8 ? $currentDate->year : $currentDate->year - 1;
            $endYear = $startYear + 1;

            // Pass the calculated school year to the view
            $schoolYear = $startYear . '-' . $endYear;

            return view('admin.constants.school_year', 
                compact('data', 'head', 'schoolYear'));

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
    public function insertSchoolYear(Request $request)
    {
        try {
            // Set the default timezone
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $schoolYearModel = app(SchoolYearModel::class);

            $schoolYear = new SchoolYearModel();
            $schoolYear->school_year = $request->school_year;
            $schoolYear->phase = $request->phase;
            $schoolYear->status = $request->status;

            // Custom validation rule to check for unique 'school_year' and 'phase' combination
            $uniqueSchoolYearPhaseRule = Rule::unique('school_year')->where(function ($query) use ($request) {
                return $query->where('phase', $request->input('phase'));
            });

            // Validate the request data with a closure for 'status' validation
            $request->validate([
                'school_year' => [
                    'required',
                    $uniqueSchoolYearPhaseRule,
                ],
                'phase' => 'required',
            ]);

            // Check if the school year is "Active" and there are currently "Active" values in the 'status' column
            if ($schoolYear->status === 'Active' && $schoolYearModel->where('status', 'Active')->exists()) {
                // If there are active values, cancel the operation
                return redirect()->back()->with('error2', 'There is already an active school year. Cannot create another active school year.');
            }

            // Get data from School Year Table
            $data['getSchoolYearRecord'] = $schoolYearModel->getSchoolYears();

            // Create a history record before saving the district
            AdminHistoryModel::create([
                'action' => 'Create',
                'old_value' => null, // For create operation, old_value is null
                'new_value' => $schoolYear->school_year . ', ' . $schoolYear->phase . ', ' . $schoolYear->status,
                'table_name' => 'school year',
            ]);

            // Save the district to the database
            $schoolYear->save();

            // Redirect with success message
            return redirect('admin/constants/school_year')->with('success', $schoolYear->school_year . ' School Year successfully added');
        } catch (\Exception $e) {
            // Log other exceptions for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error2', $e->getMessage());
        }
    }


    /**
     * Display the edit view for a specific district.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function schoolYearEdit($id) {
        try {
            // Set the default timezone to Asia/Manila
            date_default_timezone_set('Asia/Manila');
    
            // Set the headers and messages
            $head = [
                'headerTitle' => "Edit School Year",
                'headerTitle1' => "Update School Year",
                'headerCaption' => "You will edit this school year? Please be aware of the changes you will make",
            ];
    
            // Use dependency injection for models
            $userModel = app(User::class);
            $schoolYearModel = app(SchoolYearModel::class);
    
            // Retrieve the district record with the given ID
            $data['getSchoolYearRecord'] = $schoolYearModel->findOrFail($id);
    
            return view('admin.constants.school_year_edit', compact('head', 'data'));
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
    public function schoolYearUpdate($id, Request $request)
    {
        try {
            // Retrieve the district record with the given ID
            $schoolYear = SchoolYearModel::where('id', $id)->first();

            // Get the old values from the database
            $oldValues = [
                'school_year' => $schoolYear->school_year,
                'phase' => $schoolYear->phase,
                'status' => $schoolYear->status,
            ];

            // Update district information based on the request data
            $schoolYear->school_year = trim($request->school_year);
            $schoolYear->phase = trim($request->phase);
            $schoolYear->status = trim($request->status);

            // Save the updated district to the database
            $schoolYear->save();

            // Construct old and new value strings for changed fields only
            $changedValues = [];
            foreach ($oldValues as $field => $oldValue) {
                $newValue = $schoolYear->$field;
                if ($newValue !== $oldValue) {
                    $changedValues[] = "$newValue";
                }
            }

            // Add a record to admin_logs table for the 'Update' action
            AdminHistoryModel::create([
                'action' => 'Update',
                'old_value' => implode(', ', $oldValues),
                'new_value' => implode(', ', $changedValues),
                'table_name' => 'school year',
            ]);

            // Redirect to the admin constants page with a success message
            return redirect('admin/constants/school_year')->with('success', "{$schoolYear->school_year} School Year is successfully updated");
        } catch (QueryException $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with input data and a custom error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete a district record by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function schoolYearDelete($id)
    {
        try {
            // Find the district record by ID
            $schoolYear = SchoolYearModel::findOrFail($id);

            // Get the details of the district before deletion
            $schoolYearDetails = "{$schoolYear->school_year}, {$schoolYear->phase}, {$schoolYear->status}";

            // Add a record to admin_logs table for the 'Delete' action
            AdminHistoryModel::create([
                'action' => 'Delete',
                'old_value' => $schoolYearDetails,
                'new_value' => null,
                'table_name' => 'school year',
            ]);

            // Mark the district as deleted
            $schoolYear->is_deleted = '1';
            $schoolYear->save();

            // Redirect with success message
            return redirect()->route('admin.constants.school_year')->with('success', $schoolYear->school_year . ' School Year is successfully deleted');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with an error message if an exception occurs
            return redirect()->back()->with('error', 'Failed to delete school year: ' . $e->getMessage());
        }
    }

}
