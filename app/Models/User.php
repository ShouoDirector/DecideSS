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
    protected $fillable = [
        'unique_id',
        'name',
        'email',
        'user_type',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
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
    
    static public function getUserRecords(){
        $query = self::select('users.*')
                        ->where('is_deleted', '!=', '1');

        return $query->get();
    }

    //Filter purposes
    public function getUsers(){
        // Initialize the base query
        $query = self::select('users.*')->where('is_deleted', '!=', '1') //Deleted accounts is excluded
                                        ->where('user_type', '!=', '1'); //Admin account is excluded

        // Filtering logic
        $searchTerm = request()->get('search');
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');

        // Group filtering conditions within parentheses
        $query->where(function($query) use ($searchTerm, $createDate, $updateDate) {
            if (!empty($searchTerm)) {
                $query->where(function($query) use ($searchTerm) {
                    $query->where('name', 'like', '%'.$searchTerm.'%')
                        ->orWhere('email', 'like', '%'.$searchTerm.'%')
                        ->orWhere('unique_id', 'like', '%'.$searchTerm.'%');
        
                    // Map role names to their corresponding integer values
                    $roleMapping = [
                        'Medical Officer' => 2,
                        'School Nurse' => 3,
                        'Class Adviser' => 4,
                    ];
        
                    // Check if the search term corresponds to a role name
                    if (array_key_exists($searchTerm, $roleMapping)) {
                        $query->orWhere('user_type', $roleMapping[$searchTerm]);
                    }
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

        // Sorting logic based on select field values
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

    static public function getListOfClassAdvisers(){
        $searchTerm = request()->get('search');

        $query = User::select('users.*')
            ->where('is_deleted', '!=', '1')
            ->where('user_type', '=', '4');

        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('unique_id', 'like', '%'.$searchTerm.'%');
            });
        }

        return $query->get();
    }
    
    static public function getClassAdviser(){
        $searchTerm = request()->get('search_id');

        $query = User::select('users.*')
            ->where('is_deleted', '!=', '1')
            ->where('user_type', '=', '4');

        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('unique_id', '=', $searchTerm);
            });
        }

        return $query->get();
    }

    static public function getAllUsers(){

        $query = User::select('users.*')
            ->where('is_deleted', '!=', '1');

        return $query->get();
    }

    static public function getUsersByAdmin(){

        $query = User::select('users.*')
            ->where('is_deleted', '!=', '1');

            $searchTerm = request()->get('search');
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');

            $query->where(function($query) use ($searchTerm, $createDate, $updateDate) {
                if (!empty($searchTerm)) {
                    $query->where(function($query) use ($searchTerm) {
                        $query->where('name', 'like', '%'.$searchTerm.'%')
                            ->orWhere('email', 'like', '%'.$searchTerm.'%')
                            ->orWhere('unique_id', 'like', '%'.$searchTerm.'%');
            
                        // Map role names to their corresponding integer values
                        $roleMapping = [
                            'Medical Officer' => 2,
                            'School Nurse' => 3,
                            'Class Adviser' => 4,
                        ];
            
                        // Check if the search term corresponds to a role name
                        if (array_key_exists($searchTerm, $roleMapping)) {
                            $query->orWhere('user_type', $roleMapping[$searchTerm]);
                        }
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
            // Sorting logic based on select field values
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


    //Accounts Archive Tab
    public function getDeletedUsers(){
        // Initialize the base query
        $query = self::select('users.*')->where('is_deleted', '=', '1') //Deleted accounts is excluded
                                        ->where('user_type', '!=', '1'); //Admin account is excluded

        // Filtering logic
        $searchTerm = request()->get('search');
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');

        // Group filtering conditions within parentheses
        $query->where(function($query) use ($searchTerm, $createDate, $updateDate) {
            if (!empty($searchTerm)) {
                $query->where(function($query) use ($searchTerm) {
                    $query->where('name', 'like', '%'.$searchTerm.'%')
                        ->orWhere('email', 'like', '%'.$searchTerm.'%')
                        ->orWhere('unique_id', 'like', '%'.$searchTerm.'%');
        
                    // Map role names to their corresponding integer values
                    $roleMapping = [
                        'Medical Officer' => 2,
                        'School Nurse' => 3,
                        'Class Adviser' => 4,
                    ];
        
                    // Check if the search term corresponds to a role name
                    if (array_key_exists($searchTerm, $roleMapping)) {
                        $query->orWhere('user_type', $roleMapping[$searchTerm]);
                    }
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
        // Sorting logic based on select field values
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
    


    static public function getEmailSingle($email){
        return User::where('email', '=', $email)->first();
    }

    static public function getTokenSingle($remember_token){
        return User::where('remember_token', '=', $remember_token)->first();
    }
}
