<?php

namespace App\Http\Controllers\Backend;

use App\Models\Assembly\Assemblys;
use App\Models\Graduation\Graduations;
use App\Models\Subject\Subjects;
use App\Models\User\Users;
use App\Models\Year\Years;
use App\Models\Department\Departments;
use App\Users_Assemblys;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // chú ý : 1 là đã đăng ký, 2 là đã xác nhận bảo vệ, 3 là hoàn thành, 4 chưa hoàn thành cho KLTN

        $registrationGraduation = Graduations::where('status',1)->count();
        $data['registrationGraduation'] = $registrationGraduation;

        $confirmGraduation = Graduations::where('status',2)->count();
        $data['confirmGraduation'] = $confirmGraduation;

        $finishGraduation = Graduations::where('status',3)->count();
        $data['finishGraduation'] = $finishGraduation;

        $failGraduation = Graduations::where('status',4)->count();
        $data['failGraduation'] = $failGraduation;

        $allGraduation = $registrationGraduation + $confirmGraduation + $finishGraduation + $failGraduation;
        $data['allGraduation'] = $allGraduation;

        // chú ý : 1 là dễ, 2 là trung bình, 3 là khó cho đề tài


        $easySubject = Subjects::where('evaluate',1)->count();
        $mediumSubject = Subjects::where('evaluate',2)->count();
        $hardSubject = Subjects::where('evaluate',3)->count();

        $totalSubject = $easySubject + $mediumSubject + $hardSubject;
        if ($totalSubject !=0){
            $data['easySubject'] =  ($easySubject*100)/$totalSubject;
            $data['mediumSubject'] = ($mediumSubject*100)/$totalSubject;
            $data['hardSubject'] = ($hardSubject*100)/$totalSubject;
        }
        else{
            $data['easySubject'] = 0;
            $data['mediumSubject'] = 0;
            $data['hardSubject'] = 0;
        }

        // thống kê lượng sinh viên hoàn thành theo từng năm học


        $years = Years::all();


        $arrayYears = [];
        foreach ($years as $value){
            $arrayYears[$value->id] = $value->id;
        }

        $department = \Auth::user()->department_id;
        /*dd($department);*/
        $finish = Graduations::where('status',3)->orWhere('status',4)->get();
        foreach ($finish as $item){
            $item->year = $item->year;
        }
        $data1 = [];
        foreach ($years as $year){
            $temp = [];
            $temp['y'] = $year->name;
            $hoan_thanh = 0;
            $chua_hoan_thanh = 0;
            foreach ($finish as $item)
            {
                if($item->year->id == $year->id)
                {
                    if($item->status == 3){
                        $hoan_thanh++;
                    }
                    if($item->status == 4)
                    {
                        $chua_hoan_thanh++;
                    }
                }
            }
            if($hoan_thanh + $chua_hoan_thanh != 0)
            {

                $temp['a'] = $hoan_thanh / ($hoan_thanh+ $chua_hoan_thanh) * 100;
                $temp['b'] = $chua_hoan_thanh / ($hoan_thanh+ $chua_hoan_thanh) * 100 ;
            }
            else{

                $temp['a'] = $hoan_thanh;
                $temp['b'] = $chua_hoan_thanh;
            }
            $data1[] = $temp;
        }
        $data['data1'] = $data1;

        /*for($i=1; $i < $countYear; $i++){
            $finish = Graduations::where('status',4)->where()->get();
        }*/




        return view('backend.statistical.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // tìm kiếm danh sách để
    public function report(Request $request){

        // in dữ liệu tìm kiếm
        $yearList = Years::all();
        $data['yearList'] = $yearList;

        $departmentList = Departments::all();
        $data['departmentList'] = $departmentList;

        $assemblyList  = Assemblys::all();
        $data['assemblyList'] = $assemblyList ;


        // lọc dữ liệu cần tìm
        $all = $request->all();
        $faculty = array_get($all,'faculty');
        $department = array_get($all,'department');
        $status = array_get($all,'status');
        $year = array_get($all,'year');
        $semester = array_get($all,'semester');


        $graduation = Graduations::OrderBy('created_at','DESC');

        $true = 0;
        if (!empty($faculty)){
            $graduation->where('faculty_id',$faculty);
            $true = 1;
        }
        if (!empty($department)){
            $graduation->where('department_id',$department);
            $true = 1;

        }
        if (!empty($year)){
            $graduation->where('year_id',$year);
            $true = 1;

        }
        if (!empty($semester)){
            $graduation->where('semester',$semester);
            $true = 1;

        }
        if (!empty($status)){
            $graduation->where('status',$status);
            $true = 1;

        }
        $report = [];
        if ($true == 1){
            $graduation = $graduation->get();

            // tạo bảng chứa toàn bộ thông tin


            foreach ($graduation as $item){
                $temp = [];
                $temp['code'] = $item->userStudent->code;
                $temp['faculty'] = $item->faculty->name;
                $temp['department'] = $item->department->name;
                $temp['student'] = $item->userStudent->name;
                $temp['class'] = $item->userStudent->class;
                $temp['teacher'] = $item->userTeacher->name;
                $temp['subject'] = $item->subject->name;
                $temp['room'] = $item->room;
                $temp['time'] = $item->time;
                $temp['assembly'] = $item->assembly_id;
                $temp['point'] = $item->point;
                $temp['status'] = $item->status;
                $temp['year'] = $item->year->name;
                $temp['semester'] = $item->semester;

                $EachAssembly = Users_Assemblys::where('assmebly_id',$item->assembly_id)->get();

                foreach ($EachAssembly as $value){
                    if ($value->position == 'president') {
                        $temp['president'] = $value->users->name;
                    }
                    if ($value->position == 'secretary') {
                        $temp['secretary'] = $value->users->name;
                    }
                    if ($value->position == 'commissary') {
                        $temp['commissary'] = $value->users->name;
                    }
                    if ($value->position == 'reviewer') {
                        $temp['reviewer'] = $value->users->name;
                    }
                }

                $report[] = $temp;
            }

        }
        // covert mảng về đối tượng
        $object = (object) $report;

        $data['report'] = $object;
        $data['status'] = $status;
        /*dd($data['status']);*/

        /*dd($data['report']);*/

        return view('backend.statistical.report',$data);
    }

    public function getStatisticalTeacher(){
        $faculty = \Auth::user()->faculty_id;
        $department = \Auth::user()->department_id;

        $registrationUser = Users::where('status',1)->where('faculty_id',$faculty)->count();


        $confirmUser = Users::where('status',2)->where('faculty_id',$faculty)->count();


        $finishUser = Users::where('status',3)->where('faculty_id',$faculty)->count();


        $failUser = Users::where('status',4)->where('faculty_id',$faculty)->count();


        $allUser = $registrationUser + $confirmUser + $finishUser + $failUser;
        $data['allUser'] = $allUser;

        $data['registrationUser'] =  $registrationUser;
        $data['confirmUser'] = $confirmUser;
        $data['finishUser'] = $finishUser;
        $data['failUser'] = $failUser;


        // chú ý : 1 là dễ, 2 là trung bình, 3 là khó cho đề tài
        $userID = \Auth::user()->id;

        $easySubject = Subjects::where('evaluate',1)->where('user_id',$userID)->count();
        $mediumSubject = Subjects::where('evaluate',2)->where('user_id',$userID)->count();
        $hardSubject = Subjects::where('evaluate',3)->where('user_id',$userID)->count();

        $totalSubject = $easySubject + $mediumSubject + $hardSubject;
        if ($totalSubject != 0){
            $data['easySubject'] =  ($easySubject*100)/$totalSubject;
            $data['mediumSubject'] = ($mediumSubject*100)/$totalSubject;
            $data['hardSubject'] = ($hardSubject*100)/$totalSubject;
        }else{
            $data['easySubject'] =  0;
            $data['mediumSubject'] = 0;
            $data['hardSubject'] = 0;
        }

        // thống kê lượng sinh viên hoàn thành khóa luận or không hoàn thành theo năm
        $years = Years::all();

        $arrayYears = [];
        foreach ($years as $value){
            $arrayYears[$value->id] = $value->id;
        }

        $department = \Auth::user()->department_id;
        $faculty = \Auth::user()->faculty_id;
        /*dd($faculty);*/
        $finish = Graduations::where('faculty_id',$faculty)->where('department_id',$department)
            ->where('status',3)->orWhere('status',4)->where('faculty_id',$faculty)->where('department_id',$department)->get();
        /*dd($finish);*/

        foreach ($finish as $item){
            $item->year = $item->year;

        }

        $data1 = [];
        foreach ($years as $year){

            $temp = [];
            $temp['y'] = $year->name;
            $hoan_thanh = 0;
            $chua_hoan_thanh = 0;
            foreach ($finish as $item)
            {
                if($item->year->id == $year->id)
                {
                    if($item->status == 3){
                        $hoan_thanh++;
                    }
                    if($item->status == 4)
                    {
                        $chua_hoan_thanh++;
                    }
                }
            }
            if($hoan_thanh + $chua_hoan_thanh != 0)
            {

                $temp['a'] = $hoan_thanh / ($hoan_thanh+ $chua_hoan_thanh) * 100;
                $temp['b'] = $chua_hoan_thanh / ($hoan_thanh+ $chua_hoan_thanh) * 100 ;

            }
            else{

                $temp['a'] = $hoan_thanh;
                $temp['b'] = $chua_hoan_thanh;

            }
            $data1[] = $temp;

        }
        $data['data1'] = $data1;
        /*dd($data1);*/

        /*for($i=1; $i < $countYear; $i++){
            $finish = Graduations::where('status',4)->where()->get();
        }*/


        return view('backend.statistical.teacher',$data);

    }
    public function reportTeacher(Request $request){
        // báo cáo kltn dành cho giáo viên
        $yearList = Years::all();
        $data['yearList'] = $yearList;
        $all = $request->all();
        $faculty = \Auth::user()->faculty->id;
        $year = array_get($all,'year');
        $semester = array_get($all,'semester');


        $departments = Departments::all();
        $arrayDepartment = [];
        foreach ($departments as $value){
            if ($value->parent != null && $value->parent == $faculty){
                $arrayDepartment[$value->id] = $value->name;
            }
        }
        // array
        $data['arrayDepartment'] = $arrayDepartment;

        // lọc dữ liệu cần tìm
        $all = $request->all();
        $department = array_get($all,'department');
        $status = array_get($all,'status');


        $graduation = Graduations::OrderBy('created_at','DESC')->where('faculty_id',$faculty);
        $true = 0;
        if (!empty($department)){
            $graduation->where('department_id',$department);
            $true = 1;
        }
        if (!empty($status)){
            $graduation->where('status',$status);
            $true = 1;
        }
        if (!empty($year)){
            $graduation->where('year_id',$year);
            $true = 1;

        }
        if (!empty($semester)){
            $graduation->where('semester',$semester);
            $true = 1;

        }
        $report = [];
        if ($true == 1){
            $graduation = $graduation->get();

            // tạo bảng chứa toàn bộ thông tin
            foreach ($graduation as $item){
                $temp = [];
                $temp['code'] = $item->userStudent->code;
                $temp['faculty'] = $item->faculty->name;
                $temp['department'] = $item->department->name;
                $temp['student'] = $item->userStudent->name;
                $temp['class'] = $item->userStudent->class;
                $temp['teacher'] = $item->userTeacher->name;
                $temp['subject'] = $item->subject->name;
                $temp['room'] = $item->room;
                $temp['time'] = $item->time;
                $temp['assembly'] = $item->assembly_id;
                $temp['point'] = $item->point;
                $temp['status'] = $item->status;
                $temp['year'] = $item->year->name;
                $temp['semester'] = $item->semester;

                $EachAssembly = Users_Assemblys::where('assmebly_id',$item->assembly_id)->get();

                foreach ($EachAssembly as $value){
                    if ($value->position == 'president') {
                        $temp['president'] = $value->users->name;
                    }
                    if ($value->position == 'secretary') {
                        $temp['secretary'] = $value->users->name;
                    }
                    if ($value->position == 'commissary') {
                        $temp['commissary'] = $value->users->name;
                    }
                    if ($value->position == 'reviewer') {
                        $temp['reviewer'] = $value->users->name;
                    }
                }

                $report[] = $temp;
            }

        }
        // covert mảng về đối tượng
        $object = (object) $report;

        $data['report'] = $object;
        $data['status'] = $status;
        return view('backend.statistical.reportTeacher',$data);
    }
}
