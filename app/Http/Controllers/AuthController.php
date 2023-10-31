<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Models\User;
use App\Mail\ForgotPasswordMail;

class AuthController extends Controller
{
    public function Login(){
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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $remember = $request->has('remember');
    
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
    
            switch ($user->user_type) {
                case 1:
                    return redirect()->route('admin.dashboard');
                case 2:
                    return redirect()->route('medical_officer.dashboard');
                case 3:
                    return redirect()->route('school_nurse.dashboard');
                case 4:
                    return redirect()->route('class_adviser.dashboard');
            }
        }
        return redirect()->back()->with('error', 'Invalid email or password');
    }

    public function ForgotPassword(){
        return view('auth.forgotpassword');
    }

    public function PostForgotPassword(Request $request){
        $user = User::getEmailSingle($request->email);
        if(!empty($user)){
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', "Please check your email account and reset password!");
        }
        else{
            return redirect()->back()->with('error', "Email doesn't exists");
        }
    }

    public function Reset($remember_token){
        $user = User::getTokenSingle($remember_token);
        if(!empty($user)){
            $data['user'] = $user;
            return view('auth.reset', $data);
        }
        else{
            abort(404);
        }
    }

    public function PostReset($token, Request $request){
        if($request->password == $request->cpassword){
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(route('home'))->with('success', "Password Successfully Reset");
        }
        else{
            return redirect()->back()->with('error', "New Password and Confirm Password does not match!");
        }
    }

    public function Logout(){
        Auth::logout();
        return redirect(route('home'));
    }
}
