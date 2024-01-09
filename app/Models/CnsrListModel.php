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

    static public function getCNSRByMedicalOfficer()
    {
        $userId = Auth::user()->id;

        $activeSchoolYear = SchoolYearModel::where('status', '=', 'Active')->first();

        $district = DistrictModel::where('medical_officer_id', '=', $userId)->first();

        $listOfSchoolsUnderMedicalOfficer = SchoolModel::where('district_id', '=', $district->id)->pluck('id');

        $query = self::select('cnsr_list.*')
            ->whereIn('school_id', $listOfSchoolsUnderMedicalOfficer)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);

        // Execute the query and return the results
        $result = $query->get();

        return $result;
    }


    static public function getSchoolData(){

        $searchTerm = request()->get('searchTime');

        $userId = Auth::user()->id;

        if (!empty($searchTerm)) {
            $query = self::select('cnsr_list.*')
            ->where('school_nurse_id', '=', $userId)
            ->where('schoolyear_id', '=', $searchTerm);
        }
        else{
            $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->first();

            $activeSchoolYearId = $activeSchoolYear->id;

            $query = self::select('cnsr_list.*')
            ->where('school_nurse_id', '=', $userId)
            ->where('schoolyear_id', '=', $activeSchoolYearId);
        }
        
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getSelectedSchoolData(){

        $searchTerm = request()->get('class');
    
        $school = SchoolModel::find($searchTerm);
    
        $activeSchoolYear = SchoolYearModel::where('status', '=', 'Active')->first();
    
        $activeSchoolYearId = optional($activeSchoolYear)->id;
    
        $query = self::select('cnsr_list.*')
            ->where('school_id', optional($school)->id)
            ->where('schoolyear_id', '=', $activeSchoolYearId);
    
        // Execute the query and return the results
        return $query->get();
    }
    


    static public function getConsolidatedNutritionalStatusReports($districtCnsrId){
        
        $query = self::select('cnsr_list.*')
                ->where('is_deleted', '!=', '1')
                ->where('district_cnsr_id', '=', $districtCnsrId);

        $result = $query->get();
        return $result;
    }

    static public function getCNSRListsByMedicalOfficer(){
        

        $activeSchoolYear = SchoolYearModel::where('status', '=', 'Active')->first();

        $searchTerm = request()->get('search');

        $query = self::select('cnsr_list.*')
            ->where('school_id', '=', $searchTerm)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);
    
        // Execute the query and return the results
        return $query->get();
    }
    
}
