<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DistrictModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    /**
     * Display the list of accounts for the admin.
     *
     * @return \Illuminate\Http\Response
     */
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
            Ensure that you comprehend the implications of this action, as it might impact existing data and 
            overall statistics. Confirm only if you are certain.";
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

    /**
     * Store a newly created account in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'email' => 'required|email|unique:users',
                'name' => 'required|unique:users',
                // Add other validation rules here if needed.
            ]);

            // Check if user_type is 1 (Admin), and if so, abort with a 403 error.
            if ((int)$request->user_type === 1) {
                return abort(403, 'Unauthorized action.');
            }

            // Create a new user instance with validated data and user role
            $user = new User([
                'name' => trim($request->name),
                'email' => trim($request->email),
                'user_type' => (int)$request->user_type,
                'is_deleted' => 0,
                'password' => Hash::make($request->password),
            ]);

            // Save the new user to the database
            $user->save();

            // Redirect to the admin user list page with a success message
            return redirect('admin/admin/list')->with('success', 'User'. $user->name . 'successfully added');
        } catch (\Exception $e) {

            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with input data, validation errors, and a generic error message if an exception occurs
            return redirect()->back()->withInput()->withErrors(['email' => 'The email address or name already exists.'])
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the form to edit a user account.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified user account in the database.
     *
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
        {
            try {
                // Check if user_type is 1 (Admin), and if so, abort the update with a 403 error.
                if ($request->user_type == 1) {
                    abort(403, 'Unauthorized action.');
                }
                
                // Validate the incoming request data.
                $request->validate([
                    'email' => 'required|email|unique:users,email,' . $id,
                    // Add other validation rules here if needed.
                ]);

                // Retrieve the user record with the given ID
                $user = User::getSingle($id);

                // Update user information based on the request data
                $user->name = trim($request->name);
                $user->email = trim($request->email);
                $user->user_type = (int)$request->user_type;

                // Hash and update the password if provided in the request
                if (!empty($request->password)) {
                    $user->password = Hash::make($request->password);
                }

                // Save the updated user to the database
                $user->save();

                // Redirect to the admin user list page with a success message
                return redirect('admin/admin/list')->with('success', 'User successfully updated');
            } catch (\Exception $e) {
                // Log the exception for debugging purposes
                Log::error($e->getMessage());

                // Redirect back with input data, validation errors, and a generic error message if an exception occurs
                return redirect()->back()->withInput()->withErrors(['email' => $e->getMessage()])
                    ->with('error', $e->getMessage());
            }
        }

    /**
     * Soft delete the specified user account.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            // Check if the user ID is not 1 (Admin) to prevent deleting the main admin account
            if ($id != 1) {
                // Retrieve the user record with the given ID
                $user = User::findOrFail($id);

                // Mark the user as deleted (soft delete)
                $user->is_deleted = 1;
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
