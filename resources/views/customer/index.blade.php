@extends('layouts.master')
@section('content')

<!-- start  -->
<div class="row">
    <div class="col-12">
        <div>
            <h4 class="header-title mb-3">Customer</h4>
        </div>
        <!-- <div class="them" style="text-align: right;">
            <a name="" id="" class="btn btn-primary btn-sm" style="text-align: right;" href="" role="button" title="create">create
            </a>
        </div> -->
    </div>
</div>
<!-- end row -->
<div class="panel-hdr">
    <h2>All Customer</h2>
</div>
<div class="row">
    <div class="col-12">   
        <div class="mt-5">
           
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 20px;">ID</th>
                        <th>Giới Tính</th>
                        <th>Họ Tên</th>
                        <th>Độ tuổi</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Tỉnh</th>
                        <th>Mã cửa hàng</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                        <tr index="{!! $item->id !!}">
                            <td>{!! $item->id !!}</td>
                            <td>{!! $item->sex !!}</td>
                            <td>{!! $item->last_name . ' ' .$item->first_name !!}</td>
                            <td>{!! $item->age_range !!}</td>
                            <td>{!! $item->email !!}</td>
                            <td>{!! $item->contact_number !!}</td>
                            <td>{!! $item->province !!}</td>
                            <td>{!! $item->redemption_code !!}</td>
                        </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <!-- end -->
    </div>
</div>
<!-- end row -->
@endsection