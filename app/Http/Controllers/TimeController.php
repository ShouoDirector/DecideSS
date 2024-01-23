<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class TimeController extends Controller
{
    public function getCurrentTime()
    {
        return response()->json([
            'current_time' => Carbon::now()->format('l, d/m/Y, h:i:s A'),
        ]);
    }
}