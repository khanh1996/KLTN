<?php

namespace App\Models\User;

use App\Models\Assembly\Assemblys;
use App\Models\Role\Roles;
use App\Users_Assemblys;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Department\Departments;
use Maatwebsite\Excel\Excel;

class Users extends Model
{
    //


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
//    protected $fillable = [
//        'code', 'password',
//    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function department(){
        return $this->belongsTo(Departments::class,'department_id');
    }
    public function faculty(){
        return $this->belongsTo(Departments::class,'faculty_id');
    }
    public function role(){
        return $this->belongsTo(Roles::class,'role_id');
    }
    /*public function user_assembly(){
        return $this->belongsToMany(Assemblys::class,'Users_Assemblys','user_id','assmebly_id');
    }*/
    // kết nối bảng Users_Assemblys lấy ra những trường ở bảng Users_Assemblys
    public function users_assemblys(){
        return $this->hasMany(Users_Assemblys::class,'user_id');
    }

}
