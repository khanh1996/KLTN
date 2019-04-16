@extends('backend.master')
@section('title')
    <title>Thiết lập hội đồng</title>
@endsection()
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Quản lý Hội đồng
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li class=""><a href="{{route('backend.assembly.index')}}">Hội đồng</a></li>
                <li class="active"><a href="#">Thiết lập hội đồng</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thiết lập hội đồng : <b>{{$assembly->name}}</b></h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        @include('error.messages')
                        <div class="box-body" style="">
                            <div class="row">
                                <form type="" enctype="multipart/form-data" method="POST" action="{{route('backend.assembly.update',$assembly)}}">
                                    {{ method_field('PATCH') }}
                                    {{ csrf_field() }}
                                    <div class="col-md-12">
                                        <div class="row">
                                            <!--Chủ tịch-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Chủ tịch</label>
                                                    <select class="form-control select2 users_department" name="president" id="president" style="width: 100%;">
                                                        <option value="0">--Chọn giáo viên--</option>
                                                            @foreach($usersList as $value)
                                                                <option value="{{$value->id}}" {{(!empty($userSeclected['president']) && $userSeclected['president'] == $value->id) ? 'selected' : ''}} >{{$value->nameTeacher}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Trọng số</label>
                                                    <input type="number" min="0" max="100" class="form-control" name="presidentPoint" value="{{!empty($userSeclected['presidentPoint']) ? $userSeclected['presidentPoint'] : 25 }}"  placeholder="30%" >
                                                </div>
                                            </div>
                                            <!--Thư ký-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Thư ký</label>
                                                    <select class="form-control select2 users_department" name="secretary" id="secretary" {{--onchange="choseUserFuntion()"--}} style="width: 100%;">
                                                        <option value="">--Chọn giáo viên--</option>
                                                        @foreach($usersList as $value)
                                                            <option value="{{$value->id}}" {{(!empty($userSeclected['secretary']) && $userSeclected['secretary'] == $value->id) ? 'selected' : ''}} >{{$value->nameTeacher}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Trọng số</label>
                                                    <input type="number" min="0" max="100" class="form-control" name="secretaryPoint" value="{{!empty($userSeclected['secretaryPoint']) ? $userSeclected['secretaryPoint'] : 25 }}"  placeholder="30%">
                                                </div>
                                            </div>
                                            <!--Ủy viên-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Ủy viên</label>
                                                    <select class="form-control select2 users_department" name="commissary" id="commissary"  {{--onchange="choseUserFuntion()"--}} style="width: 100%;">
                                                        <option value="">--Chọn giáo viên--</option>
                                                        @foreach($usersList as $value)
                                                            <option value="{{$value->id}}" {{!empty($userSeclected['commissary']) && $userSeclected['commissary'] == $value->id ? 'selected' : ''}} > {{$value->nameTeacher}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Trọng số</label>
                                                    <input type="number" min="0" max="100" class="form-control" name="commissaryPoint" value="{{!empty($userSeclected['commissaryPoint']) ? $userSeclected['commissaryPoint'] : 25 }}"  placeholder="10%">
                                                </div>
                                            </div>
                                            <!--Phản biện-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phản biện</label>
                                                    <select class="form-control select2 users_department" name="reviewer" id="reviewer"  {{--onchange="choseUserFuntion()"--}} style="width: 100%;">
                                                        <option value="">--Chọn giáo viên--</option>
                                                        @foreach($usersList as $value)
                                                            <option value="{{$value->id}}" {{!empty($userSeclected['reviewer']) && $userSeclected['reviewer'] == $value->id ? 'selected' :'' }} >{{$value->nameTeacher}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Trọng số</label>
                                                    <input type="number" min="0" max="100" class="form-control" name="reviewerPoint" value="{{!empty($userSeclected['reviewerPoint']) ? $userSeclected['reviewerPoint'] : 25 }}"  placeholder="10%">
                                                </div>
                                            </div>
                                            <!--Thêm-->
                                            <div class="col-md-12">
                                                <div class="form-group" style="float: right; margin-right: 20px;">
                                                    <div class="input-group">
                                                        <button type="submit" class="btn btn-primary">Thiết lập</button>
                                                    </div>
                                                </div>
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
                            <h3 class="box-title">Danh sách Hội đồng</h3>
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
                                    <th>ID</th>
                                    <th>Tên Hội Đồng</th>
                                    <th>Khoa</th>
                                    <th>Ngành</th>
                                    <th>Năm</th>
                                    <th>Tác vụ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assemblyList as $value)
                                    @if($value->status == 2)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{!empty($value->faculty) ? $value->faculty->name : ""}}</td>
                                        <td>{{!empty($value->department) ? $value->department->name : ""}}</td>
                                        <td>{{!empty($value->year) ? $value->year->name : ""}}</td>
                                        <td>
                                            <a href="{{route('backend.assembly.edit',$value->id)}}" class="btn btn-xs btn-warning">
                                                <span>
                                                  <i class="fa fa-edit"></i> Sửa
                                                </span>
                                            </a>
                                            <a href="{{route('backend.AllAssembly.ajax',$value->id)}}" {{--data-id="{{$value->id}}"--}} data-toggle="modal" data-target="#assembly" class="btn btn-xs btn btn-info ">
                                                <i class="fas fa-info"></i>
                                                <span >Chi tiết</span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach()
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
            <div class="modal modal-header fade modal-ajax" id="assembly" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

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


    </script>
@endpush
