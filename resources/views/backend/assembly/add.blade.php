@extends('backend.master')
@section('title')
    <title>Thêm hội đồng</title>
@endsection()
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Quản lý Hội đồng
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li class=""><a href="{{route('backend.assembly.index')}}">Hội đồng</a></li>
                <li class="active"><a href="#">Thiết lập hội đồng</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tạo Hội đồng</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        @include('error.messages')
                        <div class="box-body" style="">
                            <div class="row">
                                <form type="" enctype="multipart/form-data" method="POST" action="{{route('backend.assembly.store')}}">
                                    <!-- đề tài -->
                                    <div class="col-md-12 ">
                                        <div class="form-group ">
                                            <label>Tên Hội Đồng <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                            <input type="text" class="form-control style-input" name="name"  placeholder="Hội đồng A"/>
                                        </div>
                                    </div>
                                    <!-- Khoa -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Khoa <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                            <select class="form-control select2" name="faculty" id="faculty" style="width: 100%;" onchange="facultyFunction()"  >
                                                <option value="">--Khoa--</option>
                                                    @foreach($departmentList as $value)
                                                        @if($value->parent == null)
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                        @endif
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Ngành -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ngành <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                            <select class="form-control select2" name="department" id="department" onchange="userFunction()"  style="width: 100%;">
                                                <option value="">--Ngành--</option>

                                            </select>
                                        </div>
                                    </div>
                                    <!-- Năm -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Năm <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                            <select class="form-control select2" name="year"  style="width: 100%;">
                                                <option value="">--Năm--</option>
                                                @foreach($yearList as $value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--Thêm-->
                                    <div class="col-md-12">
                                        <div class="form-group" style="float: right; margin-right: 20px;">
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
                            <h3 class="box-title">Danh sách Hội đồng</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="registrationGraduation" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Hội Đồng</th>
                                    <th>Ngành</th>
                                    <th>Khoa</th>
                                    <th>Năm</th>
                                    <th>Tác vụ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assemblyList as $value)
                                    @if($value->status == 1)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{!empty($value->faculty) ? $value->faculty->name : ""}}</td>
                                        <td>{{!empty($value->department) ? $value->department->name : ""}}</td>
                                        <td>{{!empty($value->year) ? $value->year->name : ""}}</td>
                                        <td>
                                            <a href="{{route('backend.assembly.show',$value->id)}}" class="btn btn-xs btn-warning">
                                                <span>
                                                  <i class="fa fa-edit"></i> Sửa
                                                </span>
                                            </a>
                                            <a data-id="{{$value->id}}" data-toggle="modal" data-target="#delete" class="btn btn-xs btn-danger">
                                                <span>
                                                  <i class="fa fa-trash"></i> Xóa
                                                </span>
                                            </a>
                                            <a href="{{route('backend.displayUserDepartment',$value->id)}}" class="btn btn-xs btn-success">
                                                <span>
                                                    <i class="fas fa-wrench"></i> Thiết lập
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach()
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
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
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>

            <!----------------------------------------------------------------------------->

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
            $('#registrationGraduation').DataTable({
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
        // date and time
        $(function () {
            $('#datetimepicker').datetimepicker();
        });
        // láy ra id để xóa
        $('#delete').on('show.bs.modal',function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id') ;// id này tương đương với id get ở trên xuống data-id=
            var modal =$(this);
            modal.find('#assembly_id').val(id);

        });
        // lọc ngành theo khoa
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

        function userFunction() {
            // lấy ra giáo viên thuộc khoa chọn
            var department = $('#department').val();
            $.ajax({
                url:"{{route('backend.user.ajax')}}",
                dataType: 'json',
                type: 'GET',
                data: {department:department},
                success:function (data) {
                    if (data.success){
                        $('.users_department').select2().empty();
                        $('.users_department').select2({
                            data: data.data,
                        });
                    }
                }
            });
        }
        /*function choseUserFuntion() {
            const president = $('#president').val();
            const secretary = $('#secretary').val();
            const commissary = $('#commissary').val();
            const reviewer = $('#reviewer').val();
            const array = [president,secretary,commissary,reviewer];
            /!*console.log('president'+'='+president);
            console.log('secretary'+'='+secretary);
            console.log('commissary'+'='+commissary);
            console.log('reviewer'+'='+reviewer);*!/
            var vtmin;
            var i;
            var j;
            var tam;
            for (i = 0 ; i < array.length - 1 ; i++) {
                vtmin = i;
                for( j = i+1 ; j < array.length ; j++)
                    if(array[j] < array[vtmin])
                        vtmin = j;
                tam = array[i];
                array[i] = array[vtmin];
                array[vtmin] = tam;
                console.log(array);
            }

        }*/
    </script>
@endpush
