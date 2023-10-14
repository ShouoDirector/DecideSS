<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
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
        try {
            // Check if the email already exists in the database
            $existingUser = User::where('email', trim($request->email))->first();
    
            if ($existingUser) {
                // Email already exists, return a message
                return redirect()->back()->with('error', 'Email already exists');
            }
    
            // If the email doesn't exist, proceed with user creation
            $user = new User;
            $user->name = trim($request->name);
            $user->email = trim($request->email);
            $user->user_type = (int)$request->user_type;
            $user->is_deleted = 0;
            $user->password = Hash::make($request->password);
            $user->save();
    
            // Determine user role based on user_type
            $role = '';
            if((int)$request->user_type == 1) {
                $role = 'Admin';
            } elseif((int)$request->user_type == 2) {
                $role = 'Medical Officer';
            } elseif((int)$request->user_type == 3) {
                $role = 'School Nurse';
            } elseif((int)$request->user_type == 4) {
                $role = 'Class Adviser';
            }
    
            // Redirect with success message after user creation
            return redirect('admin/admin/list')->with('success', $role . " user successfully created");
        } catch (\Exception $e) {
            // Handle any unexpected exceptions and return an error message
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
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
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
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
