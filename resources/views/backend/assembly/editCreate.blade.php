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
                                <form class="form-horizontal" action="{{route('backend.assembly.editCreateAssembly',$assembly->id)}}" method="POST" enctype="multipart/form-data" >
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

    </script>

@endpush
