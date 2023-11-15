<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionalAssessmentModel extends Model
{
    use HasFactory;

    protected $table = 'pupil_nutritional_assessments';
    protected $guarded = ['id', 'created_at', 'updated_at'];

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
