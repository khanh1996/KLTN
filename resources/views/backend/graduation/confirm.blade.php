@extends('backend.master')
@section('title')
    <title>Xác nhận bảo vệ</title>
@endsection()
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Xác nhận bảo vệ KLTN
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="{{route('backend.graduation.create')}}">Đăng ký KLTN</a></li>
                <li class="active"><a href="">Bảo vệ KLTN</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Đề tài: <b>{{$graduation->subject->name}}</b> của sinh viên <b>{{$graduation->userStudent->name}}</b> </h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        @include('error.messages')
                        <div class="box-body" style="">
                            <div class="row">
                                <form type="" enctype="multipart/form-data" method="POST" action="{{route('backend.graduation.comfirm.patch',$graduation)}}">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                                    <!-- hội đồng -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Hội đồng <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                            <select class="form-control select2" name="assembly"  style="width: 100%;">
                                                <option value="" >--Hội Đồng--</option>
                                                    @foreach($assemblyList as $value)
                                                        <option value="{{$value->id}}">{{$value->name}} </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                     <!--Phòng-->
                                     <div class="col-md-4">
                                         <div class="form-group">
                                             <label>Phòng <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                             <input class="form-control" type="text" name="room" placeholder="B605" />
                                         </div>
                                     </div>
                                    <!--thời gian-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Thời gian <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                            <input class="form-control" type="text" name="datetimes"  />
                                        </div>
                                    </div>
                                    <!--thời gian-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>File KLTN <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label><br>
                                            <input type="file" name="report"  />
                                        </div>
                                    </div>
                                    <!--thêm-->
                                        <div class="col-md-6">
                                            <div class="form-group" style="margin-top: 25px">
                                                <div class="input-group">
                                                    <button type="submit" class="btn btn-primary">Xác nhận bảo vệ</button>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách KLTN xác nhận bảo vệ</h3>
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
                                    <th>File báo cáo</th>
                                    <th>Trạng thái</th>
                                    <th>Hội đồng</th>
                                    <th >Tác vụ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($graduationList as $value)
                                    @if(!empty($value->status) && $value->status == 2)
                                        <tr>
                                            <td>{{!empty($value->subject->name) ? $value->subject->name : '' }}</td>
                                            <td>{{!empty($value->userStudent->name) ? $value->userStudent->name : '' }}</td>
                                            <td>{{!empty($value->userTeacher->name) ? $value->userTeacher->name : '' }}</td>
                                            <td>{{!empty($value->department->name) ? $value->department->name : '' }}</td>
                                            <td style="text-align: center;font-size: 25px;"><a href="{{url('reports/'.$value->report)}}"><i class="far fa-file"></i></a></td>
                                            <td><a class="btn btn-xs btn-soundcloud">Đã xác nhận bảo vệ</a></td>
                                            <td>
                                                <a href="{{route('backend.AllAssembly.ajax',$value->assembly_id)}}" data-toggle="modal" data-target="#assembly" class="btn btn-xs btn-primary">
                                                    <span>{{!empty($value->assembly->name) ? $value->assembly->name : '' }}</span>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('backend.point.ajax',$value->id)}}" data-toggle="modal" data-target="#point" class="btn btn-xs btn-bitbucket">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    <span >Nhập điểm</span>
                                                </a>
                                                <a href="{{route('backend.graduation.confirm',$value->id)}}" class="btn btn-xs btn-warning">
                                                    <span>
                                                      <i class="fa fa-edit"></i> Sủa
                                                    </span>
                                                </a>
                                                <a href="{{route('backend.graduation.show.comfirm',$value->id)}}" data-toggle="modal" data-target="#detail" class="btn btn-xs btn btn-info">
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
            <div class="modal fade modal-ajax" id="assembly">
                <div class="modal-dialog">
                    <div class="modal-content">
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
            <!--Phần nhập điểm-->
            <div class="modal fade modal-ajax" id="point">
                <div class="modal-dialog">
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
        // date and time
        $(function() {
            $('input[name="datetimes"]').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD/M/YYYY hh:mm A'
                }
            });
        });
    </script>
@endpush
