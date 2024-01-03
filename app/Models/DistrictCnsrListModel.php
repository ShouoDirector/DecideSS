<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DistrictCnsrListModel extends Model
{
    use HasFactory;

    protected $table = 'district_cnsr_list';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getDistrictData(){

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->first();

        $searchTerm = request()->get('searchTime');

        $userId = Auth::user()->id;

        if (!empty($searchTerm)) {
            $query = self::select('district_cnsr_list.*')
            ->where('medical_officer_id', '=', $userId)
            ->where('schoolyear_id', '=', $searchTerm);
        }
        else{

            $activeSchoolYearId = $activeSchoolYear->id;

            $query = self::select('district_cnsr_list.*')
            ->where('medical_officer_id', '=', $userId)
            ->where('schoolyear_id', '=', $activeSchoolYearId);
        }
        
    
        // Execute the query and return the results
        return $query->get();
    }
}
