<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ConstantsController extends Controller
{
    public function constants()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head['headerTitle'] = "Admin's Constants";
            $userModel = new User();
            $data['getRecord'] = $userModel->getUsers();

            if (empty($data['getRecord'])) {
                return abort(404);
            }

            return view('admin.constants.constants', compact('data', 'head'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
}
