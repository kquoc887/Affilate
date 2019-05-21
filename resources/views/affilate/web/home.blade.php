@extends('affilate.web.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>Số lượt thanh toán</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>20<sup style="font-size: 20px">%</sup></h3>

                <p>Phần trăm tăng trưởng</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>Số lượng cộng tác viên</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Lượt Khách xem website</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Bảng số lượng cộng tác viên</h3>
                </div>
                            <!-- /.card-header -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">                          
                            <div class="col-sm-12">
                                <table id="dashboard_ad" class="display" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên cộng tác viên</th>
                                            <th>Tên Công Ty</th>
                                            <th>Ngày bắt đầu làm</th>
                                            <th>user_code</th>
                                            <th>Trạng Thái</th>
                                            <th>Action</th>
                                        </tr>
                                      </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              <!-- /.card-body -->
            </div>
          </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
@section('script')
  <script>
      $(document).ready(function(){
          // alert(123);
         var t = $('#dashboard_ad').DataTable({
            processing : true,
            severSide  : true,
            ajax: {
              url : "{{route('getDataUser')}}"
            },
            columns:[
                { data : 'STT' , name: 'STT'},
                { data : 'fullname' , name: 'fullname'},
                { data : 'org_name' , name: 'org_name'},
                { data : 'created_at' , name: 'created_at'},
                { data : 'user_code' , name: 'user_code'},
                { data:'active', name:'active'},
                { data:'action',name:'action',orderable:false},
               
            ],
              columnDefs: 
              [ {
                  "searchable": false,
                  "orderable": false,
                  "targets": 0
              } ],
          });
          t.on( 'order.dt search.dt', function () {
              t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
              } );
          } ).draw();
      })
  </script>
@endsection