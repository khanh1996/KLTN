@extends('backend.master')
@section('title')
    <title>Danh sách báo cáo</title>
@endsection()
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Quản lý Báo cáo
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li class="active"><a href="#">báo cáo</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Lọc danh sách</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form method="GET" enctype="multipart/form-data" action="{{route('backend.statistical.report')}}" >
                                {{csrf_field()}}
                                <div class="row">
                                    <!-- Năm -->
                                    {{--<div class="col-md-4">
                                        <div class="form-group">
                                            <label>Năm</label>
                                            <select class="form-control select2" name="year" style="width: 100%;">
                                                <option value="">--Năm--</option>
                                                @foreach($yearList as $value)
                                                    <option value="{{$value->id}}" {{ Request::get('year') == $value->id ? 'selected': ''}} > {{!empty($value->name) ? $value->name : '' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>--}}
                                    <!--Kỳ-->
                                    {{--<div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kỳ</label>
                                            <select class="form-control same-select2" name="semester" style="width: 100%;">
                                                <option value="">--Kỳ--</option>
                                                <option value="1" {{Request::get('semester') == 1 ? 'selected' : ''}} >Kỳ 1</option>
                                                <option value="2" {{Request::get('semester') == 2 ? 'selected' : ''}} >Kỳ 2</option>
                                                <option value="3" {{Request::get('semester') == 3 ? 'selected' : ''}} >Kỳ 3</option>
                                            </select>
                                        </div>
                                    </div>--}}
                                    <!-- Khoa -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Khoa</label>
                                            <select class="form-control select2" id="faculty" onchange="facultyFunction()" name="faculty" style="width: 100%;">
                                                <option value="">--Khoa--</option>
                                                @foreach($departmentList as $value)
                                                    @if($value->parent == null)
                                                        <option value="{{$value->id}}" {{ Request::get('faculty') == $value->id ? 'selected': ''}} > {{!empty($value->name) ? $value->name : '' }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Ngành -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ngành</label>
                                            <select class="form-control select2" id="department" name="department" style="width: 100%;">
                                                <option value="">--Ngành--</option>
                                                @foreach($departmentList as $value)
                                                    @if($value->parent != null && Request::get('faculty') == $value->parent)
                                                        <option value="{{$value->id}}" {{Request::get('department') == $value->id ? 'selected' : ''}} >{{$value->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- tình trạng -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select class="form-control select2" name="status" style="width: 100%;">
                                            <option value="">--Trạng thái--</option>
                                                <option value="1" {{Request::get('status') == 1 ? 'selected' : ''}} >Đăng ký</option>
                                                <option value="2" {{Request::get('status') == 2 ? 'selected' : ''}} >Xác nhận</option>
                                                <option value="3" {{Request::get('status') == 3 ? 'selected' : ''}} >Hoàn thành</option>
                                                <option value="4" {{Request::get('status') == 4 ? 'selected' : ''}} >Chưa Hoàn thành</option>
                                        </select>
                                    </div>
                                </div>
                                <!--Kỳ-->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kỳ</label>
                                        <select class="form-control same-select2" name="semester" style="width: 100%;">
                                            <option value="">--Kỳ--</option>
                                            <option value="1" {{Request::get('semester') == 1 ? 'selected' : ''}} >Kỳ 1</option>
                                            <option value="2" {{Request::get('semester') == 2 ? 'selected' : ''}} >Kỳ 2</option>
                                            <option value="3" {{Request::get('semester') == 3 ? 'selected' : ''}} >Kỳ 3</option>
                                        </select>
                                    </div>
                                </div>
                                <!--Năm-->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Năm</label>
                                        <select class="form-control select2" name="year" style="width: 100%;">
                                            <option value="">--Năm--</option>
                                            @foreach($yearList as $value)
                                                <option value="{{$value->id}}" {{ Request::get('year') == $value->id ? 'selected': ''}} > {{!empty($value->name) ? $value->name : '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                    <!--Time-->
                                {{--<div class="col-md-4">
                                    <div class="form-group">
                                        <label>Thời gian</label>
                                        <input class="form-control" type="text" name="daterange" value="05/01/2018 - 15/2/2018" />
                                    </div>
                                </div>--}}
                                <!--Hội đồng-->
                                    <!--Làm mới-->
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-top: 24px;">
                                            <div class="input-group">
                                                <a href="{{route('backend.statistical.report')}}" class="btn btn-default">Làm mói</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Tìm kiếm-->
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-top: 24px; float: right">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <!--toàn bộ trạng thái-->
                    @if($status == 3 OR $status == 4 OR $status == 0)
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Danh sách</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            @include('error.messages')
                            <div class="box-body">
                                <table id="reportTable" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>MSV</th>
                                        <th>Sinh viên</th>
                                        <th>Lớp</th>
                                        <th>Giáo viên</th>
                                        <th>Chủ tịch</th>
                                        <th>Ủy viên</th>
                                        <th>Thư ký</th>
                                        <th>Phản biện</th>
                                        <th>Phòng</th>
                                        <th>Thời gian</th>
                                        <th>Điểm</th>
                                        {{--<th style="width: 65px">Hội đồng</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($report as $item)
                                        <tr>
                                            <td>{{!empty($item['code']) ? $item['code']: '' }}</td>
                                            <td>{{!empty($item['student']) ? $item['student']: '' }}</td>
                                            <td>{{!empty($item['class']) ? $item['class']: '' }}</td>
                                            <td>{{!empty($item['teacher']) ? $item['teacher']: '' }}</td>
                                            <td>{{!empty($item['president']) ? $item['president']: '' }}</td>
                                            <td>{{!empty($item['secretary']) ? $item['secretary']: '' }}</td>
                                            <td>{{!empty($item['commissary']) ? $item['commissary']: '' }}</td>
                                            <td>{{!empty($item['reviewer']) ? $item['reviewer']: '' }}</td>
                                            <td>{{!empty($item['room']) ? $item['room']: '' }}</td>
                                            <td>{{!empty($item['time']) ? $item['time']: '' }}</td>
                                            <td>{{!empty($item['point']) ? $item['point']: '' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    @endif
                    <!--trạng thái đăng ký-->
                    @if($status == 1)
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Danh sách</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            @include('error.messages')
                            <div class="box-body">
                                <table id="reportTableRegistration" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>MSV</th>
                                        <th>Sinh viên</th>
                                        <th>Lớp</th>
                                        <th>Giáo viên</th>
                                        <th>Khoa</th>
                                        <th>Ngành</th>
                                        {{--<th style="width: 65px">Hội đồng</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($report as $item)
                                        <tr>
                                            <td>{{!empty($item['code']) ? $item['code']: '' }}</td>
                                            <td>{{!empty($item['student']) ? $item['student']: '' }}</td>
                                            <td>{{!empty($item['class']) ? $item['class']: '' }}</td>
                                            <td>{{!empty($item['teacher']) ? $item['teacher']: '' }}</td>
                                            <td>{{!empty($item['faculty']) ? $item['faculty']: '' }}</td>
                                            <td>{{!empty($item['department']) ? $item['department']: '' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    @endif
                    <!--trạng thái xác nhận bảo vệ-->
                    @if($status == 2)
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Danh sách</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            @include('error.messages')
                            <div class="box-body">
                                <table id="reportTableConfirm" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>MSV</th>
                                        <th>Sinh viên</th>
                                        <th>Lớp</th>
                                        <th>Giáo viên</th>
                                        <th>Chủ tịch</th>
                                        <th>Ủy viên</th>
                                        <th>Thư ký</th>
                                        <th>Phản biện</th>
                                        <th>Phòng</th>
                                        <th>Thời gian</th>
                                        {{--<th style="width: 65px">Hội đồng</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($report as $item)
                                        <tr>
                                            <td>{{!empty($item['code']) ? $item['code']: '' }}</td>
                                            <td>{{!empty($item['student']) ? $item['student']: '' }}</td>
                                            <td>{{!empty($item['class']) ? $item['class']: '' }}</td>
                                            <td>{{!empty($item['teacher']) ? $item['teacher']: '' }}</td>
                                            <td>{{!empty($item['president']) ? $item['president']: '' }}</td>
                                            <td>{{!empty($item['secretary']) ? $item['secretary']: '' }}</td>
                                            <td>{{!empty($item['commissary']) ? $item['commissary']: '' }}</td>
                                            <td>{{!empty($item['reviewer']) ? $item['reviewer']: '' }}</td>
                                            <td>{{!empty($item['room']) ? $item['room']: '' }}</td>
                                            <td>{{!empty($item['time']) ? $item['time']: '' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                @endif
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>

        <!--Phần hội đồng-->
        <div class="modal fade modal-ajax" id="assembly">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection()
@push('after-script')
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#reportTable').DataTable( {
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                     'excel'
                ]
            } );
            $('#reportTableRegistration').DataTable( {
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ]
            } );
            $('#reportTableConfirm').DataTable( {
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ]
            } );

        } );
        // data table
        // $(function () {
        //     $('#reportTable').DataTable({
        //         buttons: {
        //             buttons: [ 'copy', 'csv', 'excel' ]
        //         }
        //     })
        // });
        // select 2
        $(function () {
            $('.select2').select2()
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
    </script>
@endpush
