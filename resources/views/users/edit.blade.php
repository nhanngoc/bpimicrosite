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
        <li class="breadcrumb-item">
            <a href="{!! route('users.index') !!}">Users</a>
        </li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
@stop

@section('header')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i> Users
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <a href="{!! route('users.create') !!}" class="btn btn-xl btn-primary
            waves-effect">New User</a>
        </div>
    </div>
@stop

@section('content')
    @includeIf('elements.errors.danger')
    {!! Form::model($user,[
        'id'     => 'fUsers',
        'method' => 'PUT',
        'route'  => ['users.edit', $user->id]
    ]) !!}
    {!! Form::hidden('id',$user->id) !!}
    <div class="panel panel-collapsed">
        <div class="panel-hdr text-success">
            <h2>Add New User</h2>
        </div>
        <div class="panel-container">
            <div class="panel-content">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label class="form-label" for="first_name">First Name <span
                                    class="text-danger">*</span></label>
                            {!! Form::text('first_name', null, [
                                'class'=> 'form-control',
                                'id'   => 'first_name'
                             ]) !!}
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">Phone</label>
                            {!! Form::text('phone', null, [
                                'class'=> 'form-control',
                                'id'   => 'phone'
                             ]) !!}
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label class="form-label" for="last_name">Last Name <span
                                    class="text-danger">*</span></label>
                            {!! Form::text('last_name', null, [
                                'class'=> 'form-control',
                                'id'   => 'last_name'
                             ]) !!}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                            {!! Form::email('email', null, [
                                'class'=> 'form-control',
                                'id'   => 'email'
                             ]) !!}
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xl-12 pt-3">
                        <div class="form-group">
                            <label class="form-label text-uppercase" for="summary">Role</label>
                            {!! Form::select('role_id', $roles, $user->roles->first()->id, [
                                'class' => 'form-control select2-basic',
                            ]) !!}
                        </div>
                    </div>
                </div>
            </div>
            {{--Action--}}
            <div class="panel-footer p-3">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="group-action float-left">
                            <a href="{!! route('users.index') !!}" class="btn btn-danger">
                                <i class="icon-cancel-circle2 position-left"></i>Cancel
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="group-action float-right">
                            {!! Form::button('<i class="fal fa-save fa-fw"></i> Save',[
                                'type'  =>  'submit',
                                'name'  =>  'submit',
                                'value' =>  'save',
                                'class' =>  'btn btn-success waves-effect waves-themed'
                            ]) !!}
                            {!! Form::button('<i class="fal fa-save fa-fw"></i> Save & Edit',[
                                'type'  =>  'submit',
                                'name'  =>  'submit',
                                'value' =>  'apply',
                                'class' =>  'btn btn-success waves-themed'
                            ]) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            let companySelect = $('#company_id');
            companySelect.select2();

            companySelect.change(function(value) {
                let companyId = $('#company_id option:selected').val();
                $('#department_id option').remove();
                $('#department_id').append("<option value='0'>Select Department</option>");
                $.ajax({
                    url: baseDomain + "/company-code/departments/" + companyId,
                    success: function(results) {
                        Object.entries(results).forEach(function(data) {
                            $('#department_id').append("<option value='" + data[1].id +"'> " + data[1].name + "</option>");
                        });
                    }
                });
            });
            $('#department_id').select2();
            $('#user_group_id').select2();
        });
    </script>
@stop