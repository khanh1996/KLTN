@extends('backend.master')
@section('title')
    <title>Home</title>
@endsection()
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>Xin chào <span style="text-decoration: underline">{{Auth::user()->name}}</span> đến với <i class="icon ion-heart"></i> của phần mềm Quản lý KLTN</h4>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            </ol>
        </section>
        @include('error.messages')
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 2 OR Auth::user()->role_id == 4)
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <a href="{{route('backend.assembly.index')}}">
                            <span class="info-box-icon bg-aqua"><i class="icon ion-ios-people"></i></span>
                        </a>

                        <div class="info-box-content">
                            <span class="info-box-text">Số lượng hội đồng</span>
                            <span class="info-box-number">{{!empty($assemblysCount) ? $assemblysCount : '0'}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <a href="{{route('backend.graduation.index')}}">
                            <span class="info-box-icon bg-green"><i class="icon ion-android-happy"></i></span>
                        </a>

                        <div class="info-box-content">
                            <span class="info-box-text">Số lượng KLTN đạt</span>
                            <span class="info-box-number">{{!empty($finishGraduation) ? $finishGraduation : '0'}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <a href="{{route('backend.account.index')}}">
                            <span class="info-box-icon bg-yellow"><i class="ion ion-android-person"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">Số lượng tài khoản</span>
                            <span class="info-box-number">{{!empty($accountCount) ? $accountCount : '0'}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <a href="{{route('backend.graduation.index')}}">
                            <span class="info-box-icon bg-red"><i class="fa ion-android-sad"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">Số lượng KLTN trượt</span>
                            <span class="info-box-number">{{!empty($failGraduation) ? $failGraduation : '0'}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            @endif
            <div class="row">
                <div class="col-md-12 font-design">
                    <div class="foo">
                        <span class="letter" data-letter="W">W</span>
                        <span class="letter" data-letter="E">E</span>
                        <span class="letter" data-letter="L">L</span>
                        <span class="letter" data-letter="C">C</span>
                        <span class="letter" data-letter="O">O</span>
                        <span class="letter" data-letter="M">M</span>
                        <span class="letter" data-letter="E">E</span>
                        <br>
                        <span class="letter" data-letter="T">T</span>
                        <span class="letter" data-letter="L">L</span>
                        <span class="letter" data-letter="U">U</span>

                    </div>
                </div>
                {{--<div class="col-md-12">

                </div>--}}
            </div>
            <!--phần lịch-->
            {{--<div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body no-padding">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>--}}
            <div class="row" style="margin-top: 15px">
                <div class="col-md-12">
                    <a class="weatherwidget-io" href="https://forecast7.com/en/21d03105d83/hanoi/" data-label_1="HÀ NỘI" data-label_2="WEATHER" data-theme="weather_one" >HÀ NỘI WEATHER</a>
                </div>
            </div>
            <div class="row" style="margin-top: 15px">
                <div class="col-md-6">
                    <div class="box" style="height: 400px">
                        <div class="box-header with-border">
                            <h3 class="box-title">Lịch bảo vệ</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Sinh viên</th>
                                    <th>Thời gian bảo vệ</th>
                                    <th style="width: 150px">Ngành</th>
                                </tr>
                                <tr>
                                @if(!empty($calendarList))
                                @foreach($calendarList as $value)
                                <tr>
                                    <th>{{$value->userStudent->name}}</th>
                                    <th>{{Carbon\Carbon::parse($value->time)->format('d/m/Y h:i A')}}</th>
                                    <th style="width: 40px">{{$value->department->name}}</th>
                                </tr>
                                 @endforeach
                                @endif
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                {{$calendarList->links()}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mapouter"><div class="gmap_canvas"><iframe width="615" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=th%C4%83ng%20long%20university&t=k&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.pureblack.de">pureblack.de</a></div><style>.mapouter{text-align:right;height:400px;width:615px;}.gmap_canvas {overflow:hidden;background:none!important;height:400px;width:615px;}</style></div>
                </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <!-- /.row (main row) -->
        </section>
        <!-- /.content -->
    </div>
@endsection()
@push('after-script')
    <script type="text/javascript">
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');

    </script>
@endpush()

