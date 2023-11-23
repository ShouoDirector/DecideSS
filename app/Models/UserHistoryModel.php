<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserHistoryModel extends Model
{
    use HasFactory;

    protected $table = 'user_logs';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    static public function getUserHistory(){
        $query = self::select('user_logs.*');
    
        // Execute the query and return the results
        return $query->get();
    }

    static public function getUserHistories(){

        $userId = Auth::user()->id;

        $searchTerm = request()->get('search');

        $query = self::select('user_logs.*')
                ->where('user_id', '=', $userId);

        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('action', 'like', '%'.$searchTerm.'%')
                    ->orWhere('old_value', 'like', '%'.$searchTerm.'%')
                    ->orWhere('new_value', 'like', '%'.$searchTerm.'%')
                    ->orWhere('table_name', 'like', '%'.$searchTerm.'%');
            })
            ->orWhere(function($query) use ($searchTerm) {
                $nameIds = User::where('name', 'like', '%'.$searchTerm.'%')->pluck('id')->toArray();
                $nameUniqueIds = User::where('unique_id', 'like', '%'.$searchTerm.'%')->pluck('id')->toArray();

                $query->whereIn('user_id', $nameIds)
                    ->orWhereIn('user_id', $nameUniqueIds);
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

    static public function getAllUserHistories(){

        $searchTerm = request()->get('search');

        $query = self::select('user_logs.*');

        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('action', 'like', '%'.$searchTerm.'%')
                    ->orWhere('old_value', 'like', '%'.$searchTerm.'%')
                    ->orWhere('new_value', 'like', '%'.$searchTerm.'%')
                    ->orWhere('table_name', 'like', '%'.$searchTerm.'%');
            })
            ->orWhere(function($query) use ($searchTerm) {
                $nameIds = User::where('name', 'like', '%'.$searchTerm.'%')->pluck('id')->toArray();
                $nameUniqueIds = User::where('unique_id', 'like', '%'.$searchTerm.'%')->pluck('id')->toArray();

                $query->whereIn('user_id', $nameIds)
                    ->orWhereIn('user_id', $nameUniqueIds);
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
