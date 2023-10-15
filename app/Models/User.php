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
        'name',
        'email',
        'password',
    ];

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

    public function getUsers(){
        $query = self::select('users.*')
                    ->where('is_deleted', '!=', 1);
    
        $name = request()->get('name');
        $email = request()->get('email');
        $createDate = request()->get('create_date');
        $updateDate = request()->get('update_date');

        if (!empty($name)) {
            $query->where('name', 'like', '%'.$name.'%');
        }
        if (!empty($email)) {
            $query->orWhere('email', 'like', '%'.$email.'%');
        }
        if (!empty($createDate)) {
            // Convert input date to the format used in the database
            $formattedDate1 = date('Y-m-d', strtotime($createDate));
            // Filter based on the formatted date
            $query->whereDate('created_at', '=', $formattedDate1);
        }
        if (!empty($updateDate)) {
            // Convert input date to the format used in the database
            $formattedDate2 = date('Y-m-d', strtotime($updateDate));
            // Filter based on the formatted date
            $query->whereDate('updated_at', '=', $formattedDate2);
        }
    
        $result = $query->orderBy('id', 'desc')
                        ->paginate(2);
        return $result;
    }
    
    


    static public function getEmailSingle($email){
        return User::where('email', '=', $email)->first();
    }

    static public function getTokenSingle($remember_token){
        return User::where('remember_token', '=', $remember_token)->first();
    }
}
