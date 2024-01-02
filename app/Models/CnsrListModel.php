<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CnsrListModel extends Model
{
    use HasFactory;

    protected $table = 'cnsr_list';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getCNSRLists(){
        $query = self::select('cnsr_list.*');
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getCNSRBySchoolNurse(){
        $userId = Auth::user()->id;

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();

        $query = self::select('cnsr_list.*')
        ->where('school_nurse_id', '=', $userId)
        ->where('schoolyear_id', '=', $activeSchoolYear->id);
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getSchoolData(){

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();

        $activeSchoolYearId = $activeSchoolYear->id;

        $userId = Auth::user()->id;

        $query = self::select('cnsr_list.*')
            ->where('school_nurse_id', '=', $userId)
            ->where('schoolyear_id', '=', $activeSchoolYearId);
    
        // Execute the query and return the results
        return $query->get();
    }
    
}
