@extends('backend.master')
@section('title')
    <title>Danh sách tài khoản</title>
@endsection()
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 4)
      <h1>
        Quản lý tài khoản
      </h1>
      @endif
      @if(Auth::user()->role_id == 3)
          <h1>
              {{Auth::user()->faculty->name}}
          </h1>
      @endif
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 4)
            <li class="active"><a href="#">tài khoản</a></li>
        @endif
        @if(Auth::user()->role_id == 3)
        <li class="active"><a href="#">GV hướng dẫn</a></li>
        @endif
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 4 OR Auth::user()->role_id == 2)
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tìm kiếm tài khoản</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                  <form  method="GET" enctype="multipart/form-data"  action="{{route('backend.account.index')}}">
                    {{csrf_field()}}
                    <!-- Mã -->
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Tên</label>
                        <select class="form-control select2" style="width: 100%;" name="code">
                          <option value="">--Họ&Tên--</option>
                          @foreach($user as $value)
                            <option value="{{$value->code}}" {{Request::get('code') == $value->code ? 'selected' : '' }} >{{$value->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!-- Khoa -->
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Khoa</label>
                        <select class="form-control select2" style="width: 100%;"  id="faculty" name="faculty" onchange="facultyFunction()">
                          <option value="">--Khoa--</option>
                            @foreach($departmentList as $value)
                                @if($value->parent == null)
                                    <option value="{{$value->id}}" {{Request::get('faculty') == $value->id ? 'selected' : ''}} >{{$value->name}}</option>
                                @endif
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <!-- Ngành -->
                    <div class="col-md-3">
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
                    <!--Loại-->
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Loại</label>
                        <select class="form-control" style="width: 100%;" name="role">
                          <option value="">--Loại--</option>
                            @foreach($roleList as $value)
                            <option value="{{$value->id}}" {{Request::get('role') == $value->id ? 'selected' : '' }} >{{$value->name}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <!--Làm mưới-->
                    <div class="col-md-6">
                        <div class="form-group" style="margin-top: 24px;">
                            <div class="input-group">
                                <a href="{{route('backend.account.index')}}" class="btn btn-default">Làm mói</a>
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
                  </form>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          @endif
          <!-- /.box -->
          <div class="box box-primary">
            <div class="box-header">
              @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 4)
              <h3 class="box-title">Danh sách tài khoản</h3>
              @endif
              @if(Auth::user()->role_id == 3)
                  <h3 class="box-title">Danh sách Giáo viên hướng dẫn</h3>
              @endif
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
                      @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 4)
                      <th>Mã</th>
                      @endif
                      <th>Họ & Tên</th>
                      <th>Khoa</th>
                      <th>Ngành</th>
                      <th>Liên lạc</th>
                      <th>Loại</th>
                      <th>Tác vụ</th>
                  </tr>
                </thead>
                <tbody>
                @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 4)
                @foreach($userList as $value)
                  <tr>
                    <td>{{$value->code}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{!empty($value->faculty) ? $value->faculty->name : ""}}</td>
                    <td>{{!empty($value->department) ? $value->department->name : ""}}</td>
                    <td>{{!empty($value->phone) ? $value->phone : ""}}</td>
                    <td>{{!empty($value->role) ? $value->role->name : ""}}</td>
                    <td>
                      <a href="{{route('backend.account.edit',$value->id)}}" class="btn btn-xs btn-warning">
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
                      </a>
                      <a href="{{route('backend.account.show',$value->id)}}" class="btn btn-xs btn btn-info">
                        <i class="fas fa-info"></i>
                        <span>Chi tiết</span>
                      </a>
                    </td>
                  </tr>
                @endforeach
                @endif
                {{--@if( Auth::user()->role_id == 3)
                    @foreach($userDepartmentList as $value)
                        <tr>
                            <td>{{$value->nameTeacher}}</td>
                            <td>{{!empty($value->faculty) ? $value->faculty->name : ""}}</td>
                            <td>{{!empty($value->department) ? $value->department->name : ""}}</td>
                            <td>{{!empty($value->phone) ? $value->phone : ""}}</td>
                            <td>{{!empty($value->email) ? $value->email : ""}}</td>
                            <td>
                                </a>
                                <a href="{{route('backend.account.student.detail',$value->user_id)}}" class="btn btn-xs btn btn-info">
                                    <i class="fas fa-info"></i>
                                    <span>Chi tiết</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif--}}
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
        <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Xác nhận xóa</h4>
                    </div>
                    <form method="POST" action="{{route('backend.account.destroy','id')}}">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <div class="modal-body">
                            <p>Bạn có chắc chắn muốn xóa không?</p>
                            <input type="hidden" name="id" id="account_id" value="" >
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Không</button>
                            <button type="submit" class="btn btn-outline">Có</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
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
      });
      // láy ra id để xóa
      $('#delete').on('show.bs.modal',function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('id') ;// id này tương đương với id get ở trên xuống data-id=
          var modal =$(this);
          modal.find('#account_id').val(id);
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
