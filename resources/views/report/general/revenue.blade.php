@extends('layouts.master')

@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Web Application</a></li>
        <li class="breadcrumb-item active">General Report</li>
        <li class="breadcrumb-item">Revenue</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
@stop

@section('header')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-file-excel position-left text-black-50'></i>Report Revenue
        </h1>
    </div>
@stop

@section('content')
    {!! Form::open([
        'method' => 'GET',
        'class'  => 'form',
        'id'     => 'fGeneralReport',
        'route'  => 'general_report.revenue'
    ]) !!}
    <div class="panel">
        <div class="panel-hdr">
            <h2>Report Heading</h2>
        </div>
        <div class="panel-container">
            <div class="panel-content">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-2 col-md-6">
                            <label for="end_date" class="form-label required">PO/SO</label>
                            {!! Form::select('report_type', [
                                'SO' => 'Sale Orders',
                                'PO' => 'Purchase Orders'
                            ], request()->input('report_type') ?? 'SO', [
                                    'class'         => 'form-control select2-basic',
                                    'id'            => 'report_type',
                            ]) !!}
                            @if ($errors->has('report_type'))
                                <span class="text-danger">{{ $errors->first('report_type') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label for="start_date" class="form-label">Start Date</label>
                            <div class="input-group">
                                {!! Form::text('start_date', request()->input('start_date') ?? null, [
                                    'class'         => 'form-control',
                                    'id'            => 'start_date',
                                    'placeholder'   => 'Starting Date'
                                ]) !!}
                                <div class="input-group-append">
                                    <span class="input-group-text fs-xl"><i class="fal fa-calendar-plus"></i></span>
                                </div>
                            </div>
                            @if ($errors->has('start_date'))
                                <span class="text-danger">{{ $errors->first('start_date') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label for="end_date" class="form-label">End Date</label>
                            <div class="input-group">
                                {!! Form::text('end_date', request()->input('end_date') ?? null, [
                                    'class'         => 'form-control',
                                    'id'            => 'end_date',
                                    'placeholder'   => 'End Date'
                                ]) !!}
                                <div class="input-group-append">
                                    <span class="input-group-text fs-xl"><i class="fal fa-calendar-plus"></i></span>
                                </div>
                            </div>
                            @if ($errors->has('end_date'))
                                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-2 col-md-6">
                            <label for="end_date" class="form-label">Trade Type</label>
                            {!! Form::select('trade_type_id', $tradeTypes, request()->input('trade_type_id') ?? null, [
                                    'class'         => 'form-control select2-search',
                                    'id'            => 'trade_type_id',
                                    'data-route'    => route('ajax-general.get-business-type')
                            ]) !!}
                            @if ($errors->has('trade_type_id'))
                                <span class="text-danger">{{ $errors->first('trade_type_id') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-10 col-lg-10">
                            <label for="end_date" class="form-label">Business Type</label>
                            {!! Form::select('business_type_id[]',$businessTypes, request()->input('business_type_id') ?? null, [
                                'class'       => 'form-control select2-search',
                                'multiple'    => true,
                                'id'          => 'business_type_id'
                            ]) !!}
                            @if ($errors->has('business_type_id'))
                                <span class="text-danger">{{ $errors->first('business_type_id') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-action float-right">
                                {!! Form::button('<i class="fas fa-file-excel"></i> Export Excel',[
                                    'type'  =>  'submit',
                                    'name'  =>  'submit',
                                    'value' =>  'save',
                                    'class' =>  'btn btn-sm btn-outline-primary'
                                ]) !!}
                            </div>
                            <div class="group-action float-right position-left">
                                {!! Form::button('<i class="fas fa-save"></i> Get Data',[
                                    'type'  =>  'submit',
                                    'class' =>  'btn btn-sm btn-outline-primary'
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <div class="panel">
        <div class="panel-hdr">
            <h2>Show Data</h2>
        </div>
        <div class="panel-container">
            <div class="panel-content">
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        $(function () {
            var controls = {
                leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
                rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
            }
            var runDatePicker = function () {
                if ($('#start_date').length > 0) {
                    $('#start_date').datepicker({
                        format: 'yyyy-mm-dd',
                        orientation: "bottom right",
                        todayHighlight: true,
                        templates: controls,
                        autoclose: true,
                    });
                }
                if ($('#end_date').length > 0) {
                    $('#end_date').datepicker({
                        format: 'yyyy-mm-dd',
                        orientation: "bottom right",
                        todayHighlight: true,
                        templates: controls,
                        autoclose: true,
                    });
                }
            }
            $("#item_numbers").select2({
                placeholder: "Select multiple item number so ...",
                allowClear: true
            });
            runDatePicker();


            var getBusinessType = function (source, tradeType) {
                if (tradeType !== undefined && tradeType !== "") {
                    $.ajax({
                        'url': source,
                        'type': 'PUT',
                        'data': {'trade': tradeType},
                        'async': true,
                        'dataType': 'json',
                        'success': function (response) {
                            if (!response.error) {
                                $("select#business_type_id").html('');
                                if (response.data.totals > 0) {
                                    $("select#business_type_id").html(response.data.option)
                                }
                            }
                        }
                    });
                }
                return false;
            }
            getBusinessType($("#trade_type_id option:selected").val());

            $(document).on('change', 'select#trade_type_id', function (evt) {
                evt.preventDefault();
                let tradeTypeVal = $(this).val();
                let source = $(this).data('route');
                if (tradeTypeVal !== undefined && tradeTypeVal !== "") {
                    getBusinessType(source, tradeTypeVal);
                }
            });
        })
    </script>
@stop
