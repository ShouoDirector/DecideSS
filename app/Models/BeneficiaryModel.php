<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BeneficiaryModel extends Model
{
    use HasFactory;

    protected $table = 'beneficiaries';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function listOfBeneficiaries(){
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $query = self::select('beneficiaries.*')
                ->where('is_deleted', '!=', '1')
                ->where('schoolyear_id', '=', $activeSchoolYear->id);

        return $query->get();
    }

    static public function getBeneficiaryIfExist(){
        $searchTerm = 0;
        $searchTerm = request()->get('search');

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $query = self::select('beneficiaries.*')
            ->where('schoolyear_id', '=', $activeSchoolYear->id)
            ->where('is_deleted', '!=', '1');

            if (!empty($searchTerm)) {
                $query->where(function ($query) use ($searchTerm) {
                    $pupilIds = PupilModel::where('lrn', 'like', '%' . $searchTerm . '%')
                        ->pluck('id')
                        ->toArray();
    
                    $query->whereIn('pupil_id', $pupilIds);
                });
            }

        return $query->get();
    }

    static public function getSpecifiedBeneficiary(){
        $searchTerm = request()->get('search');

        $query = self::select('beneficiaries.*')
            ->where('is_deleted', '!=', '1');

            if (!empty($searchTerm)) {
                $query->where(function ($query) use ($searchTerm) {
                    $pupilIds = PupilModel::where('lrn', '=', $searchTerm)
                        ->pluck('id')
                        ->toArray();
    
                    $query->whereIn('pupil_id', $pupilIds);
                });
            }

        return $query->get();
    }

    static public function getBeneficiaryListBySchoolNurse(){
        $userId = Auth::user()->id;
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->where('is_deleted', '=', '0')
        ->first();
    
        $searchTerm = request()->get('search');
        
        $searchTerm = trim($searchTerm);

        $query = self::select('beneficiaries.*')
            ->where('schoolyear_id', '=', $activeSchoolYear->id)
            ->where('school_nurse_id', '=', $userId);

        if (!empty($searchTerm)) {
            $query->where('date_of_examination', 'like', '%' . $searchTerm . '%')
                ->orWhere('bmi_category', '=', $searchTerm)
                ->orWhere('hfa_category', '=', $searchTerm)
                ->orWhere(function ($query) use ($searchTerm) {

                $pupilIds = PupilModel::where('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('middle_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('suffix', 'like', '%' . $searchTerm . '%')
                    ->orWhere('lrn', '=', $searchTerm)
                    ->pluck('id')
                    ->toArray();

                $userIds = User::where('name', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $classIds = ClassroomModel::where('section', 'like', '%' . $searchTerm . '%')
                    ->orWhere('grade_level', '=', $searchTerm)
                    ->pluck('id')
                    ->toArray();

                $schoolYearIds = SchoolYearModel::where('school_year', '=', $searchTerm)
                    ->pluck('id')
                    ->toArray();

                $query->whereIn('pupil_id', $pupilIds)
                    ->orWhereIn('classadviser_id', $userIds)
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

    static public function getBeneficiaryListBySchoolNurseProgram(){
        $userId = Auth::user()->id;
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->where('is_deleted', '=', '0')
        ->first();
    
        $searchTerm = request()->get('program');
        $searchTermProgram = request()->get('program_search');

        $searchTerm = trim($searchTerm);

        $query = self::select('beneficiaries.*')
            ->where('schoolyear_id', '=', $activeSchoolYear->id)
            ->where('school_nurse_id', '=', $userId);

        if (!empty($searchTerm || $searchTermProgram)) {
            $query->where('date_of_examination', 'like', '%' . $searchTerm . '%')
                ->orWhere('bmi_category', '=', $searchTerm)
                ->orWhere('hfa_category', '=', $searchTerm)
                ->orWhere(function ($query) use ($searchTerm) {

                $pupilIds = PupilModel::where('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('middle_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('suffix', 'like', '%' . $searchTerm . '%')
                    ->orWhere('lrn', '=', $searchTerm)
                    ->pluck('id')
                    ->toArray();

                $userIds = User::where('name', 'like', '%' . $searchTerm . '%')
                    ->pluck('id')
                    ->toArray();

                $classIds = ClassroomModel::where('section', 'like', '%' . $searchTerm . '%')
                    ->orWhere('grade_level', '=', $searchTerm)
                    ->pluck('id')
                    ->toArray();

                $schoolYearIds = SchoolYearModel::where('school_year', '=', $searchTerm)
                    ->pluck('id')
                    ->toArray();

                $query->whereIn('pupil_id', $pupilIds)
                    ->orWhereIn('classadviser_id', $userIds)
                    ->orWhereIn('class_id', $classIds)
                    ->orWhereIn('schoolyear_id', $schoolYearIds);
            })
            ->orWhere(function ($query) use ($searchTermProgram) {

                $pupilIds = PupilModel::where('last_name', 'like', '%' . $searchTermProgram . '%')
                    ->orWhere('first_name', 'like', '%' . $searchTermProgram . '%')
                    ->orWhere('middle_name', 'like', '%' . $searchTermProgram . '%')
                    ->orWhere('suffix', 'like', '%' . $searchTermProgram . '%')
                    ->orWhere('lrn', '=', $searchTermProgram)
                    ->pluck('id')
                    ->toArray();

                $userIds = User::where('name', 'like', '%' . $searchTermProgram . '%')
                    ->pluck('id')
                    ->toArray();

                $classIds = ClassroomModel::where('section', 'like', '%' . $searchTermProgram . '%')
                    ->orWhere('grade_level', '=', $searchTermProgram)
                    ->pluck('id')
                    ->toArray();

                $schoolYearIds = SchoolYearModel::where('school_year', '=', $searchTermProgram)
                    ->pluck('id')
                    ->toArray();

                $query->whereIn('pupil_id', $pupilIds)
                    ->orWhereIn('classadviser_id', $userIds)
                    ->orWhereIn('class_id', $classIds)
                    ->orWhereIn('schoolyear_id', $schoolYearIds);
            })
            ;
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

    static public function getSchoolBeneficiariesData(){
        $userId = Auth::user()->id;

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->where('is_deleted', '=', '0')
        ->first();

        $searchTerm = request()->get('searchTime');
    
            if (!empty($searchTerm)) {
                $query = self::select('beneficiaries.*')
                ->where('is_deleted', '!=', '1')
                ->where('schoolyear_id', '=', $searchTerm)
                ->where('school_nurse_id', '=', $userId);
            }else{
                $query = self::select('beneficiaries.*')
                ->where('is_deleted', '!=', '1')
                ->where('schoolyear_id', '=', $activeSchoolYear->id)
                ->where('school_nurse_id', '=', $userId);
            }
        
    
        return $query->get();
    }

    static public function getDistrictBeneficiariesData(){
        $userId = Auth::user()->id;

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->where('is_deleted', '=', '0')
        ->first();

        $district = DistrictModel::where('medical_officer_id', '=', $userId)->first();

        $searchTerm = request()->get('searchTime');
    
            if (!empty($searchTerm)) {
                $query = self::select('beneficiaries.*')
                ->where('is_deleted', '!=', '1')
                ->where('schoolyear_id', '=', $searchTerm)
                ->where('district_id', '=', $district->id);
            }else{
                $query = self::select('beneficiaries.*')
                ->where('is_deleted', '!=', '1')
                ->where('schoolyear_id', '=', $activeSchoolYear->id)
                ->where('district_id', '=', $district->id);
            }
        
    
        return $query->get();
    }

}
