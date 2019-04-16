@extends('backend.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quản lý Sinh viên
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"><a href="#">Sinh viên</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tìm kiếm sinh viên</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form method="GET" enctype="multipart/form-data" action="{{route('backend.account.student')}}">
              {{csrf_field()}}
                <div class="row">
                    <!-- Năm -->
                    <div class="col-md-3">
                        <div class="form-group">
                          <label>Họ & tên</label>
                          <select class="form-control select2" name="name" style="width: 100%;">
                            <option value="" selected >--Họ & Tên--</option>
                            @foreach($userListSearch as $value)
                              <option value="{{$value->id}}" {{Request::get('name') == $value->id ? 'selected' : '' }} >{{$value->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    <!--Khóa-->
                    <div class="col-md-3">
                        <div class="form-group">
                          <label>Khóa</label>
                          <select class="form-control select2" name="course" style="width: 100%;">
                            <option value="" selected >--Khóa--</option>
                            @foreach($courseList as $value)
                              <option value="{{$value->course}}" {{Request::get('course') == $value->course ? 'selected' : '' }} >{{$value->course}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    <!--trạng thái-->
                    <div class="col-md-3">
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

                </div>
                <div class="row">
                  <!--Làm mưới-->
                  <div class="col-md-6">
                    <div class="form-group" style="margin-top: 24px;">
                      <div class="input-group">
                        <a href="{{route('backend.account.student')}}" class="btn btn-default">Làm mói</a>
                      </div>
                    </div>
                  </div>
                  <!--Tìm kiếm-->
                  <div class="col-md-6" style="text-align: -webkit-right" >
                    <div class="form-group" style="margin-top: 24px;">
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
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Danh sách sinh viên</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="listStudent" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Mã</th>
                  <th>Họ & Tên</th>
                  <th>Khóa</th>
                  <th>Lớp</th>
                  <th>Email</th>
                  <th>Liên lạc</th>
                  <th>Tác vụ</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($userList as $value)
                    <tr>
                      <td>{{$value->code}}</td>
                      <td>{{$value->name}}</td>
                      <td>{{!empty($value->course) ? $value->course : ""}}</td>
                      <td>{{!empty($value->class) ? $value->class : ""}}</td>
                      <td>{{!empty($value->email) ? $value->email : ""}}</td>
                      <td>{{!empty($value->phone) ? $value->phone : ""}}</td>
                      <td>
                        {{--<a href="{{route('backend.account.edit',$value->id)}}" class="btn btn-xs btn-warning">
                          <span>
                            <i class="fa fa-edit"></i>
                            Sửa
                          </span>
                        </a>
                        <a data-id="{{$value->id}}" data-toggle="modal" data-target="#delete" class="btn btn-xs btn-danger">
                          <span>
                            <i class="fa fa-trash"></i>
                            Xóa
                          </span>
                        </a>--}}
                        <a href="{{route('backend.account.student.detail',$value->id)}}" class="btn btn-xs btn btn-info">
                          <i class="fas fa-info"></i>
                          <span>Chi tiết</span>
                        </a>
                      </td>
                    </tr>
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
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection()
@push('after-script')
  <script type="text/javascript">
      // data table
      $(function () {
          $('#example1').DataTable();
          $('#listStudent').DataTable({
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
      })
  </script>
@endpush
