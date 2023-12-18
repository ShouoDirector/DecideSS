<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminHistoryModel extends Model
{
    use HasFactory;

    protected $table = 'admin_logs';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getAdminHistory(){
        $query = self::select('admin_logs.*');
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getAdminHistories(){
        $query = self::select('admin_logs.*');
        
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
}
