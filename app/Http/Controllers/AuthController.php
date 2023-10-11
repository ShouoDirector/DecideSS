<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(){
        if (!empty(Auth::check())){
            if(Auth::user()->user_type == 1){
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type == 2){
                return redirect('medical_officer/dashboard');
            }
            else if(Auth::user()->user_type == 3){
                return redirect('school_nurse/dashboard');
            }
            else if(Auth::user()->user_type == 4){
                return redirect('class_adviser/dashboard');
            }
        }
        return view('auth.login');
    }

    public function AuthLogin(Request $request){
        $remember = !empty($request->remember); // This will be true if the checkbox is checked, otherwise false
        $credentials = ['email' => $request->email];
    
        // Get the user from the database by email
        $user = User::where('email', $request->email)->first();
    
        // Check if the user exists and the password matches
        if($user && Hash::check($request->password, $user->password)){
            // Authentication successful
            Auth::login($user, $remember); // Pass the $remember variable here

            if(Auth::user()->user_type == 1){
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type == 2){
                return redirect('medical_officer/dashboard');
            }
            else if(Auth::user()->user_type == 3){
                return redirect('school_nurse/dashboard');
            }
            else if(Auth::user()->user_type == 4){
                return redirect('class_adviser/dashboard');
            }
        }
        else{
            // Authentication failed
            return redirect()->back()->with('error', 'Please enter correct email and password');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }
}
