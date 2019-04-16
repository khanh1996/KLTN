@extends('backend.master')
@section('title')
    <title>Đổi mật khẩu</title>
@endsection()
@section('content')
    <div class="content-wrapper" style="min-height: 1125.8px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sửa tài khoản
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li><a href="{{route('backend.account.index')}}">tài khoản</a></li>
                <li class="active">Đổi mật khẩu</li>
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
                                <form class="form-horizontal" action="{{route('backend.account.password.post',$user->id)}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-2 control-label">Mật khẩu mới</label>
                                        <div class="col-sm-10">
                                            <input type="password"  class="form-control" id="inputPassword" name="password" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-2 control-label">Xác nhận mật khẩu</label>
                                        <div class="col-sm-10">
                                            <input type="password"  class="form-control" id="inputPassword" name="verifyPassword" value="">
                                        </div>
                                    </div>
                                    <!--sửa-->
                                    <div class="form-group">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <div class="form-control" style="border: none">
                                                <button type="submit" class="btn btn-primary w-100">Đổi</button>
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
