@extends('affilate.master')
@section('content')
<div class="content-wrapper" style="min-height: 560px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Payment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Payment</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <h2></h2>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        {{-- <tr>
                            <th>Tên</th>
                            <th>Địa chỉ Email</th>
                            <th>Hành động</th>
                            <th>Ngày thực hiện thao tác</th>
                            <th>Phần trăm hoa hồng</th>
                        </tr> --}}
                      
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection