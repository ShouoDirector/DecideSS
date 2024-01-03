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

    protected $fillable = [
        'cnsr_code',
        'school_id',
        'school_nurse_id',
        'schoolyear_id',
        'no_of_pupils',
        'no_of_male_pupils',
        'no_of_female_pupils',
        'no_of_severely_stunted',
        'no_of_male_severely_stunted',
        'no_of_female_severely_stunted',
        'no_of_stunted',
        'no_of_male_stunted',
        'no_of_female_stunted',
        'no_of_height_normal',
        'no_of_male_height_normal',
        'no_of_female_height_normal',
        'no_of_tall',
        'no_of_male_tall',
        'no_of_female_tall',
        'no_of_stunted_pupils',
        'no_of_male_stunted_pupils',
        'no_of_female_stunted_pupils',
        'no_of_severely_wasted',
        'no_of_male_severely_wasted',
        'no_of_female_severely_wasted',
        'no_of_wasted',
        'no_of_male_wasted',
        'no_of_female_wasted',
        'no_of_weight_normal',
        'no_of_male_weight_normal',
        'no_of_female_weight_normal',
        'no_of_overweight',
        'no_of_male_overweight',
        'no_of_female_overweight',
        'no_of_obese',
        'no_of_male_obese',
        'no_of_female_obese',
        'no_of_malnourished_pupils',
        'no_of_male_malnourished_pupils',
        'no_of_female_malnourished_pupils',
        'district_cnsr_id',
        'is_approved',
        'approved_date',
        'is_deleted',
    ];

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

        $listOfSchoolsUnderMedicalOfficer = SchoolModel::where('district_id', '=', $district->id)
            ->pluck('id');

        $query = self::select('cnsr_list.*')
            ->whereIn('school_id', $listOfSchoolsUnderMedicalOfficer)
            ->where('schoolyear_id', '=', $activeSchoolYear->id)
            ->where('is_approved', '=', '1');

        // Execute the query and return the results
        return $query->get();
    }


    static public function getSchoolData(){

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->first();

        $searchTerm = request()->get('searchTime');

        $userId = Auth::user()->id;

        if (!empty($searchTerm)) {
            $query = self::select('cnsr_list.*')
            ->where('school_nurse_id', '=', $userId)
            ->where('schoolyear_id', '=', $searchTerm);
        }
        else{

            $activeSchoolYearId = $activeSchoolYear->id;

            $query = self::select('cnsr_list.*')
            ->where('school_nurse_id', '=', $userId)
            ->where('schoolyear_id', '=', $activeSchoolYearId);
        }
        
    
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
        $userId = Auth::user()->id;

        $activeSchoolYear = SchoolYearModel::where('status', '=', 'Active')->first();

        $district = DistrictModel::where('medical_officer_id', '=', $userId)->first();

        $listOfSchoolsUnderMedicalOfficer = SchoolModel::where('district_id', '=', $district->id)
            ->pluck('id');

        $query = self::select('cnsr_list.*')
            ->whereIn('school_id', $listOfSchoolsUnderMedicalOfficer)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);
    
        // Execute the query and return the results
        return $query->get();
    }
    
}
