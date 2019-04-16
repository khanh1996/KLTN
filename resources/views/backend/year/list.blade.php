@extends('backend.master')
@section('title')
    <title>Danh sách năm</title>
@endsection()
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quản lý Năm
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"><a href="#">Năm</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Danh sách Năm</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
              @include('error.messages')
            <!-- /.box-header -->
            <div class="box-body">
              <table id="listYear" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Năm</th>
                    <th>Tác vụ</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($yearList as $value)
                    <tr>
                      <td>{{$value->id}}</td>
                      <td>{{$value->name}}</td>
                        <td>
                            <a href="{{route('backend.year.edit',$value->id)}}" class="btn btn-xs btn-warning">
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
        <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Xác nhận xóa</h4>
                    </div>
                    <form method="POST" action="{{route('backend.year.destroy','id')}}">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <div class="modal-body">
                            <p>Bạn có chắc chắn muốn xóa không?</p>
                            <input type="hidden" name="name" id="year_id" value="" >
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
          $('#listYear').DataTable({
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
          modal.find('#year_id').val(id)
      });
  </script>
@endpush
