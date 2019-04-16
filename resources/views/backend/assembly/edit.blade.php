@extends('backend.master')
@section('title')
    <title>Cập nhật hội đồng</title>
@endsection()
@section('content')

    <div class="content-wrapper" style="min-height: 1125.8px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sửa Hội đồng
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li><a href="{{route('backend.assembly.index')}}">Hội đồng</a></li>
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
                                <form class="form-horizontal" action="{{route('backend.assembly.updateAll',$assembly->id)}}" method="POST" enctype="multipart/form-data" >
                                    {{csrf_field()}}
                                    <!--tên hội đồng-->
                                    <div class="form-group">
                                        <label for="inputCode" class="col-sm-2 control-label">Tên hội đồng <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" value="{{$assembly->name}}" name="name" placeholder="Hội đồng A" />
                                        </div>
                                    </div>
                                    <!--Khoa-->
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Khoa <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="faculty" id="faculty" onchange="facultyFunction()"  style="width: 100%;">
                                                <option value="">--Khoa--</option>
                                                    @foreach($departmentList as $value)
                                                        @if($value->parent == null)
                                                            <option value="{{$value->id}}" @if($value->id == $assembly->faculty_id) selected @endif >{{$value->name}}</option>
                                                        @endif()
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--Ngành-->
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Ngành <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="department" id="department" onchange="userFunction()" style="width: 100%;">
                                                <option value="">--Ngành--</option>
                                                @foreach($arrayDepartment as $key => $value)
                                                    <option value="{{$key}}" @if($key == $assembly->department_id) selected @endif >{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--Năm-->
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Năm <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="year" style="width: 100%;">
                                                <option value="">--Năm--</option>
                                                @foreach($yearList as $value)
                                                    <option value="{{$value->id}}" @if($value->id == $assembly->year_id) selected @endif >{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Chủ tịch-->
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Chủ tịch <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-5">
                                            <select class="form-control select2 users_department"  name="president" style="width: 100%;">
                                                <option value="">--Chọn giáo viên--</option>
                                                @foreach($usersList as $value)
                                                    <option value="{{$value->id}}" {{(!empty($userSeclected['president']) && $userSeclected['president'] == $value->id) ? 'selected' : ''}} >{{$value->nameTeacher}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="number" min="0" max="100" class="form-control same-select2" name="presidentPoint" value="{{!empty($userSeclected['presidentPoint']) ? $userSeclected['presidentPoint'] : 0 }}"  placeholder="10%" required="">
                                        </div>
                                    </div>
                                    <!-- Thư ký -->
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Thư ký <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-5">
                                            <select class="form-control select2 users_department"  name="secretary" style="width: 100%;">
                                                <option value="">--Chọn giáo viên--</option>
                                                @foreach($usersList as $value)
                                                    <option value="{{$value->id}}" {{(!empty($userSeclected['secretary']) && $userSeclected['secretary'] == $value->id) ? 'selected' : ''}} >{{$value->nameTeacher}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="number" min="0" max="100" class="form-control same-select2" name="secretaryPoint" value="{{!empty($userSeclected['secretaryPoint']) ? $userSeclected['secretaryPoint'] : 0 }}"  placeholder="40%" required="">
                                        </div>
                                    </div>
                                    <!-- ủy viên -->
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Ủy viên <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-5">
                                            <select class="form-control select2 users_department"  name="commissary" style="width: 100%;">
                                                <option value="">--Chọn giáo viên--</option>
                                                @foreach($usersList as $value)
                                                    <option value="{{$value->id}}" {{(!empty($userSeclected['commissary']) && $userSeclected['commissary'] == $value->id) ? 'selected' : ''}} >{{$value->nameTeacher}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="number" min="0" max="100" class="form-control same-select2" name="commissaryPoint" value="{{!empty($userSeclected['commissaryPoint']) ? $userSeclected['commissaryPoint'] : 0 }}"  placeholder="20%" required="">
                                        </div>
                                    </div>
                                    <!-- Phản biện-->
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Phản biện <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-5">
                                            <select class="form-control select2 users_department"  name="reviewer" style="width: 100%;">
                                                <option value="">--Chọn giáo viên--</option>
                                                @foreach($usersList as $value)
                                                    <option value="{{$value->id}}" {{(!empty($userSeclected['reviewer']) && $userSeclected['reviewer'] == $value->id) ? 'selected' : ''}} >{{$value->nameTeacher}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="number" min="0" max="100" class="form-control same-select2" name="reviewerPoint" value="{{!empty($userSeclected['reviewerPoint']) ? $userSeclected['reviewerPoint'] : 0 }}"  placeholder="30%" required="">
                                        </div>
                                    </div>
                                    <!-- sửa -->
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
        //lọc user qua ngành
        function userFunction() {
            // lấy ra giáo viên thuộc khoa chọn
            var department = $('#department').val();
            $.ajax({
                url:"{{route('backend.user.ajax')}}",
                dataType: 'json',
                type: 'GET',
                data: {department:department},
                success:function (data) {
                    if (data.success){
                        $('.users_department').select2().empty();
                        $('.users_department').select2({
                            data: data.data,
                        });
                    }
                }
            });
        }

    </script>

@endpush
