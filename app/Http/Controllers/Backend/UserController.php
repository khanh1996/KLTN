<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\ImportUserRequest;
use App\Models\Department\Departments;
use App\Models\Role\Roles;
use App\Models\Subject\Subjects;
use App\Models\User\Users;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Maatwebsite\Excel\Excel;

class UserController extends Controller
{
    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    /**
     * Hiển thị danh sách tài nguyên
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = Users::all();
        $data['user'] = $user;

        $department = Departments::all();
        $data['departmentList'] = $department;

        $role = Roles::all();
        $data['roleList'] = $role;

        $input = $request->all();
        /*dd($input);*/
        $code = array_get($input,'code');
        $faculty = array_get($input,'faculty');
        $department = array_get($input,'department');
        $role = array_get($input,'role');

        $userList = Users::OrderBy('created_at','DESC');
        // kiểm tra id đó có rỗng không để thực hiện điều kiện
        if (!empty($code)){
            $userList->where('code',$code);
        }
        if (!empty($faculty)){
            $userList->where('faculty_id',$faculty);
        }
        if (!empty($department)){
            $userList->where('department_id',$department);
        }
        if (!empty($role)){
            $userList->where('role_id',$role);
        }
        // lấy tất cả ra
        $userList = $userList->get();
        // lọc các giáo viên hướng dẫn trong quyền của sinh viên theo ngành khoa
        if (\Auth::user()->role_id == 3){
           /* $departmentUser = \Auth::user()->department_id;
            $facultyUser = \Auth::user()->faculty_id;
            $userDepartmentList = Subjects::join('users','subjects.user_id','users.id')
                ->where('users.faculty_id',$facultyUser)
                ->where('users.department_id',$departmentUser)
                ->where('users.role_id',2)
                ->select('*','subjects.name as nameSubject')
                ->get();
            $data['userDepartmentList'] = $userDepartmentList;
            dd($userDepartmentList);*/
        }
        $data['userList'] = $userList;
        /*dd($data['userList']);*/

