<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NutritionalAssessmentModel extends Model
{
    use HasFactory;

    protected $table = 'pupil_nutritional_assessments';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = [
        'pupil_id',
        'classadviser_id',
        'school_nurse_id',
        'class_id',
        'schoolyear_id',
        'height',
        'weight',
        'bmi_category',
        'hfa_category',
        'is_feeding_program',
        'is_deworming_program',
        'is_immunization_vax_program',
        'is_mental_healthcare_program',
        'is_dental_care_program',
        'is_eye_care_program',
        'is_health_wellness_program',
        'is_medical_support_program',
        'is_nursing_services',
        'iron_supplementation',
        'is_immunized',
        'immunization_specify',
        'menarche',
        'date_of_examination',
        'explanation',
    ];

    static public function getNutritionalAssessment($nsrId){
        
        $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', '1')
                ->where('nsr_id', '=', $nsrId);

        $result = $query->get();
        return $result;
    }

    static public function getNutritionalAssessments(){
        
        $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', '1');

        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');

        $query->where(function($query) use ($createDate, $updateDate) {
            if (!empty($createDate)) {
                $formattedDate1 = date('Y-m-d', strtotime($createDate));
                $query->orWhereDate('created_at', '=', $formattedDate1);
            }
            if (!empty($updateDate)) {
                $formattedDate2 = date('Y-m-d', strtotime($updateDate));
                $query->orWhereDate('updated_at', '=', $formattedDate2);
            }
        });
    
        // Sorting logic based on radio button selection
        $sortAttribute = request()->get('sort_attribute', 'id');
        $sortOrder = request()->get('sort_order', 'desc'); // Default to Descending for ID

        switch ($sortAttribute) {
            case 'created_at':
            case 'updated_at':
                $query->orderBy($sortAttribute, $sortOrder);
                break;
            case 'id':
            default:
                $query->orderBy('id', $sortOrder);
                break;
        }
    
        // Pagination logic
        $pagination = request()->get('pagination', 10);
        $result = $query->paginate($pagination);
    
        return $result;
    }

    static public function getNArecords(){
        
        $searchTerm = request()->get('search');
        $userId = Auth::user()->id;

        $getPupilId = PupilModel::where('lrn', '=', $searchTerm)
                ->first();

        $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', '1')
                ->where('class_adviser_id', '=', $userId);

        if (!empty($getPupilId)) {
            $query->where(function($query) use ($getPupilId) {
                $query->where('pupil_id', '=', $getPupilId->id);
            });
        }

        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');

        $query->where(function($query) use ($createDate, $updateDate) {
            if (!empty($createDate)) {
                $formattedDate1 = date('Y-m-d', strtotime($createDate));
                $query->orWhereDate('created_at', '=', $formattedDate1);
            }
            if (!empty($updateDate)) {
                $formattedDate2 = date('Y-m-d', strtotime($updateDate));
                $query->orWhereDate('updated_at', '=', $formattedDate2);
            }
        });
    
        // Sorting logic based on radio button selection
        $sortAttribute = request()->get('sort_attribute', 'id');
        $sortOrder = request()->get('sort_order', 'desc'); // Default to Descending for ID

        switch ($sortAttribute) {
            case 'created_at':
            case 'updated_at':
                $query->orderBy($sortAttribute, $sortOrder);
                break;
            case 'id':
            default:
                $query->orderBy('id', $sortOrder);
                break;
        }
    
        // Pagination logic
        $pagination = request()->get('pagination', 10);
        $result = $query->paginate($pagination);
    
        return $result;
    }

    static public function getNArecordsByClassAdviser(){
        
        $userId = Auth::user()->id;
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', '1')
                ->where('class_adviser_id', '=', $userId)
                ->where('schoolyear_id', '=', $activeSchoolYear->id);
    
        return $query;
    }

    static public function getNArecordCountsByClassAdviser(){
        
        $userId = Auth::user()->id;
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', '1')
                ->where('class_adviser_id', '=', $userId)
                ->where('schoolyear_id', '=', $activeSchoolYear->id);
    
        return $query->get();
    }

    static public function getNArecordCountsBySchoolNurse(){
        
        $userId = Auth::user()->id;

        $school = SchoolModel::where('school_nurse_id', '=', $userId)->first();

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $listOfSectionsUnderSchoolNurse = ClassroomModel::where('school_id', '=', $school->id)
            ->where('schoolyear_id', '=', $activeSchoolYear->id)
            ->pluck('id');
        
        $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', '1')
                ->whereIn('class_id', $listOfSectionsUnderSchoolNurse);
    
        return $query->get();
    }

    static public function getNArecordCountsByMedicalOfficer(){
        
        $userId = Auth::user()->id;

        $district = DistrictModel::where('medical_officer_id', '=', $userId)->first();

        $school = SchoolModel::where('district_id', '=', $district->id)->pluck('id');

        $listOfSectionsUnderMedicalOfficer = ClassroomModel::whereIn('school_id', $school)
            ->pluck('id');

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', '1')
                ->whereIn('class_id', $listOfSectionsUnderMedicalOfficer)
                ->where('schoolyear_id', '=', $activeSchoolYear->id);
    
        return $query->get();
    }

    static public function getNArecordCountsByMedicalOfficerSelected(){
        
        $userId = Auth::user()->id;

        $searchTerm = request()->get('class');

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $classes = ClassroomModel::where('id', '=', $searchTerm)->pluck('id');

        $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', '1')
                ->whereIn('class_id', $classes)
                ->where('schoolyear_id', '=', $activeSchoolYear->id);
    
        return $query->get();
    }

    static public function getNAID(){
        $searchTerm = request()->get('search');
    
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();
    
        // Check if activeSchoolYear is not null before proceeding
        if ($activeSchoolYear) {
            $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', '1')
                ->where('class_id', '=', $searchTerm)
                ->where('schoolyear_id', '=', $activeSchoolYear->id)
                ->first();
    
            // Check if query result is not null before calling get()
            if ($query) {
                return $query->get();
            }
        }
    
        // Return an empty result or handle the absence of data based on your requirements
        return collect();
    }
    

    static public function getSingleNArecordsByClassAdviser(){
        
        $userId = Auth::user()->id;
        $searchTerm = request()->get('search');

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $getPupilId = PupilModel::where('lrn', '=', $searchTerm)
            ->first();

        $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', '1')
                ->where('class_adviser_id', '=', $userId)
                ->where('schoolyear_id', '=', $activeSchoolYear->id);

        if (!empty($getPupilId)) {
            $query->where(function($query) use ($getPupilId) {
                $query->where('pupil_id', '=', $getPupilId->id);
            });
        }
    
        return $query->first();
    }

    static public function getNArecordsBySchoolNurse(){
        
        $searchTerm = request()->get('search');

        $getPupilId = PupilModel::where('lrn', '=', $searchTerm)
                ->first();

        $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', '1');

        if (!empty($getPupilId)) {
            $query->where(function($query) use ($getPupilId) {
                $query->where('pupil_id', '=', $getPupilId->id);
            });
        }

        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');

        $query->where(function($query) use ($createDate, $updateDate) {
            if (!empty($createDate)) {
                $formattedDate1 = date('Y-m-d', strtotime($createDate));
                $query->orWhereDate('created_at', '=', $formattedDate1);
            }
            if (!empty($updateDate)) {
                $formattedDate2 = date('Y-m-d', strtotime($updateDate));
                $query->orWhereDate('updated_at', '=', $formattedDate2);
            }
        });
    
        // Sorting logic based on radio button selection
        $sortAttribute = request()->get('sort_attribute', 'id');
        $sortOrder = request()->get('sort_order', 'desc'); // Default to Descending for ID

        switch ($sortAttribute) {
            case 'created_at':
            case 'updated_at':
                $query->orderBy($sortAttribute, $sortOrder);
                break;
            case 'id':
            default:
                $query->orderBy('id', $sortOrder);
                break;
        }
    
        // Pagination logic
        $pagination = request()->get('pagination', 100);
        $result = $query->paginate($pagination);
    
        return $result;
    }

    static public function getMalnourishedList()
    {
        $userId = Auth::user()->id;

        $searchTerm = request()->get('search');
        $searchTerm = trim($searchTerm);
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $schoolData = SchoolModel::where('school_nurse_id', '=', $userId)->first();

        if (!$schoolData) {
            return collect(); // Returning an empty collection.
        }

        $schoolId = $schoolData->id;

        $classIds = ClassroomModel::where('school_id', '=', $schoolId)->get();

        if ($classIds->isNotEmpty()) {
            $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', 1)
                ->where('schoolyear_id', '=', $activeSchoolYear->id);

            foreach ($classIds as $class) {
                $query->orWhere('class_id', '=', $class->id)
                    ->whereIn('bmi', ['Severely Wasted', 'Wasted']);
            }

            $result = $query->get();
            return $result;
        } else {
            return collect(); // Returning an empty collection as an example.
        }
    }

    static public function getMalnourishedListMO()
    {
        $userId = Auth::user()->id;

        $searchTerm = request()->get('search');
        $searchTerm = trim($searchTerm);
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $districtId = DistrictModel::where('medical_officer_id', '=', $userId)->first();

        $schoolData = SchoolModel::where('district_id', '=', $districtId->id)->first();

        if (!$schoolData) {
            return collect(); // Returning an empty collection.
        }

        $schoolId = $schoolData->id;

        $classIds = ClassroomModel::where('school_id', '=', $schoolId)->get();

        if ($classIds->isNotEmpty()) {
            $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', 1)
                ->where('schoolyear_id', '=', $activeSchoolYear->id);

            foreach ($classIds as $class) {
                $query->orWhere('class_id', '=', $class->id)
                    ->whereIn('bmi', ['Severely Wasted', 'Wasted']);
            }

            $result = $query->get();
            return $result;
        } else {
            return collect(); // Returning an empty collection as an example.
        }
    }

    static public function getStuntedList()
    {
        $userId = Auth::user()->id;

        $searchTerm = request()->get('search');
        $searchTerm = trim($searchTerm);
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $schoolData = SchoolModel::where('school_nurse_id', '=', $userId)->first();

        if (!$schoolData) {
            return collect(); // Returning an empty collection.
        }

        $schoolId = $schoolData->id;

        $classIds = ClassroomModel::where('school_id', '=', $schoolId)->get();

        if ($classIds->isNotEmpty()) {
            $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', 1)
                ->where('schoolyear_id', '=', $activeSchoolYear->id);

            foreach ($classIds as $class) {
                $query->orWhere('class_id', '=', $class->id)
                    ->whereIn('hfa', ['Severely Stunted', 'Stunted']);
            }

            $result = $query->get();
            return $result;
        } else {
            return collect(); // Returning an empty collection as an example.
        }
    }

    static public function getObesityList()
    {
        $userId = Auth::user()->id;

        $searchTerm = request()->get('search');
        $searchTerm = trim($searchTerm);
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $schoolData = SchoolModel::where('school_nurse_id', '=', $userId)->first();

        if (!$schoolData) {
            return collect(); // Returning an empty collection.
        }

        $schoolId = $schoolData->id;

        $classIds = ClassroomModel::where('school_id', '=', $schoolId)->get();

        if ($classIds->isNotEmpty()) {
            $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', 1)
                ->where('schoolyear_id', '=', $activeSchoolYear->id);

            foreach ($classIds as $class) {
                $query->orWhere('class_id', '=', $class->id)
                    ->whereIn('bmi', ['Overweight', 'Obese']);
            }

            $result = $query->get();
            return $result;
        } else {
            return collect(); // Returning an empty collection as an example.
        }
    }

    static public function getPermittedAndUndecidedList(){
        $userId = Auth::user()->id;

        $searchTerm = request()->get('search');
        $searchTerm = trim($searchTerm);
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $schoolData = SchoolModel::where('school_nurse_id', '=', $userId)->first();

        if (!$schoolData) {
            return collect(); // Returning an empty collection.
        }

        $schoolId = $schoolData->id;

        $classIds = ClassroomModel::where('school_id', '=', $schoolId)->get();

        if ($classIds->isNotEmpty()) {
            $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', 1)
                ->where('schoolyear_id', '=', $activeSchoolYear->id);

            foreach ($classIds as $class) {
                $query->orWhere('class_id', '=', $class->id)
                    ->whereIn('is_permitted_deworming', ['1', NULL]);
            }

            $result = $query->get();
            return $result;
        } else {
            return collect(); // Returning an empty collection.
        }
    }

    static public function getMalnourishedPupils()
    {
        $userId = Auth::user()->id;

        $activeSchoolYear = SchoolYearModel::where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $classIds = ClassroomModel::where('classadviser_id', '=', $userId)
        ->where('schoolyear_id', '=', $activeSchoolYear->id)
        ->first();
        
        $classId = $classIds->id;

        $query = self::select('pupil_nutritional_assessments.*')
        ->where('is_deleted', '!=', '1')
        ->where('schoolyear_id', '=', $activeSchoolYear->id)
        ->where('class_id', '=', $classId)
        ->where(function ($subquery) {
            $subquery->orWhere('bmi', '=', 'Severely Wasted')
                ->orWhere('bmi', '=', 'Wasted')
                ->orWhere('bmi', '=', 'Overweight')
                ->orWhere('bmi', '=', 'Obese')
                ->orWhere('hfa', '=', 'Severely Stunted')
                ->orWhere('hfa', '=', 'Stunted');
        });

        $result = $query->get();
        return $result;
    }

}
