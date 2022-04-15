@extends('layouts.master')
@section('title')
    Users
@stop
@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('dashboard.index') !!}">
                <i class="fal fa-home fa-w"></i> Dashboard
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{!! route('roles.index') !!}">Roles and Permissions</a>
        </li>
        <li class="breadcrumb-item">Users</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
@stop

@section('header')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-user-circle'></i> Users
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <a href="{!! route('users.create') !!}" class="btn btn-xl text-white btn-primary waves-effect">
                <i class="fal fa-plus-circle position-left"></i>New User
            </a>
        </div>
    </div>
@stop
@push('footer')
    <script type="text/javascript">
        var userDataTable;
        $(document).ready(function () {
            userDataTable = $('#users').dataTable({
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
                    //     text: 'Print Members',
                    //     titleAttr: 'Print Table',
                    //     className: 'btn-outline-default'
                    // }

                ]
            });
            // Deleting for one manufacturer
            $('#users tbody').on('click', '.data-controls a.data-delete', function () {
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
        });
    </script>
@endpush
@section('content')
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>All User</h2>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                <table id="users" class="table table-bordered table-hover table-striped w-100">
                    <thead class="text-uppercase">
                    <tr>
                        <th class="text-center" style="width: 20px;">ID</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Is Supper?</th>
                        <th class="text-center">Created At</th>
                        <th class="text-right" style="width:60px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr index="{!! $user->id !!}">
                            <td class="text-center">{!! $user->id !!}</td>
                            <td>{!! $user->email !!}</td>
                            <td>
                                <a href="{!! route('roles.edit', $user->getRoleByField($user->id, 'id')) !!}">
                                    {!! $user->getRoleByField($user->id, 'name') !!}
                                </a>
                            </td>
                            <td>
                                {!! $user->super_user ? __('Yes') : __('No'); !!}
                            </td>
                            <td class="text-center">{!! date_from_database($user->created_at) !!}</td>
                            <td class="data-controls text-center">
                                <a href="{!! route('users.edit',$user->id)!!}"
                                   class="data-edit btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1"
                                   title="Edit">
                                    <i class="fal fa-pencil"></i>
                                </a>
                                {{-- <a href="{!! route('users.destroy',$user->id)!!}"
                                   data-token="{!! csrf_token()!!}"
                                   class="data-delete btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1"
                                   title="Delete">
                                    <i class="fal fa-times"></i>
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