        return view('backend.account.list',$data);
    }

    /**
     * Hiển thị biểu mẫu để tạo tài nguyên mới
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $departments = Departments::all();
        $roles = Roles::all();
        $data['departmentList'] = $departments;
        $data['roleList'] = $roles;

        $users = Users::OrderBy('created_at','DESC')->get();
        $data['userList'] = $users;
        /*dd($data['userList']);*/

        return view('backend.account.add',$data);
    }

    /**
     * Lưu trữ tài nguyên mới được tạo trong bộ nhớ.
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        //
        /*$all = $request->all();
        dd($all);*/
        // format ngày sinh
        $birthday =  $request->birthday;
        $birthday = Carbon::createFromFormat('d/m/Y',$birthday)->timestamp;

        $user = new Users();
        $user->code =  $request->code;
        $user->name = $request->name;
        $user->birthday = $birthday;
        $user->password = bcrypt($request->password);
        $user->gender = $request->gender;
        $user->class = $request->class;
        $user->course = $request->course;
        if (!empty($request->group)){
            $user->group = $request->group;
        }
        if (!empty($request->phone)){
            $user->phone = $request->phone;
        }
        if (!empty($request->email)){
            $existsEmail = User::where('email',$request->email)->first();
           if (!empty($existsEmail)){
               return back()->with('flash_danger','Đã tồn tại email trong hệ thống!!!');
           }else{
               $user->email = $request->email;
           }
        }
        // thêm file ảnh
        /*$this->validate($request, [
            'image' => 'image|required|mimes:jpeg,png,jpg,gif,svg'
        ]);*/
        // lấy tên file
        if (!empty($request->image)){
            $filename = $request->image->getClientOriginalName();
            // lưu file
            $request->image->storeAs('images', $filename);
            // chuyền file sang public
            $request->image->move(public_path('/avatars'), $filename);
            // lưu tên ảnh vào DB
            $user->image = $filename;
        }
        else{
            $user->image = null;
            /*dd('chưa có ảnh');*/
        }
        if (!empty($request->faculty)){
            $user->faculty_id = $request->faculty;
        }
        if (!empty($request->department)){
            $user->department_id = $request->department;
        }

        $user->role_id = $request->role;

        $user->save();
        return back()->with('flash_success','Đã thêm mới thành công!!! thích quá <3');
        /*return view('backend.account.add');*/
    }

    /**
     * Hiển thị tài nguyên được chỉ định
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = Users::find($id);
        $data['user'] = $user;
        /*dd($data);*/

        return view('backend.account.detail',$data);
    }

    /**
     * Hiển thị biểu mẫu để chỉnh sửa tài nguyên được chỉ định.
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = Users::find($id);
        $data['user'] = $user;

        // lọc  - khoa
        $department = Departments::all();
        $data['departmentList'] = $department;

        // loc ngành
        $departments = Departments::all();
        $arrayDepartment = [];
        foreach ($departments as $value){
            if ($value->parent != null && $user->faculty_id == $value->parent){
                $arrayDepartment[$value->id] = $value->name;
            }
        }
        // array
        $data['arrayDepartment'] = $arrayDepartment;
        /* dd($arrayDepartment);*/

        // lọc quyền
        $role = Roles::all();
        $data['roleList'] = $role;

        /*dd($data);*/

        return view('backend.account.edit',$data);
    }

    /**
     * Cập nhật tài nguyên được chỉ định trong bộ nhớ.
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        // format lại kiểu ngày sinh thành int
        $all = $request->all();
        /*dd($all);*/
        $birthday =  $request->birthday;
        $birthday = Carbon::createFromFormat('d/m/Y',$birthday)->timestamp;
        if (!empty($request->code)){
            $data['code'] = $request->code;
        }
        $data['name'] = $request->name;
        $data['birthday']  = $birthday;
        $data['gender']  = $request->gender;
        /*$data['password']  = bcrypt($request->password);*/
        if (!empty($request->course)){
            $data['course']  = $request->course;
        }
        if (!empty($request->department)){
            $data['department_id'] = $request->department;
        }
        if (!empty($request->faculty)){
            $data['faculty_id']  = $request->faculty;
        }
        if (!empty($request->group)){
            $data['group']  = $request->group;
        }
        if (!empty($request->class)){
            $data['class']  = $request->class;
        }
        if (!empty($request->role)){
            $data['role_id']  = $request->role;
        }
        if (!empty($request->email)){
            $existsEmail = User::where('email',$request->email)->where('id','!=',$id)->first();
            $existsEmailMyself = User::where('email',$request->email)->where('id',$id)->first();
            if (!empty($existsEmail)){
                return back()->with('flash_danger','Đã tồn tại email trong hệ thống!!!');
            }
            else{
                $data['email'] = $request->email;
            }
            if (!empty($existsEmailMyself) && empty($existsEmail)){
                $data['email'] = $request->email;
            }
            else{
                $data['email'] = $request->email;
            }
        }
        else{
            $data['email'] = $request->email;
        }
        $data['phone']  = $request->phone;
        if ($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename);
            $request->image->move(public_path('/avatars'), $filename);
            $data['image'] = $filename;
        }
        $update = Users::where('id',$id)->update($data);
        if (!empty($update)){
            return redirect()->route('backend.account.show',$id)->with('flash_success','Đã cập nhật thành công!!! thích quá <3');
        }
        else{
            return back()->with('flash_danger','Lỗi chưa thể sửa');
        }

    }

    /**
     * Xóa tài nguyên được chỉ định khỏi bộ nhớ.
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //id ở đây là id ở bên view
        Users::destroy($request->id);
        return back();
    }
    // import file excel vào DB
    public function getImport(){
        $department = Departments::all();
        $data['departmentList'] = $department;

        $roles = Roles::all();
        $data['roleList'] = $roles;
        return view('backend.account.import',$data);
    }
    // hàm này dây a
    public function postImport(ImportUserRequest $request){
        $all = $request->all();
        $faculty = array_get($all,'faculty');
        $department = array_get($all,'department');
        $role = array_get($all,'role');
        $import = array_get($all,'import');

        if($request->hasFile('import')) {
            // đường đãn file
            $path = $request->file('import')->getRealPath();
            // lấy dữ liêu từ file excel
            $data = $this->excel->toArray(new Users(),$request->file('import'));
            /*dd($data);*/
            // file sheet excel đầu tiên
            $data_user = [];
            foreach ($data[0] as $key => $item){
                /*dd($data[0]);*/
                if($key > 0){
                    if(!empty($item[0])){
                        $code = $item[0];
                        $name = !empty($item[1]) ? $item[1] : '';
                        $class = !empty($item[2]) ? $item[2] : '';
                        $course = !empty($item[3]) ? $item[3] : '';

                        //kiem tra neu dung la mã sinh viên va khong ton tai trong database thi tao tai khoan
                        $check_code = Users::where('code',$code)->first();

                        if (empty($check_code)) {
                            $data_user[] = [
                                'code' => $code,
                                'name' => $name,
                                'class' => $class,
                                'course' => $course,
                                'password' => bcrypt('123456'),
                                'faculty_id' => $faculty,
                                'department_id' => $department,
                                'role_id' => $role,
                            ];
                        }
                    }
                }
            }
            /*dd($data_user);*/
            // thêm 1 nhiều data thì phải dùng insert
            Users::insert($data_user);
        }
        return back()->with('flash_success','Thêm mới danh sách tài khoản từ file excel thành công!!! thích quá <3');
    }
    // export file excel

    public function getPassword($id){
        $user = User::find($id);
        $data['user'] = $user;
        return view('backend.account.changePassword',$data);
    }
    public function postPassword($id, Request $request){
        $all = $request-> all();
        $password = array_get($all,'password');
        $verifyPassword = array_get($all,'verifyPassword');

         $data['password'] = $password;
         if ($password == $verifyPassword){
             $data['password'] = bcrypt($password);
             Users::where('id',$id)->update($data);
             return redirect()->route('backend.account.show',$id)->with('flash_success','Cập nhật mật khẩu thành công!!! thích quá <3');
         }
         else{
             return back()->with('flash_warning','Xác minh khẩu không đúng!!!');
         }
    }

    // danh sách sinh viên theo ngành khoa
    public function getListStudent(Request $request){
        $userFaculty = \Auth::user()->faculty_id;
        $userDepartment = \Auth::user()->department_id;
        $userList = Users::where('role_id',3)->where('faculty_id',$userFaculty)->where('department_id',$userDepartment);
        /*dd($users);*/

        // lọc ra các khoa của sinh viên
        $courseList = \DB::table('users')
            ->groupBy('course')
            ->where('course', 'like', '%K%')->select('users.course')->get();
        $data['courseList']= $courseList;
        // lọc ra các sinh viên trong phần tìm kiếm
        $userListSearch = Users::where('role_id',3)->where('faculty_id',$userFaculty)->where('department_id',$userDepartment)->get();
        $data['userListSearch'] = $userListSearch;
        // tìm kiếm sinh viên theo khóa hoặc tên hoặc trạng thái
        $all = $request->all();
        $name = array_get($all,'name');
        $course = array_get($all,'course');
        $status = array_get($all,'status');
        if (!empty($name)){
            $userList->where('id',$name);
        }
        if (!empty($course)){
            $userList->where('course','LIKE', $course);
        }
        if (!empty($status)){
            $userList->where('status', $status);
        }
        $userList = $userList->get();
        $data['userList'] = $userList;

        return view('backend.student.list',$data);
    }
    // chi tiết sinh viên
    public function getDetailStudent($id){
        $user = Users::find($id);
        $data['user'] = $user;
        return view('backend.student.detail',$data);
    }



//    public function postImport(Request $request)
//    {
//        \Excel::import(new Users(),$request->file('import'));
//
//        return back();
//    }
}
