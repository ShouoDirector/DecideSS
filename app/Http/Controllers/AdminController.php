<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminHistoryModel;
use App\Models\UserHistoryModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

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
                    'min:8',
                    'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
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

                // Create a history record before deletion
                AdminHistoryModel::create([
                    'action' => 'Delete',
                    'old_value' => $user->name . ', ' . $user->email . ', ' . $user->user_type,
                    'new_value' => null,
                    'table_name' => 'users',
                ]);

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
}
