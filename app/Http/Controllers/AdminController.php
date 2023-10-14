<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
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

    public function list(){
        try {
            date_default_timezone_set('Asia/Manila');
    
            $head['header_title'] = "Admin's User List";
            $data['getRecord'] = User::getUsers();
    
            // Check if there are no records found, then throw a 404 error
            if (empty($data['getRecord'])) {
                abort(404);
            }
    
            return view('admin.admin.list', $data, compact('head'));
        } catch (\Exception $e) {
            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    public function insert(Request $request){

        $request->validate([
            'email' => 'required|email|unique:users',
            //Validation
        ]);

        try {
    
            // If the email doesn't exist, proceed with user creation
            $user = new User;
            $user->name = trim($request->name);
            $user->email = trim($request->email);
            $user->user_type = (int)$request->user_type;
            $user->is_deleted = 0;
            $user->password = Hash::make($request->password);
            $user->save();
    
            $role = $this->getUserRole($request->user_type);
    
            // Redirect with success message after user creation
            return redirect('admin/admin/list')->with('success', $role . " user successfully created");
        } catch (\Exception $e) {
            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->withInput()->withErrors(['email' => 'The email address already exists.'])
            ->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
    

    public function edit($id){
        try {
            date_default_timezone_set('Asia/Manila');
    
            $data['getRecord'] = User::getSingle($id);
    
            // Check if the record with the given ID exists
            if(empty($data['getRecord'])){
                abort(404);
            }
            
            $head['header_title'] = "Edit User";
            return view('admin.admin.edit', $data, compact('head'));
        } catch (\Exception $e) {
            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }

    public function update($id, Request $request){

        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id
            //Validation
        ]);

        try {
            $user = User::getSingle($id);
    
            if (!$user) {
                // User with the given ID not found, return a 404 error
                abort(404);
            }
    
            $user->name = trim($request->name);
            $user->email = trim($request->email);
            $user->user_type = (int)$request->user_type;
    
            // Check if password is provided, then update the password
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
    
            $user->save();
    
            return redirect('admin/admin/list')->with('success', 'User successfully updated');
        } catch (\Exception $e) {
            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->withInput()->withErrors(['email' => 'The email address already exists.'])
            ->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
    
    public function delete($id){
        try {
            $user = User::getSingle($id);
    
            if (!$user) {
                // User with the given ID not found, return a 404 error
                abort(404);
            }
    
            $user->is_deleted = 1;
            $user->save();
    
            return redirect('admin/admin/list')->with('success', 'User successfully deleted');
        } catch (\Exception $e) {
            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }    
    
}
