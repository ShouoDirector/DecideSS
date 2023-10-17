<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ArchivedController extends Controller
{
    /**
     * Display archived user accounts.
     *
     * @return \Illuminate\View\View
     */
    public function accountsArchive()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head['headerTitle'] = "Accounts Archive";
            $userModel = new User();
            $data['getDeletedUsers'] = $userModel->getDeletedUsers(); // Assign to $data['getDeletedUsers']

            if (empty($data['getDeletedUsers'])) {
                return abort(404);
            }

            return view('admin.archives.accounts_archive', compact('data', 'head'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    /**
     * Recover a deleted user account.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function recover($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                // User with the given ID not found, return a 404 error
                return abort(404);
            }

            // Get the user's name before deletion
            $name = $user->name;

            $user->is_deleted = 0;
            $user->save();

            return redirect('admin/archives/accounts_archive')->with('success', 'User ' . $name . ' successfully recovered');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            logger()->error($e);
            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
}
