<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolModel extends Model
{
    use HasFactory;

    protected $table = 'schools_table';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getSchoolRecords(){
        $query = self::select('schools_table.*')
                        ->where('is_deleted', '!=', 1); //Deleted accounts are excluded
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getSchoolNurseList(){
        // Initialize the base query
        $query = SchoolModel::select('id', 'school', 'school_nurse_email', 'address_barangay', 'district', 'created_at', 'updated_at')
            ->where('is_deleted', '!=', 1); //Deleted schools are excluded
    
        // Filtering logic
        $school = request()->get('school');
        $email = request()->get('school_nurse_email');
        $barangay = request()->get('address_barangay');
        $district = request()->get('district');
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');
    
        // Group filtering conditions within parentheses
        $query->where(function($query) use ($school, $email, $barangay, $district, $createDate, $updateDate) {
            if (!empty($school)) {
                $query->where('school', 'like', '%'.$school.'%');
            }
            if (!empty($email)) {
                $query->orWhere(function($query) use ($email) {
                    $query->where('school_nurse_email', 'like', '%'.$email.'%');
                });
            }
            if (!empty($barangay)) {
                $query->orWhere(function($query) use ($barangay) {
                    $query->where('address_barangay', 'like', '%'.$barangay.'%');
                });
            }
            if (!empty($district)) {
                $query->orWhere(function($query) use ($district) {
                    $query->where('district', 'like', '%'.$district.'%');
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
        $validSortFields = ['id', 'school', 'school_nurse_email', 'address_barangay', 'district', 'created_at', 'updated_at'];
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
