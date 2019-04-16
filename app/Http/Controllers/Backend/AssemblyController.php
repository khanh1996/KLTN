<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AddAssemblyRequest;
use App\Http\Requests\EditAssemblyRequest;
use App\Http\Requests\EditCreateAssemblyRequest;
use App\Models\Assembly\Assemblys;
use App\Models\Department\Departments;
use App\Models\User\Users;
use App\Models\Year\Years;
use App\Users_Assemblys;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AssemblyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $years = Years::all();
        $data['yearList'] = $years;

        $departments = Departments::all();
        $data['departmentList'] = $departments;

        /*$assemblys = Assemblys::all();
        $data['assemblyList'] = $assemblys;*/

        // tìm kiếm hội đồng
        $input = $request->all();

        $year = array_get($input,'year');
        $faculty = array_get($input,'faculty');
        $department = array_get($input,'department');

        $assemblyList = Assemblys::OrderBy('created_at','DESC');
        // kiểm tra id đó có rỗng không để thực hiện điều kiện
        if (!empty($year)){
            $assemblyList->where('year_id',$year);
        }
        if (!empty($faculty)){
            $assemblyList->where('faculty_id',$faculty);
        }
        if (!empty($department)){
            $assemblyList->where('department_id',$department);
        }
        // lấy tất cả ra
        $assemblyList = $assemblyList->get();
        $data['assemblyList'] = $assemblyList;
        /*dd($data['assemblyList']);*/


        return view('backend.assembly.list',$data);
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

        $assembly = Assemblys::all();
        $data['assemblyList'] = $assembly;

        $assembly_user = Users_Assemblys::all();
        $data['assembly_user'] = $assembly_user;
        /*dd($data);*/


        return view('backend.assembly.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddAssemblyRequest $request)
    {
        //
        $assembly = new Assemblys();
        $assembly->name = $request->name;
        $assembly->faculty_id = $request->faculty;
        $assembly->department_id = $request->department;
        $assembly->year_id = $request->year;
        // trạng thái đã tạo xong hội đồng -> chuyển đến trạng thái thiết lập hội đồng
        $assembly->status = 1;

        $assembly->save();
        return back()->with('flash_success','Đã thêm mới thành công!!! thích quá <3');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // sửa hội đồng khi mới tạo hội đồng
    public function show($id)
    {
        //
        $assembly = Assemblys::find($id);
        $data['assembly'] = $assembly;
        $year = Years::all();
        $data['yearList'] = $year;

        // loc ngành
        $departments = Departments::all();
        $arrayDepartment = [];
        foreach ($departments as $value){
            if ($value->parent != null && $assembly->faculty_id == $value->parent){
                $arrayDepartment[$value->id] = $value->name;
            }
        }
        // array
        $data['arrayDepartment'] = $arrayDepartment;
        $data['departmentList'] = $departments;
        return view('backend.assembly.editCreate',$data);

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
        $department = Departments::all();
        $data['departmentList'] = $department;

        $year = Years::all();
        $data['yearList'] = $year;

        $assembly = Assemblys::find($id);
        $data['assembly'] = $assembly;

        // loc ngành
        $departments = Departments::all();
        $arrayDepartment = [];
        foreach ($departments as $value){
            if ($value->parent != null && $assembly->faculty_id == $value->parent){
                $arrayDepartment[$value->id] = $value->name;
            }
        }
        // array
        $data['arrayDepartment'] = $arrayDepartment;

        $userSeclected = Users_Assemblys::where('assmebly_id',$id)->get();
        /*dd($userSeclected);*/
        $arrayUser = [];

        foreach ($userSeclected as $value){
            if ($value->position == 'president'){
                $arrayUser['president'] = $value->user_id;
                $arrayUser['presidentPoint'] = $value->weight;
            }
            if ($value->position == 'secretary'){
                $arrayUser['secretary'] = $value->user_id;
                $arrayUser['secretaryPoint'] = $value->weight;
            }
            if ($value->position == 'commissary'){
                $arrayUser['commissary'] = $value->user_id;
                $arrayUser['commissaryPoint'] = $value->weight;
            }
            if ($value->position == 'reviewer'){
                $arrayUser['reviewer'] = $value->user_id;
                $arrayUser['reviewerPoint'] = $value->weight;
            }
        }
        $data['userSeclected'] = $arrayUser;
        /*dd($data['userSeclected']);*/

        /*dd($department);*/
        $department = $assembly->department_id;
        // tìm những tk ở trong hội đồng
        $user =  Users::join('roles','users.role_id','roles.id')
            ->where('users.role_id',2)
            ->where('users.department_id',$department)
            ->select('users.name as nameTeacher','roles.name as roleTeacher','users.id')
            ->get();
        $data['usersList'] = $user;
        /*dd($user);*/




        return view('backend.assembly.edit',$data);
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
        // update trong phần thiết lập hội đồng
        // id hội đồng
        $assembly = Assemblys::find($id);
        // trạng thái thiết lập xong các tài khoản trong hội đồng
        $dataStatus['status'] = 2;

        $all = $request->all();
        // tên giáo viên
        $president = array_get($all,'president');
        $secretary = array_get($all,'secretary');
        $commissary = array_get($all,'commissary');
        $reviewer = array_get($all,'reviewer');
        // trọng số giáo viên
        $presidentPoint = array_get($all,'presidentPoint');
        $secretaryPoint = array_get($all,'secretaryPoint');
        $commissaryPoint = array_get($all,'commissaryPoint');
        $reviewerPoint = array_get($all,'reviewerPoint');
        $data = [];
        if (!empty($president)){
            $data[] = [
                'position' => 'president',
                'weight' => $presidentPoint,
                'user_id' => $president,
                'assmebly_id' => $assembly->id,
            ];
        }
        if (!empty($secretary)){
            $data[] = [
                'position' => 'secretary',
                'weight' => $secretaryPoint,
                'user_id' => $secretary,
                'assmebly_id' => $assembly->id,
            ];
        }
        if (!empty($commissary)){
            $data[] = [
                'position' => 'commissary',
                'weight' => $commissaryPoint,
                'user_id' => $commissary,
                'assmebly_id' => $assembly->id,
            ];
        }
        if (!empty($reviewer)){
            $data[] = [
                'position' => 'reviewer',
                'weight' => $reviewerPoint,
                'user_id' => $reviewer,
                'assmebly_id' => $assembly->id,
            ];
        }
        $true = 0;
        foreach($data as $key => $value){
            // kiểm tra tài khoản, và hội đồng xem đã có chưa?
            $check = Users_Assemblys::where('position',$value['position'])->where('assmebly_id',$value['assmebly_id'])->first();
            if(!empty($check)){
                $check->update($value);
                $true = 1;
            }
            else{
                // tồn tại rồi thì không insert nữa
                Users_Assemblys::firstOrCreate($value);
            }
        }
        if ($true = 1){
            Assemblys::where('id',$id)->update($dataStatus);
            return back()->with('flash_success','Đã cập nhật thành công!!! thích quá <3');
        }
        else{
            return back()->with('flash_danger','có lỗi trong quá trình thêm mới');
        }
    }

    // cập nhất tất cả các trường trong hội đồng
    public function postAssemblyAll(EditAssemblyRequest $request,$id){
        $assembly = Assemblys::find($id);

        $all = $request->all();

        $nameAssembly = array_get($all,'name');
        $faculty = array_get($all,'faculty');
        $department = array_get($all,'department');
        $year = array_get($all,'year');

        $data['name'] =  $nameAssembly;
        $data['faculty_id'] =  $faculty;
        $data['department_id'] =  $department;
        $data['year_id'] =  $year;

        Assemblys::where('id',$id)->update($data);

        // tên giáo viên
        $president = array_get($all,'president');
        $secretary = array_get($all,'secretary');
        $commissary = array_get($all,'commissary');
        $reviewer = array_get($all,'reviewer');
        // trọng số giáo viên
        $presidentPoint = array_get($all,'presidentPoint');
        $secretaryPoint = array_get($all,'secretaryPoint');
        $commissaryPoint = array_get($all,'commissaryPoint');
        $reviewerPoint = array_get($all,'reviewerPoint');

        $data = [];
        if (!empty($president)){
            $data[] = [
                'position' => 'president',
                'weight' => $presidentPoint,
                'user_id' => $president,
                'assmebly_id' => $assembly->id,
            ];
        }
        if (!empty($secretary)){
            $data[] = [
                'position' => 'secretary',
                'weight' => $secretaryPoint,
                'user_id' => $secretary,
                'assmebly_id' => $assembly->id,
            ];
        }
        if (!empty($commissary)){
            $data[] = [
                'position' => 'commissary',
                'weight' => $commissaryPoint,
                'user_id' => $commissary,
                'assmebly_id' => $assembly->id,
            ];
        }
        if (!empty($reviewer)){
            $data[] = [
                'position' => 'reviewer',
                'weight' => $reviewerPoint,
                'user_id' => $reviewer,
                'assmebly_id' => $assembly->id,
            ];
        }

        $true = 0;
        foreach($data as $key => $value){
            // kiểm tra tài khoản, và hội đồng xem đã có chưa?
            $check = Users_Assemblys::where('position',$value['position'])->where('assmebly_id',$value['assmebly_id'])->first();
            if(!empty($check)){
                $check->update($value);
                $true = 1;
            }
            else{
                // tồn tại rồi thì không insert nữa
                Users_Assemblys::firstOrCreate($value);
            }
        }
        if ($true = 1){
            return back()->with('flash_success','Đã cập nhật thành công!!! thích quá <3');
        }
        else{
            return back()->with('flash_danger','có lỗi trong quá trình sửa');
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
        //id ở đây là id ở bên view
        DB::table('users_assemblys')->where('assmebly_id',$request->id)->delete();
        Assemblys::destroy($request->id);
        return back();
    }
    public function displayUserDepartment($id){
        // thiết lập các thành viên và trọng số trong hội đồng
        $assemblys = Assemblys::get();
        $data['assemblyList'] = $assemblys;

        $assembly = Assemblys::find($id);

        $department = $assembly->department_id;

        $user =  Users::join('roles','users.role_id','roles.id')
            ->where('users.role_id',2)
            ->where('users.department_id',$department)
            ->select('users.name as nameTeacher','roles.name as roleTeacher','users.id')
            ->get();
        $data['usersList'] = $user;
        /*dd($data['usersList']);*/

        $data['assembly'] = $assembly;


        // xuất ra những user đã thêm
        $userSeclected = Users_Assemblys::where('assmebly_id',$id)->get();
        // lấy ra những user đã dược thiết lập trong hội đồng
        $arrayUser = [];

        foreach ($userSeclected as $value){
            if ($value->position == 'president'){
                $arrayUser['president'] = $value->user_id;
                $arrayUser['presidentPoint'] = $value->weight;
            }
            if ($value->position == 'secretary'){
                $arrayUser['secretary'] = $value->user_id;
                $arrayUser['secretaryPoint'] = $value->weight;
            }
            if ($value->position == 'commissary'){
                $arrayUser['commissary'] = $value->user_id;
                $arrayUser['commissaryPoint'] = $value->weight;
            }
            if ($value->position == 'reviewer'){
                $arrayUser['reviewer'] = $value->user_id;
                $arrayUser['reviewerPoint'] = $value->weight;
            }
        }
        $data['userSeclected'] = $arrayUser;
       /* dd($data['userSeclected']);*/

        return view('backend.assembly.setup',$data);
    }
    // sửa hội đồng khi mới tạo hội đồng
    public function editCreateAssembly(EditCreateAssemblyRequest $request,$id){
        $all = $request->all();
        /*dd($all);*/
        $name = array_get($all,'name');
        $faculty = array_get($all,'faculty');
        $department = array_get($all,'department');
        $year = array_get($all,'year');

        $data['name'] = $name;
        $data['faculty_id'] = $faculty;
        $data['department_id'] = $department;
        $data['year_id'] = $year;
        $data['status'] = 1;

        Assemblys::where('id',$id)->update($data);

        return back()->with('flash_success','Đã cập nhật thành công!!! thích quá <3');
    }
}
