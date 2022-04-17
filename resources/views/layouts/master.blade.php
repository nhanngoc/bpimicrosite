<!DOCTYPE html>
<html lang="{!! app()->getLocale() !!}">

    <head>
    <meta charset="utf-8">
        <title>narciso rodriguez - for her MUSC NOIR ROSE</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description">
        <meta content="Coderthemes" name="author">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{!! asset('templates/home/images/favicon.png') !!}">
        <!-- third party css -->
        <link href="{!! asset('templates/assets/libs/datatables/dataTables.bootstrap4.css') !!}" rel="stylesheet" type="text/css">
        <link href="{!! asset('templates/assets/libs/datatables/buttons.bootstrap4.css') !!}" rel="stylesheet" type="text/css">
        <link href="{!! asset('templates/assets/libs/datatables/responsive.bootstrap4.css') !!}" rel="stylesheet" type="text/css">
        <link href="{!! asset('templates/assets/libs/datatables/select.bootstrap4.css') !!}" rel="stylesheet" type="text/css">
        <!-- App css -->
        <link href="{!! asset('templates/assets/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet">
        <link href="{!! asset('templates/assets/css/icons.min.css') !!}" rel="stylesheet" type="text/css">
        <link href="{!! asset('templates/assets/css/app.min.css') !!}" rel="stylesheet" type="text/css" id="app-stylesheet">
    </head>

        <body>

        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">
                 
                {{-- <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell noti-icon"></i>
                            <span class="badge badge-danger rounded-circle noti-icon-badge">4</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="font-16 m-0">
                                    <span class="float-right">
                                        <a href="" class="text-dark">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Notification
                                </h5>
                            </div>
                            <div class="slimscroll noti-scroll">
                                 <!-- item-->
                                 <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i></div>
                                        <p class="notify-details">Caleb Flakelar commented on Admin<small class="text-muted">1 min ago</small></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info"><i class="mdi mdi-account-plus"></i></div>
                                        <p class="notify-details">New user registered.<small class="text-muted">5 hours ago</small></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-danger"><i class="mdi mdi-heart"></i></div>
                                        <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">3 days ago</small></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning"><i class="mdi mdi-comment-account-outline"></i></div>
                                        <p class="notify-details">Caleb Flakelar commented on Admin<small class="text-muted">4 days ago</small></p>
                                    </a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary">
                                            <i class="mdi mdi-heart"></i>
                                        </div>
                                        <p class="notify-details">Carlos Crouch liked <b>Admin</b>
                                            <small class="text-muted">13 days ago</small>
                                        </p>
                                    </a>
                            </div>
                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-primary text-center notify-item notify-all ">
                                View all
                                <i class="fi-arrow-right"></i>
                            </a>

                        </div>
                    </li> --}}

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{!! asset('templates/assets/images/users/avatar-1.jpg') !!}" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ml-1">
                               
                                <i class="mdi mdi-chevron-down"></i> 
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <form id="frmLogout" action="/admin/logoutadmin" method="POST"></form>
                            
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">{!! Auth::getUser()->getFullName() !!}</h6>
                                    <span class="text-truncate text-truncate-md opacity-80">
                                        {!! Auth::getUser()->email !!}
                                    </span>
                            </div>
                            <!-- item-->
                            <a href="{!! route('access.logout') !!}" class="dropdown-item notify-item">
                                <i class="mdi mdi-logout-variant"></i>
                                <span>Logout</span>
                            </a>
                            
                        </div>
                    </li>
                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="#" class="logo text-center logo-dark">
                        <span class="logo-lg">
                            <img src="{!! asset('templates/assets/images/icon-logo.png') !!}" alt="" height="26">
                            <!-- <span class="logo-lg-text-dark">Simple</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">S</span> -->
                            <img src="{!! asset('templates/assets/images/logo-sm.png') !!}" alt="" height="22">
                        </span>
                    </a>
                    <a href="/admin/home" class="logo text-center logo-light">
                        <span class="logo-lg">
                            <img src="{!! asset('templates/assets/images/logo-light.png') !!}" alt="" height="26">
                            <!-- <span class="logo-lg-text-light">Simple</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-lg-text-light">S</span> -->
                            <img src="{!! asset('templates/assets/images/logo-sm.png') !!}" alt="" height="22">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                   
                </ul>
            </div>
            <!-- end Topbar --> <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">
            
                <div class="user-box">
                        <div class="float-left">
                            <img src="{!! asset('templates/assets/images/users/avatar-1.jpg') !!}" alt="" class="avatar-md rounded-circle">
                        </div>
                        <div class="user-info">
                            <a href="#">aaa</a>
                            <p class="text-muted m-0"></p>
                        </div>
                    </div>
            
            <!--- Sidemenu -->
            <div id="sidebar-menu">
    
                <ul class="metismenu" id="side-menu">
                     <li>
                        <a href="index.html">
                            <i class="ti-home"></i>
                            <span> Dashboard </span>
                        </a>
                    </li> 
                    
                    
                     
                     
                     <li>
                        <a href="javascript: void(0);">
                            <i class="ti-menu-alt"></i>
                            <span>  Customer </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="/customer">Customer List</a></li>
                            
                        </ul>
                    </li>
                    
                     <li>
                        <a href="javascript: void(0);">
                            <i class="ti-menu-alt"></i>
                            <span>Administration</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="{!! route('roles.index') !!}">Roles and Permissions</a></li>
                            <li><a href="{!! route('users.index') !!}">Users</a></li>
                            <!-- <li><a href="{!! route('audit-log.index') !!}">Activities Logs</a></li> -->
                        </ul>
                    </li>
                     
                   
                   
                    
                
                </ul>
    
            </div>
            <!-- End Sidebar -->
    
            <div class="clearfix"></div>

    
    </div>
    <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start container-fluid -->
                    <div class="container-fluid">

                        <!-- start  -->
                      
                        <!-- <div class="row">
                            <div class="col-12">
                                <div>
                                    <h4 class="header-title mb-3">Thống kê</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="card-box widget-inline">
                                        <div class="row">
                                            <div class="col-xl-3 col-sm-6 widget-inline-box">
                                                <div class="text-center p-3">
                                                    <h2 class="mt-2"><i class="text-primary mdi mdi-clipboard-text mr-2"></i> <b>ss</b></h2>
                                                    <p class="text-muted mb-0">Đơn chờ duyệt</p>
                                                </div>
                                            </div>

                                            <div class="col-xl-3 col-sm-6 widget-inline-box">
                                                <div class="text-center p-3">
                                                    <h2 class="mt-2"><i class="text-teal mdi mdi-clipboard-check mr-2"></i> <b>s</b></h2>
                                                    <p class="text-muted mb-0">Đã bán</p>
                                                </div>
                                            </div>

                                            <div class="col-xl-3 col-sm-6 widget-inline-box">
                                                <div class="text-center p-3">
                                                    <h2 class="mt-2"><i class="text-info mdi mdi-account-circle mr-2"></i> <b>s</b></h2>
                                                    <p class="text-muted mb-0">Tổng người dùng</p>
                                                </div>
                                            </div>

                                            <div class="col-xl-3 col-sm-6">
                                                <div class="text-center p-3">
                                                    <h2 class="mt-2"><i class="text-danger mdi mdi-store mr-2"></i> <b>s</b></h2>
                                                    <p class="text-muted mb-0">Tổng kho</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                            
                        <!-- body -->
                        @yield('content')
                        
        
                    </div>
                    <!-- end container-fluid -->
                    <!-- Footer Start -->
                    <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    4 / 2022 &copy; narciso rodriguez -   <a href="#">for her MUSC NOIR ROSE</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    
                    <!-- end Footer -->

                </div>
                <!-- end content -->

            </div>
            <!-- END content-page -->

        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="mdi mdi-close"></i>
                </a>
                <h5 class="font-16 m-0 text-white">Theme Customizer</h5>
            </div>
            <div class="slimscroll-menu">
        
                <div class="p-4">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, layout, etc.
                    </div>
                    <div class="mb-2">
                        <img src="{!! asset('templates/assets/images/layouts/light.png') !!}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked="">
                        <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
                    </div>
            
                    <div class="mb-2">
                        <img src="{!! asset('templates/assets/images/layouts/dark.png') !!}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsstyle="{!! asset('templates/assets/css/bootstrap-dark.min.css') !!}" data-appstyle="{!! asset('templates/assets/css/app-dark.min.css') !!}">
                        <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
            
                    <div class="mb-2">
                        <img src="{!! asset('templates/assets/images/layouts/rtl.png') !!}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-5">
                        <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appstyle="{!! asset('templates/assets/css/app-rtl.min.css') !!}">
                        <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>

                    <a href="https://1.envato.market/EK71X" class="btn btn-danger btn-block mt-3" target="_blank"><i class="mdi mdi-download mr-1"></i> Download Now</a>
                </div>
            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        

        <!-- Vendor js -->
        <script src="{!! asset('templates/assets/js/vendor.min.js') !!}"></script>

        <script src="{!! asset('templates/assets/libs/morris-js/morris.min.js') !!}"></script>
        <script src="{!! asset('templates/assets/libs/raphael/raphael.min.js') !!}"></script>

        <script src="{!! asset('templates/assets/js/pages/dashboard.init.js') !!}"></script>

        <!-- Required datatable js -->
        <script src="{!! asset('templates/assets/libs/datatables/jquery.dataTables.min.js') !!}"></script>
        <script src="{!! asset('templates/assets/libs/datatables/dataTables.bootstrap4.min.js') !!}"></script>
        <!-- Buttons examples -->
        <script src="{!! asset('templates/assets/libs/datatables/dataTables.buttons.min.js') !!}"></script>
        <script src="{!! asset('templates/assets/libs/datatables/buttons.bootstrap4.min.js') !!}"></script>
        <script src="{!! asset('templates/assets/libs/datatables/dataTables.keyTable.min.js') !!}"></script>
        <script src="{!! asset('templates/assets/libs/datatables/dataTables.select.min.js') !!}"></script>
        <script src="{!! asset('templates/assets/libs/jszip/jszip.min.js') !!}"></script>
        <script src="{!! asset('templates/assets/libs/pdfmake/pdfmake.min.js') !!}"></script>
        <script src="{!! asset('templates/assets/libs/pdfmake/vfs_fonts.js') !!}"></script>
        <script src="{!! asset('templates/assets/libs/datatables/buttons.html5.min.js') !!}"></script>
        <script src="{!! asset('templates/assets/libs/datatables/buttons.print.min.js') !!}"></script>

        <!-- Responsive examples -->
        <script src="{!! asset('templates/assets/libs/datatables/dataTables.responsive.min.js') !!}"></script>
        <script src="{!! asset('templates/assets/libs/datatables/responsive.bootstrap4.min.js') !!}"></script>

        <!-- Datatables init -->
        <script src="{!! asset('templates/assets/js/pages/datatables.init.js') !!}"></script>

        <!-- App js -->
        <script src="{!! asset('templates/assets/js/app.min.js') !!}"></script>

    </body>


</html>