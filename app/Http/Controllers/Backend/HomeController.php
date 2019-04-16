<?php

namespace App\Http\Controllers\Backend;

use App\Models\Assembly\Assemblys;
use App\Models\Graduation\Graduations;
use App\Models\User\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{
    //
    public function getHome(){
        // số lượng hội đồng
        $assemblysCount = Assemblys::count();
        $data['assemblysCount'] = $assemblysCount;

        $finishGraduation = Graduations::where('point','>=',5)->count();
        $data['finishGraduation'] = $finishGraduation;

        $failGraduation = Graduations::where('point','<',5)->where('point','!=',0)->count();
        $data['failGraduation'] = $failGraduation;

        $accountCount = Users::count();
        $data['accountCount'] = $accountCount;

        // lịch bảo vê
        if (Auth::user()->role_id == 1 OR Auth::user()->role_id == 2 OR Auth::user()->role_id == 4){
            $calendars = Graduations::where('status',2)->paginate(5);
            $data['calendarList'] = $calendars;
        }
        if (Auth::user()->role_id == 3){
            $user_student_id = Auth::user()->id;
            $calendars = Graduations::where('status',2)->where('user_student_id',$user_student_id)->paginate(5);
            $data['calendarList'] = $calendars;
        }
        return view('backend.home',$data);
    }
    public function getLogout(){
        Auth::logout();
        return redirect()->intended('login');
    }
    public function search(Request $request){
        $all = $request->all();
        $search = array_get($all,'code');
        $users =  Users::where('code','like','%'.$search.'%')->orWhere('name','like','%'.$search.'%')->get();
        $dataSearch['usersListSearch'] = $users;
        $dataSearch['keySearch'] = $search;

        return view('backend.search',$dataSearch);

    }
    public function searchStudent(Request $request){
        $userFaculty = \Auth::user()->faculty_id;
        $userDepartment = \Auth::user()->department_id;
        /*dd($userDepartment);*/

        $all = $request->all();
        $search = array_get($all,'code');
        $users =  Users::where('role_id',3)
            ->where('faculty_id',$userFaculty)
            ->where('department_id',$userDepartment)
            ->where('code','like','%'.$search.'%')
            ->orWhere('name','like','%'.$search.'%')
            ->where('role_id',3)
            ->where('faculty_id',$userFaculty)
            ->where('department_id',$userDepartment)
            ->get();
        $dataSearch['usersListSearch'] = $users;
        $dataSearch['keySearch'] = $search;

        return view('backend.search',$dataSearch);
    }
}
