<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PupilModel extends Model
{
    use HasFactory;

    protected $table = 'pupils';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getPupilRecords(){
        $query = self::select('pupils.*')
                        ->where('is_deleted', '!=', '1'); //Deleted pupils are excluded
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getPupils(){
        // Filtering logic
        $lrn = request()->get('lrn');
        $last_name = request()->get('last_name');
        $first_name = request()->get('first_name');
        $middle_name = request()->get('middle_name');
        $suffix = request()->get('suffix');
        $date_of_birth = request()->get('date_of_birth');
        $barangay = request()->get('barangay');
        $municipality = request()->get('municipality');
        $province = request()->get('province');
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');
    
        // Concatenate first_name, middle_name, last_name, and suffix into 'name'
        $name = trim("{$first_name} {$middle_name} {$last_name} {$suffix}");
    
        $address = "{$barangay}, {$municipality}, {$province}";
    
        $query = PupilModel::select('pupils.*')
            ->where('is_deleted', '!=', '1'); 
    
        // Group filtering conditions within parentheses
        $query->where(function($query) use ($lrn, $last_name, $first_name, $date_of_birth, $barangay, $municipality, $province, $createDate, $updateDate) {
            if (!empty($lrn)) {
                $query->where('lrn', 'like', '%'.$lrn.'%');
            }
            if (!empty($last_name)) {
                $query->where('last_name', 'like', '%'.$last_name.'%');
            }
            if (!empty($first_name)) {
                $query->where('first_name', 'like', '%'.$first_name.'%');
            }
            if (!empty($date_of_birth)) {
                $formattedDate = date('Y-m-d', strtotime($date_of_birth));
                $query->orWhereDate('date_of_birth', '=', $formattedDate);
            }
            if (!empty($barangay)) {
                $query->where('barangay', 'like', '%'.$barangay.'%');
            }
            if (!empty($municipality)) {
                $query->where('municipality', 'like', '%'.$municipality.'%');
            }
            if (!empty($province)) {
                $query->where('province', 'like', '%'.$province.'%');
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
