<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AddGraduationRequest;
use App\Http\Requests\ConfirmGraduationRequest;
use App\Http\Requests\EditGraduationRequest;
use App\Models\Assembly\Assemblys;
use App\Models\Department\Departments;
use App\Models\Graduation\Graduations;
use App\Models\Subject\Subjects;
use App\Models\User\Users;
use App\Models\Year\Years;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GraduationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //tất cả kltn dành cho phần DS đăng ký , DS hoàn thành, DS chưa hoàn thành
        $graduations = Graduations::all();
        $data['graduationList'] = $graduations;
        //

        $status = Graduations::all();
        $data['statusList'] = $status;
        /*dd($data['statusList']);*/

        $years = Years::all();
        $data['yearList'] = $years;
        /*dd($years);*/

        $departments = Departments::all();
        $data['departmentList'] = $departments;

        $subjects = Subjects::all();
        $data['subjectList'] = $subjects;

        $assemblys = Assemblys::all();
        $data['assemblyList'] = $assemblys;

        $all = $request->all();
        /*dd($all);*/
        $status = array_get($all,'status');
        $year = array_get($all,'year');
        $faculty = array_get($all,'faculty');
        $department = array_get($all,'department');
        $semester = array_get($all,'semester');
        $assembly = array_get($all,'assembly');

        $graduationList = Graduations::OrderBy('created_at','DESC');
        /*dd($graduationList->get());*/
        $true = 0;
        if (!empty($status)){
            $graduationList->where('status',$status);
            $true = 1;
        }
        if (!empty($year)){
            $graduationList->where('year_id',$year);
            $true = 1;
        }
        if (!empty($faculty)){
            $graduationList->where('faculty_id',$faculty);
            $true = 1;
        }
        if (!empty($department)){
            $graduationList->where('department_id',$department);
            $true = 1;
        }
        if (!empty($semester)){
            $graduationList->where('semester',$semester);
            $true = 1;
        }
        if (!empty($assembly)){
            $graduationList->where('assembly_id',$assembly);
            $true = 1;
        }
        if ($true == 1){
            $graduationList = $graduationList->get();
            $data['graduationListSeach'] = $graduationList;
        }

        /*dd($graduationList);*/
        $data['graduationListSeach'] = $graduationList;


        return view('backend.graduation.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $departments = Departments::all();
        $data['departmentList'] = $departments;

        $years = Years::all();
        $data['yearList'] = $years;

        $graduations = Graduations::where('status',1)->get();
        $data['graduationList'] = $graduations;
        /*dd($data['graduationList']);*/

        return view('backend.graduation.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddGraduationRequest $request)
    {
        //
        $graduation = new Graduations();
        $graduation->faculty_id = $request->faculty;
        $graduation->department_id = $request->department;
        $graduation->subject_id = $request->subject;
        $graduation->user_teacher_id = $request->teacher;
        $graduation->user_student_id = $request->student;
        $graduation->year_id = $request->year;
        $graduation->semester = $request->semester;
        $graduation->status = 1;


        $graduation->save();

        $user = Users::where('id','=',$graduation->user_student_id = $request->student);
        /*dd($user);*/
        // trạng thái đã đang ký
        $data['status'] = 1;
        $user->update($data);

        return back()->with('flash_success','Đã thêm mới thành công!!! thích quá <3');
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
        $graduation = Graduations::find($id);
        $data['graduation'] = $graduation;
        /*dd(  $data['graduation'] );*/


        return view('backend.modal.showGraduation',$data);
    }
    public function showComfirm($id){
        $graduation = Graduations::find($id);
        $data['graduation'] = $graduation;
        /*dd(  $data['graduation'] );*/
        return view('backend.modal.showGraduationConfirm',$data);
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
        // tìm tk cần sửa
        $graduation = Graduations::find($id);
        $data['graduation'] = $graduation;

        /*dd($data['graduation']);*/
        $subjects = Subjects::where('department_id',$graduation->department_id)->get();

        $subjects = Subjects::join('departments','subjects.department_id','departments.id')
            ->where('subjects.department_id',$graduation->department_id)->select('subjects.id','subjects.name')->get();
        $data['subjectList'] = $subjects;

        $departments = Departments::all();
        $data['departmentList'] = $departments;

        //hiện thị ngành của khoa cần sửa
        $departments = Departments::all();
        $arrayDepartment = [];
        foreach ($departments as $value){
            if ($value->parent != null && $graduation->faculty_id == $value->parent){
                $arrayDepartment[$value->id] = $value->name;
            }
        }
        // array
        $data['arrayDepartment'] = $arrayDepartment;
        /* dd($arrayDepartment);*/

        $users = Users::where('department_id',$graduation->department_id)->get();
        $data['userList'] = $users;

        $years = Years::all();
        $data['yearList'] = $years;

        $assemblys = Assemblys::where('department_id',$graduation->department_id)->where('year_id',$graduation->year_id)->get();
        $data['assemblyList'] = $assemblys;

        return view('backend.graduation.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditGraduationRequest $request, $id)
    {
        //
        $graduation = Graduations::find($id);
        $all = $request->all();
        /*dd($all);*/
        $faculty = array_get($all,'faculty');
        $department = array_get($all,'department');
        $subject = array_get($all,'subject');
        $student = array_get($all,'student');
        $teacher = array_get($all,'teacher');
        $year = array_get($all,'year');
        $semester = array_get($all,'semester');
        $assembly = array_get($all,'assembly');
        $pointPresident = array_get($all,'pointPresident');
        $pointSecretary = array_get($all,'pointSecretary');
        $pointCommissary = array_get($all,'pointCommissary');
        $pointReviewer = array_get($all,'pointReviewer');
        $room = array_get($all,'room');
        $datetimes = array_get($all,'datetimes');
        /*$report = array_get($all,'datetimes');*/

        if (!empty($pointPresident) && !empty($pointSecretary) && !empty($pointCommissary) && !empty($pointReviewer)){
            $data['pointPresident'] = $pointPresident;
            $data['pointSecretary'] = $pointSecretary;
            $data['pointCommissary'] = $pointCommissary;
            $data['pointReviewer'] = $pointReviewer;
        }
        else{
            $data['pointPresident'] = 0;
            $data['pointSecretary'] = 0;
            $data['pointCommissary'] = 0;
            $data['pointReviewer'] = 0;
        }

        // tính điểm tổng KLTN
        $assemblyPoint = Assemblys::find($graduation->assembly_id);
        /*dd($assembly->assemblys_users);*/
        foreach ($assemblyPoint->assemblys_users as $item){
            if(!empty($pointPresident) && $item->position == 'president'){
                $pointPresident = $pointPresident*($item->weight)/100;
            }
            if(!empty($pointSecretary) && $item->position == 'secretary'){
                $pointSecretary = $pointSecretary*($item->weight)/100;
            }
            if(!empty($pointCommissary) && $item->position == 'commissary'){
                $pointCommissary = $pointCommissary*($item->weight)/100;
            }
            if(!empty($pointReviewer) && $item->position == 'reviewer'){
                $pointReviewer = $pointReviewer*($item->weight)/100;
            }
        }
        $sumPoint = $pointPresident + $pointSecretary + $pointCommissary + $pointReviewer;
        // kiểm tra nếu tồn tại điểm thì trạng thái lên 2 là trạng thái kltn đỗ hay trượt
        // trạng thái 3 là hoàn thành còn 4 là không hoàn thành
        if (!empty($sumPoint)){
            if($sumPoint >=5){
                $data['status'] = 3;
            }
            else{
                $data['status'] = 4;
            }
            // cập nhât lại trạng thái của sinh viên
            if ($sumPoint >=5){
                $user = Users::where('id',$graduation->user_student_id);
                // 3 là trạng thái hoàn thành
                $dataUser['status'] = 3;
                $user->update($dataUser);
            }
            else{
                $user = Users::where('id',$graduation->user_student_id);
                // 4 là trạng thái  không hoàn thành
                $dataUser['status'] = 4;
                $user->update($dataUser);
            }
        }


        $datetimes = Carbon::createFromFormat("d/m/Y h:i A",$datetimes)->toDateTimeString();
        /*dd($datetimes);*/

        // đưa vào DB
        $data['faculty_id'] = $faculty;
        $data['department_id'] = $department;
        $data['subject_id'] = $subject;
        $data['user_student_id'] = $student;
        $data['user_teacher_id'] = $teacher;
        $data['year_id'] = $year;
        $data['semester'] = $semester;
        $data['assembly_id'] = $assembly;
        $data['room'] = $room;
        $data['time'] = $datetimes;
        $data['point'] = $sumPoint;

        if ($request->hasFile('report')){
            $filename = $request->report->getClientOriginalName();
            $request->report->storeAs('reports', $filename);
            $request->report->move(public_path('/reports'), $filename);
            $data['report'] = $filename;
        }
        $true = 0;
        if(!empty($graduation)){

            $graduation->update($data);
            $true = 1;
        }
        if ($true == 1){
             /*dd('đã thêm mới thành công');*/
            return back()->with('flash_success','Đã cập nhật thành công!!! thích quá <3');
        }
        else{
            /*dd('có lỗi trong quá trình thếm mới');*/
            return back()->with('flash_danger','Có lỗi trong quá trình sửa');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        //name ở đây là name ở bên view
        $graduation = Graduations::find($request->name);
        // cập nhât lại trạng thái của sinh viên
        $user = Users::where('id',$graduation->user_student_id);
        // 0 là trạng thái chưa đăng ký khóa luận
        $dataUser['status'] = 0;
        $user->update($dataUser);
        Graduations::destroy($request->name);
        return back();
    }
    public function getComfirmGraduation($id){
        $graduation = Graduations::find($id);
        $data['graduation'] = $graduation;

        //lấy ra khoa của ktln
        $faculty = $graduation->faculty_id;
        // lấy ra ngành của kltn
        $department = $graduation->department_id;
        //lấy ra năm của ktln
        $year = $graduation->year_id;


        $assemblys = Assemblys::where('faculty_id',$faculty)->where('department_id',$department)->where('year_id',$year)->get();

        $data['assemblyList'] = $assemblys;

        //danh sách đã xác nhận bảo vệ KLTN trạng thái 2
        $graduations = Graduations::where('status',2)->get();
        $data['graduationList'] = $graduations;

        return view('backend.graduation.confirm',$data);
    }
    public function patchComfirmGraduation(ConfirmGraduationRequest $request,$id){
        $graduation =  Graduations::find($id);

        $all = $request->all();


        $assembly = array_get($all,'assembly');
        $room = array_get($all,'room');
        $datetimes = array_get($all,'datetimes');
        /*$report = array_get($all,'report');*/

        /*dd($report);*/
        $datetimes = Carbon::createFromFormat("d/m/Y h:i A",$datetimes)->toDateTimeString();
        /*dd($datetimes);*/

        // đưa vào DB
        $data['assembly_id'] = $assembly;
        $data['room'] = $room;
        $data['time'] = $datetimes;
        if ($request->hasFile('report')){
            $filename = $request->report->getClientOriginalName();
            $request->report->storeAs('reports', $filename);
            $request->report->move(public_path('/reports'), $filename);
            $data['report'] = $filename;
        }
        /*dd($data);*/
        $true = 0;
        if(!empty($graduation)){
            $graduation->update($data);
            $this->checkGraduation($graduation);
            $true = 1;
            // update trường thông tin status bảng tài khoản lên 2
            $user = Users::where('id','=',$graduation->user_student_id);
            // 2 là trạng thái đã xác nhận bảo vệ
            $dataUser['status'] = 2;
            $user->update($dataUser);
        }


        if ($true == 1){
           /* dd('đã thêm mới thành công');*/
            return back()->with('flash_success','Đã xác nhận bảo vệ thành công!!! thích quá <3');
        }
        elseif($true == 0){
            /*dd('có lỗi trong quá trình thếm mới');*/
            return back()->with('flash_danger','Có lỗi trong quá trình xác nhận bảo vệ!!!');
        }

    }
    // hàm kiểm tra đã tòn tại trường
    public function checkGraduation($graduation){
        if ($graduation->assembly_id > 0 && $graduation->report != 'NULL' && $graduation->time != 'NULL'
            && $graduation->room != 'NULL' && $graduation->semester > 0 && $graduation->subject_id > 0
            && $graduation->year_id > 0 && $graduation->user_student_id > 0 && $graduation->user_teacher_id > 0
            && $graduation->department_id > 0 && $graduation->faculty_id > 0){
            $data['status'] = 2;
            $graduation->update($data);
        }
    }
    public function patchPointGraduation($id,Request $request){

        $all = $request->all();
        $pointPresident = array_get($all,'pointPresident');
        $pointSecretary = array_get($all,'pointSecretary');
        $pointCommissary = array_get($all,'pointCommissary');
        $pointReviewer = array_get($all,'pointReviewer');

        // lưu vào DB các điểm của hội đồng
        $data['pointPresident'] = $pointPresident;
        $data['pointSecretary'] = $pointSecretary;
        $data['pointCommissary'] = $pointCommissary;
        $data['pointReviewer'] = $pointReviewer;

        $graduation = Graduations::find($id);
        $assembly = Assemblys::find($graduation->assembly_id);
        /*dd($assembly->assemblys_users);*/
        foreach ($assembly->assemblys_users as $item){
            if(!empty($pointPresident) && $item->position == 'president'){
                $pointPresident = $pointPresident*($item->weight)/100;
            }
            if(!empty($pointSecretary) && $item->position == 'secretary'){
                $pointSecretary = $pointSecretary*($item->weight)/100;
            }
            if(!empty($pointCommissary) && $item->position == 'commissary'){
                $pointCommissary = $pointCommissary*($item->weight)/100;
            }
            if(!empty($pointReviewer) && $item->position == 'reviewer'){
                $pointReviewer = $pointReviewer*($item->weight)/100;
            }
        }

        $sumPoint = $pointPresident + $pointSecretary + $pointCommissary + $pointReviewer;
        $data['point'] = $sumPoint;
       /* dd($data['point']);*/
        // trạng thái 3 là hoàn thành còn 4 là không hoàn thành
        if ($sumPoint >= 5 ){
            $data['status'] = 3;
        }else{
            $data['status'] = 4;
        }

        if ($sumPoint >=5){
            $user = Users::where('id',$graduation->user_student_id);
            // 3 là trạng thái hoàn thành
            $dataUser['status'] = 3;
            $user->update($dataUser);
        }
        else{
            $user = Users::where('id',$graduation->user_student_id);
            // 4 là trạng thái  không hoàn thành
            $dataUser['status'] = 4;
            $user->update($dataUser);
        }


        Graduations::where('id',$id)->update($data);

        return redirect(route('backend.graduation.index'))->with('flash_success','Đã nhập điểm thành công!!! thích quá <3');
    }
    public function getDetailGraduation($id){
        $graduation = Graduations::find($id);
        $assembly = $graduation->assembly_id;
        $data['graduation'] = $graduation;

        $assembly = Assemblys::find($assembly);
        $data['assembly'] = $assembly;

        /*dd($data);*/
        return view('backend.modal.showGraduationAll',$data);
    }
    // sửa kltn đã đang ký
    public function getGraduationRegistration($id){
        $graduation = Graduations::find($id);
        $data['graduation'] = $graduation;

        /*dd($data['graduation']);*/
        $subjects = Subjects::where('user_id',$graduation->user_teacher_id)->get();
        $data['subjectList'] = $subjects;


        $departments = Departments::all();
        $data['departmentList'] = $departments;

        //hiện thị ngành của khoa cần sửa
        $departments = Departments::all();
        $arrayDepartment = [];
        foreach ($departments as $value){
            if ($value->parent != null && $graduation->faculty_id == $value->parent){
                $arrayDepartment[$value->id] = $value->name;
            }
        }
        // array
        $data['arrayDepartment'] = $arrayDepartment;
        /* dd($arrayDepartment);*/
        // các tài sinh viên đã đăng ký khoa luận
        /*$studentGraduation = Graduations::where('user_student_id',$department)->select('subject_id','id')->get();*/
        $users = Users::where('department_id',$graduation->department_id)->get();
        $data['userList'] = $users;
//        // những sinh viên đã đăng ký khoa luận
//        $userExistGraduation = Graduations::where('department_id',$graduation->department_id)->select('id','user_student_id')->get();
//        /*dd($userExistGraduation);*/
//        // những sinh viên cùng ngành
//        $userStudent = Users::where('role_id',3)->where('department_id',$graduation->department_id)->select('users.id','users.name')->get();
//        $data['userStudent'] = $userStudent;
//        /*dd($userStudent);*/
//        $arrayStudentExist = [];
//        $arrayStudent = [];
//        foreach ($userExistGraduation as $value){
//            $arrayStudentExist[$value->id] = $value->userStudent->name;
//        }
//
//        foreach ($userStudent as $value){
//            $arrayStudent[$value->id] = $value->name;
//        }
//        $listStudent = array_diff($arrayStudent,$arrayStudentExist);
//        $data['listStudent'] = $listStudent;
        $userStudent = Users::where('role_id',3)->where('department_id',$graduation->department_id)->select('users.id','users.name')->get();
        $data['userStudent'] = $userStudent;

        $years = Years::all();
        $data['yearList'] = $years;

        return view('backend.graduation.editRegistration',$data);
    }

    public function postGraduationRegistration(Request $request,$id){
        $graduation = Graduations::find($id);
        $all = $request->all();
        /*dd($all);*/
        $faculty = array_get($all,'faculty');
        $department = array_get($all,'department');
        $subject = array_get($all,'subject');
        $student = array_get($all,'student');
        $teacher = array_get($all,'teacher');
        $year = array_get($all,'year');
        $semester = array_get($all,'semester');

        $data['faculty_id'] = $faculty;
        $data['department_id'] = $department;
        $data['subject_id'] = $subject;
        $data['user_student_id'] = $student;
        $data['user_teacher_id'] = $teacher;
        $data['year_id'] = $year;
        $data['semester'] = $semester;
        $data['status'] = 1;

        $true = 0;
        if(!empty($graduation)){
            $graduation->update($data);
            $true = 1;
        }
        if ($true == 1){
            /*dd('đã thêm mới thành công');*/
            return back()->with('flash_success','Đã cập nhật thành công!!! thích quá <3');
        }
        else{
            /*dd('có lỗi trong quá trình thếm mới');*/
            return back()->with('flash_danger','Có lỗi trong quá trình sửa');
        }
    }

    // sửa kltn đã xác nhận bảo vệ
    public function getGraduationConfirm($id){
        $graduation = Graduations::find($id);
        $data['graduation'] = $graduation;

        $assemblys = Assemblys::where('department_id',$graduation->department_id)->where('year_id',$graduation->year_id)->get();
        $data['assemblyList'] = $assemblys;

        return view('backend.graduation.editConfirm',$data);
    }
    public function postGraduationConfirm($id,Request $request){
        $all = $request->all();
        /*dd($all);*/
        $assembly = array_get($all,'assembly');
        $room = array_get($all,'room');
        $datetimes = array_get($all,'datetimes');
        // cover time
        $datetimes = Carbon::createFromFormat("d/m/Y h:i A",$datetimes)->toDateTimeString();

        if ($request->hasFile('report')){
            $filename = $request->report->getClientOriginalName();
            $request->report->storeAs('reports', $filename);
            $request->report->move(public_path('/reports'), $filename);
            $data['report'] = $filename;
        }
        $graduation = Graduations::find($id);

        $data['assembly_id'] = $assembly;
        $data['room'] = $room;
        $data['time'] = $datetimes;
        $true = 0;
        if(!empty($graduation)){
            $data['status'] = 2;
            $graduation->update($data);
            $true = 1;
        }
        if ($true == 1){
            return back()->with('flash_success','Đã cập nhật thành công!!! thích quá <3');
        }
        else{
            return back()->with('flash_danger','Có lỗi trong quá trình cập nhật');
        }
    }
    public function getTeacherGraduation(Request $request){
        // năm
        $years = Years::all();
        $data['yearList'] = $years;

        $all = $request->all();
        /*dd($all);*/
        $status = array_get($all,'status');
        $year = array_get($all,'year');
        $semester = array_get($all,'semester');
        $userID =\Auth::user()->id;
        $graduationList = Graduations::OrderBy('created_at','DESC')->where('user_teacher_id',$userID);
        /*dd($graduationList->get());*/
        if (!empty($status)){
            $graduationList->where('status',$status);
        }
        if (!empty($year)){
            $graduationList->where('year_id',$year);
        }
        if (!empty($semester)){
            $graduationList->where('semester',$semester);
        }
        $graduationList = $graduationList->get();

        $data['graduationList'] = $graduationList;
        return view('backend.graduation.teacherGraduation',$data);
    }
    public function getStudentGraduation(){
        $userID =\Auth::user()->id;
        $graduationList = Graduations::OrderBy('created_at','DESC')->where('user_student_id',$userID)->get();
        $data['graduationList'] = $graduationList;
        return view('backend.graduation.studentGraduation',$data);
    }
}
