@extends('affilate.master')
@section('content')
<div class="content-wrapper" style="min-height: 445px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sale Profit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Lợi nhuận của từng cộng tác viên</h3>
                </div>
                <!-- /.card-header -->
                <div class="cotainer-fluid region-search" style="padding-top:5%; padding-right:2%">
                    <form action="#" method="POST" class="offset-md-9 form-inline">
                        <div class="form-group">
                            <button type="button" class="btn btn-success btn-flat btn-search" id="addColumnSearch">+</button>
                            <input type="text" class="form-control" placeholder="Vui lòng điền thông tin cần tìm">
                            <button type="button" class="btn btn-success btn-flat btn-search">Tìm kiếm</button>
                            <button type="submit" class="btn btn-success btn-flat btn-search" >Tất cả</button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                      <table id="sale_profit_ad" class="table table-bordered" class="display" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th>STT</th>
                                  <th>Tên cộng tác viên</th>
                                  <th>Mã đơn hàng</th>
                                  <th>Số tiền</th>
                                  <th>Ngày thanh toán</th>
                                  <th>Hành động</th>
                              </tr>
                          </thead>
                      </table>
                  </div>
                </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    
  </section>
    <!-- /.content -->
</div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
     var t = $('#sale_profit_ad').DataTable({
        searching: false,
        language: {
            "lengthMenu": "Hiển thị _MENU_ đơn hàng"
        },
       processing : true,
       severSide: true,
       ajax:{
          url: "{{route('getDataSaleProfit')}}"
       },
       columns: [
            {data:'STT',name:'STT'},
            {data:'fullname',name:'fullname'},
            {data:'order_id',name:'order_id'},
            {data:'total',name:'total'},
            {data:'created_at',name : 'created_at'},
            {data:'action',name:'action'},
       ],
       columnDefs: [ {
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