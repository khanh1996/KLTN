@extends('backend.master')
@section('title')
    <title>Danh sách hội đồng</title>
@endsection()
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 1125.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quản lý Hội đồng
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li><a href="{{route('backend.assembly.index')}}">Hội đồng</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Tìm kiếm Hội đồng</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form method="GET" enctype="multipart/form-data" action="{{route('backend.assembly.index')}}">
            {{csrf_field()}}
            <div class="row">
            <!-- Khoa -->
            <div class="col-md-4">
              <div class="form-group">
                <label>Năm</label>
                <select class="form-control select2" style="width: 100%;" name="year">
                  <option value="">--Năm--</option>
                    @foreach($yearList as $value)
                      <option value="{{$value->id}}" {{ Request::get('year') == $value->id ? 'selected': ''}}> {{$value->name}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <!-- Khoa -->
            <div class="col-md-4">
              <div class="form-group">
                <label>Khoa</label>
                <select class="form-control select2" style="width: 100%;" id="faculty" name="faculty" onchange="facultyFunction()">
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
                <select class="form-control select2" style="width: 100%;" id="department" name="department">
                  <option value="">--Ngành--</option>
                  @foreach($departmentList as $value)
                    @if($value->parent != null && Request::get('faculty') == $value->parent)
                      <option value="{{$value->id}}" {{Request::get('department') == $value->id ? 'selected' : ''}} >{{$value->name}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
            <!--làm mới-->
            <div class="col-md-6">
              <div class="form-group" style="margin-top: 24px;">
                <div class="input-group">
                  <a href="{{route('backend.assembly.index')}}" class="btn btn-default">Làm mói</a>
                </div>
              </div>
            </div>
            <!--Tìm kiếm-->
            <div class="col-md-6" style="text-align: -webkit-right">
              <div class="form-group" style="margin-top: 24px;">
                <div class="input-group ">
                  <button type="submit" class="btn btn-primary ">Tìm kiếm</button>
                </div>
              </div>
            </div>
          </div>
          </form>
        </div>
        <!--Kết quả tìm kiếm-->
        <div style="border-bottom: 3px solid #367fa9"></div>
        <div class="box-body">
          <table id="listAssemblySearch" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>ID</th>
              <th>Tên hội đồng</th>
              <th>Khoa</th>
              <th>Ngành</th>
              <th>Năm</th>
              <th>Tác vụ</th>
            </tr>
            </thead>
            <tbody>
            @foreach($assemblyList as $value)
              <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->name}}</td>
                <td>{{!empty($value->faculty) ? $value->faculty->name : ""}}</td>
                <td>{{!empty($value->department) ? $value->department->name : ""}}</td>
                <td>{{!empty($value->year) ? $value->year->name : ""}}</td>
                <td>
                  @if($value->status == 2)
                  <a href="{{route('backend.assembly.edit',$value->id)}}" class="btn btn-xs btn-warning">
                    <span>
                      <i class="fa fa-edit"></i> Sửa
                    </span>
                  </a>
                  @endif
                  @if($value->status == 1)
                      <a href="{{route('backend.assembly.show',$value->id)}}" class="btn btn-xs btn-warning">
                    <span>
                      <i class="fa fa-edit"></i> Sửa
                    </span>
                      </a>
                  @endif
                  <a data-id="{{$value->id}}" data-toggle="modal" data-target="#delete" class="btn btn-xs btn-danger">
                    <span>
                      <i class="fa fa-trash"></i> Xóa
                    </span>
                  </a>
                  @if($value->status == 2)
                      <a href="{{route('backend.AllAssembly.ajax',$value->id)}}" data-toggle="modal" data-target="#assembly" class="btn btn-xs btn btn-info">
                        <i class="fas fa-info"></i>
                        <span>Chi tiết</span>
                      </a>
                  @endif
                    <a href="{{route('backend.displayUserDepartment',$value->id)}}" class="btn btn-xs btn-success">
                  <span>
                    <i class="fas fa-wrench"></i> Thiết lập
                  </span>
                    </a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!--Phần hội đồng-->
      <div class="modal modal-header fade modal-ajax" id="assembly" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document">
          <div class="modal-content">

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!--Phần xóa hội đồng-->
      <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title text-center" id="myModalLabel">Xác nhận xóa</h4>
            </div>
            <form method="POST" action="{{route('backend.assembly.destroy','id')}}">
              {{method_field('DELETE')}}
              {{csrf_field()}}
              <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa không?</p>
                <input type="hidden" name="id" id="assembly_id" value="" >
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
      <!--Phần Chi tiết đăng ký-->
      <div class="modal fade" id="detailregistration">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Chi tiết</h4>
            </div>
            <div class="modal-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <td>Khóa</td>
                  <td>Kỳ</td>
                  <td>Nhóm</td>
                  <td>Năm</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>K27</td>
                  <td>Kỳ 2</td>
                  <td>Nhóm 2</td>
                  <td>2018</td>
                </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Close</button>
            </div>
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
          $('#listAssemblySearch').DataTable();
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
          modal.find('#assembly_id').val(id);

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
