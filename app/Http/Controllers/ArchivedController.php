<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ArchivedController extends Controller
{
    private function getUserRole($userType)
    {
        switch ((int)$userType) {
            case 1:
                return 'Admin';
            case 2:
                return 'Medical Officer';
            case 3:
                return 'School Nurse';
            case 4:
                return 'Class Adviser';
            default:
                return 'Unknown Role';
        }
    }

    public function accounts_archive(){
        try {
            date_default_timezone_set('Asia/Manila');
    
            $head['header_title'] = "Accounts Archive";
            $userModel = new User(); // Create an instance of the User model
            $data['getDeletedRecord'] = $userModel->getDeletedUsers(); // Call the non-static method on the instance
    
            // Check if there are no records found, then throw a 404 error
            if (empty($data['getDeletedRecord'])) {
                abort(404);
            }
    
            return view('admin.archives.accounts_archive', $data, compact('head'));
        } catch (\Exception $e) {
            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    public function recover($id){
        try {
            $user = User::getSingle($id);
    
            if (!$user) {
                // User with the given ID not found, return a 404 error
                abort(404);
            }

            // Get the user's name before deletion
            $name = $user->name;
    
            $user->is_deleted = 0;
            $user->save();
    
            return redirect('admin/archives/accounts_archive')->with('success', 'User '. $name .' successfully recovered');
        } catch (\Exception $e) {
            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
}
