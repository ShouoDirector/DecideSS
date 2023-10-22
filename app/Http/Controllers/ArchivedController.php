<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ArchivedController extends Controller{
    public function accountsArchive(){
        try {
            // Set the default timezone to Asia/Manila
            date_default_timezone_set('Asia/Manila');

            // Set header titles for the archived accounts view
            $head['headerTitle'] = "Accounts Archive";
            $head['headerFilter'] = "Filter Deleted Accounts";
            $head['headerInformation'] = "The Accounts Archive provides a structured overview of deleted users with administrative 
            privileges within the system. Each entry includes the user's full name, associated email address, assigned role, 
            creation date, and last update date.";

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
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
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
    
            // Recover the deleted user account by setting 'is_deleted' to 0
            $user->is_deleted = 0;
            $user->save();
    
            // Redirect to the archived accounts page with a success message
            return redirect('admin/archives/accounts_archive')->with('success', 'User ' . $name . ' successfully recovered');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
    
            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
}
