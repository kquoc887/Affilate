@extends('affilate.master')
@section('content')
<div class="content-wrapper" style="min-height: 560px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Hoa hồng </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Hoa hồng</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="cotainer-fluid region-search text-center" >
        <label for="toDate">Từ ngày:</label>
        <input type="date" id="inputFromdate">
        <label for="toDate">Đến ngày:</label>
        <input type="date" id="inputToDate">
        <button type="button" class="btn btn-success btn-flat" id="btn-search" value='payment'>Tìm kiếm</button>
        <button type="button" class="btn btn-success btn-flat" id="btn-search-all" value='payment-all'>Tìm Tất cả</button>
    </div>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <h2></h2>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="table-payment">
                       <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã đơn hàng</th>
                                <th>Tổng tiền đơn hàng</th>
                                <th>Tiền được thưởng</th>
                                <th>Ngày được duyệt</th>
                                <th>Trạng thái</th>
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
        $(document).ready(function () {
            var tablePayment = $('#table-payment').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                language: {
                    "lengthMenu": "Hiển thị _MENU_ cộng tác viên",
                    "info": "Trang hiển tại _PAGE_ Trong _PAGES_",
                    "search" : "Tìm kiếm:",
                    "paginate": {
                   
                        "next":       "Tiếp theo",
                        "previous":   "Về trước"
                    },
                },
                ajax: {
                    url: route('publisher.getOrderSuccess')
                },
                columns: [
                    { data: 'rownum', name: 'rownum'},
                    { data: 'order_id', name: 'order_id' },
                    { data: 'total', name:'total' },
                    { data: 'discount', name: 'discount'},
                    { data: 'created_at', name:'created_at' },
                    { data: 'status', name: 'status'},
                ],
                order: [[ 1, 'asc' ]]
            });
        });
    </script>
@endsection