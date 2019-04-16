@extends('backend.master')
@section('content')

    <div class="content-wrapper" style="min-height: 1125.8px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 4)
                <h1>
                    Chi tiết tài khoản
                </h1>
            @endif
            @if(Auth::user()->role_id == 3)
                <h1>
                    Thông tin
                </h1>
            @endif
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                    <li><a href="{{route('backend.account.index')}}">tài khoản</a></li>
                @endif
                <li class="active">chi tiết</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" style="margin-top: 20px;">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            @if(!empty($user->image))
                                <img class="profile-user-img img-responsive img-circle"
                                     style="object-fit: cover; object-position: center; width: 150px;height: 150px; "
                                     src="{{url('avatars/'.$user->image)}}" alt="{{$user->image}}">
                            @else
                                <img class="profile-user-img img-responsive img-circle"
                                     style="object-fit: cover; object-position: center; width: 150px;height: 150px; "
                                     src="{{url('images/errorImage.png')}}">
                            @endif
                            <h3 class="profile-username text-center">{{$user->name}}</h3>
                            <p class="text-muted text-center">{{!empty($user->role) ? $user->role->name : ""}}</p>
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
                        @include('error.messages')
                        <div class="tab-content">
                            <div class="tab-pane active" id="activity">
                                @if( Auth::user()->role_id == 1 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-responsive">
                                                    <tbody>
                                                    <tr>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Mã thành viên</span>
                                                        </td>
                                                        <td style="width: 35%">{{!empty($user->code) ? $user->code : ''}}
                                                        </td>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Khóa</span>
                                                        </td>
                                                        <td style="width: 35%"> {{!empty($user->course) ? $user->course : ''}} </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Ngày sinh</span>
                                                        </td>
                                                        <td style="width: 35%">{{!empty($user->birthday) ? date('d/m/Y',$user->birthday) : ''}}</td>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Giới tính</span>
                                                        </td>
                                                        <td style="width: 35%">
                                                            @if($user->gender == '2')
                                                                {{'Nam'}}
                                                            @elseif($user->gender == '1')
                                                                {{'Nữ'}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Email</span>
                                                        </td>
                                                        <td style="width: 35%">{{!empty($user->email) ? $user->email : ''}}</td>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Liên lạc</span>
                                                        </td>
                                                        <td style="width: 35%">{{!empty($user->phone) ? $user->phone : ''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Khoa</span>
                                                        </td>
                                                        <td style="width: 35%">{{!empty($user->faculty->name) ? $user->faculty->name :'' }}</td>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Ngành</span>
                                                        </td>
                                                        <td style="width: 35%">{{!empty($user->department->name) ? $user->department->name : ''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Nhóm</span>
                                                        </td>
                                                        <td style="width: 35%">
                                                            @if($user->group == 0)
                                                            @elseif($user->group == 0)
                                                                {{" "}}
                                                            @elseif($user->group == 1)
                                                                {{"Nhóm 1"}}
                                                            @elseif($user->group == 2)
                                                                {{"Nhóm 2"}}
                                                            @elseif($user->group == 3)
                                                                {{"Nhóm 3"}}
                                                            @endif
                                                        </td>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Lớp</span>
                                                        </td>
                                                        <td style="width: 35%">{{!empty($user->class) ? $user->class : ''}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            <!--giáo viên-->
                                @if( Auth::user()->role_id == 2)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-responsive">
                                                    <tbody>
                                                    <tr>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Mã thành viên</span>
                                                        </td>
                                                        <td style="width: 35%">{{!empty($user->code) ? $user->code : ''}}
                                                            <a href="{{route('backend.account.password',$user->id)}}" class="btn btn-xs btn-default" style="margin-top: 5px;">Đổi mật khẩu</a>
                                                        </td>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Khóa</span>
                                                        </td>
                                                        <td style="width: 35%"> {{!empty($user->course) ? $user->course : ''}} </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Ngày sinh</span>
                                                        </td>
                                                        <td style="width: 35%">{{!empty($user->birthday) ? date('d/m/Y',$user->birthday) : ''}}</td>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Giới tính</span>
                                                        </td>
                                                        <td style="width: 35%">
                                                            @if($user->gender == '2')
                                                                {{'Nam'}}
                                                            @elseif($user->gender == '1')
                                                                {{'Nữ'}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Email</span>
                                                        </td>
                                                        <td style="width: 35%">{{!empty($user->email) ? $user->email : ''}}</td>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Liên lạc</span>
                                                        </td>
                                                        <td style="width: 35%">{{!empty($user->phone) ? $user->phone : ''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Khoa</span>
                                                        </td>
                                                        <td style="width: 35%">{{!empty($user->faculty->name) ? $user->faculty->name :'' }}</td>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Ngành</span>
                                                        </td>
                                                        <td style="width: 35%">{{!empty($user->department->name) ? $user->department->name : ''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Nhóm</span>
                                                        </td>
                                                        <td style="width: 35%">
                                                            @if($user->group == 0)
                                                            @elseif($user->group == 0)
                                                                {{" "}}
                                                            @elseif($user->group == 1)
                                                                {{"Nhóm 1"}}
                                                            @elseif($user->group == 2)
                                                                {{"Nhóm 2"}}
                                                            @elseif($user->group == 3)
                                                                {{"Nhóm 3"}}
                                                            @endif
                                                        </td>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Lớp</span>
                                                        </td>
                                                        <td style="width: 35%">{{!empty($user->class) ? $user->class : ''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 15%">
                                                            <span class="text-bold">Trạng thái</span>
                                                        </td>
                                                        <td style="width: 35%">
                                                            @if($user->status == 0)
                                                                {{""}}
                                                            @elseif($user->status == 1)
                                                                {{"Đã đăng ký khóa luận"}}
                                                            @elseif($user->status == 2)
                                                                {{"Đã xác nhận bảo vệ"}}
                                                            @elseif($user->status == 3)
                                                                {{"Hoàn thành"}}
                                                            @elseif($user->status == 4)
                                                                {{"Không hoàn thành"}}
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
