@extends('affilate.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tình Hình Chung</h1>
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
                <!-- {{-- sử dụng bảng saleprofit --}} -->
                <h3>{{$total_order}}</h3>
                <p>Số lượt thanh toán</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <!-- {{-- sử dụng bảng payment --}} -->
              <h3>{{$percent_growup}}<sup style="font-size: 20px">%</sup></h3>

                <p>Phần trăm tăng trưởng</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
           
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <!-- {{-- sử dụng dữ liệu bảng user_link --}} -->
              <h3>{{$total_pub}}</h3>
                <p>Số lượng cộng tác viên</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>0</h3>
                <p>Lượt Khách xem website</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
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
                            <div class="table-responsive ">
                                <table id="dashboard_ad" class="display table table-bordered text-center" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên cộng tác viên</th>
                                            <th>Email</th>
                                            <th>Ngày bắt đầu làm</th>
                                            <th>Trạng Thái</th>
                                            <th>Hành Động</th>
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
    {{-- modal confirm --}}
    <div class="modal" tabindex="-1" role="dialog" id="modal-confirm">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Khóa Cộng Tác Viên</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Bạn có chắc chắn muốn khóa cộng tác viên này?</p>
          </div>
          <div class="modal-footer">
            <button type="button" id="ok_button" class="btn btn-primary">Đồng ý</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
          </div>
        </div>
      </div>
    </div>
    {{-- end modal confirm --}}
    <!-- /.content -->
  </div>
  @endsection

@section('scripts')
  <script>
      $(document).ready(function(){
          
         var t = $('#dashboard_ad').DataTable({
            language: {
              "lengthMenu": "Hiển thị _MENU_ đơn hàng",
                    "info": "Trang hiển tại _PAGE_ Trong _PAGES_",
                    "emptyTable":     "Không có dữ liệu",
                    "paginate": {
                        "next":       "Tiếp theo",
                        "previous":   "Về trước"
                    },
                    "infoEmpty":      "",
                    "infoFiltered":   "",
                    "zeroRecords": "Không tìm thấy dữ liệu",
                    "search":         "Tìm Kiếm:",
                    "loadingRecords": "Đang tải...",
                    "processing":     "Đang tiến hành...",
             },
            processing : true,
            severSide  : true,
            ajax: {
              url : "{{route('getDataUser')}}"
            },
            columns:[
                { data : 'STT' , name: 'STT'},
                { data : 'fullname' , name: 'fullname'},
                { data : 'email' , name: 'email'},
                { data : 'created_at', name: 'created_at'},
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
          
      });
      var  id_user;
      var  action;
      $(document).on('click','.btn_lock',function(){
             
                id_user = $(this).attr('id');
                action = $(this).attr('name');
                $('#modal-confirm').modal('show');
                $('#ok_button').on('click',function(){             
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                $.ajax({
                  url : route('lockPub'),  
                  type : "post",
                  dataType: 'json',
                  data: {
                        'id_user' : id_user,
                        'action' : action
                    },
                    success: function(data){
                      if (data.message == 'success') {
                        $('#modal-confirm').modal('hide');
                        $('#dashboard_ad').DataTable().ajax.reload();
                      }
                    },
                })
              })            
      })
     
      $(document).on('click','.btn_unlock',function(){
             
            id_user = $(this).attr('id');
            action = $(this).attr('name');          
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
              url : route('lockPub'),  
              type : "post",
              dataType: 'json',
              data: {
                    'id_user' : id_user,
                    'action' : action
                },
                success: function(data){
                  
                  if (data.message == 'success') {
                    $('#dashboard_ad').DataTable().ajax.reload();
                  }
                 
                },
            })      
        })
        var runtime =  setInterval(function(){ 
          
          $.ajax({
            url : route('realTimeNotify'),  
              type : "get",
              dataType: 'json',
              data: {
                   numberNotify: $('.badge').text(),
                },
                success: function(data){

                  if (data.notify && data.notify.length >0) {  
                    $('.badge').text(data.notify.length);
                    $('.notify-header').text(data.notify.length + 'Notifications');
                    $('.list-notify').empty();
                    for (var index = 0; index < data.notify.length; index++) {
                      var div = '<div class="dropdown-divider"></div>';
                      var button = '<button id="clickNotifi" class="btn btn-default"><i>Đơn hàng mới-Mã đơn hàng:'+ data.notify[index].data.Order_ID + '</i>';
                          button += '<span class="float-right text-muted text-sm">'+ data.notify[index].data.Created_at +'</span>'
                          button += '<input type="hidden" id="hidden-read" value="' + data.notify[index].id + '"></button>';
                          $('.list-notify').append('<li>'+ div + button +'</li>');
                    }
                  }
                },
            });
        }, 60000);
  </script>
@endsection