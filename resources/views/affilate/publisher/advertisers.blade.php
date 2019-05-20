@extends('affilate.master')
@section('content')
<div class="content-wrapper" style="min-height: 560px;">
<!-- Content Header (Page header) -->
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Advertisers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Advertisers</li>
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
                <h2>Danh sách các Advertiser</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="listAdvertiser">
                        <tr>
                            <th>Stt</th>
                            <th>Tên công ty</th>
                            <th>Địa chỉ Email</th>
                            <th>Hành động</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection