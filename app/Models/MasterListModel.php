<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MasterListModel extends Model
{
    use HasFactory;

    protected $table = 'masterlists';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getMasterListByPupilId($pupilId){
        // Use the where method to retrieve the record by pupil_id
        return self::where('pupil_id', $pupilId)->first();
    }

    public static function getIdByPupilId($pupilId)
    {
        return self::where('pupil_id', $pupilId)->value('id');
    }
    
    static public function getPupilIfExist(){
        $searchTerm = request()->get('search');

        $query = PupilModel::select('pupil.*')
            ->where('lrn', '=', $searchTerm)
            ->where('is_deleted', '!=', '1');

        return $query->get();
    }
    
    static public function getMasterLists(){
        $query = self::select('masterlists.*');
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getMasterList(){
        $userId = Auth::user()->id;
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();
    
        $searchTerm = request()->get('search');
        
        $query = self::select('masterlists.*')
            ->where('classadviser_id', '=', $userId)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);

        if (!empty($searchTerm)) {
            $query->where(function ($query) use ($searchTerm) {
                $pupilIds = PupilModel::where('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('middle_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('suffix', 'like', '%' . $searchTerm . '%')
                    ->orWhere('lrn', 'like', '%' . $searchTerm . '%')
                    ->orWhere('municipality', 'like', '%' . $searchTerm . '%')
                    ->orWhere('province', 'like', '%' . $searchTerm . '%')
                    ->orWhere('gender', 'like', '%' . $searchTerm . '%')
                    ->orWhere(function ($query) use ($searchTerm) {
                        $query->whereYear('date_of_birth', '=', now()->subYears((int)$searchTerm)->year);
                    })
                    
                    ->pluck('id')
                    ->toArray();

                $adviserIds = User::where('name', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $classIds = ClassroomModel::where('section', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $schoolYearIds = SchoolYearModel::where('school_year', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $query->whereIn('pupil_id', $pupilIds)
                    ->orWhereIn('classadviser_id', $adviserIds)
                    ->orWhereIn('class_id', $classIds)
                    ->orWhereIn('schoolyear_id', $schoolYearIds);
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

    static public function getMasterListClassAdviserCount(){
        $userId = Auth::user()->id;
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();
        
        $query = self::select('masterlists.*')
            ->where('classadviser_id', '=', $userId)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);

        return $query->get();
    }

    static public function getMasterListSchoolNurseCount(){
        $userId = Auth::user()->id;

        $school = SchoolModel::where('school_nurse_id', '=', $userId)->first();

        $listOfSectionsUnderSchoolNurse = ClassroomModel::where('school_id', '=', $school->id)
            ->pluck('id');

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();
        
        $query = self::select('masterlists.*')
            ->whereIn('class_id', $listOfSectionsUnderSchoolNurse)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);

        return $query->get();
    }

    static public function getMasterListMedicalOfficerCount(){
        $userId = Auth::user()->id;
    
        $district = DistrictModel::where('medical_officer_id', '=', $userId)->first();
    
        $schools = SchoolModel::where('district_id', '=', $district->id)->pluck('id');
    
        $listOfSectionsUnderSchoolNurse = ClassroomModel::whereIn('school_id', $schools)->pluck('id');
    
        $activeSchoolYear = SchoolYearModel::where('status', '=', 'Active')->first();
        
        $query = self::select('masterlists.*')
            ->whereIn('class_id', $listOfSectionsUnderSchoolNurse)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);
    
        return $query->get();
    }    

    static public function getMasterListMedicalOfficerID(){
        $searchTerm = request()->get('class');
    
        $activeSchoolYear = SchoolYearModel::where('status', '=', 'Active')->first();

        $classes = ClassroomModel::where('school_id', '=', $searchTerm)->pluck('id');
        
        $query = self::select('masterlists.*')
            ->whereIn('class_id', $classes)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);
    
        return $query->get();
    } 

    static public function getMasterListBySchoolNurse(){
        $userId = Auth::user()->id;
        
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();
    
        $searchTerm = request()->get('search');
        
        $query = self::select('masterlists.*')
            ->where('classadviser_id', '=', $userId)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);

        if (!empty($searchTerm)) {
            $query->where(function ($query) use ($searchTerm) {
                $pupilIds = PupilModel::where('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('middle_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('suffix', 'like', '%' . $searchTerm . '%')
                    ->orWhere('lrn', 'like', '%' . $searchTerm . '%')
                    ->orWhere('municipality', 'like', '%' . $searchTerm . '%')
                    ->orWhere('province', 'like', '%' . $searchTerm . '%')
                    ->orWhere('gender', 'like', '%' . $searchTerm . '%')
                    ->orWhere(function ($query) use ($searchTerm) {
                        $query->whereYear('date_of_birth', '=', now()->subYears((int)$searchTerm)->year);
                    })
                    
                    ->pluck('id')
                    ->toArray();

                $adviserIds = User::where('name', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $classIds = ClassroomModel::where('section', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $schoolYearIds = SchoolYearModel::where('school_year', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $query->whereIn('pupil_id', $pupilIds)
                    ->orWhereIn('classadviser_id', $adviserIds)
                    ->orWhereIn('class_id', $classIds)
                    ->orWhereIn('schoolyear_id', $schoolYearIds);
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

    static public function getMasterListPDF(){
        $userId = Auth::user()->id;
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();
    
        $searchTerm = request()->get('search');
        
        $query = self::select('masterlists.*')
            ->where('classadviser_id', '=', $userId)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);

        if (!empty($searchTerm)) {
            $query->where(function ($query) use ($searchTerm) {
                $pupilIds = PupilModel::where('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('middle_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('suffix', 'like', '%' . $searchTerm . '%')
                    ->orWhere('lrn', 'like', '%' . $searchTerm . '%')
                    ->orWhere('municipality', 'like', '%' . $searchTerm . '%')
                    ->orWhere('province', 'like', '%' . $searchTerm . '%')
                    ->orWhere('gender', 'like', '%' . $searchTerm . '%')
                    ->orWhere(function ($query) use ($searchTerm) {
                        $query->whereYear('date_of_birth', '=', now()->subYears((int)$searchTerm)->year);
                    })
                    
                    ->pluck('id')
                    ->toArray();

                $adviserIds = User::where('name', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $classIds = ClassroomModel::where('section', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $schoolYearIds = SchoolYearModel::where('school_year', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $query->whereIn('pupil_id', $pupilIds)
                    ->orWhereIn('classadviser_id', $adviserIds)
                    ->orWhereIn('class_id', $classIds)
                    ->orWhereIn('schoolyear_id', $schoolYearIds);
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
        $pagination = request()->get('pagination', 9999);
        $result = $query->paginate($pagination);
    
        return $result;
    }

    static public function getMasterListPDFBySchoolNurse(){

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();
    
        $searchTerm = request()->get('class');

        $classAdviserId = ClassroomModel::where('id', '=', $searchTerm)->first();
        
        $query = self::select('masterlists.*')
            ->where('classadviser_id', '=', $classAdviserId->classadviser_id)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);

        if (!empty($searchTerm)) {
            $query->where(function ($query) use ($searchTerm) {
                $pupilIds = PupilModel::where('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('middle_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('suffix', 'like', '%' . $searchTerm . '%')
                    ->orWhere('lrn', 'like', '%' . $searchTerm . '%')
                    ->orWhere('municipality', 'like', '%' . $searchTerm . '%')
                    ->orWhere('province', 'like', '%' . $searchTerm . '%')
                    ->orWhere('gender', 'like', '%' . $searchTerm . '%')
                    ->orWhere(function ($query) use ($searchTerm) {
                        $query->whereYear('date_of_birth', '=', now()->subYears((int)$searchTerm)->year);
                    })
                    
                    ->pluck('id')
                    ->toArray();

                $adviserIds = User::where('name', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $classIds = ClassroomModel::where('section', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $schoolYearIds = SchoolYearModel::where('school_year', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $query->whereIn('pupil_id', $pupilIds)
                    ->orWhereIn('classadviser_id', $adviserIds)
                    ->orWhereIn('class_id', $classIds)
                    ->orWhereIn('schoolyear_id', $schoolYearIds);
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
        $pagination = request()->get('pagination', 9999);
        $result = $query->paginate($pagination);
    
        return $result;
    }

    static public function getCheckedPupilsInMasterList(){
        $userId = Auth::user()->id;
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();
    
        $searchTerm = request()->get('search');
        
        $query = self::select('masterlists.*')
            ->where('classadviser_id', '=', $userId)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);

        if (!empty($searchTerm)) {
            $query->where(function ($query) use ($searchTerm) {
                $pupilIds = PupilModel::where('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('middle_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('suffix', 'like', '%' . $searchTerm . '%')
                    ->orWhere('lrn', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $adviserIds = User::where('name', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $classIds = ClassroomModel::where('section', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $schoolYearIds = SchoolYearModel::where('school_year', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $query->whereIn('pupil_id', $pupilIds)
                    ->orWhereIn('classadviser_id', $adviserIds)
                    ->orWhereIn('class_id', $classIds)
                    ->orWhereIn('schoolyear_id', $schoolYearIds);
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
    
        $result = $query->get();
    
        return $result;
    }

    static public function getPupilRecord(){
        $searchTerm = request()->get('search');

        $query = PupilModel::select('pupil.*')
            ->where('is_deleted', '!=', '1');

        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('lrn', 'like', '%'.$searchTerm.'%');
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

    static public function getListOfMasterlists(){
        $searchTerm = request()->get('class');

        if (empty($searchTerm)) {
            return collect();
        }

        $query = MasterListModel::select('masterlists.*')
            ->where('class_id', '=', $searchTerm);
    
        return $query->get();

    }

    static public function getPupilRecordLineUps(){
        $searchTerm = request()->get('search');

        if (empty($searchTerm)) {
            return collect();
        }

        $pupil = PupilModel::where('lrn', '=', $searchTerm)->first();

        if ($pupil === null) {
            return collect();
        }

        $query = MasterListModel::select('masterlists.*')
            ->where('pupil_id', '=', $pupil->id);
    
        return $query->get();
    }

    static public function getClassRecord(){
        $userId = Auth::user()->id;
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->first();

        $classId = ClassroomModel::select('class.*')
            ->where('classadviser_id', '=', $userId)
            ->where('is_deleted', '!=', '1')
            ->where('schoolyear_id', '=', $activeSchoolYear->id)
            ->first();

        $searchTerm = $classId->id;
    
        if(empty($searchTerm)){
        $searchTerm = request()->get('search');
        }
        
        $query = NutritionalAssessmentModel::select('pupil_nutritional_assessments.*')
            ->where('class_id', '=', $searchTerm)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);
        
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
        $pagination = request()->get('pagination', 9999);
        $result = $query->paginate($pagination);
    
        return $result;
    }

    static public function getClassRecordBySchoolNurse(){
        $userId = Auth::user()->id;
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();
    
        $searchTerm = request()->get('search');
        
        $query = NutritionalAssessmentModel::select('pupil_nutritional_assessments.*')
            ->where('class_id', '=', $searchTerm)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);
        
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
        $pagination = request()->get('pagination', 9999);
        $result = $query->paginate($pagination);
    
        return $result;
    }

    static public function getClassRecordBySchoolNurseById()
    {
        $userId = Auth::user()->id;
        
        // Get the active school year
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->first();

        // Get the school information for the current nurse
        $schools = SchoolModel::select('id') // Assuming the primary key column is 'id', change it accordingly
            ->where('school_nurse_id', '=', $userId)
            ->first();

        // Get the classes for the specified school and school year
        $classes = ClassroomModel::select('id') // Assuming the primary key column is 'id', change it accordingly
            ->where('school_id', '=', $schools->id)
            ->where('schoolyear_id', '=', $activeSchoolYear->id)
            ->first();
        
        // Build the query for the nutritional assessments
        $query = NutritionalAssessmentModel::select('pupil_nutritional_assessments.*')
            ->where('class_id', '=', $classes->id)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);

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
        $pagination = request()->get('pagination', 9999);
        $result = $query->paginate($pagination);

        return $result;
    }
    
    static public function getSchoolRecordByMedicalOfficer(){
        $userId = Auth::user()->id;
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();
    
        $searchTerm = request()->get('search');
        
        $query = NsrListModel::select('nsr_list.*')
            ->where('school_id', '=', $searchTerm)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);
        
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
        $pagination = request()->get('pagination', 9999);
        $result = $query->paginate($pagination);
    
        return $result;
    }


    static public function getClassRecords(){
        $query = NutritionalAssessmentModel::select('pupil_nutritional_assessments.*');

        return $query->get();
    }

    static public function selectedMasterlistPupil(){
        $searchTerm = request()->get('search');

        if(!empty($searchTerm)){
        $pupil = PupilModel::select('pupil.*')
            ->where('is_deleted', '!=', '1')
            ->where('lrn', '=', $searchTerm)
            ->first();

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();

        $query = MasterListModel::select('masterlists.*')
            ->where('pupil_id', '=', $pupil->id)
            ->where('schoolyear_id', '=', $activeSchoolYear->id);

        return $query->get();
        }
    }
}
