@extends('admin.auth.master')
@section('title')
    Forgot Password- InThePocket
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
                     style="background: url({!! asset('templates/admin/img/svg/pattern-1.svg') !!}) no-repeat center bottom
                         fixed;
                         background-size:
                         cover;">
                    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                        <div class="row">
                            <div class="col-xl-12">
                                <h2 class="fs-xxl fw-500 mt-4 text-white text-center text-uppercase">
                                    Forgot password
                                    <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60 hidden-sm-down">
                                        Not a problem, happens to the best of us. Just use the form below to reset it!
                                    </small>
                                </h2>
                            </div>
                            <div class="col-xl-6 ml-auto mr-auto">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>Well done: </strong> {!! session('success') !!}
                                    </div>
                                @endif

                                @if(session('failed'))
                                    <div class="alert alert-danger alert-dismissible">
                                        <strong>Warning: </strong> {!! session('failed') !!}
                                    </div>
                                @endif

                                @if($errors->all())
                                    <div class="alert alert-danger alert-dismissible">
                                        <strong>Warning: </strong> Please check the form carefully for errors!
                                    </div>
                                @endif
                                <div class="card p-4 rounded-plus bg-faded">
                                    <form id="js-login" novalidate="novalidate"
                                          action="{!! route('access.password.email') !!}"
                                          method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" for="lostaccount">Your Email Address?</label>
                                            <input type="email" id="email" class="form-control"
                                                   placeholder="Recovery email" name="email" required/>
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                        <div class="row no-gutters">
                                            <div class="col-md-4 ml-auto text-right">
                                                <button id="js-login-btn" type="submit" class="btn btn-danger">
                                                    Recover now
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-block text-center text-white">
                        2019 © InThePocket
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
