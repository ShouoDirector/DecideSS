<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\DB;

class SchoolModel extends Model{
    use HasFactory;

    protected $table = 'schools_table';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getSchoolRecords(){
        $query = self::select('schools_table.*')
                        ->where('is_deleted', '!=', '1'); //Deleted schools are excluded
    
        // Execute the query and return the results
        return $query->get();
    }

    //Filter Purposes Non-Deleted Schools
    static public function getSchoolNurseList(){
        $searchTerm = request()->get('search');
    
        // Initialize the base query
        $query = SchoolModel::select('id', 'school', 'school_id', 'school_nurse_id', 'address_barangay', 'district_id', 'created_at', 'updated_at')
            ->where('is_deleted', '!=', '1');
    
        // Additional search conditions for school ID, school name, barangay, and district
        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('school_id', 'like', '%'.$searchTerm.'%')
                    ->orWhere('school', 'like', '%'.$searchTerm.'%')
                    ->orWhere('address_barangay', 'like', '%'.$searchTerm.'%')
                    ->orWhere('district_id', 'like', '%'.$searchTerm.'%');
            })
            ->orWhere(function($query) use ($searchTerm) {
                // Find user IDs based on the search term in the 'email' column of the 'users' table
                $userIds = User::where('email', 'like', '%'.$searchTerm.'%')->pluck('id')->toArray();
            
                $districtIds = DistrictModel::where('district', 'like', '%'.$searchTerm.'%')->pluck('id')->toArray();
    
                $query->whereIn('school_nurse_id', $userIds)
                    ->orWhereIn('district_id', $districtIds);
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

    static public function getSchoolByDistrictId(){
        $searchTerm = request()->get('searchSchools');

        $query = SchoolModel::select('schools_table.*')
            ->where('is_deleted', '!=', '1');
    
        if ($searchTerm !== null && is_numeric($searchTerm)) {

            $searchTermAsInt = intval($searchTerm);
            $query->where('district_id', '=', $searchTermAsInt);
        } elseif ($searchTerm == null) {
            $query->where('district_id', '=', null);
        }
    
        $result = $query->get();
    
        return $result;
    }

    //Filter Purposes Non-Deleted Schools
    static public function getDeletedSchools(){
        $searchTerm = request()->get('search');
    
        // Initialize the base query
        $query = SchoolModel::select('id', 'school', 'school_id', 'school_nurse_id', 'address_barangay', 'district_id', 'created_at', 'updated_at')
            ->where('is_deleted', '=', '1');
    
        // Additional search conditions for school ID, school name, barangay, and district
        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('school_id', 'like', '%'.$searchTerm.'%')
                    ->orWhere('school', 'like', '%'.$searchTerm.'%')
                    ->orWhere('address_barangay', 'like', '%'.$searchTerm.'%')
                    ->orWhere('district_id', 'like', '%'.$searchTerm.'%');
            })
            ->orWhere(function($query) use ($searchTerm) {
                // Find user IDs based on the search term in the 'email' column of the 'users' table
                $userIds = User::where('email', 'like', '%'.$searchTerm.'%')->pluck('id')->toArray();
            
                $districtIds = DistrictModel::where('district', 'like', '%'.$searchTerm.'%')->pluck('id')->toArray();
    
                $query->whereIn('school_nurse_id', $userIds)
                    ->orWhereIn('district_id', $districtIds);
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

    static public function getSchoolRecord(){
        $searchTerm = request()->get('search');

        $query = SchoolModel::select('schools_table.*')
            ->where('is_deleted', '!=', '1');

        if (!empty($searchTerm) && is_numeric($searchTerm)) {
            $searchTermAsInt = intval($searchTerm);
        
            $query->where('school_id', '=', $searchTermAsInt);
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
        
        $result = $query;
    
        return $result ? $result->first() : null;

    }

    static function getSchoolData(){
        $userId = Auth::user()->id;

        $schoolId = SchoolModel::where('school_nurse_id', $userId)->value('id');

        return $schoolId;
    }
}
