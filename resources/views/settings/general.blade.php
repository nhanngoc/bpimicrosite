@extends('layouts.master')
@section('title')
    General Setting
@stop
@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('dashboard.index') !!}">
                <i class="fal fa-home fa-w"></i> Dashboard
            </a>
        </li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
@stop

@section('header')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-cog'></i> General Setting
        </h1>
    </div>
@stop

@section('content')

@stop
