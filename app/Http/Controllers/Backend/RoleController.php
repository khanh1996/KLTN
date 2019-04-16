<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AddRoleRequest;
use App\Http\Requests\EditRoleRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role\Roles;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Roles::all();
        $data['roleList'] = $roles;
        return view('backend.role.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roleList = Roles::all();
        $data['roleList'] = $roleList;
        return view('backend.role.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRoleRequest $request)
    {
        //
        $role = new Roles();
        $role->name = $request->name;

        $role->save();
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
        $id = Roles::find($id);
        $data['role'] = $id;

        return view('backend.role.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRoleRequest $request, $id)
    {
        //
        $data['name'] = $request->name;
        Roles::where('id',$id)->update($data);
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
        //
        Roles::destroy($request->name);
        return back()->with('flash_success','Đã xóa thành công!!! thích quá <3');
    }
}
