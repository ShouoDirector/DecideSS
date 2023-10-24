<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SchoolModel extends Model{
    use HasFactory;

    protected $table = 'schools_table';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getSchoolRecords(){
        $query = self::select('schools_table.*')
                        ->where('is_deleted', '!=', 1); //Deleted schools are excluded
    
        // Execute the query and return the results
        return $query->get();
    }

    //Filter Purposes
    static public function getSchoolNurseList(){
        // Initialize the base query
        $query = SchoolModel::select('id', 'school', 'school_id', 'school_nurse_id', 'address_barangay', 'district_id', 'created_at', 'updated_at')
            ->where('is_deleted', '!=', 1); //Deleted schools are excluded
    
        // Filtering logic
        $school = request()->get('school');
        $school_id = request()->get('school_id');
        $school_nurse_id = request()->get('school_nurse_id');
        $barangay = request()->get('address_barangay');
        $district_id = request()->get('district_id');
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');
    
        // Group filtering conditions within parentheses
        $query->where(function($query) use ($school, $school_id, $school_nurse_id, $barangay, $district_id, $createDate, $updateDate) {
            if (!empty($school)) {
                $query->where('school', 'like', '%'.$school.'%');
            }
            if (!empty($school_id)) {
                $query->orWhere(function($query) use ($school_id) {
                    $query->where('school_id', 'like', '%'.$school_id.'%');
                });
            }
            if (!empty($school_nurse_id)) {
                $query->orWhere(function($query) use ($school_nurse_id) {
                    $query->where('school_nurse_id', 'like', '%'.$school_nurse_id.'%');
                });
            }
            if (!empty($barangay)) {
                $query->orWhere(function($query) use ($barangay) {
                    $query->where('address_barangay', 'like', '%'.$barangay.'%');
                });
            }
            if (!empty($district_id)) {
                $query->orWhere(function($query) use ($district_id) {
                    $query->where('district_id', 'like', '%'.$district_id.'%');
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
    
        // Sorting logic
        $sortField = request()->get('sort_field', 'id');
        $sortDirection = request()->get('sort_direction', 'desc');
    
        // Validate sort field to prevent potential SQL injection
        $validSortFields = ['id', 'school', 'school_id', 'school_nurse_id', 'address_barangay', 'district_id', 'created_at', 'updated_at'];
        if (!in_array($sortField, $validSortFields)) {
            $sortField = 'id'; // Default to 'id' if an invalid sort field is provided
        }
    
        // Validate sort direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc'; // Default to 'desc' if an invalid sort direction is provided
        }
    
        // Apply sorting to the query
        $query->orderBy($sortField, $sortDirection);
    
        // Pagination logic
        $pagination = request()->get('pagination', 10);
        $result = $query->paginate($pagination);
    
        return $result;
    }

}
