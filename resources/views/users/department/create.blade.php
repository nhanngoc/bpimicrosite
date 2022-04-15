@extends('layouts.master')
@php 
    $title = "Department";
@endphp
@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="fal fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item">{{ $title }}</li>
        <li class="breadcrumb-item active">Create new</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
@stop

@section('header')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-user-alien'></i> {{ $title }}
        </h1>
    </div>
@stop

@section('head')
    <style type="text/css">
        .form-group {
            margin-bottom: .8rem;
        }
    </style>
@stop

@section('javascript')
    
@stop


@section('content')
    @includeIf('elements.errors.danger')
    {!! Form::model($repository,[
       'id'     => 'fDepartment',
       'method' => 'POST',
       'route'  => 'department.create'
   ]) !!}
    <div class="panel panel-collapsed">
        <div class="panel-hdr text-success">
            <h2>Add {{ $title }}</h2>
        </div>
        <div class="panel-container">
            <div class="panel-content">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <label class="form-label" for="name">{{ $title }} <span
                                    class="text-danger">*</span></label>
                            {!! Form::text('name', null, [
                                'class'=> 'form-control',
                                'id'   => 'name'
                            ]) !!}
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label class="form-label" for="description">Description</label>
                            {!! Form::text('description', null, [
                                'class'=> 'form-control',
                                'id'   => 'description'
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
                            <a href="{!! route('department.index') !!}" class="btn btn-danger">
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
                            {{-- {!! Form::button('<i class="fal fa-save fa-fw"></i> Draft',[
                                'type'  =>  'submit',
                                'name'  =>  'submit',
                                'value' =>  'apply',
                                'class' =>  'btn btn-success waves-themed'
                            ]) !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@stop
