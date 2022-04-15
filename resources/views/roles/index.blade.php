@extends('layouts.master')
@section('title')
    Roles and Permissions
@stop
@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('dashboard.index') !!}">
                <i class="fal fa-home fa-w"></i> Dashboard
            </a>
        </li>
        <li class="breadcrumb-item active">Roles and Permissions</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
@stop

@section('header')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i> Roles and Permissions
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <a href="{!! route('roles.create') !!}" class="text-white btn btn-xl btn-primary waves-effect">
                <i class="fal fa-plus-circle position-left"></i>Create New Role
            </a>
        </div>
    </div>
@stop

@push('footer')
    <script type="text/javascript">
        var rolesDataTable;
        $(document).ready(function () {
            rolesDataTable = $('#roles').dataTable({
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
        });
    </script>
    <script type="text/javascript" src="{!! asset('templates/admin/pages/roles.js?v='.time()) !!}"></script>
@endpush
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>Roles and Permissions</h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table id="roles" class="table table-bordered table-hover table-striped w-100">
                            <thead class="text-uppercase">
                            <tr>
                                <th class="text-center" style="width: 20px;">ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Created By</th>
                                <th style="width: 90px" class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr index="{!! $role->id !!}">
                                    <td class="text-center">{!! $role->id !!}</td>
                                    <td>
                                        <a href="{!! route('roles.edit',$role->id)!!}"
                                           class="font-weight-bold">{!! $role->name !!}</a>
                                    </td>
                                    <td>{!! $role->description !!}</td>
                                    <td>{!! date_from_database($role->created_at) !!}</td>
                                    <td>{!! date_from_database($role->created_at) !!}</td>
                                    <td class="data-controls text-right">
                                        {{-- @if(Auth::user()->hasPermission('roles.destroy'))
                                            <a href="{!! route('roles.destroy',$role->id)!!}"
                                               data-token="{!! csrf_token() !!}"
                                               class="data-delete btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1"
                                               title="Delete"><i
                                                    class="fal fa-times"></i>
                                            </a>
                                        @endif --}}
                                        @if(Auth::user()->hasPermission('roles.edit'))
                                            <a href="{!! route('roles.edit',$role->id)!!}"
                                               class="data-edit btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1"
                                               title="Edit">
                                                <i class="fal fa-pencil"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
