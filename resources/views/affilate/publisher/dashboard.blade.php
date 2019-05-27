@extends('affilate.master')
@section('content')
    <!-- Dashboard -->

    
    <div class="content-wrapper" style="min-height: 560px;">
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
                            <li class="breadcrumb-item active">General Infomation</li>
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
                                <h5>Số lần link được click</h5>
        
                                <h3>0</h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-eye"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h5>Số đơn hàng thành công</h5>
                                <h3>0 <sup style="font-size: 20px">%</sup></h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                        <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h5>Tổng hoa hồng</h5>

                                <h3>0</h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                        <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h5>Tổng hoa hồng trong tháng</h5>

                                <h3>0</h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-credit-card"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                {{-- end small boxes --}}
            </div>
        </section>

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-12">
                    <h2>Khách hàng thao tác gần nhất</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Tên</th>
                                <th>Địa chỉ Email</th>
                                <th>Hành động</th>
                                <th>Ngày thực hiện thao tác</th>
                            </tr>
                            <tr>
                                <td>Maker lover</td>
                                <td>marker@gmail.com</td>
                                <td>Xem</td>
                                <td>16/05/2019</td>
                            </tr>
                             <tr>
                                <td>Stacky went</td>
                                <td>stacky@gmail.com</td>
                                <td>Mua hàng</td>
                                <td>16/05/2019</td>
                            </tr>
                            <tr>
                                <td>Movers men</td>
                                <td>movers@gmail.com</td>
                                <td>Xem</td>
                                <td>16/05/2019</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="col-12">
                <h2>Các công ty đã đăng ký tham gia</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="table-org">
                       <thead>
                            <tr>
                                <th></th>
                                <th>Tên</th>
                                <th>Link giới thiệu</th>
                                <th>Ngày đăng ký<th>
                            </tr>
                       </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Dashboard -->    
@endsection
@section('scripts')
<script>
    $(function() {
            var t = $('#table-org').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{route('publisher.getDataOrg')}}"
                },
                columns: [
                    { data: 'stt'},
                    { data: 'org_name', name: 'org_name' },
                    { data: 'link_referal', name:'link_referal' },
                    { data:'created_at', name:'created_at' },
                ],
                columnDefs: [ {
                    searchable: false,
                    orderable: false,
                    targets: 0
                } ],
                order: [[ 1, 'asc' ]]
                  
            });
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        });
</script>
@endsection