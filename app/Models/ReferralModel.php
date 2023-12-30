<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ReferralModel extends Model
{
    use HasFactory;

    protected $table = 'referrals';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getReferralList(){
        $userId = Auth::user()->id;
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();
    
        $searchTerm = request()->get('search');
        
        $query = self::select('referrals.*')
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
    
        // Pagination logic
        $pagination = request()->get('pagination', 10);
        $result = $query->paginate($pagination);
    
        return $result;
    }

    static public function getReferralListBySchoolNurse(){
        $userId = Auth::user()->id;
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->where('is_deleted', '=', '0')
        ->first();
    
        $searchTerm = request()->get('search');
        
        $searchTerm = trim($searchTerm);

        $query = self::select('referrals.*')
            ->where('schoolyear_id', '=', $activeSchoolYear->id)
            ->where('school_nurse_id', '=', $userId);

        if (!empty($searchTerm)) {
            $query->where('program', 'like', '%' . $searchTerm . '%')
                ->orWhere(function ($query) use ($searchTerm) {

                $pupilIds = PupilModel::where('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('middle_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('suffix', 'like', '%' . $searchTerm . '%')
                    ->orWhere('lrn', '=', $searchTerm)
                    ->pluck('id')
                    ->toArray();

                $adviserIds = User::where('name', 'like', '%' . $searchTerm . '%')
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

    static public function getDeletedReferralList(){
        $userId = Auth::user()->id;
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
        ->where('status', '=', 'Active')
        ->first();
    
        $searchTerm = request()->get('search');
        
        $query = self::select('referrals.*')
            ->where('schoolyear_id', '=', $activeSchoolYear->id)
            ->where('school_nurse_id', '=', $userId)
            ->where('is_deleted', '=', '1');

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
    
        // Pagination logic
        $pagination = request()->get('pagination', 10);
        $result = $query->paginate($pagination);
    
        return $result;
    }
}
