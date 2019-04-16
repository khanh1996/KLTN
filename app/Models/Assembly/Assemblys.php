<?php

namespace App\Models\Assembly;

use App\Models\Department\Departments;
use App\Models\User\Users;
use App\Models\Year\Years;
use App\Users_Assemblys;
use Illuminate\Database\Eloquent\Model;

class Assemblys extends Model
{
    //
    protected $table = 'assemblys';
    protected $guarded=['id'];

    public function department(){
        return $this->belongsTo(Departments::class,'department_id');
    }
    public function faculty(){
        return $this->belongsTo(Departments::class,'faculty_id');
    }
    public function year(){
        return $this->belongsTo(Years::class,'year_id');
    }
    /*public function assembly_user(){
        return $this->belongsToMany(Users::class,'Users_Assemblys','assmebly_id','user_id');
    }*/
    // kết nối bảng Users_Assemblys lấy ra những trường ở bảng Users_Assemblys
    public function assemblys_users(){
        return $this->hasMany(Users_Assemblys::class,'assmebly_id');
    }
}
