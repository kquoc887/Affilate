@extends('affilate.master')
@section('content')
<div class="content-wrapper" style="min-height: 560px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh sách các công ty</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách các công ty</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    {{-- <div class="cotainer-fluid region-search">
        <form action="#" method="POST" class="offset-md-9 form-inline">
            <div class="form-group">
                <button type="button" class="btn btn-success btn-flat btn-search" id="addColumnSearch">+</button>
                <input type="text" class="form-control" placeholder="Vui lòng điền thông tin cần tìm">
                <button type="button" class="btn btn-success btn-flat btn-search">Tìm kiếm</button>
                <button type="submit" class="btn btn-success btn-flat btn-search" >Tất cả</button>
            </div>
        </form>
    </div> --}}
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover text-center" id="advertiser-table">
                        <thead>
                            <tr>
                               
                                <th>Tên công ty</th>
                                <th>Địa chỉ</th>
                                <th>Website</th>
                                <th>Hành động</th>    
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
            var table_ad = $('#advertiser-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ordering:true,
                info: true,
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
                ajax: {
                    url:"{{route('publisher.getAdvertiser')}}",
                },
                columns: [
                    { data: 'org_name' },
                    { data: 'org_address' },
                    { data: 'org_uri'},
                    { data:'action'}
                ],
                order: [[ 3, 'ASC' ]]
            });
        });
    </script>
@endsection