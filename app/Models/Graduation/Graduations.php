<?php

namespace App\Models\Graduation;

use App\Models\Assembly\Assemblys;
use App\Models\Department\Departments;
use App\Models\Subject\Subjects;
use App\Models\User\Users;
use App\Models\Year\Years;
use Illuminate\Database\Eloquent\Model;

class Graduations extends Model
{
    //
    protected $table = 'graduations';
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
    public function subject(){
        return $this->belongsTo(Subjects::class,'subject_id');
    }
    public function userTeacher(){
        return $this->belongsTo(Users::class,'user_teacher_id');
    }
    public function userStudent(){
        return $this->belongsTo(Users::class,'user_student_id');
    }
    public function assembly(){
        return $this->belongsTo(Assemblys::class,'assembly_id');
    }

}
