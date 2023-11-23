<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * Display the constants view with necessary data.
     *
     * @return \Illuminate\View\View
     */
    public function settings(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Profile Settings"
            ];

            // Use dependency injection to create instances
            $userModel = app(User::class);

            // Get records from the users table
            $data['getRecord'] = $userModel->getUsers();

            return view('admin.profile.settings', 
                compact('data', 'head'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function saveSettings(Request $request){
        try {
            date_default_timezone_set('Asia/Manila');
            
            // Validate the form data with custom error messages
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ], [
                'current_password.required' => 'The current password field is required.',
                'new_password.required' => 'The new password field is required.',
                'new_password.min' => 'The new password must be at least 8 characters long.',
                'new_password.confirmed' => 'The new password and confirmation do not match.',
            ]);

            // Get the user based on their ID (assuming the user ID is 1 for the admin)
            $user = User::find(1);

            // Verify the current password
            if ($user && Hash::check($request->current_password, $user->password)) {
                // Update the password
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->back()->with('success', 'Password changed successfully.');
            } else {
                // Redirect back with validation errors
                return redirect()->back()->withErrors(['current_password' => 'The current password provided is incorrect.']);
            }

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error2', $e->getMessage());
        }
    }

    public function updateDetails(Request $request)
    {
        try {
            // Get the Admin ID from the session
            $userId = 1; // Assuming the admin's ID is 1

            // Validate the form data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone_number' => 'nullable|string|max:255',
            ]);

            // Get the user based on their ID
            $user = User::find($userId);

            if (!$user) {
                return redirect()->back()->with('error', 'User not found.');
            }

            // Update user details
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone_number = $request->input('phone_number');
            $user->save();

            return redirect()->back()->with('success', 'Account details updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //User ====================================================================//

    public function userSettings(){
        try {
            date_default_timezone_set('Asia/Manila');
    
            $head = [
                'headerTitle' => "Profile Settings"
            ];
    
            // Use dependency injection to create instances
            $userModel = app(User::class);
    
            $currentUser = Auth::user()->user_type;

            $role = '';
    
            // Map user types to roles
            $rolesMapping = [
                2 => 'medical_officer',
                3 => 'school_nurse',
                4 => 'class_adviser'
            ];

            // Validate if the user type is in the mapping
            if (array_key_exists($currentUser, $rolesMapping)) {
                $role = $rolesMapping[$currentUser];
            } else {
                abort(404, 'Page not found');
            }
    
            // Get records from the users table
            $data['getRecord'] = $userModel->getUsers();
    
            return view( $role . '.profile.settings', compact('head'));
    
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    

    public function userSaveSettings(Request $request){
        try {
            date_default_timezone_set('Asia/Manila');
            
            // Validate the form data with custom error messages
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ], [
                'current_password.required' => 'The current password field is required.',
                'new_password.required' => 'The new password field is required.',
                'new_password.min' => 'The new password must be at least 8 characters long.',
                'new_password.confirmed' => 'The new password and confirmation do not match.',
            ]);

            // Get the user based on their ID (assuming the user ID is 1 for the admin)
            $userId = Auth::user()->id;

            $user = User::find($userId);

            // Verify the current password
            if ($user && Hash::check($request->current_password, $user->password)) {
                // Update the password
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->back()->with('success', 'Password changed successfully.');
            } else {
                // Redirect back with validation errors
                return redirect()->back()->withErrors(['current_password' => 'The current password provided is incorrect.']);
            }

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error2', $e->getMessage());
        }
    }

    public function userUpdateDetails(Request $request)
    {
        try {
            // Get the Admin ID from the session
            $userId = Auth::user()->id; // Assuming the admin's ID is 1

            // Validate the form data
            $request->validate([
                'name' => 'required|string|min:8|max:255',
                'phone_number' => 'nullable|string|min:11|max:255',
            ]);

            // Get the user based on their ID
            $user = User::find($userId);

            if (!$user) {
                return redirect()->back()->with('error', 'User not found.');
            }

            // Update user details
            $user->name = $request->input('name');
            $user->phone_number = $request->input('phone_number');
            $user->save();

            return redirect()->back()->with('success', 'Account details updated successfully.');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
