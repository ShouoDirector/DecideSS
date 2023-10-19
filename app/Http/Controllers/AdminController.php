<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Get user role based on user type.
     *
     * @param int $userType
     * @return string
     */
    private function getUserRole($userType)
    {
        switch ($userType) {
            case 1:
                return 'Admin';
            case 2:
                return 'Medical Officer';
            case 3:
                return 'School Nurse';
            case 4:
                return 'Class Adviser';
            default:
                return abort(404);
        }
    }

    /**
     * Display the list of accounts for the admin.
     *
     * @return \Illuminate\View\View
     */
    public function list()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head['headerTitle'] = "Admin's User List";
            $userModel = new User();
            $data['getRecord'] = $userModel->getUsers();

            if (empty($data['getRecord'])) {
                return abort(404);
            }

            return view('admin.admin.list', compact('data', 'head'));
        } catch (\Exception $e) {

            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    /**
     * Store a newly created account in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insert(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:users',
                // Add validation rules here if needed
            ]);

            // Check if user_type is 1, and if so, abort with a 404 error.
            if ((int)$request->user_type === 1) {
                return abort(403, 'Unauthorized action.');
            }

            $user = new User([
                'name' => trim($request->name),
                'email' => trim($request->email),
                'user_type' => (int)$request->user_type,
                'is_deleted' => 0,
                'password' => Hash::make($request->password),
            ]);
            $user->save();

            $role = $this->getUserRole($request->user_type);

            return redirect('admin/admin/list')->with('success', $role . " user successfully created");
        } catch (\Exception $e) {

            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->withInput()->withErrors(['email' => 'The email address already exists.'])
                ->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $data['getRecord'] = User::findOrFail($id);
            $head['headerTitle'] = "Update User";

            return view('admin.admin.edit', compact('data', 'head'));
        } catch (\Exception $e) {

            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        try {

            // Check if user_type is 1, then abort the update
            if ($request->user_type == 1) {
                abort(403, 'Unauthorized action.');
            }
            
            $request->validate([
                'email' => 'required|email|unique:users,email,' . $id,
                // Add other validation rules here
            ]);

            $user = User::findOrFail($id);

            $user->name = trim($request->name);
            $user->email = trim($request->email);
            $user->user_type = (int)$request->user_type;

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect('admin/admin/list')->with('success', 'User successfully updated');
        } catch (\Exception $e) {

            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->withInput()->withErrors(['email' => 'The email address already exists.'])
                ->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->is_deleted = 1;
            $user->save();

            return redirect('admin/admin/list')->with('success', 'User ' . $user->name . ' successfully deleted');
        } catch (\Exception $e) {

            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
}
