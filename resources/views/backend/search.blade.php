@extends('backend.master')
@section('title')
    <title>Tìm kiếm</title>
@endsection()
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Từ khóa tìm kiếm : {{$keySearch}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active"><a href="#">Search</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- /.box -->
                    <div class="box box-primary">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="listStudent" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Họ & Tên</th>
                                    <th>Khoa</th>
                                    <th>Ngành</th>
                                    <th>Khóa</th>
                                    <th>Loại</th>
                                    <th>Tác vụ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($usersListSearch as $value)
                                    <tr>
                                        <td>{{$value->code}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{!empty($value->faculty) ? $value->faculty->name : ""}}</td>
                                        <td>{{!empty($value->department) ? $value->department->name : ""}}</td>
                                        <td>{{$value->course}}</td>
                                        <td>{{!empty($value->role) ? $value->role->name : ""}}</td>
                                        <td>
                                            @if( Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
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
                                            @endif
                                            <a href="{{route('backend.account.show',$value->id)}}" class="btn btn-xs btn btn-info">
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
    </script>
@endpush
