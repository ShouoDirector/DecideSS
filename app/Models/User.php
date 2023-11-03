<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static public function getSingle($id){
        return self::find($id);
    }

    //Filter purposes
    public function getUsers(){
        // Initialize the base query
        $query = self::select('users.*')->where('is_deleted', '!=', '1') //Deleted accounts is excluded
                                        ->where('user_type', '!=', '1'); //Admin account is excluded

        // Filtering logic
        $name = request()->get('name');
        $email = request()->get('email');
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');

        // Group filtering conditions within parentheses
        $query->where(function($query) use ($name, $email, $createDate, $updateDate) {
            if (!empty($name)) {
                $query->where('name', 'like', '%'.$name.'%');
            }
            if (!empty($email)) {
                $query->orWhere(function($query) use ($email) {
                    $query->where('email', 'like', '%'.$email.'%');
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
        $validSortFields = ['id', 'name', 'email', 'user_type', 'created_at', 'updated_at'];
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

    public function getMedicalOfficers(){
        // Initialize the base query
        $query = self::select('users.*')->where('is_deleted', '!=', '1') //Deleted accounts are excluded
                                        ->where('user_type', '=', '2'); //Only Medical Officers are included
    
        // Execute the query and return the results
        return $query->get();
    }

    public function getSchoolNurses(){
        // Initialize the base query
        $query = self::select('users.*')->where('is_deleted', '!=', '1') //Deleted accounts are excluded
                                        ->where('user_type', '=', '3'); //Only School Nurses are included
    
        // Execute the query and return the results
        return $query->get();
    }

    public function getClassAdvisers(){
        // Initialize the base query
        $query = self::select('users.*')->where('is_deleted', '!=', '1') //Deleted accounts are excluded
                                        ->where('user_type', '=', '4'); //Only School Nurses are included
    
        // Execute the query and return the results
        return $query->get();
    }
    


    //Accounts Archive Tab
    public function getDeletedUsers(){
        // Initialize the base query
        $query = self::select('users.*')->where('is_deleted', '=', '1') //Deleted accounts is excluded
                                        ->where('user_type', '!=', '1'); //Admin account is excluded

        // Filtering logic
        $name = request()->get('name');
        $email = request()->get('email');
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');

        // Group filtering conditions within parentheses
        $query->where(function($query) use ($name, $email, $createDate, $updateDate) {
            if (!empty($name)) {
                $query->where('name', 'like', '%'.$name.'%');
            }
            if (!empty($email)) {
                $query->orWhere(function($query) use ($email) {
                    $query->where('email', 'like', '%'.$email.'%');
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
        $validSortFields = ['id', 'name', 'email', 'user_type', 'created_at', 'updated_at'];
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
    


    static public function getEmailSingle($email){
        return User::where('email', '=', $email)->first();
    }

    static public function getTokenSingle($remember_token){
        return User::where('remember_token', '=', $remember_token)->first();
    }
}
