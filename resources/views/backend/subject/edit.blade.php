@extends('backend.master')
@section('title')
    <title>Cập nhật đề tài</title>
@endsection()
@section('content')

    <div class="content-wrapper" style="min-height: 1125.8px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sửa đề tài
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="{{route('backend.subject.index')}}">Đề tài</a></li>
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
                                <form class="form-horizontal" action="{{route('backend.subject.update',$subject)}}" method="post" >
                                    {{ method_field('PUT') }}
                                    {{csrf_field()}}
                                    <!--tên đề tài-->
                                    <div class="form-group">
                                        <label for="inputSubject" class="col-sm-2 control-label"> Tên đề tài <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" id="inputSubject" value="{{$subject->name}}">
                                        </div>
                                    </div>
                                    <!--Đánh giá-->
                                    <div class="form-group">
                                        <label for="inputGender" class="col-sm-2 control-label" >Đánh giá</label>
                                        <div class="col-sm-10" style="margin-top: 6px">
                                            <select class="form-control" style="width: 100%;" name="evaluate">
                                                <option value="1" @if ($subject->evaluate == 1) selected @endif >Dễ</option>
                                                <option value="2" @if ($subject->evaluate == 2) selected @endif >Trung bình</option>
                                                <option value="3" @if ($subject->evaluate == 3) selected @endif>Khó</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--Khoa-->
                                    <div class="form-group">
                                        <label for="inputDepartment" class="col-sm-2 control-label">Khoa <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" style="width: 100%;" name="faculty" id="faculty" onchange="facultyFunction()" >
                                                <option value="">--Khoa--</option>
                                                @foreach($departmentList as $value)
                                                    @if($value->parent == null)
                                                        <option value="{{$value->id}}"
                                                            @if($subject->faculty_id == $value->id) selected @endif>
                                                            {{$value->name}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--Ngành-->
                                    <div class="form-group">
                                        <label for="inputDepartment" class="col-sm-2 control-label">Ngành <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" style="width: 100%;" name="department" id="department" onchange="teacherFunction()">
                                                @foreach($arrayDepartment as $key => $value)
                                                    <option value="{{$key}}" @if($subject->department_id == $key) selected @endif>{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--giáo viên-->
                                    <div class="form-group">
                                        <label for="inputDepartment" class="col-sm-2 control-label">Giáo viên hướng dẫn <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" style="width: 100%;" name="teacher" id="teacher">
                                                @foreach($teacherList as $value)
                                                    <option value="{{$value->id}}" @if($subject->user_id == $value->id) selected @endif>{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--mô tả-->
                                    <div class="form-group">
                                        <label for="inputDescription" class="col-sm-2 control-label">Mô tả</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control textarea" rows="10" name="description" id="description" placeholder="Mô tả sơ qua về đề tài..."> {!! !empty($subject->detail) ? $subject->detail : '' !!}</textarea>
                                        </div>
                                    </div>

                                    <!--thêm-->
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
        });
        // lọc ngành khi click khoa
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
    </script>
@endpush()
