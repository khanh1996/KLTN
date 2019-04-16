<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('welcome');
});
Route::get('test','TestController@getTest');

Route::get('table',function (){
    return view('backend.data');
})->name('table');
// phần quản trị
Route::group(['namespace' => 'Backend'],function (){
    Route::group(['prefix'=>'login','middleware'=>'CheckLogin'],function(){
        Route::get('/','LoginController@getLogin');
        Route::post('/','LoginController@postLogin');
    });

    // tài khoản
    Route::group(['as' => 'backend.','middleware'=>'CheckLogout'] ,function(){
        Route::get('home','HomeController@getHome')->name('home');
        Route::get('logout','HomeController@getlogout')->name('logout');

        Route::resource('account','UserController');
        // import bằng file excel danh sách tài khoản
        Route::get('getImport','UserController@getImport')->name('account.import');
        Route::post('postImport','UserController@postImport')->name('account.import.post');
        // đổi mật khẩu
        Route::get('getPassword/{id}','UserController@getPassword')->name('account.password');
        Route::post('postPassword/{id}','UserController@postPassword')->name('account.password.post');
        // danh sách sinh viên
        Route::get('getListStudent','UserController@getListStudent')->name('account.student');
        Route::get('getDetailStudent/{id}','UserController@getDetailStudent')->name('account.student.detail');

        Route::resource('graduation','GraduationController');
        Route::get('getDetailGraduation/{id}','GraduationController@getDetailGraduation')->name('graduation.detail');
        Route::get('getComfirmGraduation/{id}','GraduationController@getComfirmGraduation')->name('graduation.comfirm');
        Route::patch('patchComfirmGraduation/{id}','GraduationController@patchComfirmGraduation')->name('graduation.comfirm.patch');
        Route::patch('patchPointGraduation/{id}','GraduationController@patchPointGraduation')->name('graduation.point');
        // phần chi tiết kltn xác nhận KLTN
        Route::get('getShowGraduation/{id}','GraduationController@showComfirm')->name('graduation.show.comfirm');

        // sủa KLTN đã đăng ký
        Route::get('getGraduationRegistration/{id}','GraduationController@getGraduationRegistration')->name('graduation.registration');
        Route::post('postGraduationRegistration/{id}','GraduationController@postGraduationRegistration')->name('graduation.registration.post');
        // sủa KLTN đã xác nhận
        Route::get('getGraduationConfirm/{id}','GraduationController@getGraduationConfirm')->name('graduation.confirm');
        Route::post('postGraduationConfirm/{id}','GraduationController@postGraduationConfirm')->name('graduation.confirm.post');

        Route::resource('assembly','AssemblyController');
        Route::post('editCreateAssembly/{id}','AssemblyController@editCreateAssembly')->name('assembly.editCreateAssembly');
        Route::post('updateAssemblyAll/{id}','AssemblyController@postAssemblyAll')->name('assembly.updateAll');

        Route::get('user_assembly/{id}','AssemblyController@displayUserDepartment')->name('displayUserDepartment');

        Route::resource('role','RoleController');
        Route::resource('statistical','StatisticalController');
        // báo cáo
        Route::get('report','StatisticalController@report')->name('statistical.report');
        Route::get('reportTeacher','StatisticalController@reportTeacher')->name('statistical.reportTeacher');
        // Thống kê dành cho giáo viên
        Route::get('getStatisticalTeacher','StatisticalController@getStatisticalTeacher')->name('statistical.getStatisticalTeacher');

        Route::resource('department','DepartmentController');
        Route::resource('subject','SubjectController');
        Route::resource('year','YearController');
        Route::resource('role','RoleController');
        Route::resource('users_assembly','user_assemblyController');

        // lấy ra các ngành theo khoa
        Route::get('ajaxDepartment','AjaxController@ajaxDepartment')->name('department.ajax');
        // láy ra giáo viên theo ngành
        Route::get('ajaxUser','AjaxController@ajaxUser')->name('user.ajax');
        // lấy ra sinh viên theo ngành
        Route::get('ajaxUserStudent','AjaxController@ajaxUserStudent')->name('userStudent.ajax');
        // lấy ra các đề tài theo giáo viên
        Route::get('ajaxSubject','AjaxController@ajaxSubject')->name('subject.ajax');
        // lấy hội đồng theo ngành
        Route::get('ajaxAssembly','AjaxController@ajaxAssembly')->name('assembly.ajax');
        // lấy ra giáo viên theo đề tài
        Route::get('ajaxUserTeacher','AjaxController@ajaxUserTeacher')->name('userTeacher.ajax');


        Route::get('ajaxAllAssembly/{id}','AjaxController@ajaxAllAssembly')->name('AllAssembly.ajax');
        Route::get('ajaxPoint/{id}','AjaxController@ajaxPoint')->name('point.ajax');

        //lấy ra hội đồng và điểm thi trong sửa khóa luận
        Route::get('ajaxAssemblyPoint','AjaxController@ajaxAssemblyPoint')->name('assembly.point');
        // hiện thi modal hội đồng và điểm đã tồn tại trong csdl phần sửa
        Route::get('ajaxAssemblyPointExist/{id}','AjaxController@ajaxAssemblyPointExist')->name('assembly.point.exist');
        // tìm kiếm theo tên or theo mã sinh viên
        Route::post('search','HomeController@search')->name('search');
        // tìm kiếm theo tên or theo mã sinh viên của tài khoản giáo viên
        Route::post('searchStudent','HomeController@searchStudent')->name('search.student');

        // giáo viên xem KLTN của các sinh viên mình hướng dẫn
        Route::get('getTeacherGraduation','GraduationController@getTeacherGraduation')->name('graduation.teacherGraduation');
        // sinh viên xem KLTN của mình
        Route::get('getStudentGraduation','GraduationController@getStudentGraduation')->name('graduation.studentGraduation');

    });

});

