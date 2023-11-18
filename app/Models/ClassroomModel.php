<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ClassroomModel extends Model
{
    use HasFactory;

    protected $table = 'classroom';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getClassroomRecords(){
        $query = self::select('classroom.*')
                        ->where('is_deleted', '!=', '1'); //Deleted accounts are excluded
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getClassrooms(){

        $searchTerm = request()->get('search');

        $query = self::select('id', 'section', 'school_id', 'classadviser_id', 'grade_level', 'created_at', 'updated_at')
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
