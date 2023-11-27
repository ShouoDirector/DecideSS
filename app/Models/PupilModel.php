<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PupilModel extends Model
{
    use HasFactory;

    protected $table = 'pupil';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getPupilRecords(){
        $query = self::select('pupil.*')
                        ->where('is_deleted', '!=', '1'); //Deleted pupils are excluded
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getPupils(){

        $userId = Auth::user()->id;

        $searchTerm = request()->get('search');
    
        $query = PupilModel::select('pupil.*')
            ->where('is_deleted', '!=', '1')
            ->where('added_by', '=', $userId);

        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('lrn', 'like', '%'.$searchTerm.'%')
                    ->orWhere('last_name', 'like', '%'.$searchTerm.'%')
                    ->orWhere('first_name', 'like', '%'.$searchTerm.'%')
                    ->orWhere('middle_name', 'like', '%'.$searchTerm.'%')
                    ->orWhere('suffix', 'like', '%'.$searchTerm.'%')
                    ->orWhere('date_of_birth', 'like', '%'.$searchTerm.'%')
                    ->orWhere('barangay', 'like', '%'.$searchTerm.'%')
                    ->orWhere('municipality', 'like', '%'.$searchTerm.'%')
                    ->orWhere('province', 'like', '%'.$searchTerm.'%')
                    ->orWhere('pupil_guardian_name', 'like', '%'.$searchTerm.'%')
                    ->orWhere('pupil_guardian_contact_no', 'like', '%'.$searchTerm.'%');
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
    
    static public function getPupil(){
        $return = PupilModel::select('pupil.*')
        ->where('is_deleted', '!=', '1')
        ->get();

        return $return;
    }
}