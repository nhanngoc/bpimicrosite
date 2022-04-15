@extends('layouts.master')

@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="fal fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item">MDG Partner</li>
        <li class="breadcrumb-item active">Listings</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
@stop
@section('title')
    Customer - Vendor
@stop
@section('head')
    <style type="text/css">
        #modalNew .progress {
            background: none;
            font-size: 100%;
            line-height: normal;
            height: auto;
        }
    </style>
@stop
@section('header')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-usd-circle'></i> MDG Partners
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <a href="{!! route('customer-vendor.index') !!}" class="btn btn-sm btn-default position-left">
                <i class="fal fa-clipboard-user position-left"></i> Customer/Vendor
            </a>
            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal"
                    data-target=".example-modal-centered-transparent">
                <i class="fal fa-exchange position-left"></i> Match Data MDG
            </button>
        </div>
    </div>
@stop
@section('content')
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>Last Update &nbsp;<i>{!! date('Y-m-d',strtotime($last->CHDAT)) !!} - {!! $count !!}</i></h2>
        </div>
        <div class="panel-container">
            <div class="panel-content">
                <table id="customer_vendors" class="table table-bordered table-hover table-striped w-100">
                    <thead class="text-uppercase">
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th style="width: 120px;">PARTNER</th>
                        <th>BUKRS</th>
                        <th>BU_SORT1</th>
                        <th>NAME1</th>
                        <th>TEL_NUMBER</th>
                        <th>AKONT_C</th>
                        <th>AKONT_V</th>
                        <th>ZTERM1</th>
                        <th>CRDAT</th>
                        <th>CHDAT</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Center Transparent -->
    <div class="modal fade example-modal-centered-transparent" id="modalNew" tabindex="-1" role="dialog"
         aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="fileUploadForm" method="POST" action="{{ route('mdg_partner.matching') }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Matching MDG Partner Data to Customer/Vendor
                            <small class="m-0">
                                Check all data to matching MDG Data to Customer/Vendor
                            </small>
                        </h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="progress d-none">
                                <i class="fa fa-spin fa-spinner"></i> Processing! Please don't close or resfesh.
                            </div>
                            <div class="message"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Match Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script type="text/javascript">

        var data = [];
        for (var i = 0; i < 100000; i++) {
            var tmp = [];
            for (var i = 0; i < 100000; i++) {
                tmp[i] = 'hue';
            }
            data[i] = tmp;
        }
        (function ($) {
            "use strict";
            $("#modalNew").on('shown.bs.modal', function (e) {
                e.preventDefault();
                /* var buttonSubmit = $("#fileUploadForm").find('button[type=submit]'),
                     buttonCloseModal = $("#fileUploadForm").find('button[type=button]');*/
                $(document).on('click', '#fileUploadForm button[type=submit]', function (evt) {
                    evt.preventDefault();
                    evt.stopPropagation();
                    var buttonSubmit = $(this);
                    var buttonCloseModal = $(this).closest('form').find('button[type=button]');
                    var buttonTextSubmit = buttonSubmit.text();
                    buttonSubmit.prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i>');
                    buttonCloseModal.prop('disabled', true);
                    $('#modalNew .progress').removeClass('d-none').addClass('d-block');
                    $.ajax({
                        type: 'POST',
                        cache: false,
                        url: $(this).closest('form').prop('action'),
                        data: new FormData($(this).closest('form')[0]),
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            if (!data.error) {
                                $('#modalNew .progress').removeClass('d-block').addClass('d-none');
                                $('#modalNew .message').html(data.message);
                            }
                        },
                        error: function (xhr) { // if error occured
                            alert("Error occured.please try again");
                        },
                        complete: function (xhr) {
                            console.log(xhr);
                            buttonSubmit.prop('disabled', false).html(buttonTextSubmit);
                            buttonCloseModal.prop('disabled', false);
                        }
                    });

                    return false;
                });

                /*$('#fileUploadForm').ajaxForm({
                    beforeSend: function () {
                        var percentage = 0;
                        buttonCloseModal.prop('disabled', true);
                        buttonSubmit.prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i>');
                    },
                    uploadProgress: function (event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('#modalNew .progress .progress-bar').css("width", percentage + '%', function () {
                            return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function (xhr) {
                        console.log(xhr);
                        let buttonSubmit = $(this).find('button[type=submit]'),
                            buttonTextSubmit = buttonSubmit.text();
                        buttonSubmit.prop('disabled', false).html(buttonTextSubmit);
                    }
                });*/
            })
            $("#modalNew").on('hidden.bs.modal', function (e) {
                e.preventDefault();
                let percentage = 0;
                $('#modalNew .progress .progress-bar').css("width", percentage + '%', function () {
                    return $(this).attr("aria-valuenow", percentage) + "%";
                })
            })

        })(jQuery);

        $(function () {

            var productDataTable = $('#customer_vendors').dataTable({
                paging: true,
                order: [[0, "desc"]],
                responsive: true,
                fixedHeader: true,
                searching: true,
                processing: true,
                serverSide: true,
                bStateSave: false,
                pageLength: 100,
                searchDelay: 500,
                buttons: [],
                ajax: "{{ route('mdg-partner.index') }}",
                columns: [
                    {data: 'id', name: 'id', sortable: true, className: 'text-center'},
                    {data: 'PARTNER', name: 'PARTNER', sortable: true},
                    {data: 'BUKRS', name: 'BUKRS', sortable: true},
                    {data: 'BU_SORT1', name: 'PARTNER', sortable: true},
                    {data: 'NAME1', name: 'NAME1', sortable: true},
                    {data: 'TEL_NUMBER', name: 'TEL_NUMBER', sortable: true},
                    {data: 'AKONT_C', name: 'AKONT_C', sortable: true},
                    {data: 'AKONT_V', name: 'AKONT_V', sortable: true},
                    {data: 'ZTERM1', name: 'ZTERM1', sortable: true},
                    {data: 'CRDAT', name: 'CRDAT', sortable: true},
                    {data: 'CHDAT', name: 'CHDAT', sortable: true}
                    /*{
                        data: 'action',
                        name: 'action',
                        className: 'text-center data-controls',
                        searchable: false,
                        sortable: false
                    },*/
                ],
            });
            /*$('#customer_vendors thead tr').clone(true).appendTo('#customer_vendors thead');
            $('#customer_vendors thead tr:eq(1) th').each(function (i) {
                var title = $(this).text();
                $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');
                $('input', this).on('keyup change', function () {
                    if (productDataTable.column(i).search() !== this.value) {
                        productDataTable
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            });*/
        })
    </script>
@stop
