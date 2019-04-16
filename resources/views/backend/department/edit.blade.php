@extends('backend.master')
@section('title')
    <title>Cập nhật khoa-ngành</title>
@endsection()
@section('content')

    <div class="content-wrapper" style="min-height: 1125.8px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sửa Khoa - Ngành
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li><a href="{{route('backend.department.index')}}">Khoa - Ngành</a></li>
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
                                <form role="form" class="form-horizontal" enctype="multipart/form-data" action="{{route('backend.department.update',$department)}}" method="POST">
                                    {{ method_field('PUT') }}
                                    {{csrf_field()}}
                                    <!--Ngành-->
                                    <div class="form-group">
                                        <label for="inputDepartment" class="col-sm-2 control-label">Ngành <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" value="{{$department->name}}"  >
                                        </div>
                                    </div>
                                    <!--Khoa -->
                                    <div class="form-group">
                                        <label for="inputDepartment" class="col-sm-2 control-label">Khoa <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="parent" style="width: 100%;">
                                                <option value="">--Khoa--</option>
                                                @foreach($departmentList as $value)
                                                    @if($value->parent == null)
                                                    <option value="{{$value->id}}" @if($value->id == $department->parent) selected @endif>{{$value->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
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

        // select 2
        $(function () {
            $('.select2').select2()
        })
    </script>
@endpush
