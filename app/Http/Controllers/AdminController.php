<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function list(){
        $data['getRecord'] = User::getUsers();
        return view('admin.admin.list', $data);
    }

    public function insert(Request $request){
        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->user_type = (int)$request->user_type;
        $user->password = Hash::make($request->password);
        $user->save();
    
        $role = '';
    
        if(Auth::user()->user_type == 1) {
            $role = 'Admin';
        } elseif(Auth::user()->user_type == 2) {
            $role = 'Medical Officer';
        } elseif(Auth::user()->user_type == 3) {
            $role = 'School Nurse';
        } elseif(Auth::user()->user_type == 4) {
            $role = 'Class Adviser';
        }
    
        return redirect('admin/admin/list')->with('success', $role . " user successfully created");
    }
    
}
