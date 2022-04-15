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
                <!-- Advanced login -->
                {!! Form::open([
                    'method' => 'POST',
                    'route'  => ['resetPassword.action', request('userId'), request('code')]
                ]) !!}
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-warning-400 text-warning-400"><i class="icon-people"></i>
                            </div>
                            <h5 class="content-group-lg">Login to your account
                                <small class="display-block">Enter your credentials</small>
                            </h5>
                        </div>
                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" name="password" placeholder="@lang('auth.form_user_password_label')">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>
                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="@lang('auth.form_user_password_confirm_label')">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn bg-blue btn-block">@lang('auth.reset_password_submit_btn')</button>
                        </div>
                    </div>
                {!! Form::close() !!}
                <!-- /advanced login -->
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
