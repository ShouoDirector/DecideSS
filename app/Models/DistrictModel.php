<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictModel extends Model
{
    use HasFactory;

    protected $table = 'districts_table';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getDistrictRecords(){
        $query = self::select('districts_table.*')
                        ->where('is_deleted', '!=', 1); //Deleted accounts are excluded
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getMedicalOfficersList(){
        // Initialize the base query
        $query = DistrictModel::select('id', 'district', 'medical_officer_email', 'created_at', 'updated_at')
            ->where('is_deleted', '!=', 1);
    
        // Filtering logic
        $district = request()->get('district');
        $email = request()->get('medical_officer_email');
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');
    
        // Group filtering conditions within parentheses
        $query->where(function($query) use ($district, $email, $createDate, $updateDate) {
            if (!empty($district)) {
                $query->where('district', 'like', '%'.$district.'%');
            }
            if (!empty($email)) {
                $query->orWhere(function($query) use ($email) {
                    $query->where('medical_officer_email', 'like', '%'.$email.'%');
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
        $validSortFields = ['id', 'district', 'medical_officer_email', 'created_at', 'updated_at'];
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
    
    static public function getDistrictsList(){
        // Initialize the base query
        $query = self::select('districts_table.*')->where('is_deleted', '!=', 1); //Deleted accounts are excluded
    
        // Execute the query and return the results
        return $query->get();
    }

}
