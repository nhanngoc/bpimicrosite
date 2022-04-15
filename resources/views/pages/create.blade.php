@extends('layouts.master')

@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="fal fa-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item">Pages</li>
        <li class="breadcrumb-item active">Create</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
@stop

@section('header')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-chart-area'></i> Pages
        </h1>
    </div>
@stop

@section('content')
    <div class="panel">
        <div class="panel-hdr">
            <h2>New Page</h2>
        </div>
        <div class="page-footer">
            ss
        </div>
    </div>
@stop
