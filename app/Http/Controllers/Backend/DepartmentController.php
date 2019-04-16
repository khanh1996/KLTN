<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AddDepartmentRequest;
use App\Http\Requests\EditDepartmentRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department\Departments;
use DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // bộ lọc
        // lấy tất cả các id để nhập vào từ form input
        $input = $request->all();
        // láy trường id từ name="faculty"
        $faculty = array_get($input,'faculty');
        // query câu lệnh lọc
        $departmentList = Departments::orderBy('created_at','DESC');
        // kiểm tra id đó có rỗng không để thực hiện điều kiện
        if($faculty != ''){
            $departmentList->where('parent',$faculty);
        }
        // lấy tất cả ra
        $departmentList = $departmentList->get();

        //
        $departments = Departments::all();
        $arrayDepartment = [];
        foreach ($departments as $value){
            if ($value->parent == null){
                $arrayDepartment[$value->id] = $value->name;
            }
        }
        // array
        $data['arrayDepartment'] = $arrayDepartment;

        //object
        $data['departmentList'] = $departmentList;
        $data['departmentSearchList'] = $departmentList;


        return view('backend.department.list',$data);
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
        // xuất ra mảng cha
        $arrayDepartment = [];
        foreach ($departments as $value){
            $arrayDepartment[$value->id] = $value->name;
        }
        // mangr
        $data['arrayDepartment'] = $arrayDepartment;
        //object
        $data['departmentList'] = $departments;
//        dd($data);

        return view('backend.department.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddDepartmentRequest $request)
    {
        //
        /*$all = $request->all();
        dd($all);*/
        $department = new Departments();
        $department->name = $request->department;
        $department->parent = $request->parent;

        $department->save();
        return back()->with('flash_success','Đã thêm mới thành công!!! thích quá <3');
        /*return view('backend.department.add');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $data['department'] = Departments::find($id);

        $departments = Departments::all();
        $arrayDepartment = [];
        foreach ($departments as $value){
            $arrayDepartment[$value->id] = $value->name;
        }
        // xuất ra tk cha
        $data['arrayDepartment'] = $arrayDepartment;

        $data['departmentList'] = $departments;

        return view('backend.department.edit',$data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditDepartmentRequest $request, $id)
    {
        //
        $data['name'] = $request->name;
        $data['parent'] = $request->parent;
        Departments::where('id','=',$id)->update($data);
        /*return redirect()->route('backend.department.index')->with('flash_message','Cập nhật thành công');*/
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
        Departments::destroy($request->name);
        return back()->with('flash_success','Đã xóa thành công!!! thích quá <3');
    }
}
