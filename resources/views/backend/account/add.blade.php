@extends('backend.master')
@section('title')
    <title>Thêm tài khoản</title>
@endsection()
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Quản lý tài khoản
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li ><a href="{{route('backend.account.index')}}">tài khoản</a></li>
                <li class="active"><a href="#">Thêm</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thêm tài khoản</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        @include('error.messages')
                        <div class="box-body" style="">
                            <div class="row">
                                <form method="POST" action="{{route('backend.account.store')}}" enctype="multipart/form-data" role="form">
                                    <!--Loại-->
                                    <div class="col-md-4">
                                        <label>Loại <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="form-group">
                                            <select class="form-control select2"  name="role"  id="role" onchange="showFields()" style="width: 100%;">
                                                <option value="">--Loại--</option>
                                                @foreach($roleList as $value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Khoa -->
                                    <div class="col-md-4">
                                        <label>Khoa</label>
                                        <div class="form-group">
                                            <select class="form-control select2"  name="faculty"  id="faculty" onchange="facultyFunction()">
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
                                            <label>Ngành</label>
                                            <select class="form-control select2"  name="department" id="department">
                                                <option value="">--Ngành--</option>
                                                @foreach($departmentList as $value)
                                                    @if($value->parent != null)
                                                        <option  value="{{$value->id}}">{{$value->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- mã tài khoản -->
                                    <div class="col-md-3">
                                        <label>Mã <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="form-group">
                                            <input type="text"  class="form-control" name="code" placeholder="A25603">
                                        </div>
                                    </div>
                                    <!--email-->
                                    <div class="col-md-3">
                                        <label>Email</label>
                                        <div class="form-group">
                                            <input class="form-control" type="email" name="email" placeholder="khanh@gmail.com"/>
                                        </div>
                                    </div>
                                    <!--tên -->
                                    <div class="col-md-3">
                                        <label>Họ và tên <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="form-group">
                                            <input type="text"  class="form-control" name="name" placeholder="Văn Bảo Khánh" >
                                        </div>
                                    </div>
                                    <!--Lớp-->
                                    <div class="col-md-3" id="contentClass">
                                        <label>Lớp</label>
                                        <div class="form-group">
                                            <input type="text"  class="form-control" name="class" id="class" placeholder="TI27g2" >
                                        </div>
                                    </div>
                                    <!-- Mật khẩu -->
                                    <div class="col-md-3">
                                        <label>Mật Khẩu <i class="fas fa-star-of-life fa-xs" style="color: red"></i></label>
                                        <div class="form-group">
                                            <input type="password"  class="form-control" name="password" placeholder="123456" value="123456">
                                        </div>
                                    </div>
                                    <!-- Khóa -->
                                    <div class="col-md-3" id="contentCourse">
                                        <label>Khóa</label>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <input type="text"  class="form-control" name="course" id="course" placeholder="K27" >
                                            </div>
                                        </div>
                                    </div>
                                    <!--Ngày sinh -->
                                    <div class="col-md-3">
                                        <label>Ngày sinh</label>
                                        <div class="form-group">
                                            <input class="form-control" required type="text" name="birthday" value="9/02/1996"/>
                                        </div>
                                    </div>
                                    <!--Số điện thoại-->
                                    <div class="col-md-3">
                                        <label>Liên lạc</label>
                                        <div class="form-group">
                                            <input type="text" name="phone" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                        </div>
                                    </div>
                                    <!--nhóm-->
                                    <div class="col-md-3" id="contentGroup">
                                        <label>Nhóm</label>
                                        <div class="form-group">
                                            <select class="form-control"  name="group" id="group" style="width: 100%;">
                                                <option value="0">--Nhóm-- </option>
                                                <option value="1">Nhóm 1</option>
                                                <option value="2">Nhóm 2</option>
                                                <option value="3">Nhóm 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--Giới tính-->
                                    <div class="col-md-3">
                                        <label>Giới tính</label><br>
                                        <div class="form-group" required style="margin-top: 5px;">
                                            <input type="radio" name="gender"  value="2" checked>Nam
                                            <div class="inline" style="margin-right: 10px"> </div>
                                            <input type="radio" name="gender" value="1"> Nữ<br>
                                        </div>
                                    </div>
                                    <!--Ảnh-->
                                    <div class="col-md-3">
                                        <label>Ảnh</label>
                                        <div class="form-group">
                                            <div class="" required>
                                                <input type="file" class="upload"  name="image" />
                                            </div>
                                        </div>
                                    </div>

                                    <!--thêm-->
                                    <div class="col-md-12">
                                        <div class="form-group" style=" float: right; margin-right: 20px;">
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
                            <h3 class="box-title">Danh sách tài khoản</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="listStudent" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Họ & Tên</th>
                                    <th>Khoa</th>
                                    <th>Ngành</th>
                                    <th>Liên lạc</th>
                                    <th>Loại</th>
                                    <th>Tác vụ</th>
                                </tr>
                                </thead>
                                <tbody>
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
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Mã</th>
                                        <th>Họ & Tên</th>
                                        <th>Khoa</th>
                                        <th>Ngành</th>
                                        <th>Lớp</th>
                                        <th>Loại</th>
                                        <th>Tác vụ</th>
                                    </tr>
                                </tfoot>
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
            });
            $('[data-mask]').inputmask()
        });
        // select 2
        $(function () {
            $('.select2').select2()
        });
        // ngày sinh
        $(function() {
            $('input[name="birthday"]').daterangepicker({
                datepicker:true,
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD/M/YYYY'
                }
            });
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
        // show các trường cần nhập của giáo viên
        function showFields() {
            var role = $('#role').val();
            if (role == 2 || role == 4 ){
                $('#contentClass').css('display','none');
                $('#contentCourse').css('display','none');
                $('#contentGroup').css('display','none');
            }
            else {
                $('#contentClass').css('display','block');
                $('#contentCourse').css('display','block');
                $('#contentGroup').css('display','block');
            }
        }

    </script>
@endpush
