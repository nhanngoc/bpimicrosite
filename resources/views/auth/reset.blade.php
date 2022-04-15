@extends('admin.auth.master')
@section('title')
    Reset Password- InThePocket
@stop
@section('auth_content')
    <div class="page-wrapper">
        <div class="page-inner bg-brand-gradient">
            <div class="page-content-wrapper bg-transparent m-0">
                <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                    <div class="d-flex align-items-center container p-0">
                        <div
                            class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                            <a href="javascript:void(0)"
                               class="page-logo-link press-scale-down d-flex align-items-center">
                                <span class="page-logo-text mr-1 text-uppercase">Web Application</span>
                            </a>
                        </div>
                        <span class="text-white opacity-50 ml-auto mr-2 hidden-sm-down">
                                Already a member?
                            </span>
                        <a href="{!! route('access.login') !!}" class="btn-link text-white ml-auto ml-sm-0">
                            Secure Login
                        </a>
                    </div>
                </div>
                <div class="flex-1"
                     style="background: url({!! asset('templates/admin/img/svg/pattern-1.svg') !!}) no-repeat center bottom fixed; background-size: cover;">
                    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                        <div class="row">
                            <div class="col-xl-6 ml-auto mr-auto">
                                <div class="card p-4 rounded-plus bg-faded">
                                    <div class="alert alert-primary text-dark" role="alert">
                                        <strong>Heads Up!</strong> Due to server maintenance from 9:30GTA to 12GTA, the
                                        verification emails could be delayed by up to 10 minutes.
                                    </div>
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
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form id="js-login" novalidate="novalidate"
                                          action="{!! route('access.password.reset.post') !!}"
                                          method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email will be needed for
                                                verification and account recovery.</label>
                                            <input type="email" id="email" class="form-control"
                                                   placeholder="Email for verification" name="email" required />
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label"
                                                   for="password">@lang('auth.form_user_password_label')</label>
                                            <input type="password" id="password" class="form-control"
                                                   placeholder="@lang('auth.form_user_password_label')" name="password"
                                                   required />
                                            @if ($errors->has('password'))
                                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label"
                                                   for="password_confirmation">@lang('auth.form_user_password_confirm_label')</label>
                                            <input type="password" id="email" class="form-control"
                                                   placeholder="@lang('auth.form_user_password_confirm_label')"
                                                   name="password_confirmation" required />
                                        </div>
                                        <div class="row no-gutters">
                                            <div class="col-md-4 m-auto text-center">
                                                <input type="hidden" name="token" value="{{ $token }}"/>
                                                <button id="js-login-btn" type="submit" class="btn btn-block
                                                btn-primary btn-lg mt-3">
                                                    Change Now
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                        2019 © InThePocket
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
