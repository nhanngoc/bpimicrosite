@extends('layouts.master')
@section('title')
    Roles and Permissions
@stop

@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('dashboard.index') !!}">
                <i class="fal fa-home"></i> Dashboard
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{!! route('roles.index') !!}">
                Roles and Permissions
            </a>
        </li>
        <li class="breadcrumb-item active">Create new</li>
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
    </div>
@stop

@section('head')
    <style type="text/css">
        .hrv-checkbox,
        input[type=checkbox] {
            position: relative;
            top: 0;
            margin: 0 .5rem 0 0;
            cursor: pointer
        }

        .hrv-checkbox:before,
        input[type=checkbox]:not(.hrv-checkbox):before {
            transition: -webkit-transform .4s cubic-bezier(.45, 1.8, .5, .75);
            transition: transform .4s cubic-bezier(.45, 1.8, .5, .75);
            transition: transform .4s cubic-bezier(.45, 1.8, .5, .75), -webkit-transform .4s cubic-bezier(.45, 1.8, .5, .75);
            -webkit-transform: rotate(-45deg) scale(0);
            transform: rotate(-45deg) scale(0);
            content: "";
            position: absolute;
            left: 2px;
            right: 0;
            top: .2em;
            margin: auto;
            z-index: 1;
            width: 10px;
            height: 5px;
            border-color: #58b3f0;
            border-style: none none solid solid;
            border-width: 2px
        }

        .hrv-checkbox:checked:before,
        input[type=checkbox]:not(.hrv-checkbox):checked:before {
            -webkit-transform: rotate(-45deg) scale(1);
            transform: rotate(-45deg) scale(1)
        }

        .hrv-checkbox:after,
        input[type=checkbox]:not(.hrv-checkbox):after {
            content: "";
            position: absolute;
            left: -1px;
            right: 0;
            bottom: 0;
            top: 0;
            margin: auto;
            width: 16px;
            height: 16px;
            background: #fff;
            border: 1px solid #c4cdd5;
            cursor: pointer;
            border-radius: 3px
        }

        .hrv-checkbox:checked:after,
        input[type=checkbox]:not(.hrv-checkbox):checked:after {
            border-color: #58b3f0
        }

        .ui-widget-content {
            background: none;
            border: 0;
        }

        .daredevel-tree li span.daredevel-tree-anchor {
            background-image: url(../../templates/admin/img/ui-icons_444444_256x240.png);
        }

    </style>
@stop

@section('javascript')
    <script type="text/javascript">
        $(function () {
            $('#auto-checkboxes li').tree({
                onCheck: {
                    node: 'expand'
                },
                onUncheck: {
                    node: 'expand'
                },
                dnd: false,
                selectable: false
            });

            $('#mainNode .checker').change((event) => {
                let _self = $(event.currentTarget);
                let set = _self.attr('data-set');
                let checked = _self.is(':checked');
                $(set).each((index, el) => {
                    if (checked) {
                        $(el).attr('checked', true);
                    } else {
                        $(el).attr('checked', false);
                    }
                });
            });
        })
    </script>
@stop

