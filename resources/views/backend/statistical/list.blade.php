@extends('backend.master')
@section('title')
    <title>Thống kê</title>
@endsection()
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 1125.8px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Thống kê
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
        <li><a href="{{route('backend.statistical.index')}}">Thống kê</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
          <!-- thống kê đề tài dễ, trung bình, khó theo %-->
        <div class="col-xs-6">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Thống kê đề tài</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
                <canvas id="subjectPie"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
          <!--lọc sinh viên hoàn thành kltn hoặc chưa hoàn thành theo năm-->
        <div class="col-xs-6">
          <div class="box box-success">
              <div class="box-header with-border">
                  <h3 class="box-title">Thống kê số lượng sinh viên hoàn thành KLTN theo năm</h3>

                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
              </div>
              <div class="box-body chart-responsive">
                  <div class="chart" id="graduation-chart" style="height: 300px;"></div>
              </div>
              <!-- /.box-body -->
          </div>
        </div>
          <!--test-->
        <div class="col-xs-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thống kê KLTN</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <canvas class="chart" id="studentGraduation"></canvas>
                </div>
            </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection()
@push('after-script')
  <script>
      $(function () {
          // thống kê đề tài dễ, trung bình, khó theo %
          var subject = document.getElementById("subjectPie");
          var subjectPie = new Chart(subject,{
              type: 'pie',
              data: {
                  labels: [
                      'Dễ',
                      'Trung Bình',
                      'Khó'
                  ],
                  datasets: [{
                      data: [{{$easySubject}}, {{$mediumSubject}}, {{$hardSubject}}],
                      backgroundColor: [
                          'rgba(60, 141, 188, 1)',
                          'rgba(243, 156, 18, 1)',
                          'rgba(221, 75, 57, 1)'
                      ],
                      borderColor: [
                          'rgba(54, 162, 235, 0.5)',
                          'rgba(243, 156, 18, 0.5)',
                          'rgba(221, 75, 57, 0.5)'
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  responsive: true
              }
          });


          //lọc sinh viên hoàn thành kltn hoặc chưa hoàn thành theo năm
          var bar = new Morris.Bar({
              element: 'graduation-chart',
              resize: true,
              data:
                  <?php
                  echo json_encode($data1);
                  ?>
                  {{--@foreach($yearList as $value)--}}
                    {{--{y: {{$value->name}}, a: 100, b: 90},--}}
                  {{--@endforeach--}}

              ,
              barColors: ['#00a65a', '#f56954'],
              xkey: 'y',
              ykeys: ['a', 'b'],
              labels: ['Hoàn thành', 'Chưa hoàn thành'],
              hideHover: 'auto'
          });
          //test
          var studentGraduation = document.getElementById("studentGraduation").getContext('2d');
          var studentGraduation = new Chart(studentGraduation, {
              type: 'horizontalBar',
              data: {
                  labels: ["Đăng ký", "Xác nhận", "Hoàn thành", "Không hoàn thành"],
                  datasets: [{
                      label: ["Sinh viên"],
                      data: [{{$registrationGraduation}}, {{$confirmGraduation}}, {{$finishGraduation}}, {{$failGraduation}}, 0, {{$allGraduation}}],
                      backgroundColor: [
                          '#d7d7d7',
                          '#f50',
                          '#008d4c',
                          '#dd4b39',
                      ],
                      borderColor: [
                          '#f4f4f4',
                          '#f50',
                          '#008d4c',
                          '#dd4b39',
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero:true
                          }
                      }]
                  },
              }
          });
      });
  </script>
@endpush
