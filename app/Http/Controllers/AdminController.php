<?php

namespace App\Http\Controllers;

use App\Models\PupilModel;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserHistoryModel;
use App\Models\MasterListModel;
use App\Models\ClassroomModel;
use App\Models\SchoolModel;
use App\Models\DistrictModel;
use App\Models\SchoolYearModel;
use App\Models\SectionModel;
use App\Models\NsrListModel;
use App\Models\NutritionalAssessmentModel;
use App\Models\ReferralModel;
use App\Models\BeneficiaryModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    private function instantiateModels() 
    {
        return [
            'masterListModel' => app(MasterListModel::class),
            'classroomModel' => app(ClassroomModel::class),
            'schoolModel' => app(SchoolModel::class),
            'districtModel' => app(DistrictModel::class),
            'schoolYearModel' => app(SchoolYearModel::class),
            'pupilModel' => app(PupilModel::class),
            'sectionModel' => app(SectionModel::class),
            'nsrListModel' => app(NsrListModel::class),
            'nutritionalAssessmentModel' => app(NutritionalAssessmentModel::class),
            'referralModel' => app(ReferralModel::class),
            'userModel' => app(User::class),
            'beneficiaryModel' => app(BeneficiaryModel::class),
        ];
    }

    public function list()
    {
        try {
            // Set the default timezone to Asia/Manila
            date_default_timezone_set('Asia/Manila');

            // Set headers and associate messages
            $head['headerTitle'] = "Account List";
            $head['headerTitle1'] = "Add Account";
            $head['headerTable1'] = "Accounts";
            $head['headerMessage1'] = "Please Note: Adding a new account along with its designated role will permanently 
            link it to the associated role privileges. Verify the accuracy of the email address before proceeding. 
            Confirm only if you are certain.";
            $head['FilterName'] = "Filter Account";

            // Retrieve user records from the User Model through getUsers() function and save to the array
            $userModel = new User();
            $data['getRecord'] = $userModel->getUsers();

            // If no records are found, return a 404 error
            if (empty($data['getRecord'])) {
                return abort(404);
            }

            // Render the admin list view with data and header information
            return view('admin.admin.list', compact('data', 'head'));
        } catch (\Exception $e) {

            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with a generic error message if an exception occurs
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function user_accounts(){
        try {
            // Set the default timezone to Asia/Manila
            date_default_timezone_set('Asia/Manila');

            $head['headerTitle'] = "User Accounts";
            $head['headerTitle1'] = "Add Account/s";
            $head['headerTable1'] = "User Accounts";
            $head['headerMessage1'] = "Please Note: Verify the accuracy of the email address before proceeding.";
            $head['FilterName'] = "Filter Account";

            return view('admin.admin.user_accounts', compact('head'));
        } catch (\Exception $e) {

            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with a generic error message if an exception occurs
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function pupils(){
        try {
            // Set the default timezone to Asia/Manila
            date_default_timezone_set('Asia/Manila');

            $head['headerTitle'] = "Pupils";
            $head['headerTitle1'] = "Add Pupil/s";
            $head['headerTable1'] = "Pupils";
            $head['headerMessage1'] = "Please Note: Verify the accuracy of the LRN (Learner's Reference Number) before proceeding.";
            $head['FilterName'] = "Filter Pupils";

            return view('admin.admin.pupils', compact('head'));
        } catch (\Exception $e) {

            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with a generic error message if an exception occurs
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function pupilList(){
        try {
            // Set the default timezone to Asia/Manila
            date_default_timezone_set('Asia/Manila');

            $head['headerTitle'] = "Pupils";
            $head['headerTitle1'] = "Add Pupil/s";
            $head['headerTable1'] = "Pupils";
            $head['headerMessage1'] = "Please Note: Verify the accuracy of the LRN (Learner's Reference Number) before proceeding.";
            $head['FilterName'] = "Filter Pupils";

            $pupilModel = new PupilModel();
            $data['getRecord'] = $pupilModel->getAllPupils();

            return view('admin.admin.pupil_list', compact('head', 'data'));
        } catch (\Exception $e) {

            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with a generic error message if an exception occurs
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function massUserInsert(Request $request)
    {
        // Uncomment for debugging purposes
        //dd($request->all());

        $usersData = $request->input('users') ?? [];

        // Validation rules
        $rules = [
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'string',
                'min:8'
            ],
        ];
        if (array_key_exists('email', $usersData) && is_array($usersData['email'])) {
            foreach ($usersData['email'] as $key => $email) {
                // Combine validation data for each user
                $userData = [
                    'email' => $email,
                    'name' => $usersData['name'][$key],
                    'password' => $usersData['password'][$key],
                ];

                // Validate user data
                $validator = Validator::make($userData, $rules);

                // If validation fails, redirect back with errors
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                // Check if user with the same email already exists
                $existingUser = User::where('email', $email)->first();

                // If user with the same email exists, skip insertion
                if ($existingUser) {
                    continue;
                }

                $password = $userData['password'];

                if ($usersData['user_type'][$key] == '2') {
                    $userNite = 'MO';
                } elseif ($usersData['user_type'][$key] == '3') {
                    $userNite = 'SN';
                } elseif ($usersData['user_type'][$key] == '4') {
                    $userNite = 'CA';
                } else {
                    abort(404);
                }

                // Encrypt the password before insertion
                $hashedPassword = Hash::make($password);

                // Insert the user record
                User::create([
                    'unique_id' => $userNite . '-' . uniqid(),
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'user_type' => $usersData['user_type'][$key],
                    'password' => $hashedPassword,
                ]);
            }
            return redirect()->back()->with('success', 'Records inserted successfully');
        }
        return redirect()->route('admin.admin.user_accounts')->with('primary', 'No records in local storage to clear');;
    }

    public function massPupilInsert(Request $request)
    {

        // Uncomment for debugging purposes
        //dd($request->all());

        $pupilsData = $request->input('pupil') ?? [];

        // Validation rules
        $rules = [
            'lrn' => [
                'required',
                'string',
                'min:8',
                'unique:pupil',
            ],
            'date_of_birth' => [
                'required',
                'date',
                'before_or_equal:' . now(),
                'after_or_equal:' . now()->subYears(100),
            ],
        ];

        if (array_key_exists('lrn', $pupilsData) ) {
            foreach ($pupilsData['lrn'] as $key => $lrn) {
                // Combine validation data for each user
                $pupilData = [
                    'lrn' => $lrn,
                    'last_name' => $pupilsData['last_name'][$key],
                    'middle_name' => $pupilsData['middle_name'][$key],
                    'first_name' => $pupilsData['first_name'][$key],
                    'suffix' => $pupilsData['suffix'][$key],
                    'date_of_birth' => $pupilsData['date_of_birth'][$key],
                    'gender' => $pupilsData['gender'][$key],
                ];

                // Validate user data
                $validator = Validator::make($pupilData, $rules);

                // If validation fails, redirect back with errors
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                // Check if user with the same lrn already exists
                $existingPupil = PupilModel::where('lrn', $lrn)->first();

                // If user with the same lrn exists, skip insertion
                if ($existingPupil) {
                    continue;
                }

                // Insert the user record
                PupilModel::create([
                    'lrn' => $pupilData['lrn'],
                    'last_name' => $pupilData['last_name'],
                    'first_name' => $pupilData['first_name'],
                    'middle_name' => $pupilData['middle_name'],
                    'suffix' => $pupilData['suffix'],
                    'date_of_birth' => $pupilData['date_of_birth'],
                    'gender' => $pupilData['gender'],
                    'added_by' => auth()->user()->id,
                ]);
            }
            return redirect()->back()->with('success', 'Records inserted successfully');
        }
        return redirect()->route('admin.admin.pupils')->with('primary', 'No records');;
    }

    public function insert(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'email' => 'required|email|unique:users',
                'name' => 'required|unique:users',
                'password' => [
                    'required',
                    'string',
                    'min:8'
                ],
            ]);

            // Check if user_type is valid, if not, abort with a 403 error.
            $validUserTypes = ['2', '3', '4'];
            if (!in_array($request->user_type, $validUserTypes)) {
                return abort(403, 'Invalid user type.');
            }

            // Define user type mapping
            $userTypes = [
                '2' => 'Medical Officer',
                '3' => 'School Nurse',
                '4' => 'Class Adviser',
            ];

            // Get the user count for the specific user type
            $userCount = User::where('user_type', $request->user_type)->count();

            // Increment the user count for the specific user type
            $userCount++;

            // Generate the unique ID based on user type and row ID
            $uniqueId = $userTypes[$request->user_type][0] . $request->user_type . '-' . str_pad($userCount, 7, '0', STR_PAD_LEFT);

            // Create a new user instance with validated data and user role
            $user = new User([
                'name' => trim($request->name),
                'unique_id' => $uniqueId,
                'email' => trim($request->email),
                'user_type' => trim($request->user_type),
                'is_deleted' => '0',
            ]);

            $user->password = Hash::make($request->password);

            // Save the new user to the database
            $user->save();

            // Add a record to admin_logs table for the 'Create' action
            $data = [
                'Name' => $request->name,
                'Email' => $request->email,
                'User Type' => $userTypes[$request->user_type],
            ];
            
            $newValue = implode(', ', array_map(fn ($key, $value) => "$key: $value", array_keys($data), $data));

            $currentUser = Auth::user()->id;
            
            UserHistoryModel::create([
                'action' => 'Create',
                'old_value' => null,
                'new_value' => $newValue,
                'table_name' => 'users',
                'user_id' => $currentUser,
            ]);

            // Redirect to the admin user list page with a success message
            return redirect()->route('admin.admin.list')->with('success', 'User ' . $user->name . ' successfully added');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with input data, validation errors, and a generic error message if an exception occurs
            return redirect()->back()->withInput()->withErrors(['email' => 'The email address or name already exists.'])
                ->with('error_add_account_failed', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            // Set the default timezone to Asia/Manila
            date_default_timezone_set('Asia/Manila');

            // Set the headers and messages
            $head['headerTitle'] = "Update User";
            $head['headerCaption'] = "You will update this account? Please be aware of the changes you will made";
            $head['skipPassword'] = "Skip this if you don't want to change the account's password";

            // Retrieve the user record with the given ID
            $data['getRecord'] = User::findOrFail($id);

            // Render the edit view with the user data and header information
            return view('admin.admin.edit', compact('data', 'head'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with a generic error message if an exception occurs
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        try {
            // Retrieve the user record with the given ID
            $user = User::findOrFail($id);

            // Check if user_type is 1 (Admin), and if so, abort the update with a 403 error.
            if ($user->user_type === '1') {
                abort(403, 'Unauthorized action.');
            }

            // Validate the incoming request data.
            $request->validate([
                'email' => 'required|email|unique:users,email,' . $id,
                'name' => 'required|unique:users,name,' . $id . '|max:30',
            ]);            

            // Get the old values from the database
            $oldValues = [
                'name' => $user->name,
                'user_type' => $user->user_type,
                'email' => $user->email,
            ];

            // Update user information based on the request data
            $user->name = trim($request->name);

            // Initialize an array to store old values
            $oldValues = [];

            // Check if user_type is changed and update user_type
            if ($user->user_type !== trim($request->user_type)) {
                $oldValues['user_type'] = $user->user_type;
                $user->user_type = trim($request->user_type);
            }

            // Check if email is changed and update email
            if ($user->email !== $request->email) {
                $oldValues['email'] = $user->email;
                $user->email = trim($request->email);
            }

            // Check if password is provided and update it
            if (!empty($request->password)) {
                $oldValues['password'] = '***'; // Mask the password in old values
                $user->password = Hash::make($request->password);
            }

            // Save the updated user to the database
            $user->save();

            // Filter out the password from old values
            $filteredOldValues = array_filter($oldValues, fn ($field) => $field !== 'password', ARRAY_FILTER_USE_KEY);

            // Construct old and new value strings for changed fields only
            $changedValues = array_map(fn ($field, $oldValue) => "$field: {$user->$field}", array_keys($filteredOldValues), $filteredOldValues);

            $currentUser = Auth::user()->id;
            
            // Add a record to admin_logs table for the 'Update' action
            UserHistoryModel::create([
                'action' => 'Update',
                'old_value' => implode(', ', $filteredOldValues),
                'new_value' => implode(', ', $changedValues),
                'table_name' => 'users',
                'user_id' => $currentUser,
            ]);

            // Redirect to the admin user list page with a success message
            return redirect()->route('admin.admin.list')->with('success', 'User successfully updated');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with input data, validation errors, and a generic error message if an exception occurs
            return redirect()->back()->withInput()->withErrors(['email' => $e->getMessage()])
                ->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            // Check if the user ID is not 1 (Admin) to prevent deleting the main admin account
            if ($id != 1) {
                // Retrieve the user record with the given ID
                $user = User::findOrFail($id);

                // Mark the user as deleted (soft delete)
                $user->is_deleted = '1';
                $user->save();

                // Redirect to the admin user list page with a success message
                return redirect('admin/admin/list')->with('success', 'User ' . $user->name . ' successfully deleted');
            } else {
                // If an attempt is made to delete the main admin account, abort with a 403 error
                abort(403, 'Unauthorized Action');
            }
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with a generic error message if an exception occurs
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function manageSchools(){
            try {
                // Set the default timezone to Asia/Manila
                date_default_timezone_set('Asia/Manila');
    
                $head['headerTitle'] = "Manage Schools";
                $head['headerTitle1'] = "Manage Schools";
                $head['headerTable1'] = "Districts and Schools";
                $head['headerMessage1'] = "Please Note: Verify the accuracy of the selected data before proceeding.";
                $head['FilterName'] = "Filter Districts and Schools";

                // Use dependency injection to create instances
                $models = $this->instantiateModels();

                $districts['getList'] = $models['districtModel']->getDistrictRecords();

                $schools['getList'] = $models['schoolModel']->getSchoolByDistrictIdByAdmin();

                $sections['getList'] = $models['sectionModel']->getSectionBySchoolIdByAdmin();

                $schoolData['getList'] = $models['schoolModel']->getSchoolRecords();
                $scID = collect($schoolData['getList'])->pluck('school_id', 'id')->toArray();

                $classes['getList'] = $models['classroomModel']->getClassroomsForAdmin();
                $checkedForClasses['getList'] = $models['classroomModel']->getClassesForAdmin();

                $classAdviserName['getList'] = $models['userModel']->getClassAdvisers();
                $classAdviserNames = collect($classAdviserName['getList'])->pluck('name', 'id')->toArray();

                $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

                $dataSection['getRecord'] = $models['sectionModel']->getSectionsByAdmin();
                $sectionName = collect($dataSection['getRecord'])->pluck('section_name', 'id')->toArray();

                $users['getRecord'] = $models['userModel']->getAllUsers();
                $userName = collect($users['getRecord'])->pluck('name', 'id')->toArray();

                $searchWithName['getList'] = $models['pupilModel']->searchedPupilByName();

                $searchWithSchoolName['getList'] = $models['schoolModel']->getSchoolListSearched();

                $districtId = collect($schoolData['getList'])->pluck('district_id', 'id')->toArray();
    
                return view('admin.admin.manage_schools', compact('head', 'activeSchoolYear', 'districts', 'schools', 'sections',
            'scID', 'classes', 'sectionName', 'users', 'userName', 'searchWithName', 'checkedForClasses', 'classAdviserNames', 
            'searchWithSchoolName', 'districtId'));
            } catch (\Exception $e) {
    
                // Log the exception for debugging purposes
                Log::error($e->getMessage());
    
                // Redirect back with a generic error message if an exception occurs
                return redirect()->back()->with('error', $e->getMessage());
            }
    }

    
}
