@extends('backend.master')
@section('title')
    <title>Khóa luận tốt nghiệp</title>
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
                <li><a href="{{route('backend.graduation.studentGraduation')}}">KLTN</a></li>
            </ol>
        </section>

        <!-- Main content -->
        @include('error.messages')
        <section class="content">
            <div class="box box-primary">
                <div style="border-bottom: 3px solid #367fa9"></div>
                <div class="box-body">
                    <table id="listGraduation" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Đề tài</th>
                            <th>Sinh viên thực hiện</th>
                            <th>Giáo viên hướng dẫn</th>
                            <th>Ngành</th>
                            <th style="width: 90px;">File báo cáo</th>
                            <th>Điểm</th>
                            <th>Trạng thái</th>
                            <th>Hội đồng</th>
                            <th style="width: 45px">Tác vụ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($graduationList as $value)
                            <tr>
                                <td>{{!empty($value->subject->name) ? $value->subject->name : '' }}</td>
                                <td>
                                    <a href="{{route('backend.account.student.detail',$value->userStudent->id)}}" class="text">
                                        {{!empty($value->userStudent->name) ? $value->userStudent->name : '' }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('backend.account.student.detail',$value->userTeacher->id)}}" class="text">
                                        {{!empty($value->userTeacher->name) ? $value->userTeacher->name : '' }}
                                    </a>
                                </td>
                                <td>{{!empty($value->department->name) ? $value->department->name : '' }}</td>
                                <td style="text-align: center;font-size: 25px;">
                                    @if(!empty($value->report))
                                        <a href="{{url('reports/'.$value->report)}}"><i class="far fa-file"></i></a>
                                    @endif
                                </td>
                                <td>{{ !empty($value->point) ? $value->point : 'chưa có' }}</td>
                                <td class="text-center">
                                    @if($value->status == 1)
                                        <span class="btn btn-xs btn-default">Đã đăng ký</span>
                                    @endif
                                    @if($value->status == 2)
                                        <span class="btn btn-xs btn-soundcloud">Đã xác nhận bảo vệ</span>
                                    @endif
                                    @if($value->status == 3 && $value->point >= 5.0)
                                        <span class="btn btn-xs btn-success">Hoàn thành</span>
                                    @endif
                                    @if($value->status == 4 && $value->point < 5.0)
                                        <span class="btn btn-xs btn-danger">Không hoàn thành</span>
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
                                    @if($value->status == 2 || $value->status == 3 || $value->status == 1)
                                        <a href="{{route('backend.graduation.show.comfirm',$value->id)}}" data-toggle="modal" data-target="#detailregistration" class="btn btn-xs btn btn-info margin-2px">
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
            $('#listGraduation').DataTable({
                'searching' : true,
            });
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
            $('.select2').select2()
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
