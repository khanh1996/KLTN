<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AddSubjectRequest;
use App\Http\Requests\EditSubjectRequest;
use App\Models\Graduation\Graduations;
use App\Models\Subject\Subjects;
use App\Models\User\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department\Departments;
use DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //láy danh sách khoa
        $departments = Departments::all();
        $data['departmentList'] = $departments;
        // lấy ra danh sách giáo viên

        $user = Users::where('role_id',2)->get();
        $data['teacherList'] = $user;

        $input = $request->all();
        // láy trường id từ name="faculty"
        $faculty = array_get($input,'faculty');
        // láy trường id từ name="department"
        $department = array_get($input,'department');
        // láy trường id từ name="evaluate"
        $evaluate = array_get($input,'evaluate');
        // láy trường id từ name="teacher"
        $teacher = array_get($input,'teacher');

        $subjectList = Subjects::OrderBy('created_at','DESC');
        // kiểm tra id đó có rỗng không để thực hiện điều kiện
        if (!empty($faculty)){
            $subjectList->where('faculty_id',$faculty);
        }
        if (!empty($department)){
            $subjectList->where('department_id',$department);
        }
        if (!empty($evaluate)){
            $subjectList->where('evaluate',$evaluate);
        }
        if (!empty($teacher)){
            $subjectList->where('user_id',$teacher);
        }
        //thư ký ,admin
        if (\Auth::user()->role_id == 1 || \Auth::user()->role_id == 4){
            // lấy tất cả ra
            $subjectList = $subjectList->get();
            $data['subjectList'] = $subjectList;
        }
        // đối với giáo viên
        elseif (\Auth::user()->role_id == 2){
            $userFaculty = \Auth::user()->faculty_id;
            $userID = \Auth::user()->id;
            $subjectList = $subjectList->where('faculty_id',$userFaculty)->where('user_id',$userID)->get();
            $data['subjectList'] = $subjectList;
        }
        elseif (\Auth::user()->role_id == 3){
            $userFaculty = \Auth::user()->faculty_id;
            $userDepartment = \Auth::user()->department_id;
            // đề tài có trong ngành khoa
            $subjectList = $subjectList->where('faculty_id',$userFaculty)->where('department_id',$userDepartment)->get();

            $data['subjectList'] = $subjectList;
            /*dd($data);*/
        }
        return view('backend.subject.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (\Auth::user()->role_id == 1 || \Auth::user()->role_id == 4){
            $department = Departments::all();
            $data['departmentList'] = $department;
        }
        elseif (\Auth::user()->role_id == 2){
            $userFaculty = \Auth::user()->faculty_id;
            $department = Departments::where('id',$userFaculty)->get();
            $data['departmentList'] = $department;
        }
        // danh sách đề tài
        $subject = Subjects::orderBy('id', 'desc');
        /*dd($subject);*/
        if (\Auth::user()->role_id == 1 || \Auth::user()->role_id == 4){
            $subject = $subject->get();
            $data['subjectList'] = $subject;
        }
        elseif (\Auth::user()->role_id == 2){
            $userFaculty = \Auth::user()->faculty_id;
            $userID = \Auth::user()->id;
            $subject = $subject->where('faculty_id',$userFaculty)->where('user_id',$userID)->get();
            $data['subjectList'] = $subject;
        }
        /*dd($data);*/
        return view('backend.subject.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSubjectRequest $request)
    {
        //
        $subject = new Subjects();
        $subject->name = $request->name;
        $subject->evaluate = $request->evaluate;
        $subject->faculty_id = $request->faculty;
        $subject->department_id = $request->department;
        if (\Auth::user()->role_id == 1 || \Auth::user()->role_id == 4){
            $subject->user_id = $request->teacher;
        }
        if (\Auth::user()->role_id == 2){
            $subject->faculty_id = \Auth::user()->faculty_id;;
            $subject->department_id = \Auth::user()->department_id;
            $subject->user_id = \Auth::user()->id;
        }

        $subject->detail = $request->description;

        $subject->save();
        return back()->with('flash_success','Đã thêm mới thành công!!! thích quá <3');
        /*return view('backend.subject.add');*/
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
        $subject = Subjects::find($id);
        $data['subject'] = $subject;
        return view('backend.modal.showSubject',$data);
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
        $subject = Subjects::find($id);

        $data['subject'] = $subject;
        /*dd($data);*/
        // lọc ngành - khoa
        if (\Auth::user()->role_id == 1 || \Auth::user()->role_id == 4){
            $department = Departments::all();
            $data['departmentList'] = $department;

            // giáo viên
            $teacher = Users::where('users.department_id',$subject->department_id)->get();
            $data['teacherList'] = $teacher;
        }
        elseif (\Auth::user()->role_id == 2){
            $userFaculty = \Auth::user()->faculty_id;
            $department = Departments::where('id',$userFaculty)->get();
            $data['departmentList'] = $department;
            $teacher = Users::where('id',\Auth::user()->id)->get();
            $data['teacherList'] = $teacher;
        }
        //hiện thị ngành của khoa cần sửa
        $departments = Departments::all();
        $arrayDepartment = [];
        foreach ($departments as $value){
            if ($value->parent != null && $subject->faculty_id == $value->parent){
                $arrayDepartment[$value->id] = $value->name;
            }
        }
        // array
        $data['arrayDepartment'] = $arrayDepartment;
         /*dd($arrayDepartment);*/


        return view('backend.subject.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditSubjectRequest $request, $id)
    {
        //

        $data['name'] = $request->name;
        $data['evaluate']  = $request->evaluate;
        $data['department_id'] = $request->department;
        $data['faculty_id']  = $request->faculty;
        $data['detail']  = $request->description;
        $data['user_id']  = $request->teacher;

        Subjects::where('id',$id)->update($data);

        /*return redirect()->route('backend.subject.create');*/
        return back()->with('flash_success','Đã cập nhật thành công!!! thích quá <3');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //name ở đây là name ở bên view
        Subjects::destroy($request->id);
        return back()->with('flash_success','Đã xóa thành công!!! thích quá <3');
    }
}
