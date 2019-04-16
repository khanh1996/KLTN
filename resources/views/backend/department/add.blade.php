@extends('backend.master')
@section('title')
    <title>Thêm khoa-ngành</title>
@endsection()
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Quản lý Khoa - Ngành
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li class="active"><a href="#">Khoa - Ngành</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thêm Khoa - Ngành</h3>
                            {{--<!--thêm danh sách sinh viên từ file excel-->
                            <form>
                                <div class="form-group" style="position: absolute;top: 7px;right: 100px;">
                                    <label>Inport Danh sách</label>
                                    <div class="btn btn-xs btn-primary">
                                        <input type="file" id="exampleInputFile" value="Inport Sinh viên">
                                    </div>
                                </div>
                            </form>--}}
                            @include('error.messages')
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body" style="">
                            <div class="row">
                                <form method="post" action="{{route('backend.department.store')}}" enctype="multipart/form-data" role="form">
                                    <!-- Ngành -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ngành <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                            <input class="form-control" type="text" placeholder="Khoa học máy tính"  name="department">
                                        </div>
                                    </div>
                                    <!-- Khoa -->
                                    <div class="col-md-6">
                                        <label>Khoa</label>
                                        <div class="form-group">
                                            <select class="form-control select2" name="parent"  style="width: 100%;" title="">
                                                <option value=""> --Khoa-- </option>
                                                @foreach($departmentList as $value)
                                                    @if($value->parent == null)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--thêm-->
                                    <div class="col-md-4">
                                        <div class="form-group" style="margin-top: 24px;">
                                            <div class="input-group">
                                                <button type="submit" name="submit" class="btn btn-primary">Thêm</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{csrf_field()}}
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách Khoa - Ngành</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="listDepartment" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ngành</th>
                                    <th>Khoa</th>
                                    <th>Tác vụ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($departmentList as $value)
                                    @if($value->parent != null)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>
                                            @if(!empty($value->parent != null))
                                                {{$value->name}}
                                            @endif
                                        </td>
                                        <td>@if(!empty($value->parent) && !empty($arrayDepartment[$value->parent]) )
                                                {{$arrayDepartment[$value->parent]}}
                                            @else
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('backend.department.edit',['id' => $value->id,'name' => $value->name])}}" class="btn btn-xs btn-warning">
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
                                    @endif
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
            <!-- Xóa-->
            <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-center" id="myModalLabel">Xác nhận xóa</h4>
                        </div>
                        <form method="POST" action="{{route('backend.department.destroy','id')}}">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}
                            <div class="modal-body">
                                <p>Bạn có chắc chắn muốn xóa không?</p>
                                <input type="hidden" name="name" id="department_id" value="" >
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
@endsection()
@push('after-script')
    <script type="text/javascript">
        // data table
        $(function () {
            $('#example1').DataTable();
            $('#listDepartment').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
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
            var modal = $(this);
            modal.find('#department_id').val(id)
        });

        function notifyMessage(){
            $.notify({
                // options
                icon: 'glyphicon glyphicon-ok',
                message: 'Hello World'
            },{
                // settings
                type: 'success',
                animate: {
                    enter: 'animated flipInX',
                    exit: 'animated flipOutX'
                },
                placement: {
                    from: "top",
                    align: "right"
                },

            });
        }
    </script>
@endpush