@section('content')
    @includeIf('elements.errors.danger')

    {!! Form::model($role,[
        'id'     => 'fRoles',
        'method' => 'POST',
        'route'  => 'roles.create'
    ]) !!}

    <div class="panel panel-collapsed">
        <div class="panel-hdr text-success">
            <h2>Add New Role</h2>
        </div>
        <div class="panel-container">
            <div class="panel-content">
                <div class="form-group">
                    <label class="form-label" for="first_name">Name <span class="text-danger">*</span></label>
                    {!! Form::text('name', null, [
                        'class'=> 'form-control',
                        'id'   => 'name'
                     ]) !!}
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <label class="form-label" for="approval_limit_from">Approval Limit From</label>
                            {!! Form::text('approval_limit_from', null, [
                                'class'=> 'form-control',
                                'id'   => 'approval_limit_from'
                            ]) !!}
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <label class="form-label" for="approval_limit_to">Approval Limit To</label>
                            {!! Form::text('approval_limit_to', null, [
                                'class'=> 'form-control',
                                'id'   => 'approval_limit_to'
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="last_name">Description <span class="text-danger">*</span></label>
                    {!! Form::textarea('description', null, [
                        'class'=> 'form-control',
                        'rows' => 4,
                        'id'   => 'description'
                     ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('is_default',1 ,false ,[
                            'class' => 'custom-control-input',
                            'id'    => 'is_default'
                        ]) !!}
                    <label class="custom-control-label" for="is_default">Is default?</label>
                </div>
            </div>
            <div class="panel-content">
                <div class="panel-tag">
                    <p class="text-uppercase color-black font-weight-bold">Please choose Permission for new role ?</p>
                    <ul id='auto-checkboxes' data-name='foo' class="list-unstyled list-feature">
                        <li id="mainNode">
                            <input type="checkbox" class="hrv-checkbox" id="expandCollapseAllTree">&nbsp;&nbsp;
                            <label for="expandCollapseAllTree"
                                   class="label label-default allTree">{{ trans('permissions.all') }}</label>
                            <ul>
                                @foreach($children['root'] as $element_key => $element)
                                    <li class="collapsed" id="node{{ $element_key }}">
                                        <input type="checkbox" class="hrv-checkbox" id="checkSelect{{ $element_key }}"
                                               name="flags[]" value="{{ $flags[$element]['flag'] }}"
                                               @if (in_array($flags[$element]['flag'], $active)) checked @endif>
                                        <label for="checkSelect{{ $element_key }}" class="label label-warning"
                                               style="margin: 5px;">{{ $flags[$element]['name'] }}</label>
                                        @if (isset($children[$element]))
                                            <ul>
                                                @foreach($children[$element] as $sub_key => $subElements)
                                                    <li class="collapsed"
                                                        id="node_sub_{{ $element_key  }}_{{ $sub_key }}">
                                                        <input type="checkbox" class="hrv-checkbox"
                                                               id="checkSelect_sub_{{ $element_key  }}_{{ $sub_key }}"
                                                               name="flags[]" value="{{ $flags[$subElements]['flag'] }}"
                                                               @if (in_array($flags[$subElements]['flag'], $active)) checked @endif>
                                                        <label for="checkSelect_sub_{{ $element_key  }}_{{ $sub_key }}"
                                                               class="label label-primary nameMargin">{{ $flags[$subElements]['name'] }}</label>
                                                        @if (isset($children[$subElements]))
                                                            <ul>
                                                                @foreach($children[$subElements] as $sub_sub_key => $subSubElements)
                                                                    <li class="collapsed"
                                                                        id="node_sub_sub_{{ $sub_sub_key }}">
                                                                        <input type="checkbox" class="hrv-checkbox"
                                                                               id="checkSelect_sub_sub{{ $sub_sub_key }}"
                                                                               name="flags[]"
                                                                               value="{{ $flags[$subSubElements]['flag'] }}"
                                                                               @if (in_array($flags[$subSubElements]['flag'], $active)) checked @endif>
                                                                        <label
                                                                            for="checkSelect_sub_sub{{ $sub_sub_key }}"
                                                                            class="label label-success nameMargin">{{ $flags[$subSubElements]['name'] }}</label>
                                                                        @if(isset($children[$subSubElements]))
                                                                            <ul>
                                                                                @foreach($children[$subSubElements] as $grand_children_key => $grandChildrenElements)
                                                                                    <li class="collapsed"
                                                                                        id="node_grand_child{{ $grand_children_key }}">
                                                                                        <input type="checkbox"
                                                                                               class="hrv-checkbox"
                                                                                               id="checkSelect_grand_child{{ $grand_children_key }}"
                                                                                               name="flags[]"
                                                                                               value="{{ $flags[$grandChildrenElements]['flag'] }}"
                                                                                               @if (in_array($flags[$grandChildrenElements]['flag'], $active)) checked @endif>
                                                                                        <label
                                                                                            for="checkSelect_grand_child{{ $grand_children_key }}"
                                                                                            class="label label-danger nameMargin">{{ $flags[$grandChildrenElements]['name'] }}</label>
                                                                                        @if(isset($children[$grandChildrenElements]))
                                                                                            <ul>
                                                                                                @foreach($children[$grandChildrenElements] as $grand_children_key_sub => $greatGrandChildrenElements)
                                                                                                    <li class="collapsed"
                                                                                                        id="node{{ $grand_children_key }}">
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            class="hrv-checkbox"
                                                                                                            id="checkSelect_grand_child{{ $grand_children_key_sub }}"
                                                                                                            name="flags[]"
                                                                                                            value="{{ $flags[$grandChildrenElements]['flag'] }}"
                                                                                                            @if (in_array($flags[$grandChildrenElements]['flag'], $active)) checked @endif>
                                                                                                        <label
                                                                                                            for="checkSelect_grand_child{{ $grand_children_key_sub }}"
                                                                                                            class="label label-info nameMargin">{{ $flags[$grandChildrenElements]['name'] }}</label>
                                                                                                    </li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        @endif
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            {{--Action--}}
            <div class="panel-footer p-3">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="group-action float-left">
                            <a href="{!! route('roles.index') !!}" class="btn btn-danger">
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
