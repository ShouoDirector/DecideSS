<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ClassroomModel extends Model
{
    use HasFactory;

    protected $table = 'class';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getClassroomRecords(){
        $query = self::select('class.*')
                        ->where('is_deleted', '!=', '1'); //Deleted accounts are excluded
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getClassroomRecordsForCurrentUser()
    {
        $userId = Auth::user()->id;

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $query = self::select('class.*')
            ->where('is_deleted', '!=', '1') // Exclude deleted accounts
            ->where('classadviser_id', '=', $userId)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);

        // Execute the query and return the results
        return $query->get();
    }

    static public function getClassroomRecordsForClassAdviser()
    {
        $userId = Auth::user()->id;

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $query = self::select('class.*')
            ->where('is_deleted', '!=', '1')
            ->where('classadviser_id', '=', $userId)
            ->where('schoolyear_id', '=', $activeSchoolYear->id)
            ->first();

        // Execute the query and return the results
        return $query;
    }

    static public function getClassroomRecordsForCurrentSchoolNurse()
    {
        $userId = Auth::user()->id;

        $school = SchoolModel::where('school_nurse_id', '=', $userId)->first();

        $schoolYear = request()->get('schoolYear');
        
        if(!empty($schoolYear)){
            $activeSchoolYear = $schoolYear;
        }else{
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->pluck('id')
        ->first();
        }

        $query = self::select('class.*')
            ->where('school_id', '=', $school->id)
            ->where('schoolyear_id', '=', $activeSchoolYear)
            ->where('is_deleted', '!=', '1');

        // Execute the query and return the results
        return $query->get();
    }

    static public function getClassroomRecordsForSchoolNurse()
    {
        $userId = Auth::user()->id;

        $school = SchoolModel::where('school_nurse_id', '=', $userId)->first();


        $query = self::select('class.*')
            ->where('school_id', '=', $school->id)
            ->where('is_deleted', '!=', '1');

        // Execute the query and return the results
        return $query->get();
    }

    static public function getClassroomsForCurrentSchoolNurse()
    {
        $userId = Auth::user()->id;

        $school = SchoolModel::where('school_nurse_id', '=', $userId)->first();

        $query = self::select('class.*')
            ->where('school_id', '=', $school->id)
            ->where('is_deleted', '!=', '1')
            ->first();

        // Execute the query and return the results
        return $query->get();
    }

    static public function getClassroomsForCurrentMO()
    {
        $userId = Auth::user()->id;

        $school = SchoolModel::where('school_nurse_id', '=', $userId)->first();

        $query = self::select('class.*')
            ->where('school_id', '=', $school->id)
            ->where('is_deleted', '!=', '1');

        // Execute the query and return the results
        return $query->get();
    }

    static public function getClassroomsUnderSchool(){
        $school = request()->get('masterlist');

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $query = self::select('class.*')
            ->where('school_id', '=', $school)
            ->where('schoolyear_id', '=', $activeSchoolYear->id)
            ->where('is_deleted', '!=', '1');

        return $query->get();
    }

    static public function getClassroomsForCurrenMO()
    {
        $school = request()->get('class');

        $query = self::select('class.*')
            ->where('school_id', '=', $school)
            ->where('is_deleted', '!=', '1');

        // Execute the query and return the results
        return $query->get();
    }

    static public function getClassroomsForAdmin()
    {
        $sectionId = request()->get('sectionId') ?? null;

        $query = self::select('class.*')
            ->where('section_id', '=', $sectionId)
            ->where('is_deleted', '!=', '1');

        // Execute the query and return the results
        return $query->get();
    }

    static public function getClassesForAdmin()
    {
        $schoolId = request()->get('schoolId') ?? null;

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $query = self::select('class.*')
            ->where('school_id', '=', $schoolId)
            ->where('schoolyear_id', '=', $activeSchoolYear->id)
            ->where('is_deleted', '!=', '1');

        // Execute the query and return the results
        return $query->get();
    }

    static public function getSectionForCurrentMedicalOfficer()
    {
        $school = request()->get('section');

        $query = self::select('class.*')
            ->where('id', '=', $school)
            ->where('is_deleted', '!=', '1');

        // Execute the query and return the results
        return $query->get();
    }

    static public function getClassroomsForCurrentMedicalOfficer()
    {
        $userId = Auth::user()->id;

        $districts = DistrictModel::where('medical_officer_id', '=', $userId)->first();

        $school = SchoolModel::where('district_id', '=', $districts->id)->pluck('id');

        $query = self::select('class.*')
            ->whereIn('school_id', $school)
            ->where('is_deleted', '!=', '1');

        // Execute the query and return the results
        return $query->get();
    }

    static public function getClassroomRecordsForCurrentMedicalOfficer()
    {
        $query = self::select('class.*')
            ->where('is_deleted', '!=', '1');

        // Execute the query and return the results
        return $query->get();
    }

    static public function getClassrooms(){

        $searchTerm = request()->get('search');

        $query = self::select('id', 'section', 'school_id', 'classadviser_id', 'grade_level', 'schoolyear_id', 
                            'created_at', 'updated_at')
            ->where('is_deleted', '!=', '1');

        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('section', 'like', '%'.$searchTerm.'%')
                    ->orWhere('grade_level', 'like', '%'.$searchTerm.'%');
            })
            ->orWhere(function($query) use ($searchTerm) {
                $schoolIds = SchoolModel::where('school', 'like', '%'.$searchTerm.'%')->pluck('id')->toArray();

                $adviserIds = User::where('email', 'like', '%'.$searchTerm.'%')->pluck('id')->toArray();

                $query->whereIn('school_id', $schoolIds)
                    ->orWhereIn('classadviser_id', $adviserIds);
            });
        }
    
        // Rest of your filtering logic remains unchanged
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');
    
        // Group filtering conditions within parentheses
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

    static public function getDeletedClassrooms(){
        $user = Auth::user(); // Get the authenticated user (school nurse)

        // Filtering logic
        $section = request()->get('section');
        $classadviser_id = request()->get('classadviser_id');
        $grade_level = request()->get('grade_level');
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');

        // Find user IDs based on the search term in the 'email' column of the 'users' table
        $adviserIds = User::where('email', 'like', '%'.$classadviser_id.'%')->pluck('id')->toArray();

        // Get the school nurse's associated school
        $schoolId = SchoolModel::where('school_nurse_id', $user->id)->value('id');

        $query = self::select('id', 'section', 'school_id', 'classadviser_id', 'grade_level', 'created_at', 'updated_at')
            ->where('is_deleted', '=', '1')
            ->whereIn('classadviser_id', $adviserIds)
            ->where('school_id', $schoolId);
    
        // Group filtering conditions within parentheses
        $query->where(function($query) use ($section, $grade_level, $createDate, $updateDate) {
            if (!empty($section)) {
                $query->where('section', 'like', '%'.$section.'%');
            }
            if (!empty($grade_level)) {
                $query->where('grade_level', 'like', '%'.$grade_level.'%');
            }
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
}
