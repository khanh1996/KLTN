@extends('backend.master')
@section('title')
    <title>Đăng ký khóa luận</title>
@endsection()
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Quản lý KLTN
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li class="active"><a href="{{route('backend.graduation.create')}}">Đăng ký KLTN</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Đăng ký KLTN</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        @include('error.messages')
                        <div class="box-body" style="">
                            <div class="row">
                                <form type="" enctype="multipart/form-data" method="POST" action="{{route('backend.graduation.store')}}">
                                    <!-- Khoa -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Khoa <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                            <select  class="form-control select2" name="faculty" id="faculty" onchange="facultyFunction()" style="width: 100%;">
                                                <option value="">--Khoa--</option>
                                                    @foreach($departmentList as $value)
                                                        @if($value->parent == null)
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                        @endif
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Ngành -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ngành <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                            <select class="form-control select2" name="department" id="department" onchange="studentFunction(); teacherFunction()" style="width: 100%;">
                                                <option value="">--Ngành--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--giáo viên hướng dẫn-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Giáo viên hướng dẫn <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                            <select class="form-control select2 " name="teacher" id="teacher" onchange="subjectFunction()" style="width: 100%;">
                                                <option value="">--Giáo viên--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- đề tài -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Đề Tài <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                            <select class="form-control select2" name="subject" id="subject" style="width: 100%;">
                                                <option value="">--Đề Tài--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--Sinh viên thực hiện -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sinh viên thực hiện <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                            <select class="form-control select2" name="student" id="student" style="width: 100%;">
                                                <option value="">--Sinh viên--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--Năm-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Năm <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                            <select class="form-control select2" name="year" style="width: 100%;">
                                                <option value="">--Năm--</option>
                                                @foreach($yearList as $value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--Kỳ-->
                                    <div class="col-md-4">
                                        <label>Kỳ <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <select class="form-control" name="semester" style="width: 100%;">
                                            <option value="">--Kỳ--</option>
                                            <option value="1">Kỳ I</option>
                                            <option value="2">Kỳ II</option>
                                            <option value="3">Kỳ III</option>
                                        </select>
                                    </div>
                                {{-- <!--Phòng-->
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label>Phòng</label>
                                         <select class="form-control select2" name="year" style="width: 100%;">
                                             <option selected="selected">B102</option>
                                             <option>B506</option>
                                             <option>B708</option>
                                         </select>
                                     </div>
                                 </div>
                                 <!--thời gian-->
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label>Thời gian</label>
                                         <input type="text" class="form-control datetimepicker-input" id="datetimepicker" data-toggle="datetimepicker" data-target="#datetimepicker"/>
                                     </div>
                                 </div>--}}

                                <!--thêm-->
                                    <div class="col-md-4">
                                        <div class="form-group" style="margin-top: 25px;">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-primary">Đăng ký</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{csrf_field()}}
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách KLTN đã đăng ký</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="registrationGraduation" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Đề tài</th>
                                    <th>Sinh viên thực hiện</th>
                                    <th>Giáo viên hướng dẫn</th>
                                    <th>Ngành</th>
                                    <th>Trạng thái</th>
                                    <th style=" width: 140px">Tác vụ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($graduationList as $value)
                                    @if($value->status == 1)
                                        <tr>
                                        <td>{{!empty($value->subject->name) ? $value->subject->name : ''}}</td>
                                        <td>{{!empty($value->userStudent->name) ? $value->userStudent->name : ''}}</td>
                                        <td>{{!empty($value->userTeacher->name) ? $value->userTeacher->name : ''}}</td>
                                        <td>{{!empty($value->department->name) ? $value->department->name : ''}}</td>
                                        <td><a href="{{route('backend.graduation.comfirm',$value->id)}}" class="btn btn-xs btn-default">Đã đăng ký</a></td>
                                        <td>
                                            <a href="{{route('backend.graduation.registration',$value->id)}}" class="btn btn-xs btn-warning">
                                                <span>
                                                  <i class="fa fa-edit"></i> Sửa
                                                </span>
                                            </a>
                                            <a data-id="{{$value->id}}"  data-toggle="modal" data-target="#delete" class="btn btn-xs btn-danger">
                                                <span>
                                                  <i class="fa fa-trash"></i> Xóa
                                                </span>
                                            </a>
                                            <a href="{{route('backend.graduation.show',$value->id)}}" data-toggle="modal" data-target="#detail" class="btn btn-xs btn btn-info">
                                                <i class="fas fa-info"></i>
                                                <span >Chi tiết</span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>

            <!----------------------------------------------------------------------------->
            <!--Phần hội đồng-->
            <div class="modal fade" id="assembly">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Hội Đồng A</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td>Chức vụ</td>
                                    <td>Họ và tên</td>
                                    <td>Điểm</td>
                                    <td>Trọng số</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Chủ tịch</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>10</td>
                                    <td>50%</td>
                                </tr>
                                <tr>
                                    <td>Thư ký</td>
                                    <td>Nguyễn Văn D</td>
                                    <td>10</td>
                                    <td>20%</td>
                                </tr>
                                <tr>
                                    <td>Ủy Viên</td>
                                    <td>Nguyễn Văn B</td>
                                    <td>9</td>
                                    <td>20%</td>
                                </tr>
                                <tr>
                                    <td>Phản biện</td>
                                    <td>Nguyễn Văn C</td>
                                    <td>9</td>
                                    <td>10%</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Phần Chi tiết-->
            <div class="modal fade modal-ajax" id="detail">
                <div class="modal-dialog">
                    <div class="modal-content">

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Xóa-->
            <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-center" id="myModalLabel">Xác nhận xóa</h4>
                        </div>
                        <form method="POST" action="{{route('backend.graduation.destroy','id')}}">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}
                            <div class="modal-body">
                                <p>Bạn có chắc chắn muốn xóa không?</p>
                                <input type="hidden" name="name" id="graduation_id" value="" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Không</button>
                                <button type="submit" class="btn btn-outline">Có</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection()
@push('after-script')
    <script type="text/javascript">
        // data table
        $(function () {
            $('#example1').DataTable();
            $('#registrationGraduation').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        });
        // select 2
        $(function () {
            $('.select2').select2()
        });
        // date and time
        $(function () {
            $('#datetimepicker').datetimepicker();
        });

        // láy ra id để xóa
        $('#delete').on('show.bs.modal',function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id') ;// id này tương đương với id get ở trên xuống data-id=
            var modal =$(this);
            modal.find('#graduation_id').val(id)
        });

        //lọc ngành theo khoa
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
        //lọc đề tài qua giáo viên
        function subjectFunction() {
            var teacher = $('#teacher').val();
            var department = $('#department').val();
            $.ajax({
                url:"{{route('backend.subject.ajax')}}",
                dataType: 'json',
                type: 'GET',
                data: {teacher:teacher,
                        department:department},
                success:function (data) {
                    if (data.success){
                        $('#subject').select2().empty();
                        $('#subject').select2({
                            data: data.data,
                        });
                    }
                    else {
                        $('#subject').select2().empty();
                    }
                }
            });
        }
    </script>
@endpush
