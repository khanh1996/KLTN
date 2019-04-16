<?php

namespace App\Models\Subject;

use App\Models\Department\Departments;
use App\Models\User\Users;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    //
    protected $table = 'subjects';
    protected $guarded=['id'];

    public function department(){
        return $this->belongsTo(Departments::class,'department_id');
    }
    public function faculty(){
        return $this->belongsTo(Departments::class,'faculty_id');
    }
    public function teacher(){
        return $this->belongsTo(Users::class,'user_id');
    }

}
