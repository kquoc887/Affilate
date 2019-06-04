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
        <div class="cotainer-fluid region-search text-center" >
            <label for="toDate">Từ ngày:</label>
            <input type="date" id="inputFromdate">
            <label for="toDate">Đến ngày:</label>
            <input type="date" id="inputToDate">
            <button type="button" class="btn btn-success btn-flat" id="btn-search">Tìm kiếm</button>
            <button type="button" class="btn btn-success btn-flat" id="btn-search-all">Tìm Tất cả</button>
        </div>
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-12">
                    <h2>Thông tin các đơn hàng</h2>
                    <div class="table-responsive">
                        {{-- Sau này sẽ dùng datatable của laravel để thay thế. --}}
                        <table class="table table-striped  table-bordered table-hover display"  id="table-sale">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Tiền hoa hồng</th>
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
                searching: true,
                language: {
                    "lengthMenu": "Hiển thị _MENU_ cộng tác viên",
                    "info": "Trang hiển tại _PAGE_ Trong _PAGES_",
                    "search" : "Tìm kiếm:",
                },
                ajax: {
                    url: "{{route('publisher.getDataOrder')}}"
                },
                columns: [
                    { data: 'rownum', name: 'rownum'},
                    { data: 'order_id', name: 'order_id' },
                    { data: 'total', name:'total' },
                    { data: 'discount', name: 'discount'},
                    { data: 'created_at', name:'created_at' },
                ],
                columnDefs: [ {
                    searchable: false,
                    orderable: false,
                    targets: 0
                } ],
                order: [[ 1, 'asc' ]]
            });

        });
    </script>
@endsection