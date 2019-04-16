@extends('backend.master')
@section('title')
    <title>Danh sách đề tài</title>
@endsection()
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quản lý đề tài
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
        <li class="active"><a href="#">đề tài</a></li>
      </ol>
    </section>
    @include('error.messages')
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          @if(Auth::user()->role_id == 1 OR Auth::user()->role_id == 4)
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tìm kiếm Đề tài</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form method="GET" enctype="multipart/form-data" action="{{route('backend.subject.index')}}">
                  {{csrf_field()}}
                  <!-- Khoa -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Khoa</label>
                      <select class="form-control select2" style="width: 100%;" name="faculty" id="faculty" onchange="facultyFunction()" >
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
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Ngành</label>
                      <select class="form-control select2" style="width: 100%;" name="department" id="department" onchange="teacherFunction()">
                        <option value="">--Ngành--</option>
                            @foreach($departmentList as $value)
                              @if($value->parent != null && Request::get('faculty') == $value->parent)
                                <option value="{{$value->id}}" {{Request::get('department') == $value->id ? 'selected' : ''}} >{{$value->name}}</option>
                              @endif
                            @endforeach
                      </select>
                    </div>
                  </div>
                  <!-- Giáo viên -->
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Giáo viên hướng dẫn</label>
                          <select class="form-control select2" style="width: 100%;" name="teacher" id="teacher">
                              <option value="">--Giáo viên--</option>
                              @if(!empty(Request::get('teacher')))
                              @foreach($teacherList as $value)
                                  <option value="{{$value->id}}" {{Request::get('teacher') == $value->id ? 'selected' : '' }} >{{$value->name}}</option>
                              @endforeach
                              @endif
                          </select>
                      </div>
                  </div>
                  <!--Đánh giá-->
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Đánh giá</label>
                      <select class="form-control" style="width: 100%;" name="evaluate">
                        <option value="" >--Đánh giá--</option>
                        <option value="1" {{Request::get('evaluate') == 1 ? 'selected' : '' }}>Dễ</option>
                        <option value="2" {{Request::get('evaluate') == 2 ? 'selected' : '' }} >Trung bình</option>
                        <option value="3" {{Request::get('evaluate') == 3 ? 'selected' : '' }} >Khó</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <!--làm mới-->
                          <div class="col-md-6">
                              <div class="form-group" style="margin-top: 24px;">
                                  <div class="input-group">
                                      <a href="{{route('backend.subject.index')}}" class="btn btn-default">Làm mới</a>
                                  </div>
                              </div>
                          </div>
                          <!--Tìm kiếm-->
                          <div class="col-md-6" style="text-align: -webkit-right">
                              <div class="form-group" style="margin-top: 24px;">
                                  <div class="input-group">
                                      <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                  </div>
                              </div>
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
                <h3 class="box-title">Danh sách Đề tài </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="listSubject" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Đề tài</th>
                    <th>Đánh giá</th>
                    <th style="width: 60px; ">Khoa</th>
                    <th>Ngành</th>
                    <th style="width: 112px">Giáo viên hướng dẫn</th>
                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                        <th style="width: 140px;" >Tác vụ</th>
                    @endif
                    @if(Auth::user()->role_id == 2)
                        <th style="width: 140px;" >Tác vụ</th>
                    @endif
                    @if(Auth::user()->role_id == 3)
                        <th>Mô tả</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                    @foreach($subjectList as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td class="text-center">
                            @if($value->evaluate == 1)
                                <span class="badge label-primary" style="width: 100px; text-transform: uppercase">Dễ</span>
                            @endif
                            @if($value->evaluate == 2)
                                <span class="badge label-warning" style="width: 100px; text-transform: uppercase">Trung bình</span>
                            @endif
                            @if($value->evaluate == 3)
                                <span class="badge label-danger" style="width: 100px; text-transform: uppercase">Khó</span>
                            @endif
                        </td>
                        <td>{{$value->faculty->name}}</td>
                        <td>{{$value->department->name}}</td>
                        <td>
                            <a class="text" href="{{route('backend.account.student.detail',$value->user_id)}}">
                                {{$value->teacher->name}}
                            </a>
                        </td>
                        @if(Auth::user()->role_id == 3)
                            <td>
                                <a href="{{route('backend.subject.show',$value->id)}}" data-toggle="modal" data-target="#detail" class="btn btn-xs btn-info">
                                  <span>
                                    <i class="fa fa-info"></i>
                                    Chi tiết
                                  </span>
                                </a>
                            </td>
                        @endif
                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4 || Auth::user()->role_id == 2)
                        <td>
                            <a href="{{route('backend.subject.edit',$value->id)}}" class="btn btn-xs btn-warning">
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
                            <a href="{{route('backend.subject.show',$value->id)}}" data-toggle="modal" data-target="#detail" class="btn btn-xs btn-info">
                          <span>
                            <i class="fa fa-info"></i>
                            Chi tiết
                          </span>
                            </a>
                        </td>
                        @endif
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
        <!--Phần Chi tiết-->
        <div class="modal fade modal-ajax" id="detail">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Phần xóa-->
        <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Xác nhận xóa</h4>
                    </div>
                    <form method="POST" action="{{route('backend.subject.destroy','id')}}">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <div class="modal-body">
                            <p>Bạn có chắc chắn muốn xóa không?</p>
                            <input type="hidden" name="id" id="subject_id" value="" >
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
          $('#listSubject').DataTable({
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
          modal.find('#subject_id').val(id);
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
      //lọc giáo viên qua ngành
      function teacherFunction() {
          // lấy ra giáo viên thuộc khoa chọn
          var department = $('#department').val();
          $.ajax({
              url:"{{route('backend.user.ajax')}}",
              dataType: 'json',
              type: 'GET',
              data: {department:department},
              success:function (data) {
                  if (data.success){
                      $('#teacher').select2().empty();
                      $('#teacher').select2({
                          data: data.data,
                      });
                  }
              }
          });
      }
  </script>
@endpush
