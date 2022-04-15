@extends('layouts.master')

@php 
    $title = "Customer";
@endphp

@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="fal fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item">{{ $title }}</li>
        <li class="breadcrumb-item active">Listings</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
@stop

@section('header')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-usd-circle'></i> Listings
        </h1>
       
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        var productDataTable;
        $(function () {
            let $dataTable = $('#dataTable');
            productDataTable = $dataTable.dataTable({
                order: [[0, "desc"]],
                responsive: true,
                dom:
                    "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    // {
                    //     extend: 'csvHtml5',
                    //     text: 'CSV',
                    //     titleAttr: 'Generate CSV',
                    //     className: 'btn-outline-default'
                    // },
                    // {
                    //     extend: 'print',
                    //     text: 'Print',
                    //     titleAttr: 'Print Table',
                    //     className: 'btn-outline-default'
                    // }

                ]
            });

            $('#dataTable tbody').on('click', '.data-controls a.data-delete', function () {
                var thisRow = $(this).parents('tr[role=row]');
                var thisChild = thisRow.hasClass('parent') ? thisRow.next('tr.child') : false;
                var id = thisRow.attr('index');
                if (window.confirm('Do you really want to delete this record?')) {
                    $.ajax({
                        'url': $(this).attr('href'),
                        'type': 'POST',
                        'data': {'_method': 'DELETE'},
                        'async': true,
                        'dataType': 'json',
                    }).done(function (data, statusText, xhr) {
                        if (data.status === 200) {
                            thisRow.remove();
                            if (thisChild) {
                                thisChild.remove();
                            }
                            toastr["success"](data.msg);
                        } else {
                            toastr["danger"](data.msg);
                        }
                    }).fail(function (data) {
                        $.jGrowl('Quy trình xóa dữ liệu gặp sự cố (mã ' + data.status + '), vui lòng quay lại sau', {
                            theme: 'bg-danger',
                            position: 'bottom-right'
                        });
                    });
                }
                return false;
            });
        })
    </script>
@stop
@section('content')
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>{{ $title }}s</h2>
        </div>
        <div class="panel-container">
            <div class="panel-content">
                <table id="dataTable" class="table table-bordered table-hover table-striped w-100">
                    <thead class="text-uppercase">
                    <tr>
                        <th class="text-center" style="width: 20px;">ID</th>
                        <th>Giới Tính</th>
                        <th>Họ Tên</th>
                        <th>Độ tuổi</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Tỉnh</th>
                        <th>Mã cửa hàng</th>
                        <!-- <th class="text-right" style="width:100px">Actions</th> -->
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

                            {{--<td class="data-controls text-right">
                            
                                <a href="#"
                                   class="data-edit btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1"
                                   title="Edit">
                                    <i class="fal fa-pencil"></i>
                                </a>
                                <a href="#"
                                   class="data-edit btn btn-sm btn-icon btn-outline-warning rounded-circle mr-1"
                                   title="Detail">
                                    <i class="fal fa-eye"></i>
                                </a>
                            
                                 <a href="#"
                                    data-token="{!! csrf_token()!!}"
                                    class="data-delete btn btn-sm btn-icon btn-outline-success rounded-circle mr-1"
                                    title="Delete">
                                     <i class="fal fa-trash"></i>
                                 </a> --}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
