<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NsrListModel extends Model
{
    use HasFactory;

    protected $table = 'nsr_list';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getNSRLists(){
        $query = self::select('nsr_list.*');
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getNSRList(){
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();

        $query = self::select('nsr_list.*');

        // Execute the query and return the results
        return $query->get();
    }

    static public function getNutritionalStatusReports($cnsrId){
        
        $query = self::select('nsr_list.*')
                ->where('is_deleted', '!=', '1')
                ->where('cnsr_id', '=', $cnsrId);

        $result = $query->get();
        return $result;
    }

    static public function getNSRListsBySchoolNurse(){
        $userId = Auth::user()->id;

        $schoolId = SchoolModel::where('school_nurse_id', $userId)->value('id');

        $query = self::select('nsr_list.*')
            ->where('school_id', '=', $schoolId)
            ->where('is_approved', '=', '1')
            ->orderBy('grade_level');
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getNSRListsByMedicalOfficerForCNSR(){
        $userId = Auth::user()->id;

        $district = DistrictModel::where('medical_officer_id', '=', $userId)->first();

        $listOfSchoolsUnderMedicalOfficer = SchoolModel::where('district_id', '=', $district->id)->pluck('id');

        $query = self::select('nsr_list.*')
            ->whereIn('school_id', $listOfSchoolsUnderMedicalOfficer)
            ->where('is_approved', '=', '1')
            ->orderBy('grade_level');
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getNSRListsByMedicalOfficer(){
        $userId = Auth::user()->id;

        $searchTerm = request()->get('search');

        $query = self::select('nsr_list.*')
            ->where('school_id', '=', $searchTerm)
            ->where('is_approved', '=', '1')
            ->orderBy('grade_level');
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getSectionData(){

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();

        $activeSchoolYearId = $activeSchoolYear->id;

        $userId = Auth::user()->id;

        $query = self::select('nsr_list.*')
            ->where('class_adviser_id', '=', $userId)
            ->where('schoolyear_id', '=', $activeSchoolYearId);
    
        // Execute the query and return the results
        return $query->get();
    }
}
