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

    public function getAllPupils(){
        // Initialize the base query
        $query = self::select('pupil.*')->where('is_deleted', '!=', '1');

        // Filtering logic
        $searchTerm = request()->get('search');
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');

        // Group filtering conditions within parentheses
        $query->where(function($query) use ($searchTerm, $createDate, $updateDate) {
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
            if (!empty($createDate)) {
                $formattedDate1 = date('Y-m-d', strtotime($createDate));
                $query->orWhereDate('created_at', '=', $formattedDate1);
            }
            if (!empty($updateDate)) {
                $formattedDate2 = date('Y-m-d', strtotime($updateDate));
                $query->orWhereDate('updated_at', '=', $formattedDate2);
            }
        });

        // Sorting logic based on select field values
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
    
    static public function getPupil(){
        $return = PupilModel::select('pupil.*')
        ->where('is_deleted', '!=', '1')
        ->get();

        return $return;
    }

    static public function selectedPupil(){

        $searchTerm = request()->get('search');
    
        $query = PupilModel::select('pupil.*')
            ->where('is_deleted', '!=', '1');

        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('lrn', '=', $searchTerm);
            });
        }
    
        return $query->get();
    }

    static public function searchedPupil(){

        $searchTerm = request()->get('search');
    
        $query = PupilModel::select('pupil.*')
            ->where('is_deleted', '!=', '1');

        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('lrn', '=', $searchTerm);
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

    static public function searchedPupilByName(){
        $searchTerm = request()->get('name');
    
        $query = PupilModel::whereRaw("CONCAT_WS(' ', first_name, last_name) LIKE ?", ['%' . $searchTerm . '%'])
                        ->whereNotNull('id'); // Add this line to filter out null IDs
    
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
        $pagination = request()->get('pagination', 25);
        $result = $query->paginate($pagination);
    
        return $result;
    }
    
    static public function getPupilList(){
        $userId = Auth::user()->id;
        $searchTerm = request()->get('search');

        $query = PupilModel::select('pupil.*')
            ->where('added_by', '=', $userId)
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
        $pagination = request()->get('pagination', 100);
        $result = $query->paginate($pagination);
    
        return $result;
    }
}
