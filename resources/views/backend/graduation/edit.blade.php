@extends('backend.master')
@section('title')
    <title>Cập nhật khóa luận</title>
@endsection()
@section('content')

    <div class="content-wrapper" style="min-height: 1125.8px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sửa KLTN
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li><a href="{{route('backend.graduation.index')}}">KLTN</a></li>
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
                                <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{route('backend.graduation.update',$graduation->id)}}">
                                    {{ method_field('PATCH') }}
                                    {{csrf_field()}}
                                    <!--Khoa-->
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Khoa <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="faculty" id="faculty" onchange="facultyFunction()" style="width: 100%;" required >
                                                <option value="" >--Khoa--</option>
                                                    @foreach($departmentList as $value)
                                                        @if($value->parent == null)
                                                            <option value="{{$value->id}}" {{!empty($graduation->faculty_id) && $graduation->faculty_id == $value->id ? 'selected' :'' }}>{{$value->name}}</option>
                                                        @endif
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--Ngành-->
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Ngành <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="department" id="department" onchange="teacherFunction(); studentFunction(); subjectFunction(); assemblyFunction(); " required style="width: 100%;">
                                                @foreach($arrayDepartment as $key => $value)
                                                    <option value="{{$key}}" {{!empty($graduation->department_id) && $graduation->department_id == $key ? 'selected' :'' }}>{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--đề tài-->
                                    <div class="form-group">
                                        <label for="inputCode" class="col-sm-2 control-label">Đề tài <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="subject" id="subject" required style="width: 100%;">
                                                <option value="">--Đề Tài--</option>
                                                    @foreach($subjectList as $value)
                                                        <option value="{{$value->id}}" {{$graduation->subject_id == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--sinh viên-->
                                    <div class="form-group">
                                        <label for="inputYear" class="col-sm-2 control-label">Sinh viên thưc hiện <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="student" id="student" required style="width: 100%;">
                                                <option value="">--Sinh viên--</option>
                                                    @foreach($userList as $value)
                                                        <!--3 là role sinh viên-->
                                                        @if($value->role->id == 3)
                                                            <option value="{{$value->id}}" {{!empty($graduation->user_student_id) && $graduation->user_student_id == $value->id ? 'selected' :'' }}>{{$value->name}}</option>
                                                        @endif
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- giáo viên-->
                                    <div class="form-group">
                                        <label for="inputDepartment" class="col-sm-2 control-label">Giáo viên hướng dẫn <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="teacher" id="teacher" required style="width: 100%;">
                                                <option value="">--Giáo viên--</option>
                                                    @foreach($userList as $value)
                                                        <!--3 là role sinh viên-->
                                                        @if($value->role->id == 2)
                                                            <option value="{{$value->id}}" {{!empty($graduation->user_teacher_id) && $graduation->user_teacher_id == $value->id ? 'selected' :'' }} >{{$value->name}}</option>
                                                        @endif
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Năm-->
                                    <div class="form-group">
                                        <label for="inputDepartment" class="col-sm-2 control-label">Năm <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="year" id="year" onchange="assemblyFunction()" required style="width: 100%;">
                                                <option value="">--Năm--</option>
                                                    @foreach($yearList as $value)
                                                        <option value="{{$value->id}}" {{!empty($graduation->year_id) && $graduation->year_id == $value->id ? 'selected' :'' }} >{{$value->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--Kỳ-->
                                    <div class="form-group">
                                        <label for="inputDepartment" class="col-sm-2 control-label">Kỳ <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="semester" required style="width: 100%;">
                                                <option value="">--Kỳ--</option>
                                                <option value="1" {{!empty($graduation->semester) && $graduation->semester == 1 ? 'selected' : ''}} >Kỳ 1</option>
                                                <option value="2" {{!empty($graduation->semester) && $graduation->semester == 2 ? 'selected' : ''}} >Kỳ 2</option>
                                                <option value="3" {{!empty($graduation->semester) && $graduation->semester == 3 ? 'selected' : ''}} >Kỳ 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--Hội đồng-->
                                    <div class="form-group">
                                        <label for="inputAssembly" class="col-sm-2 control-label">Hội đồng <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="assembly" id="assembly" data-graduation="{{$graduation->id}}" {{--onchange="pointAssemblyFunction(this)"--}} required style="width: 100%;">
                                                <option value="">--Hội Đồng--</option>
                                                @foreach($assemblyList as $value)
                                                    <option value="{{$value->id}}" {{!empty($graduation->assembly_id) && $graduation->assembly_id == $value->id ? 'selected': '' }} >{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--Điểm-->
                                        {{--<a data-id="{{$graduation->id}}" data-toggle="modal" data-target="#detail" id="point" class="btn btn-sm btn-info" style="margin-top: 5px">
                                            <span>Chi tiết</span>
                                        </a>--}}
                                    <div class="form-group">
                                        <label for="inputPoint" class="col-sm-2 control-label">Điểm</label>
                                        <div class="col-sm-10" style="margin-top: 6px">


                                            <a href="{{route('backend.assembly.point.exist',$graduation->id)}}" data-toggle="modal" data-target="#assemblyPointExist" class="btn btn-sm btn-info" style="margin-top: 5px">
                                                <span>Chi tiết</span>
                                            </a>
                                        </div>
                                    </div>

                                        <!--Phần Chi tiết-->
                                        <div class="modal fade" id="detail">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="title_assembly">Tên hội đồng</h4>
                                                    </div>
                                                    <div class="modal-body" id="table-assembly-point">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Lưu</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!--Phần Chi tiết-->
                                        <!--Phần hội đồng và điểm tồn tại-->
                                        <div class="modal fade modal-ajax" id="assemblyPointExist">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!--Phần hội đồng và điểm tồn tại-->

                                    <!--Phòng-->
                                    <div class="form-group">
                                        <label for="inputType" class="col-sm-2 control-label">Phòng <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10" style="margin-top: 6px">
                                            <input class="form-control" type="text" name="room" required placeholder="B605" value="{{$graduation->room}}" />
                                        </div>
                                    </div>
                                    <!--thời gian-->
                                    <div class="form-group">
                                        <label for="inputType" class="col-sm-2 control-label">Thời gian <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        {{--{{dd(Carbon\Carbon::parse($graduation->time)->format('d/m/Y h:i A'))}}--}}
                                        <div class="col-sm-10" style="margin-top: 6px">
                                            <input class="form-control" type="text" name="datetimes" value="{{Carbon\Carbon::parse($graduation->time)->format('d/m/Y h:i A')}}"/>
                                        </div>
                                    </div>
                                    <!--file KLTN-->
                                    <div class="form-group">
                                        <label for="inputType" class="col-sm-2 control-label">File báo cáo</label>
                                        <div class="col-sm-10" style="margin-top: 6px">
                                            <div class="fileUpload btn btn-default">
                                                <span>Upload</span>
                                                <input type="file" class="upload" name="report" value="{{$graduation->report}}" />
                                            </div>
                                            <small>{{$graduation->report}}</small>
                                        </div>
                                    </div>
                                    <!--Sủa-->
                                    <div class="form-group">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10" style="margin-top: 6px">
                                            <button type="submit" class="btn btn-primary">Sửa</button>
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
        // select 2
        $(function () {
            $('.select2').select2()
        });
        // date and time
        $(function() {
            $('input[name="datetimes"]').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'D/MM/YYYY hh:mm A'
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
        //lọc giáo viên qua ngành
        function teacherFunction() {
            // lấy ra giáo viên thuộc khoa chọn
            var department = $('#department').val();
            $.ajax({
                url:"{{route('backend.user.ajax')}}",
                dataType: 'json',
                type: 'GET',
                data: {department:department},
                success:function (data) {
                    if (data.success){
                        $('#teacher').select2().empty();
                        $('#teacher').select2({
                            data: data.data,
                        });
                    }
                }
            });
        }
        //lọc sinh viên qua ngành
        function studentFunction() {
            var department = $('#department').val();
            $.ajax({
                url:"{{route('backend.userStudent.ajax')}}",
                dataType: 'json',
                type: 'GET',
                data: {department:department},
                success:function (data) {
                    if (data.success){
                        $('#student').select2().empty();
                        $('#student').select2({
                            data: data.data,
                        });
                    }
                }
            });
        }
        //lọc đề tài qua ngành
        function subjectFunction() {
            var department = $('#department').val();
            $.ajax({
                url:"{{route('backend.subject.ajax')}}",
                dataType: 'json',
                type: 'GET',
                data: {department:department},
                success:function (data) {
                    if (data.success){
                        $('#subject').select2().empty();
                        $('#subject').select2({
                            data: data.data,
                        });
                    }
                }
            });
        }
        //lọc hội đồng qua ngành
        function assemblyFunction() {
            var department = $('#department').val();
            var year = $('#year').val();
            $.ajax({
                url:"{{route('backend.assembly.ajax')}}",
                dataType: 'json',
                type: 'GET',
                data: {department:department, year:year},
                success:function (data) {
                    if (data.success){
                        $('#assembly').select2().empty();
                        $('#assembly').select2({
                            data: data.data,
                        });
                    }
                }
            });
        }
        function pointAssemblyFunction(element) {
            var assembly = $(element).val();
            var graduation = $("#assembly").data('graduation');
            $.ajax({
                url:"{{route('backend.assembly.point')}}",
                dataType: 'json',
                type: 'GET',
                data: {assembly:assembly, graduation:graduation},
                success:function (data) {
                    if (data.success){
                        /*console.log(data);*/
                        var modal = $("#detail");
                        modal.find('#table-assembly-point').html(data.data);
                    }
                }
            });
        }

    </script>
@endpush
