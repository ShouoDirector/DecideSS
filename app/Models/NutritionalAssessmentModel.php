<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NutritionalAssessmentModel extends Model
{
    use HasFactory;

    protected $table = 'pupil_nutritional_assessments';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getNutritionalAssessment($nsrId){
        
        $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', '1')
                ->where('nsr_id', '=', $nsrId);

        $result = $query->get();
        return $result;
    }

    static public function getNutritionalAssessments(){
        
        $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', '1');

        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');

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

    static public function getNArecords(){
        
        $searchTerm = request()->get('search');
        $userId = Auth::user()->id;

        $getPupilId = PupilModel::where('lrn', '=', $searchTerm)
                ->first();

        $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', '1')
                ->where('class_adviser_id', '=', $userId);

        if (!empty($getPupilId)) {
            $query->where(function($query) use ($getPupilId) {
                $query->where('pupil_id', '=', $getPupilId->id);
            });
        }

        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');

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

    static public function getMalnourishedList(){
        $userId = Auth::user()->id;
    
        $schoolData = SchoolModel::where('school_nurse_id', '=', $userId)->first();
    
        if (!$schoolData) {
            // Handle the case when $schoolData is null, e.g., return an empty result or throw an exception.
            return collect(); // Returning an empty collection as an example.
        }
    
        $schoolId = $schoolData->id;
    
        $classIds = ClassroomModel::where('school_id', '=', $schoolId)->get();
    
        // Check if $classIds is not empty before using it
        if ($classIds->isNotEmpty()) {
            $query = self::select('pupil_nutritional_assessments.*')
                ->where('is_deleted', '!=', 1);
    
            foreach ($classIds as $class) {
                $query->orWhere('class_id', '=', $class->id)
                ->whereIn('bmi', ['Severely Wasted', 'Wasted']);
            }
    
            $result = $query->get();
            return $result;
        } else {
            // Handle the case when $classIds is empty, e.g., return an empty result or throw an exception.
            return collect(); // Returning an empty collection as an example.
        }
    }
    
    
    
}
