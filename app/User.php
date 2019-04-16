<?php

namespace App;

use App\Models\Department\Departments;
use App\Models\Role\Roles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'code', 'password',
    ];

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
}
