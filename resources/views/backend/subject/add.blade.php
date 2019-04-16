@extends('backend.master')
@section('title')
    <title>Thêm đề tài</title>
@endsection()
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Quản lý Đề tài
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active"><a href="#">Đề tài</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thêm Đề tài</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        @include('error.messages')
                        <div class="box-body" style="">
                            <div class="row">
                                <form type="" enctype="multipart/form-data" method="POST" action="{{route('backend.subject.store')}}">
                                    <!-- Tên Đề tài-->
                                    <div class="col-md-12">
                                        <label>Đề tài <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Quản lý Khóa luận tốt nghiệp">
                                        </div>
                                    </div>
                                    <!-- Độ khó -->
                                    <div class="col-md-6">
                                        <label>Đánh giá</label>
                                        <div class="form-group">
                                            <select class="form-control select2" name="evaluate" style="width: 100%;">
                                                <option value="1" selected="selected">Dễ</option>
                                                <option value="2">Trung bình</option>
                                                <option value="3">Khó</option>
                                            </select>
                                        </div>
                                    </div>
                                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                                    <!-- Khoa -->
                                    <div class="col-md-6">
                                        <label>Khoa <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="form-group">
                                            <select class="form-control select2" name="faculty" id="faculty" onchange="facultyFunction()" style="width: 100%;">
                                                <option value="">--Khoa--</option>
                                                @foreach($departmentList as $value)
                                                    @if($value->parent == null)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                                    <!-- Ngành -->
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <label>Ngành <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                            <select class="form-control select2" name="department" id="department"  onchange="teacherFunction()" style="width: 100%;">
                                                <option value="">--Ngành--</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    <!-- giáo viên -->
                                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Giáo viên hướng dẫn <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                                <select class="form-control select2" name="teacher" id="teacher" style="width: 100%;">
                                                    <option value="">--Giáo viên--</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea class="form-control textarea" rows="10" name="description" id="description" placeholder="Mô tả sơ qua về đề tài..."> </textarea>
                                        </div>
                                    </div>
                                    <!--thêm-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-primary">Thêm</button>
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
                            <h3 class="box-title">Danh sách Đề tài</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="listStudent" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Đề tài</th>
                                    <th>Đánh giá</th>
                                    <th>Khoa</th>
                                    <th>Ngành</th>
                                    @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                                        <th>Giáo viên</th>
                                    @endif
                                    <th style="width: 165px;">Tác vụ</th>
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
                                        <td>{{!empty($value->faculty) ? $value->faculty->name : ""}}</td>
                                        <td>{{!empty($value->department) ? $value->department->name : ""}}</td>
                                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                                            <td>{{!empty($value->teacher) ? $value->teacher->name : ""}}</td>
                                        @endif
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
                'ordering'    : false,
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
