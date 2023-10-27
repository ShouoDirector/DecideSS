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

    //For updating foreign key medical_officer_id
    static public function getDistrictRecordSingle($id){
        return self::select('districts_table.*')
                    ->where('medical_officer_id', $id)
                    ->where('is_deleted', '!=', 1)
                    ->first();
    }

    static public function getMedicalOfficersList(){
        // Filtering logic
        $district = request()->get('district');
        $medical_officer_id = request()->get('medical_officer_id');
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');
    
        // Find user IDs based on the search term in the 'email' column of the 'users' table
        $userIds = User::where('email', 'like', '%'.$medical_officer_id.'%')->pluck('id')->toArray();
        
        $query = DistrictModel::select('id', 'district', 'medical_officer_id', 'created_at', 'updated_at')
            ->where('is_deleted', '!=', 1)
            ->whereIn('medical_officer_id', $userIds); 
    
        // Group filtering conditions within parentheses
        $query->where(function($query) use ($district, $createDate, $updateDate) {
            if (!empty($district)) {
                $query->where('district', 'like', '%'.$district.'%');
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
    

    static public function getDeletedDistricts(){
        // Filtering logic
        $district = request()->get('district');
        $medical_officer_id = request()->get('medical_officer_id');
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');
    
        // Find user IDs based on the search term in the 'email' column of the 'users' table
        $userIds = User::where('email', 'like', '%'.$medical_officer_id.'%')->pluck('id')->toArray();
        
        $query = DistrictModel::select('id', 'district', 'medical_officer_id', 'created_at', 'updated_at')
            ->where('is_deleted', '=', 1)
            ->whereIn('medical_officer_id', $userIds); 
    
        // Group filtering conditions within parentheses
        $query->where(function($query) use ($district, $createDate, $updateDate) {
            if (!empty($district)) {
                $query->where('district', 'like', '%'.$district.'%');
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
