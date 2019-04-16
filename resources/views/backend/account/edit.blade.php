@extends('backend.master')
@section('title')
    <title>Cập nhật tài khoản</title>
@endsection()
@section('content')
    <div class="content-wrapper" style="min-height: 1125.8px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sửa tài khoản
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li><a href="{{route('backend.account.index')}}">tài khoản</a></li>
                <li class="active">Sửa</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="" style="border-top-color: #3c8dbc;"><a href="#activity" data-toggle="tab" aria-expanded="false">Thông tin</a></li>
                        </ul>
                        @include('error.messages')
                        <div class="tab-content">
                            <div class="tab-pane active" id="activity">
                                <form class="form-horizontal" action="{{route('backend.account.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                                    {{ method_field('PUT') }}
                                    {{csrf_field()}}
                                    @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 4)
                                    <div class="form-group">
                                        <label for="inputCode" class="col-sm-2 control-label">Mã thành viên<i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <input type="text" required class="form-control" name="code" id="inputCode" value="{{$user->code}}">
                                        </div>
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Họ và tên <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <input type="text"  class="form-control" id="inputName" name="name" value="{{$user->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Email </label>
                                        <div class="col-sm-10">
                                            <input type="email"  class="form-control" id="inputEmail" name="email" value="{{$user->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-sm-2 control-label">Liên lạc </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="phone" class="form-control" id="inputPhone"  value="{{$user->phone}}" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputBirthday" class="col-sm-2 control-label">Ngày sinh</label>
                                        <div class="col-sm-10">
                                            <input type="text"  class="form-control" name="birthday" id="inputBirthday" value="{{!empty($user->birthday) ? date('d/m/Y',$user->birthday) : '' }}" placeholder="9/02/1996">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputGender" class="col-sm-2 control-label">Giới tính</label>
                                        <div class="col-sm-10" style="margin-top: 6px">
                                            <input type="radio"  name="gender" value="2" @if($user->gender == 2) checked @endif >Nam
                                            <div class="inline" style="margin-right: 10px"> </div>
                                            <input type="radio" name="gender" value="1" @if($user->gender == 1) checked @endif >Nữ<br>
                                        </div>
                                    </div>
                                    {{--<div class="form-group">
                                        <label for="inputPassword" class="col-sm-2 control-label">Password <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <input type="password"  class="form-control" id="inputPassword" name="password" value="{{$user->password}}">
                                        </div>
                                    </div>--}}
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <a href="{{route('backend.account.password',$user->id)}}" class="btn btn-xs btn-default" style="margin-top: 5px;">Đổi mật khẩu</a>
                                        </div>
                                    </div>
                                    @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 4)
                                    <div class="form-group">
                                        <label for="inputType" class="col-sm-2 control-label">Loại <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10" style="margin-top: 6px">
                                            <select class="form-control select2" required name="role" id="role" onchange="showFields()" style="width: 100%;">
                                                <option value="0">--Loại--</option>
                                                @foreach($roleList as $value)
                                                    <option value="{{$value->id}}"
                                                            @if($user->role_id == $value->id) selected @endif>
                                                        {{$value->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 4)
                                    <div class="form-group" id="contentCourse">
                                        <label for="inputYear" class="col-sm-2 control-label">Khóa</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputCourse" name="course" value="{{$user->course}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDepartment" class="col-sm-2 control-label">Khoa</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="faculty" id="faculty" style="width: 100%;" onchange="facultyFunction()">
                                                <option value="0">--Khoa--</option>
                                                @foreach($departmentList as $value)
                                                    @if($value->parent == null)
                                                        <option value="{{$value->id}}"{{!empty($user->faculty_id) && $user->faculty_id == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDepartment" class="col-sm-2 control-label">Ngành</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="department" id="department" style="width: 100%;">
                                                <option value="0">--Ngành--</option>
                                                @foreach($arrayDepartment as $key => $value)
                                                    <option value="{{$key}}" {{$user->department_id == $key ? 'selected' : ''}}>
                                                        {{$value}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="contentGroup">
                                        <label for="inputGender" class="col-sm-2 control-label">Nhóm</label>
                                        <div class="col-sm-10" style="margin-top: 6px">
                                            <select class="form-control select2" name="group" style="width: 100%;">
                                                <option value="0" @if($user->group == 0) selected @endif >--Nhóm--</option>
                                                <option value="1" @if($user->group == 1) selected @endif >Nhóm 1</option>
                                                <option value="2" @if($user->group == 2) selected @endif >Nhóm 2</option>
                                                <option value="3" @if($user->group == 3) selected @endif >Nhóm 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="contentClass">
                                        <label for="inputGender" class="col-sm-2 control-label">Lớp</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="class" id="inputPassword" value="{{$user->class}}">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="inputType" class="col-sm-2 control-label">Ảnh</label>
                                        <div class="col-sm-10" style="margin-top: 6px">
                                            <img class="img-circle"
                                                 style="object-fit: cover; object-position: center; width: 150px;height: 150px;"
                                                 src="{{url('avatars/'.$user->image)}}" alt="{{$user->image}}">
                                            <div class="form-control" style="border: none">
                                                <input type="file" value="" name="image">
                                            </div>
                                        </div>
                                    </div>
                                    <!--sửa-->
                                    <div class="form-group">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <div class="form-control" style="border: none">
                                                <button type="submit" class="btn btn-primary w-100">Sửa</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
@endsection()

@push('after-script')
    <script type="text/javascript">
        $(function () {
            $('.select2').select2();
            $('[data-mask]').inputmask()
        });
        // ngày sinh
        $(function() {
            $('input[name="birthday"]').daterangepicker({
                datepicker:true,
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'D/M/YYYY'
                }
            });
        });
        // lọc ngành theo khoa
        function facultyFunction() {
            var faculty = $('#faculty').val();
            $.ajax({
                url:"{{route('backend.department.ajax')}}",
                dataType: 'json',
                type: 'GET',
                data: {faculty:faculty},
                success:function (data) {
                    if (data.success){
                        $('#department').select2().empty();
                        $('#department').select2({
                            data: data.data,
                        })
                    }
                }
            });
        }
        function showFields() {
            var role = $('#role').val();
            if (role == 2 || role == 4){
                $('#contentClass').css('display','none');
                $('#contentCourse').css('display','none');
                $('#contentGroup').css('display','none');
            }
            else {
                $('#contentClass').css('display','block');
                $('#contentCourse').css('display','block');
                $('#contentGroup').css('display','block');
            }
        }


    </script>
@endpush()
