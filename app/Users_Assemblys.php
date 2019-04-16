<?php

namespace App;

use App\Models\Assembly\Assemblys;
use App\Models\User\Users;
use Illuminate\Database\Eloquent\Model;

class Users_Assemblys extends Model
{
    //
    protected $table = 'users_assemblys';
    protected $guarded=['id'];

    // kết nối bảng users lấy ra những trường ở bảng users
    public function users(){
        return $this->belongsTo(Users::class,'user_id');
    }
    public function assemblys(){
        return $this->belongsTo(Assemblys::class,'assmebly_id');
    }


}
