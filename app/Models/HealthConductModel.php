<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class HealthConductModel extends Model
{
    use HasFactory;

    protected $table = 'health_conduct';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $fillable = [
        'pupil_id', 'class_id', 'vaccination1', 'vaccination2', 'vaccination3', 'vaccination4', 
        'feeding1', 'feeding2', 'feeding3', 'feeding4', 'feeding5', 
        'deworming1', 'deworming2', 'deworming3', 'deworming4',
        'dental1', 'dental2', 'dental3', 'dental4', 'dental5',
        'mental1','mental2','mental3','mental4', 'mental5','mental6','mental7',
        'eye1', 'eye2', 'eye3', 'eye4',
        'health1', 'health2', 'health3', 'health4',
    ];

    static public function getHealthRecordsBySchoolNurse(){
        $userId = Auth::user()->id;

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();

        $schoolId = SchoolModel::where('school_nurse_id', '=', $userId)->value('id');

        $classes = ClassroomModel::where('school_id', '=', $schoolId)
                    ->where('schoolyear_id', '=', $activeSchoolYear->id)
                    ->pluck('id');

        $query = BeneficiaryModel::select('beneficiaries.*')
            ->whereIn('class_id', $classes)
            ->orderBy('grade_level');
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getHealthRecordsSpecified(){
        $userId = Auth::user()->id;

        $searchTerm =  request()->input('search');

        $getPupil = PupilModel::where('lrn', '=', $searchTerm)->first();

        $query = BeneficiaryModel::select('beneficiaries.*')
            ->where('pupil_id', '=', $getPupil->id)
            ->orderBy('grade_level');
    
        // Execute the query and return the results
        return $query->get();
    }

}