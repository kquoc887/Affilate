@extends('affilate.master')
@section('content')
    <!-- Dashboard -->
    <div class="content-wrapper" style="min-height: 560px;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Thông tin tổng quan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Thông tin tổng quan</li>
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
                           
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h5>Số đơn hàng thành công</h5>
                                <h3>{{$numberOrder}}<sup style="font-size: 20px"></sup></h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check"></i>
                            </div>
                          
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h5>Tổng hoa hồng trong tháng</h5>
                                <h3>{{number_format($totalCommissionOfMonth, 0, ',', '.')}}</h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-credit-card"></i>
                            </div>
                            
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h5>Tổng hoa hồng</h5>

                                <h3>{{number_format($totalCommission, 0, ',', '.')}}</h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                         
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
                    <h2>Đơn hàng gần nhất</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center" id='table-order'>
                             <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tổng tiền đơn hàng</th>
                                    <th>Ngày được thực hiện</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2>Các công ty đã đăng ký tham gia</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center"   id='table-org'>
                            <thead>
                                <tr>
                                    <th>STT</th>
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
    </div>
    <!-- End Dashboard -->    
@endsection
@section('scripts')
<script>
    $(function() {
            var tableOrg = $('#table-org').DataTable({
                language: {
                    "lengthMenu": "Hiển thị _MENU_ cộng tác viên",
                    "info": "Trang hiển tại _PAGE_ Trong _PAGES_",
                },
                processing: true,
                serverSide: true,
                searching: false,
                paging: false,
                length: 5,
                ajax: {
                    url: "{{route('publisher.getDataOrg')}}"
                },
                columns: [
                    {data: 'rownum', name: 'rownum'},
                    { data: 'org_name', name: 'org_name' },
                    { data: 'link_referal', name:'link_referal' },
                    { data:'created_at', name:'created_at' },
                ],
                order: [[ 1, 'desc' ]]
                  
            });
         

            var tableOrder = $('#table-order').DataTable({
                language: {
                    "lengthMenu": "Hiển thị _MENU_ cộng tác viên",
                    "info": "Trang hiển tại _PAGE_ Trong _PAGES_",
                },
                processing: true,
                serverSide: true,
                searching: false,
                paging: false,
                ajax: {
                    url: "{{route('publisher.getNearestOrder')}}"
                },
                columns: [
                    { data: 'rownum', name: 'rownum'},
                    { data: 'order_id', name: 'order_id' },
                    { data: 'total', name:'total' },
                    { data:'created_at', name:'created_at' },
                ],
            });
           
        });
</script>
@endsection