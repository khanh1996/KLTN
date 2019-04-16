@extends('backend.master')
@section('content')
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
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thêm Sinh viên</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body" style="">
                            <div class="row">
                                <form type="">
                                    <!-- mã sinh viên -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mã Sinh viên</label>
                                            <input type="text" class="form-control" name="code" placeholder="A25603">
                                        </div>
                                    </div>
                                    <!--tên -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tên sinh viên</label>
                                            <input type="text" class="form-control" name="name" placeholder="Văn Bảo Khánh">
                                        </div>
                                    </div>
                                    <!--Lớp-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Lớp</label>
                                            <input type="text" class="form-control" name="class" placeholder="TI27g2">
                                        </div>
                                    </div>
                                    <!-- Ngành -->
                                    <div class="col-md-4">
                                        <label>Khóa</label>
                                        <div class="form-group">
                                            <select class="form-control select2" name="year"  style="width: 100%;">
                                                <option selected="selected">K27</option>
                                                <option>K26</option>
                                                <option>K25</option>
                                                <option>K24</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Khoa -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Khoa</label>
                                            <select class="form-control select2" name="faculty" style="width: 100%;">
                                                <option selected="selected">Toán tin</option>
                                                <option>Ngôn ngữ</option>
                                                <option>Quản trị du lịch và lữ hành</option>
                                                <option>Điều dưỡng khoa học sách sức khỏe</option>
                                                <option>Kinh tế quản lý</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Ngành -->
                                    <div class="col-md-4">
                                        <label>Ngành</label>
                                        <div class="form-group">
                                            <select class="form-control select2" name="department"  style="width: 100%;">
                                                <option selected="selected">Khoa học máy tính</option>
                                                <option>Truyền thông mạng máy tính</option>
                                                <option>Du lịch</option>
                                                <option>Kê toàn</option>
                                                <option>Ngôn ngữ Hàn</option>
                                                <option>An toàn mạng</option>
                                                <option>Ngôn ngữ Nhật</option>
                                                <option>Tài chính</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--Nhóm-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nhóm</label>
                                            <select class="form-control" name="group" style="width: 100%;">
                                                <option selected="selected">Nhóm 1</option>
                                                <option>Nhóm 2</option>
                                                <option>Nhóm 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--Giới tính-->
                                    <div class="col-md-4">
                                        <div class="form-group" style="margin-top: 5px;">
                                            <label style="margin-top: 5px">Giới tính </label><br>
                                            <input type="radio" name="gender" value="male" checked>Nam
                                            <div class="inline" style="margin-right: 10px"> </div>
                                            <input type="radio" name="gender" value="female"> Nữ<br>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ảnh</label>
                                            <input type="file" value="Inport Sinh viên">
                                        </div>
                                    </div>
                                    <!--thêm-->
                                    <div class="col-md-4">
                                        <div class="form-group" style="margin-top: 24px;">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-primary">Thêm</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách sinh viên</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="listStudent" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Họ & Tên</th>
                                    <th>Khóa</th>
                                    <th>Khoa</th>
                                    <th>Ngành</th>
                                    <th>Lớp</th>
                                    <th>Tác vụ</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @for($i=0; $i <7 ; $i++)
                                        <tr>
                                        <td>A25603</td>
                                        <td>Văn Bảo Khánh</td>
                                        <td>K27</td>
                                        <td>Toán tin</td>
                                        <td>Khoa học máy tính</td>
                                        <td>TI27g2</td>
                                        <td>
                                            <a href="#" class="btn btn-xs btn-warning">
                                                <span>
                                                  <i class="fa fa-edit"></i>
                                                  Sửa
                                                </span>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-danger">
                                                <span>
                                                  <i class="fa fa-trash"></i>
                                                  Xóa
                                                </span>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-primary">
                                                <span data-toggle="modal" data-target="#detail" >
                                                  <i class="fas fa-info"></i>
                                                  Chi tiết
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endfor
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Mã</th>
                                    <th>Họ & Tên</th>
                                    <th>Khóa</th>
                                    <th>Khoa</th>
                                    <th>Ngành</th>
                                    <th>Lớp</th>
                                    <th>Tác vụ</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <!--Phần Chi tiết-->
                        <div class="modal fade" id="detail">
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
                                                <td>Giới tính</td>
                                                <td>Nhóm</td>
                                                <td>Năm</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Nam</td>
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
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
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
            $('#listStudent').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
        // select 2
        $(function () {
            $('.select2').select2()
        })
    </script>
@endpush