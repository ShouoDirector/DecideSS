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
        $sortOption = request()->get('sort_option', 'id_desc');
        switch ($sortOption) {
            case 'recently_created':
                $query->orderBy('created_at', 'desc');
                break;
            case 'recently_updated':
                $query->orderBy('updated_at', 'desc');
                break;
            case 'id_desc':
                $query->orderBy('id', 'desc');
                break;
            case 'id_asc':
            default:
                $query->orderBy('id', 'asc');
                break;
        }
    
        // Pagination logic
        $pagination = request()->get('pagination', 10);
        $result = $query->paginate($pagination);
    
        return $result;
    }

    static public function getPupilRecord(){
        $searchTerm = request()->get('search');

        $query = PupilModel::select('id', 'lrn', 'last_name', 'first_name', 'middle_name', 'suffix', 
        'date_of_birth', 'gender', 'barangay', 'municipality', 'province', 'pupil_guardian_name', 'pupil_guardian_contact_no', 'added_by', 'created_at', 'updated_at')
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
        $sortOption = request()->get('sort_option', 'id_desc');
        switch ($sortOption) {
            case 'recently_created':
                $query->orderBy('created_at', 'desc');
                break;
            case 'recently_updated':
                $query->orderBy('updated_at', 'desc');
                break;
            case 'id_desc':
                $query->orderBy('id', 'desc');
                break;
            case 'id_asc':
            default:
                $query->orderBy('id', 'asc');
                break;
        }
    
        // Pagination logic
        $pagination = request()->get('pagination', 10);
        $result = $query->paginate($pagination);
    
        return $result;
    }

}
