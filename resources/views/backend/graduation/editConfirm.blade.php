@extends('backend.master')
@section('title')
    <title>Cập nhật khóa luận</title>
@endsection()
@section('content')

    <div class="content-wrapper" style="min-height: 1125.8px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sửa KLTN đã xác nhận bảo vệ
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li><a href="{{route('backend.graduation.index')}}">KLTN</a></li>
                <li class="active">Sửa KLTN đã xác nhận bảo vệ</li>
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
                                <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{route('backend.graduation.confirm.post',$graduation->id)}}">
                                {{csrf_field()}}
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
                                                <input type="file" class="upload" name="report" value="{{$graduation->report}}"/>
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

    </script>
@endpush
