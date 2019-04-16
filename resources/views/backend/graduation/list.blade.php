@extends('backend.master')
@section('title')
    <title>Danh sách khóa luận</title>
@endsection()
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 1125.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quản lý KLTN
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
        <li><a href="{{route('backend.graduation.index')}}">KLTN</a></li>
      </ol>
    </section>

    <!-- Main content -->
      @include('error.messages')
    <section class="content">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Tìm kiếm KLTN</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="GET" enctype="multipart/form-data" action="{{route('backend.graduation.index')}}" >
                {{csrf_field()}}
                <div class="row">
                    <!-- Mã sinh viên -->
                    {{--<div class="col-md-4">
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="form-control select2" name="status" style="width: 100%;">
                                <option value="">--Trạng thái--</option>
                                    <option value="0" {{Request::get('status') == 0 ? 'selected' : ''}} >Đăng ký</option>
                                    <option value="1" {{Request::get('status') == 1 ? 'selected' : ''}} >Xác nhận</option>
                                    <option value="2" {{Request::get('status') == 2 ? 'selected' : ''}} >Hoàn thành hoặc chưa</option>
                            </select>
                        </div>
                    </div>--}}
                    <!-- Năm -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Năm</label>
                            <select class="form-control select2" name="year" style="width: 100%;">
                                <option value="">--Năm--</option>
                                @foreach($yearList as $value)
                                    <option value="{{$value->id}}" {{ Request::get('year') == $value->id ? 'selected': ''}} > {{!empty($value->name) ? $value->name : '' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Khoa -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Khoa</label>
                            <select class="form-control select2" id="faculty" onchange="facultyFunction()" name="faculty" style="width: 100%;">
                                <option value="">--Khoa--</option>
                                @foreach($departmentList as $value)
                                    @if($value->parent == null)
                                        <option value="{{$value->id}}" {{ Request::get('faculty') == $value->id ? 'selected': ''}} > {{!empty($value->name) ? $value->name : '' }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Ngành -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Ngành</label>
                            <select class="form-control select2" id="department"  name="department" style="width: 100%;">
                                <option value="">--Ngành--</option>
                                @foreach($departmentList as $value)
                                    @if($value->parent != null && Request::get('faculty') == $value->parent)
                                        <option value="{{$value->id}}" {{Request::get('department') == $value->id ? 'selected' : ''}} >{{$value->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--Kỳ-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kỳ</label>
                            <select class="form-control same-select2" name="semester" style="width: 100%;">
                                <option value="">--Kỳ--</option>
                                <option value="1" {{Request::get('semester') == 1 ? 'selected' : ''}} >Kỳ 1</option>
                                <option value="2" {{Request::get('semester') == 2 ? 'selected' : ''}} >Kỳ 2</option>
                                <option value="3" {{Request::get('semester') == 3 ? 'selected' : ''}} >Kỳ 3</option>
                            </select>
                        </div>
                    </div>
                    <!--Time-->
                    {{--<div class="col-md-4">
                        <div class="form-group">
                            <label>Thời gian</label>
                            <input class="form-control" type="text" name="daterange" value="05/01/2018 - 15/2/2018" />
                        </div>
                    </div>--}}
                    <!--Hội đồng-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Hội đồng</label>
                            <select class="form-control select2" name="assembly" style="width: 100%;">
                                <option value="">--Hội Đồng--</option>
                                @foreach($assemblyList as $value)
                                    <option value="{{$value->id}}" {{Request::get('assembly') == $value->id ? 'selected' : ''}} >{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--Làm mới-->
                    <div class="col-md-6">
                        <div class="form-group" style="margin-top: 24px;">
                            <div class="input-group">
                                <a href="{{route('backend.graduation.index')}}" class="btn btn-default">Làm mói</a>
                            </div>
                        </div>
                    </div>
                    <!--Tìm kiếm-->
                    <div class="col-md-6">
                        <div class="form-group" style="margin-top: 24px; float: right">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--Kết quả tìm kiếm-->
        <div style="border-bottom: 3px solid #367fa9"></div>
        <div class="box-body">
          <table id="listGraduationSearch" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Đề tài</th>
              <th style=" width: 67px">Sinh viên thực hiện</th>
              <th style=" width: 75px">Giáo viên hướng dẫn</th>
              <th>Ngành</th>
              <th>File báo cáo</th>
              <th>Điểm</th>
              <th>Trạng thái</th>
              <th>Hội đồng</th>
              <th style="width: 145px">Tác vụ</th>
            </tr>
            </thead>
            <tbody>
                @foreach($graduationListSeach as $value)
              <tr>
                <td>{{!empty($value->subject->name) ? $value->subject->name : '' }}</td>
                <td><a href="{{route('backend.account.show',$value->userStudent->id)}}" class="text">{{!empty($value->userStudent->name) ? $value->userStudent->name : '' }}</a></td>
                <td>{{!empty($value->userTeacher->name) ? $value->userTeacher->name : '' }}</td>
                <td>{{!empty($value->department->name) ? $value->department->name : '' }}</td>
                <td style="text-align: center;font-size: 25px;"><a href="{{url('reports/'.$value->report)}}"><i class="far fa-file"></i></a></td>
                <td>{{ !empty($value->point) ? $value->point : 'chưa có' }}</td>
                <td class="text-center">
                  @if($value->status == 1)
                    <a href="{{route('backend.graduation.comfirm',$value->id)}}" class="btn btn-xs btn-default">Đã đăng ký</a>
                  @endif
                  @if($value->status == 2)
                    <div class="btn btn-xs btn-soundcloud">Đã xác nhận bảo vệ</div>
                  @endif
                  @if($value->status == 3 && $value->point >= 5.0)
                    <div class="btn btn-xs btn-success">Hoàn thành</div>
                  @endif
                  @if($value->status == 4 && $value->point < 5.0)
                    <div class="btn btn-xs btn-danger">Không hoàn thành</div>
                  @endif
                </td>
                <td>
                  @if(!empty($value->assembly->name))
                    <a href="{{route('backend.AllAssembly.ajax',$value->assembly_id)}}" data-toggle="modal" data-target="#assembly" class="btn btn-xs btn-primary">
                      <span>{{!empty($value->assembly->name) ? $value->assembly->name : '' }}</span>
                    </a>
                  @else
                      <span>Chưa có</span>
                  @endif
                </td>
                <td>
                  @if(empty($value->point) && !empty($value->assembly_id))
                    <a href="{{route('backend.point.ajax',$value->id)}}" data-toggle="modal" data-target="#point" class="btn btn-xs btn-bitbucket margin-2px">
                        <i class="fas fa-pencil-alt"></i>
                        <span >Nhập điểm</span>
                    </a>
                  @endif
                  @if($value->status == 1)
                      <a href="{{route('backend.graduation.registration',$value->id)}}" class="btn btn-xs btn-warning">
                        <span>
                          <i class="fa fa-edit"></i> Sửa
                        </span>
                      </a>
                  @elseif($value->status == 2)
                      <a href="{{route('backend.graduation.confirm',$value->id)}}" class="btn btn-xs btn-warning">
                        <span>
                          <i class="fa fa-edit"></i> Sủa
                        </span>
                      </a>
                  @elseif($value->status == 3 || $value->status == 4 )
                      <a href="{{route('backend.graduation.edit',$value->id)}}" class="btn btn-xs btn-warning margin-2px">
                          <span>
                            <i class="fa fa-edit"></i> Sửa
                          </span>
                      </a>
                  @endif
                  <a data-id="{{$value->id}}" data-toggle="modal" data-target="#delete" class="btn btn-xs btn-danger margin-2px">
                      <span>
                        <i class="fa fa-trash"></i> Xóa
                      </span>
                  </a>
                  @if($value->status == 1)
                    <a href="{{route('backend.graduation.show',$value->id)}}" data-toggle="modal" data-target="#detailregistration" class="btn btn-xs btn btn-info margin-2px" style="margin-top: 5px">
                        <i class="fas fa-info"></i>
                        <span>Chi tiết</span>
                    </a>
                    @elseif($value->status == 2)
                    <a href="{{route('backend.graduation.show.comfirm',$value->id)}}" data-toggle="modal" data-target="#detailregistration" class="btn btn-xs btn btn-info margin-2px">
                        <i class="fas fa-info"></i>
                        <span >Chi tiết</span>
                    </a>
                    @elseif($value->status == 3 || $value->status == 4)
                    <a href="{{route('backend.graduation.detail',$value->id)}}" data-toggle="modal" data-target="#detail" class="btn btn-xs btn btn-info margin-2px">
                        <i class="fas fa-info"></i>
                        <span >Chi tiết</span>
                    </a>
                  @endif
                </td>
              </tr>
            @endforeach

            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#registration" data-toggle="tab">Danh sách KLTN đã đăng ký</a></li>
              <li><a href="#confirm" data-toggle="tab">Danh sách KLTN đã xác nhận</a></li>
              <li><a href="#finish" data-toggle="tab">Danh sách KLTN hoàn thành</a></li>
              <li><a href="#false" data-toggle="tab">Danh sách KLTN chưa hoàn thành</a></li>
            </ul>

            <div class="tab-content">
              <!-- danh sách KLTN đẫ đăng ký-->
              <div class="active tab-pane" id="registration">
                <table id="registrationGraduation" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Đề tài</th>
                    <th>Sinh viên thực hiện</th>
                    <th>Giáo viên hướng dẫn</th>
                    <th>Ngành</th>
                    <th>Trạng thái</th>
                    <th style="width: 140px">Tác vụ</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($graduationList as $value)
                    @if($value->status == 1)
                    <tr>
                      <td>{{!empty($value->subject->name) ? $value->subject->name : '' }}</td>
                      <td>{{!empty($value->userStudent->name) ? $value->userStudent->name : '' }}</td>
                      <td>{{!empty($value->userTeacher->name) ? $value->userTeacher->name : '' }}</td>
                      <td>{{!empty($value->department->name) ? $value->department->name : '' }}</td>
                      <td><a href="{{route('backend.graduation.comfirm',$value->id)}}" class="btn btn-xs btn-default">Đã đăng ký</a></td>
                      <td>
                        <a href="{{route('backend.graduation.registration',$value->id)}}" class="btn btn-xs btn-warning">
                          <span>
                            <i class="fa fa-edit"></i> Sửa
                          </span>
                        </a>
                        <a data-id="{{$value->id}}"  data-toggle="modal" data-target="#delete" class="btn btn-xs btn-danger">
                            <span>
                              <i class="fa fa-trash"></i> Xóa
                            </span>
                        </a>
                        <a href="{{route('backend.graduation.show',$value->id)}}" data-toggle="modal" data-target="#detailregistration" class="btn btn-xs btn btn-info">
                          <i class="fas fa-info"></i>
                          <span >Chi tiết</span>
                        </a>
                      </td>
                    </tr>
                    @endif
                  @endforeach
                  </tbody>
                </table>
              </div>
                <!-- danh sách KLTN đẫ xác nhận-->
              <div class="tab-pane" id="confirm">
                <table id="confirmGraduation" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Đề tài</th>
                    <th>Sinh viên thực hiện</th>
                    <th>Giáo viên hướng dẫn</th>
                    <th>Ngành</th>
                    <th>File báo cáo</th>
                    <th>Trạng thái</th>
                    <th style="width: 120px;">Tác vụ</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($graduationList as $value)
                    @if($value->status == 2)
                    <tr>
                      <td>{{!empty($value->subject->name) ? $value->subject->name : '' }}</td>
                      <td>{{!empty($value->userStudent->name) ? $value->userStudent->name : '' }}</td>
                      <td>{{!empty($value->userTeacher->name) ? $value->userTeacher->name : '' }}</td>
                      <td>{{!empty($value->department->name) ? $value->department->name : '' }}</td>
                      <td style="text-align: center;font-size: 25px;"><a href="{{url('reports/'.$value->report)}}"><i class="far fa-file"></i></a></td>
                      <td><div class="btn btn-xs btn-soundcloud">Đã xác nhận bảo vệ</div></td>
                      <td>
                         <a href="{{route('backend.point.ajax',$value->id)}}" data-toggle="modal" data-target="#point" class="btn btn-xs btn-bitbucket margin-2px">
                            <i class="fas fa-pencil-alt"></i>
                            <span >Nhập điểm</span>
                        </a>
                        <a href="{{route('backend.graduation.confirm',$value->id)}}" class="btn btn-xs btn-warning">
                          <span>
                            <i class="fa fa-edit"></i> Sủa
                          </span>
                        </a>
                        <a data-id="{{$value->id}}"  data-toggle="modal" data-target="#delete" class="btn btn-xs btn-danger margin-2px">
                            <span>
                              <i class="fa fa-trash"></i> Xóa
                            </span>
                        </a>
                        <a href="{{route('backend.graduation.show.comfirm',$value->id)}}" data-toggle="modal" data-target="#detailregistration" class="btn btn-xs btn btn-info margin-2px">
                          <i class="fas fa-info"></i>
                          <span >Chi tiết</span>
                        </a>
                      </td>
                    </tr>
                    @endif
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="finish">
                <table id="finishGraduation" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Đề tài</th>
                    <th>Sinh viên thực hiện</th>
                    <th>Giáo viên hướng dẫn</th>
                    <th>Ngành</th>
                    <th>File báo cáo</th>
                    <th>Điểm</th>
                    <th>Trạng thái</th>
                    <th style="width: 140px;" >Tác vụ</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($graduationList as $value)
                    @if($value->status == 3 && $value->point >=5)
                    <tr>
                      <td>{{!empty($value->subject->name) ? $value->subject->name : '' }}</td>
                      <td>{{!empty($value->userStudent->name) ? $value->userStudent->name : '' }}</td>
                      <td>{{!empty($value->userTeacher->name) ? $value->userTeacher->name : '' }}</td>
                      <td>{{!empty($value->department->name) ? $value->department->name : '' }}</td>
                      <td style="text-align: center;font-size: 25px;"><a href="{{url('reports/'.$value->report)}}"><i class="far fa-file"></i></a></td>
                      <td>{{!empty($value->point) ? $value->point : '' }}</td>
                      <td><div class="btn btn-xs btn-success">Hoàn thành </div></td>
                      <td>
                        <a href="{{route('backend.graduation.edit',$value->id)}}" class="btn btn-xs btn-warning">
                            <span>
                              <i class="fa fa-edit"></i> Sửa
                            </span>
                        </a>
                        <a data-id="{{$value->id}}" data-toggle="modal" data-target="#delete" class="btn btn-xs btn-danger">
                          <span>
                            <i class="fa fa-trash"></i> Xóa
                          </span>
                        </a>
                        <a href="{{route('backend.graduation.detail',$value->id)}}" data-toggle="modal" data-target="#detail" class="btn btn-xs btn btn-info">
                          <i class="fas fa-info"></i>
                          <span >Chi tiết</span>
                        </a>
                      </td>
                    </tr>
                    @endif
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="false">
                <table id="falseGraduation" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Đề tài</th>
                    <th>Sinh viên thực hiện</th>
                    <th>Giáo viên hướng dẫn</th>
                    <th>Ngành</th>
                    <th>File báo cáo</th>
                    <th>Điểm</th>
                    <th>Trạng thái</th>
                    <th style="width: 140px;" >Tác vụ</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($graduationList as $value)
                    @if($value->status == 4 && $value->point < 5)
                    <tr>
                      <td>{{!empty($value->subject->name) ? $value->subject->name : ''}}</td>
                      <td>{{!empty($value->userStudent->name) ? $value->userStudent->name : ''}}</td>
                      <td>{{!empty($value->userTeacher->name) ? $value->userTeacher->name : ''}}</td>
                      <td>{{!empty($value->department->name) ? $value->department->name : ''}}</td>
                      <td style="text-align: center;font-size: 25px;"><a href="{{url('reports/'.$value->report)}}"><i class="far fa-file"></i></a></td>
                      <td>{{!empty($value->point) ? $value->point : ''}}</td>
                      <td><div class="btn btn-xs btn-danger">Không hoàn thành</div></td>
                      <td>
                        <a href="{{route('backend.graduation.edit',$value->id)}}" class="btn btn-xs btn-warning">
                            <span>
                              <i class="fa fa-edit"></i> Sửa
                            </span>
                        </a>
                        <a data-id="{{$value->id}}"  data-toggle="modal" data-target="#delete" class="btn btn-xs btn-danger">
                            <span>
                              <i class="fa fa-trash"></i> Xóa
                            </span>
                        </a>
                        <a href="{{route('backend.graduation.detail',$value->id)}}" data-toggle="modal" data-target="#detail" class="btn btn-xs btn btn-info" style="margin-top: 5px">
                          <i class="fas fa-info"></i>
                          <span>Chi tiết</span>
                        </a>
                      </td>
                    </tr>
                    @endif
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!--Phần hội đồng-->
      <div class="modal fade modal-ajax" id="assembly">
        <div class="modal-dialog">
          <div class="modal-content">

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!--Phần Chi tiết-->
      <div class="modal fade modal-ajax" id="detail">
        <div class="modal-dialog">
          <div class="modal-content">

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!--Phần Chi tiết đăng ký-->
      <div class="modal fade modal-ajax" id="detailregistration">
        <div class="modal-dialog">
          <div class="modal-content">

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!--Phần Chi tiết xác nhận-->
      <div class="modal fade modal-ajax" id="detailComfirm">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
      <!--Phần Chi tiết search-->
      <div class="modal fade modal-ajax" id="detailSearch">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
      <!--Phần nhập điểm-->
      <div class="modal fade " id="point">
        <div class="modal-dialog">
          <div class="modal-content">

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
            <form method="POST" action="{{route('backend.graduation.destroy','id')}}">
              {{method_field('DELETE')}}
              {{csrf_field()}}
              <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa không?</p>
                <input type="hidden" name="name" id="graduation_id" value="" >
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
          $('#listGraduationSearch').DataTable({
              'searching' : false,
          });
          $('#registrationGraduation').DataTable();
          $('#confirmGraduation').DataTable();
          $('#falseGraduation').DataTable();
          $('#finishGraduation').DataTable({
              'paging'      : true,
              'lengthChange': true,
              'searching'   : true,
              'ordering'    : true,
              'info'        : true,
              'autoWidth'   : false
          })
      });
      // tìm theo thời gian
      $(function() {
          $('input[name="daterange"]').daterangepicker({
              opens: 'left',
              locale: {
                  format: 'DD/M/YYYY'
              }
          }, function(start, end, label) {
             /* console.log("A new date selection was made: " + start.format('DD-M-YYYY') + ' to ' + end.format('DD-M-YYYY'));*/
          });
      });
      // select 2
      $(function () {
          $('.select2').select2({
              placeholder: "Chọn một trạng thái",
          })
      });
      // láy ra id để xóa
      $('#delete').on('show.bs.modal',function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('id') ;// id này tương đương với id get ở trên xuống data-id=
          var modal =$(this);
          modal.find('#graduation_id').val(id)
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
