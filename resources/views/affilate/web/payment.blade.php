@extends('affilate.master')
@section('content')
<div class="content-wrapper" style="min-height: 445px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Hoa Hồng Cần Trả Theo Tháng</h1>
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
                  <h3 class="card-title">Hoa hồng cần trả cho từng cộng tác viên</h3>
                </div>
                <!-- /.card-header -->
                <div class="cotainer-fluid region-search" style="padding-top:5%; padding-right:5%">
                    <form action="#" method="POST" class="offset-md-9 form-inline">
                        <div class="form-group">
                            <h5>Tháng cần tìm:</h5>
                            <select name="selectMonth">
                              @for($i=1; $i<=12; $i++)
                                {!!'<option value="'. $i . '">'.$i."</option>"!!}
                              @endfor
                            </select>
                            <button type="button" id="btnSearch-month" class="btn btn-success btn-flat btn-search">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                      <table id="payment_ad" class="table table-bordered" class="display" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th>STT</th>
                                  <th>Tên cộng tác viên</th>
                                  <th>Tổng doanh thu</th>
                                  <th>Phần trăm hoa hồng</th>
                                  <th>Thành tiền</th>

                                  <th>Hành Động</th>

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
        var t = $('#payment_ad').DataTable({
            searching: false,
            language: {
                "lengthMenu": "Hiển thị _MENU_ đơn hàng",
                "info": "Trang hiển tại _PAGE_ Trong _PAGES_",
            },
          processing : true,
          severSide: true,
          ajax:{
              url: route('getDataPayment')
          },
          columns: [
                {data:'STT',name:'STT'},
                {data:'fullname',name:'fullname'},
                {data:'totalOrder',name:'totalOrder'},
                {data:'commision',name : 'commision'},
                {data:'moneyCommission',name:'moneyCommission'},
                {data:'action',name:'action'},
              
          ],
          columnDefs: [ {
                      "searchable": false,
                      "orderable": false,
                      "targets": 0
              } ],
      })
      t.on( 'order.dt search.dt', function () {
                  t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                      cell.innerHTML = i+1;
                  } );
              } ).draw();

  })
</script>

@endsection