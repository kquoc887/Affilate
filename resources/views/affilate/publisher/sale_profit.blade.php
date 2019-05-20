@extends('affilate.master')
@section('content')
<div class="content-wrapper" style="min-height: 560px;">
     <!-- Content Header (Page header) -->
     <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Sale-Profit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Sale-Profit</li>
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
                    <h2>Khách hàng đã mua hàng</h2>
                    <div class="table-responsive">
                        {{-- Sau này sẽ dùng datatable của laravel để thay thế. --}}
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Tên</th>
                                <th>Địa chỉ Email</th>
                                <th>Hành động</th>
                                <th>Ngày thực hiện thao tác</th>
                                <th>Phần trăm hoa hồng</th>
                            </tr>
                            <tr>
                                <td>Maker lover</td>
                                <td>marker@gmail.com</td>
                                <td>Mua hàng</td>
                                <td>16/05/2019</td>
                                <td>3%</td>
                            </tr>
                                <tr>
                                <td>Stacky went</td>
                                <td>stacky@gmail.com</td>
                                <td>Mua hàng</td>
                                <td>16/05/2019</td>
                                <td>4%</td>
                            </tr>
                            <tr>
                                <td>Movers men</td>
                                <td>movers@gmail.com</td>
                                <td>Mua hàng</td>
                                <td>16/05/2019</td>
                                <td>5%</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection