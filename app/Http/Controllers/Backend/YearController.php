<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AddYearRequest;
use App\Http\Requests\EditYearRequest;
use App\Models\Department\Departments;
use App\Models\Subject\Subjects;
use App\Models\User\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Year\Years;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $years = Years::all();
        $data['yearList'] = $years;
        return view('backend.year.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $yearList = Years::all();
        $data['yearList'] = $yearList;
        return view('backend.year.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddYearRequest $request)
    {
        //
        $year = new Years();
        $year->name = $request->name;

        $year->save();
        return back()->with('flash_success','Đã thêm mới thành công!!! thích quá <3');
        /*return view('backend.year.add');*/
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
        $id = Years::find($id);
        $data['year'] = $id;

        return view('backend.year.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditYearRequest $request, $id)
    {
        //
        $data['name'] = $request->name;
        Years::where('id',$id)->update($data);
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
        Years::destroy($request->name);
        return back()->with('flash_success','Đã xóa thành công!!! thích quá <3');
    }
}
