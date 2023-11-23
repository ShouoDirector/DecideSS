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
