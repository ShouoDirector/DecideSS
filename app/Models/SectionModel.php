<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionModel extends Model
{
    use HasFactory;

    protected $table = 'sections';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getSections(){
        $searchTerm = request()->get('search');
    
        // Initialize the base query
        $query = SectionModel::select('id', 'section_code', 'section_name', 'grade_level', 'school_id', 'created_at', 'updated_at')
            ->where('is_deleted', '!=', '1');
    
        // Additional search conditions for school ID, school name, barangay, and district
        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('section_name', 'like', '%'.$searchTerm.'%');
            })
            ->orWhere(function($query) use ($searchTerm) {
                // Find user IDs based on the search term in the 'email' column of the 'users' table
                $schoolIds = SchoolModel::where('school', 'like', '%'.$searchTerm.'%')->pluck('id')->toArray();
    
                $query->whereIn('school_id', $schoolIds);
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

    static public function getDeletedSections(){
        $searchTerm = request()->get('search');
    
        // Initialize the base query
        $query = SectionModel::select('id', 'section_code', 'section_name', 'grade_level', 'school_id', 'created_at', 'updated_at')
            ->where('is_deleted', '=', '1');
    
        // Additional search conditions for school ID, school name, barangay, and district
        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('section_name', 'like', '%'.$searchTerm.'%');
            })
            ->orWhere(function($query) use ($searchTerm) {
                // Find user IDs based on the search term in the 'email' column of the 'users' table
                $schoolIds = SchoolModel::where('school', 'like', '%'.$searchTerm.'%')->pluck('id')->toArray();
    
                $query->whereIn('school_id', $schoolIds);
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

    static public function getSection(){
        $searchTerm = request()->get('search');
    
        // Initialize the base query
        $query = SectionModel::select('id', 'section_code', 'section_name', 'grade_level', 'school_id', 'created_at', 'updated_at')
            ->where('is_deleted', '!=', '1');
    
        // Additional search conditions for school ID, school name, barangay, and district
        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('section_code', '=', $searchTerm);
            });
        }
    
        // Pagination logic
        $result = $query->first();
    
        return $result;
    }

    static public function getAllSection(){
        $searchTerm = request()->get('search');
    
        // Initialize the base query
        $query = SectionModel::select('id', 'section_code', 'section_name', 'grade_level', 'school_id', 'created_at', 'updated_at')
            ->where('is_deleted', '!=', '1');
    
        // Additional search conditions for school ID, school name, barangay, and district
        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('section_code', '=', $searchTerm);
            });
        }
    
        // Pagination logic
        $result = $query->first();
    
        return $result;
    }

    static public function getSectionBySchoolId(){
        $searchTerm = request()->get('searchSections');

        $query = SectionModel::select('sections.*')
            ->where('is_deleted', '!=', '1');
    
        if ($searchTerm !== null && is_numeric($searchTerm)) {

            $searchTermAsInt = intval($searchTerm);
            $query->where('school_id', '=', $searchTermAsInt);
        } elseif ($searchTerm == null) {
            $query->where('school_id', '=', null);
        }
    
        $result = $query->get();
    
        return $result;
    }

    static public function getRetrievedSectionId(){
        $searchTerm = request()->get('retrieveId');

        $query = SectionModel::select('sections.*')
            ->where('is_deleted', '!=', '1');
    
        if ($searchTerm !== null && is_numeric($searchTerm)) {

            $searchTermAsInt = intval($searchTerm);
            $query->where('id', '=', $searchTermAsInt);
        } elseif ($searchTerm == null) {
            $query->where('id', '=', null);
        }
    
        $result = $query->get();
    
        return $result;
    }

}
