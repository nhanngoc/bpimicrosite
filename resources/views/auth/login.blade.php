@extends('auth.master')
@section('title')
    Login - Web Application
@stop
@section('auth_content')
    <div class="blankpage-form-field">
        <div
            class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
            <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                <span class="page-logo-text mr-1 text-center text-uppercase">Web Application</span>
            </a>
        </div>
        <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
            @if(session('success'))
                <div class="alert alert-styled-left bg-info p-10">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {!! session('success') !!}
                </div>
            @endif
            @if ($alert = session('danger'))
                <div class="alert alert-styled-left bg-danger p-10">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {!! $alert !!}
                </div>
            @endif
            <form action="{!! route('access.login') !!}" method="post">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="username">Email</label>
                    {!! Form::email('email',null,[
                        'class'       => 'form-control',
                        'placeholder' => 'Enter your email'
                    ]) !!}
                    @if ($errors->has('email'))
                        <span class="help-block text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" class="form-control" name="password"
                           placeholder="Enter your password"/>
                    @if ($errors->has('password'))
                        <span class="help-block text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group text-left">
                    <div class="custom-control custom-checkbox">
                        {!! Form::checkbox('remember',1,true,[
                            'class' => 'custom-control-input',
                            'id'    => 'remember_me'
                        ]) !!}
                        <label class="custom-control-label" for="remember"> Remember me</label>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-md-12 m-auto text-center">
                        <button type="submit" class="btn btn-primary text-center">Secure login</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="blankpage-footer text-center">
            <a href="{!! route('access.password.request') !!}"><strong>Recover Password</strong></a>
        </div>
    </div>
@stop
