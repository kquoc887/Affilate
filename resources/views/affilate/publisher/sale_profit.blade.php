@extends('affilate.master')
@section('content')
<div class="content-wrapper" style="min-height: 560px;">
     <!-- Content Header (Page header) -->
     <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Lợi nhuận bán hàng</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Lợi nhuận bán hàng</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="cotainer-fluid region-search">
            <form action="#" method="POST" class="offset-md-9 form-inline">
                <div class="form-group">
                    <button type="button" class="btn btn-success btn-flat btn-search" id="addColumnSearch">+</button>
                    <input type="text" class="form-control" placeholder="Vui lòng điền thông tin cần tìm">
                    <button type="button" class="btn btn-success btn-flat btn-search">Tìm kiếm</button>
                    <button type="submit" class="btn btn-success btn-flat btn-search" >Tất cả</button>
                </div>
            </form>
        </div>
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-12">
                    <h2>Thông tin các đơn hàng</h2>
                    <div class="table-responsive">
                        {{-- Sau này sẽ dùng datatable của laravel để thay thế. --}}
                        <table class="table table-striped table-hover" id="table-sale">

                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày thành công</th>
                                </tr>    
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
@section('scripts')
    <script>
        $(function() {

            var tableSale = $('#table-sale').DataTable({

                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{route('publisher.getDataOrder')}}"
                },
                columns: [
                    { data: 'stt'},
                    { data: 'order_id', name: 'order_id' },
                    { data: 'total', name:'total' },
                    { data:'created_at', name:'created_at' },
                ],
                columnDefs: [ {
                    searchable: false,
                    orderable: false,
                    targets: 0
                } ],
                order: [[ 1, 'asc' ]]
            });

            tableSale.on( 'order.dt search.dt', function () {
                tableSale.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        });
    </script>
@endsection