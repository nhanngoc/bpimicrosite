<!DOCTYPE html>
<html lang="{!! app()->getLocale() !!}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login to dashboard</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{!! asset('templates/admin/css/icons/icomoon/styles.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('templates/admin/css/bootstrap.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('templates/admin/css/core.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('templates/admin/css/components.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('templates/admin/css/colors.css') !!}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{!! asset('templates/admin/js/plugins/loaders/pace.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('templates/admin/js/core/libraries/jquery.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('templates/admin/js/core/libraries/bootstrap.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('templates/admin/js/plugins/loaders/blockui.min.js') !!}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript"
            src="{!! asset('templates/admin/js/plugins/forms/styling/uniform.min.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('templates/admin/js/core/app.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('templates/admin/js/pages/login.js') !!}"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container bg-slate-800">


<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Content area -->
            <div class="content">
                {!! Form::open([
                    'method' => 'post',
                    'id'     => 'js-login',
                    'route'  => 'password.postRecover'
                ]) !!}
                <div class="panel panel-body login-form">
                    <div class="text-center">
                        <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
                        <h5 class="content-group">Password recovery
                            <small class="display-block">We'll send you instructions in email</small>
                        </h5>
                    </div>
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
                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                        {!! Form::text('email', null, [
                            'class'       => 'form-control',
                            'id'          => 'email',
                            'placeholder' => 'Your email',
                        ]) !!}
                        <div class="form-control-feedback">
                            <i class="icon-mail5 text-muted"></i>
                        </div>
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                    </div>

                    <button type="submit" class="btn bg-blue btn-block">Reset password <i
                            class="icon-arrow-right14 position-right"></i></button>
                </div>
                {!! Form::close() !!}
                <div class="footer text-muted text-center">
                    &copy; 2019. <a href="#">InThePocket</a> by <a href="http://piceweb.com" target="_blank">PiceWeb</a>
                </div>
                <!-- /footer -->
            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</div>
<!-- /page container -->
</body>
</html>
