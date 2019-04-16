@extends('backend.master')
@section('content')

    <div class="content-wrapper" style="min-height: 1125.8px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Chi tiết tài khoản
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li><a href="#">tài khoản</a></li>
                <li class="active">chi tiết</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{url('assets/backend/dist/img/user4-128x128.jpg')}}" alt="User profile picture">
                            <h3 class="profile-username text-center">Văn Bảo Khánh</h3>
                            <p class="text-muted text-center">Sinh viên</p>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="" style="border-top-color: #3c8dbc;"><a href="#activity" data-toggle="tab" aria-expanded="false">Thông tin</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="activity">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputCode" class="col-sm-2 control-label">Mã thành viên</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputCode" placeholder="A25603">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputPassword" placeholder="Mật Khẩu">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputYear" class="col-sm-2 control-label">Khóa</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" style="width: 100%;">
                                                <option selected="selected">K27</option>
                                                <option>K26</option>
                                                <option>K25</option>
                                                <option>K24</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDepartment" class="col-sm-2 control-label">Khoa</label>

                                        <div class="col-sm-10">
                                            <select class="form-control select2" style="width: 100%;">
                                                <option selected="selected">Toán tin</option>
                                                <option>Ngôn ngữ</option>
                                                <option>Quản trị du lịch và lữ hành</option>
                                                <option>Điều dưỡng khoa học sách sức khỏe</option>
                                                <option>Kinh tế quản lý</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDepartment" class="col-sm-2 control-label">Ngành</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" style="width: 100%;">
                                                <option selected="selected">Khoa học máy tính</option>
                                                <option>Truyền thông mạng máy tính</option>
                                                <option>Du lịch</option>
                                                <option>Kê toàn</option>
                                                <option>Ngôn ngữ Hàn</option>
                                                <option>An toàn mạng</option>
                                                <option>Ngôn ngữ Nhật</option>
                                                <option>Tài chính</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputGender" class="col-sm-2 control-label">Giới tính</label>
                                        <div class="col-sm-10" style="margin-top: 6px">
                                            <input type="radio" name="gender" value="male" checked>Nam
                                            <div class="inline" style="margin-right: 10px"> </div>
                                            <input type="radio" name="gender" value="female"> Nữ<br>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputGender" class="col-sm-2 control-label">Nhóm</label>
                                        <div class="col-sm-10" style="margin-top: 6px">
                                            <select class="form-control select2" style="width: 100%;">
                                                <option selected="selected">Nhóm 1</option>
                                                <option>Nhóm 2</option>
                                                <option>Nhóm 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputGender" class="col-sm-2 control-label">Lớp</label>
                                        <div class="col-sm-10" style="margin-top: 6px">
                                            <select class="form-control select2" style="width: 100%;">
                                                <option selected="selected">TI27g2</option>
                                                <option>TI27g2</option>
                                                <option>TI27g2</option>
                                            </select>
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