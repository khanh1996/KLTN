<?php

namespace App\Http\Controllers\Backend;

use App\Models\Department\Departments;
use App\Models\Role\Roles;
use App\Models\Subject\Subjects;
use App\Models\User\Users;
use App\Models\Year\Years;
use App\Models\Assembly\Assemblys;
use App\Models\Graduation\Graduations;
use App\User;
use App\Users_Assemblys;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    //lọc ngành theo khoa
    public function ajaxDepartment(Request $request){
        $input = $request->all();
        $faculty = array_get($input,'faculty');
        $departments = Departments::where('parent',$faculty)->select('id','name as text')->get();
        if (!empty($departments)) {
            return response()->json(['success'=>true, 'data'=> $departments]);
        }else{
            return response()->json(['message'=>'Không có dữ liệu trả về']);
        }
    }
    // lọc các giáo viên theo ngành
    public function ajaxUser(Request $request){
        $input = $request->all();
        $department = array_get($input,'department');
        /*$role = Roles::where('roles.id',2);*/
        /*join('roles', 'users.role_id', $role)*/
        // giáo viên là role 2
        $users = Users::join('departments','users.department_id','departments.id')->where('users.department_id',$department)
                ->join('roles','users.role_id','roles.id')->where('users.role_id',2)
                ->select('users.id','users.name as text')
                ->get();
        if (!empty($users)) {
            return response()->json(['success'=>true, 'data'=> $users]);
        }else{
            return response()->json(['message'=>'Không có dữ liệu trả về']);
        }
    }
    // lọc các sinh viên theo ngành
    public function ajaxUserStudent(Request $request){
        $input = $request->all();
        $department = array_get($input,'department');
        // sinh viên là role 3
        $usersStudent = Users::join('departments','users.department_id','departments.id')->where('users.department_id',$department)
            ->join('roles','users.role_id','roles.id')->where('users.role_id',3)->where('users.status',0)
            ->select('users.id','users.name as text')
            ->get();
        if (!empty($usersStudent)) {
            return response()->json(['success'=>true, 'data'=> $usersStudent]);
        }else{
            return response()->json(['message'=>'Không có dữ liệu trả về']);
        }
    }
    // lọc các đề tài theo ngành
    /*public function ajaxSubject(Request $request){
        $input = $request->all();
        $department = array_get($input,'department');
        // đề tài đã có người chọn
        $subjectsGraduation = Graduations::where('department_id',$department)->select('subject_id','id')->get();
        // tât cả các đề tải trong ngành, khoa
        $subjects = Subjects::join('departments','subjects.department_id','departments.id')
            ->where('subjects.department_id',$department)->select('subjects.id','subjects.name')->get();
        $arraySubjectExist = [];
        $arraySubject = [];
        foreach ($subjectsGraduation as $value){
            $arraySubjectExist[$value->id] = $value->subject->name;
        }
        foreach ($subjects as $value){
            $arraySubject[$value->id] = $value->name;
        }
        // so sánh 2 mảng lấy ra những tk ở mảng 1 so sánh với mảng 2, tìm ra những tk có trong mảng 1 mà k có trong mảng 2
        $listSubject = array_diff($arraySubject,$arraySubjectExist);
        $results = [];
        // chuyển mảng $listSubject về dạng mảng array['id'=>value,'text'=>value]
        foreach ($listSubject as $key => $value)
        {
            $results[] = [
              "id" => $key,
              "text" => $value
            ];
        }
        if (!empty($results)) {
            return response()->json(['success'=>true, 'data'=> $results]);
        }else{
            return response()->json(['message'=>'Không có dữ liệu trả về']);
        }
    }*/
    // lọc các đề tài theo giáo viên hướng dẫn, nếu đề tài dc chọn rồi sẽ không hiện nữa
    public function ajaxSubject(Request $request){
        $input = $request->all();
        $teacher = array_get($input,'teacher');
        $department = array_get($input,'department');
        // đề tài đã có người chọn
        $subjectsGraduation = Graduations::where('department_id',$department)->select('subject_id','id')->get();
        // tất cả các đề tải trong ngành, khoa, theo giáo viên tạo đề tài đó.
        $subjects = Subjects::where('subjects.user_id',$teacher)->select('subjects.id','subjects.name')->get();
        $arraySubjectExist = [];
        $arraySubject = [];
        foreach ($subjectsGraduation as $value){
            $arraySubjectExist[$value->id] = $value->subject->name;
        }
        foreach ($subjects as $value){
            $arraySubject[$value->id] = $value->name;
        }
        // so sánh 2 mảng lấy ra những tk ở mảng 1 so sánh với mảng 2, tìm ra những tk có trong mảng 1 mà k có trong mảng 2
        $listSubject = array_diff($arraySubject,$arraySubjectExist);
        $results = [];
        // chuyển mảng $listSubject về dạng mảng array['id'=>value,'text'=>value]
        foreach ($listSubject as $key => $value)
        {
            $results[] = [
                "id" => $key,
                "text" => $value
            ];
        }
        if (!empty($results)) {
            return response()->json(['success'=>true, 'data'=> $results]);
        }else{
            return response()->json(['message'=>'Không có dữ liệu trả về']);
        }
    }
    // hiển thị hội đồng chấm thi
    public function ajaxAllAssembly($id){
        $assembly = Assemblys::find($id);
        $data = [];
        if (!empty($assembly)){
            /*dd($assembly->assemblys_users()->first()->users());*/
            $data['assembly'] = $assembly;
            return view('backend.modal.showAssembly',$data);
        }
    }
    // thêm điểm cho kltn của từng thành viên trong hội đồng
    public function ajaxPoint($id){
        $graduation = Graduations::find($id);
        $assembly = Assemblys::find($graduation->assembly_id);
        $data = [];
        if (!empty($assembly) && !empty($graduation)){
            $data['assembly'] = $assembly;
            $data['graduation'] = $graduation;
            return view('backend.modal.showPoint',$data);
        }
    }
    // lọc ra các hội đồng của ngành và năm
    public function ajaxAssembly(Request $request){
        $input = $request->all();
        $department = array_get($input,'department');
        $year = array_get($input,'year');
        $assemblys = Assemblys::where('department_id',$department)->where('year_id',$year)->select('assemblys.id','assemblys.name as text')->get();
        if (!empty($assemblys)) {
            return response()->json(['success'=>true, 'data'=> $assemblys]);
        }else{
            return response()->json(['message'=>'Không có dữ liệu trả về']);
        }
    }
    //lấy ra hội đồng và điểm thi trong sửa khóa luận
    public function ajaxAssemblyPoint(Request $request){
        $input = $request->all();
        $assembly = array_get($input,'assembly');
        $graduation = array_get($input,'graduation');
        /*$assembly = Assemblys::where('id',$assembly)->select('assemblys.id','assemblys.name as text')->get();*/
        $assembly = Assemblys::find($assembly);
        $arrayData['assembly'] = $assembly;
        $graduation = Graduations::find($graduation);
        $arrayData['graduation'] = $graduation;
        /*dd($arrayData);*/
        // truyền kiểu view
        $data = view('backend.modal.showAssemblyPoint',$arrayData)->render();
        /*dd($data);*/
        if (!empty($data)) {
            return response()->json(['success'=>true, 'data'=> $data]);
        }else{
            return response()->json(['message'=>'Không có dữ liệu trả về']);
        }
    }
    // hiện thi modal hội đồng và điểm đã tồn tại trong csdl ở trang danh sách KLTN
    public function ajaxAssemblyPointExist(Request $request,$id){
        $graduation = Graduations::find($id);
        $assembly = Assemblys::find($graduation->assembly_id);
        $data = [];
        if (!empty($assembly) && !empty($graduation)){
            $data['assembly'] = $assembly;
            $data['graduation'] = $graduation;
            return view('backend.modal.showAssemblyPointExist',$data);
        }
    }
    // lọc giáo viên theo đề tài
    public function ajaxUserTeacher(Request $request){
        $input = $request->all();
        $subject = array_get($input,'subject');
        /*$role = Roles::where('roles.id',2);*/
        /*join('roles', 'users.role_id', $role)*/
        // giáo viên là role 2
        $users = Subjects::join('users','users.id','subjects.user_id')->where('subjects.id',$subject)
            ->select('users.id','users.name as text')
            ->get();
        /*dd($users);*/
        if (!empty($users)) {
            return response()->json(['success'=>true, 'data'=> $users]);
        }else{
            return response()->json(['message'=>'Không có dữ liệu trả về']);
        }
    }
}
