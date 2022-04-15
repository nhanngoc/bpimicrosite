<!DOCTYPE html>
<html lang="{!! app()->getLocale() !!}">
<head>
    <meta charset="utf-8">
    <title>narciso rodriguez - for her MUSC NOIR ROSE</title>
    <meta name="description" content="Marketing Dashboard">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="{!! asset('templates/admin/css/vendors.bundle.css') !!}">
    <link rel="stylesheet" media="screen, print" href="{!! asset('templates/admin/css/app.bundle.css') !!}">
    <link rel="stylesheet" href="{!! asset('templates/admin/css/fa-solid.css') !!}">
    <link rel="stylesheet" href="{!! asset('templates/admin/css/fa-brands.css') !!}">
    <!-- Place favicon.ico in the root directory -->
    <link href="{!! asset('templates/home/images/favicon.png') !!}" rel="shortcut icon" type="image/x-icon">
<!--     <link rel="apple-touch-icon" sizes="180x180" href="{!! asset('templates/admin/img/favicon/apple-touch-icon
    .png') !!}">
    <link rel="icon" type="image/png" sizes="32x32"
          href="{!! asset('templates/admin/img/favicon/favicon-32x32.png') !!}">
    <link rel="mask-icon" href="{!! asset('templates/admin/img/favicon/safari-pinned-tab.svg') !!}" color="#5bbad5"> -->
    <link rel="stylesheet" media="screen, print"
          href="{!! asset('templates/admin/css/datagrid/datatables/datatables.bundle.css') !!}">
    <link rel="stylesheet" media="screen, print"
          href="{!! asset('templates/admin/css/formplugins/select2/select2.bundle.css') !!}"/>
    <link rel="stylesheet" media="screen, print"
          href="{!! asset('templates/admin/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') !!}">
    <link rel="stylesheet" media="screen, print"
          href="{!! asset('templates/admin/css/notifications/toastr/toastr.css') !!}">
    <link rel="stylesheet" href="{!! asset('templates/admin/js/jquery-ui/css/jquery-ui.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('templates/admin/js/jquery-tree/css/jquery.tree.css') !!}">
    <link rel="stylesheet" href="{!! asset('templates/admin/css/formplugins/select2/select2.bundle.css') !!}">
    <link rel="stylesheet"
          href="{!! asset('templates/admin/css/notifications/sweetalert2/sweetalert2.bundle.css') !!}"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all"
          rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
    <style type="text/css">
        /*.datepicker

            .select2-container {
            z-index: 9999 !important;
        } */
    </style>
    @yield('head')
    @stack('header')
</head>

<body class="mod-bg-1">
<!-- DOC: script to save and load page settings -->
<script>
    /**
     *    This script should be placed right after the body tag for fast execution
     *    Note: the script is written in pure javascript and does not depend on thirdparty library
     **/
    'use strict';

    var classHolder = document.getElementsByTagName("BODY")[0],
        /**
         * Load from localstorage
         **/
        themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {},
        themeURL = themeSettings.themeURL || '',
        themeOptions = themeSettings.themeOptions || '';
    /**
     * Load theme options
     **/
    if (themeSettings.themeOptions) {
        classHolder.className = themeSettings.themeOptions;
        console.log("%c✔ Theme settings loaded", "color: #148f32");
    } else {
        console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
    }
    if (themeSettings.themeURL && !document.getElementById('mytheme')) {
        var cssfile = document.createElement('link');
        cssfile.id = 'mytheme';
        cssfile.rel = 'stylesheet';
        cssfile.href = themeURL;
        document.getElementsByTagName('head')[0].appendChild(cssfile);
    }
    /**
     * Save to localstorage
     **/
    var saveSettings = function () {
        themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function (item) {
            return /^(nav|header|mod|display)-/i.test(item);
        }).join(' ');
        if (document.getElementById('mytheme')) {
            themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
        }
        localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
    }
    /**
     * Reset settings
     **/
    var resetSettings = function () {
        localStorage.setItem("themeSettings", "");
    }

</script>
<!-- BEGIN Page Wrapper -->
<div class="page-wrapper">
    <div class="page-inner">
        <!-- BEGIN Left Aside -->
    @includeIf('layouts.sidebar')
    <!-- END Left Aside -->
        <div class="page-content-wrapper">
            <!-- BEGIN Page Header -->
            <header class="page-header" role="banner">
                <!-- we need this logo when user switches to nav-function-top -->
                <div class="page-logo">
                    <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
                       data-toggle="modal" data-target="#modal-shortcut">
                        <img src="{!! asset('templates/admin/img/logo.png') !!}" alt="SmartAdmin WebApp"
                             aria-roledescription="logo">
                        <span class="page-logo-text mr-1">SmartAdmin WebApp</span>
                        <span
                            class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                        <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                    </a>
                </div>
                <!-- DOC: nav menu layout change shortcut -->
                <div class="hidden-md-down dropdown-icon-menu position-relative">
                    <a href="#" class="header-btn btn js-waves-off" data-action="toggle"
                       data-class="nav-function-hidden" title="Hide Navigation">
                        <i class="ni ni-menu"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="#" class="btn js-waves-off" data-action="toggle"
                               data-class="nav-function-minify" title="Minify Navigation">
                                <i class="ni ni-minify-nav"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn js-waves-off" data-action="toggle"
                               data-class="nav-function-fixed" title="Lock Navigation">
                                <i class="ni ni-lock-nav"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- DOC: mobile button appears during mobile width -->
                <div class="hidden-lg-up">
                    <a href="#" class="header-btn btn press-scale-down" data-action="toggle"
                       data-class="mobile-nav-on">
                        <i class="ni ni-menu"></i>
                    </a>
                </div>
                <div class="ml-auto d-flex">
                    <!-- activate app search icon (mobile) -->
                    <div class="hidden-sm-up">
                        <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on"
                           data-focus="search-field" title="Search">
                            <i class="fal fa-search"></i>
                        </a>
                    </div>
                    <!-- app message -->
                    {{-- <a href="#" target="_blank" class="header-icon">
                        <i class="fal fa-globe"></i>
                        <span class="badge badge-icon">!</span>
                    </a> --}}
                    <!-- app notification -->
                    <div>
                        {{-- <a href="#" class="header-icon" data-toggle="dropdown" title="You got 11 notifications">
                            <i class="fal fa-bell"></i>
                            <span class="badge badge-icon">11</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-xl">
                            <div
                                class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">
                                <h4 class="m-0 text-center color-white">
                                    11 New
                                    <small class="mb-0 opacity-80">User Notifications</small>
                                </h4>
                            </div>
                            <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab"
                                       href="#tab-messages" data-i18n="drpdwn.messages">Messages</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab"
                                       href="#tab-feeds" data-i18n="drpdwn.feeds">Feeds</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab"
                                       href="#tab-events" data-i18n="drpdwn.events">Events</a>
                                </li>
                            </ul>
                            <div class="tab-content tab-notification">
                                <div class="tab-pane active p-3 text-center">
                                    <h5 class="mt-4 pt-4 fw-500">
                                            <span class="d-block fa-3x pb-4 text-muted">
                                                <i class="ni ni-arrow-up text-gradient opacity-70"></i>
                                            </span> Select a tab above to activate
                                        <small class="mt-3 fs-b fw-400 text-muted">
                                            This blank page message helps protect your privacy, or you can show the
                                            first message here automatically through
                                            <a href="#">settings page</a>
                                        </small>
                                    </h5>
                                </div>
                                <div class="tab-pane" id="tab-messages" role="tabpanel">
                                    <div class="custom-scroll h-100">
                                        <ul class="notification">
                                            <li class="unread">
                                                <a href="#" class="d-flex align-items-center">
                                                        <span class="status mr-2">
                                                            <span class="profile-image rounded-circle d-inline-block"
                                                                  style="background-image:url('{!! asset
                                                                  ('templates/admin/img/demo/avatars/avatar-c.png')
                                                                  !!}')
                                                                      "></span>
                                                        </span>
                                                    <span class="d-flex flex-column flex-1 ml-1">
                                                            <span class="name">Melissa Ayre <span
                                                                    class="badge badge-primary fw-n position-absolute pos-top pos-right mt-1">INBOX</span></span>
                                                            <span class="msg-a fs-sm">Re: New security codes</span>
                                                            <span class="msg-b fs-xs">Hello again and thanks for being
                                                                part...</span>
                                                            <span class="fs-nano text-muted mt-1">56 seconds ago</span>
                                                        </span>
                                                </a>
                                            </li>
                                            <li class="unread">
                                                <a href="#" class="d-flex align-items-center">
                                                        <span class="status mr-2">
                                                            <span class="profile-image rounded-circle d-inline-block"
                                                                  style="background-image:url('{!! asset
                                                                  ('templates/admin/img/demo/avatars/avatar-a.png')
                                                                   !!}')
                                                                      "></span>
                                                        </span>
                                                    <span class="d-flex flex-column flex-1 ml-1">
                                                            <span class="name">Adison Lee</span>
                                                            <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                            <span class="fs-nano text-muted mt-1">2 minutes ago</span>
                                                        </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="d-flex align-items-center">
                                                        <span class="status status-success mr-2">
                                                            <span class="profile-image rounded-circle d-inline-block"
                                                                  style="background-image:url('img/demo/avatars/avatar-b.png')"></span>
                                                        </span>
                                                    <span class="d-flex flex-column flex-1 ml-1">
                                                            <span class="name">Oliver Kopyuv</span>
                                                            <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                            <span class="fs-nano text-muted mt-1">3 days ago</span>
                                                        </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="d-flex align-items-center">
                                                        <span class="status status-warning mr-2">
                                                            <span class="profile-image rounded-circle d-inline-block"
                                                                  style="background-image:url('img/demo/avatars/avatar-e.png')"></span>
                                                        </span>
                                                    <span class="d-flex flex-column flex-1 ml-1">
                                                            <span class="name">Dr. John Cook PhD</span>
                                                            <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                            <span class="fs-nano text-muted mt-1">2 weeks ago</span>
                                                        </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="d-flex align-items-center">
                                                        <span class="status status-success mr-2">
                                                            <!-- <img src="img/demo/avatars/avatar-m.png" data-src="img/demo/avatars/avatar-h.png" class="profile-image rounded-circle" alt="Sarah McBrook" /> -->
                                                            <span class="profile-image rounded-circle d-inline-block"
                                                                  style="background-image:url('img/demo/avatars/avatar-h.png')"></span>
                                                        </span>
                                                    <span class="d-flex flex-column flex-1 ml-1">
                                                            <span class="name">Sarah McBrook</span>
                                                            <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                            <span class="fs-nano text-muted mt-1">3 weeks ago</span>
                                                        </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="d-flex align-items-center">
                                                        <span class="status status-success mr-2">
                                                            <span class="profile-image rounded-circle d-inline-block"
                                                                  style="background-image:url('img/demo/avatars/avatar-m.png')"></span>
                                                        </span>
                                                    <span class="d-flex flex-column flex-1 ml-1">
                                                            <span class="name">Anothony Bezyeth</span>
                                                            <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                            <span class="fs-nano text-muted mt-1">one month ago</span>
                                                        </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="d-flex align-items-center">
                                                        <span class="status status-danger mr-2">
                                                            <span class="profile-image rounded-circle d-inline-block"
                                                                  style="background-image:url('img/demo/avatars/avatar-j.png')"></span>
                                                        </span>
                                                    <span class="d-flex flex-column flex-1 ml-1">
                                                            <span class="name">Lisa Hatchensen</span>
                                                            <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                            <span class="fs-nano text-muted mt-1">one year ago</span>
                                                        </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-feeds" role="tabpanel">
                                    <div class="custom-scroll h-100">
                                        <ul class="notification">
                                            <li class="unread">
                                                <div class="d-flex align-items-center show-child-on-hover">
                                                        <span class="d-flex flex-column flex-1">
                                                            <span class="name d-flex align-items-center">Administrator
                                                                <span
                                                                    class="badge badge-success fw-n ml-1">UPDATE</span></span>
                                                            <span class="msg-a fs-sm">
                                                                System updated to version <strong>4.0.1</strong> <a
                                                                    href="intel_build_notes.html">(patch notes)</a>
                                                            </span>
                                                            <span class="fs-nano text-muted mt-1">5 mins ago</span>
                                                        </span>
                                                    <div
                                                        class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                        <a href="#" class="text-muted" title="delete"><i
                                                                class="fal fa-trash-alt"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center show-child-on-hover">
                                                    <div class="d-flex flex-column flex-1">
                                                            <span class="name">
                                                                Adison Lee <span class="fw-300 d-inline">replied to your
                                                                    video <a href="#" class="fw-400"> Cancer Drug</a>
                                                                </span>
                                                            </span>
                                                        <span class="msg-a fs-sm mt-2">Bring to the table win-win
                                                                survival strategies to ensure proactive domination. At
                                                                the end of the day...</span>
                                                        <span class="fs-nano text-muted mt-1">10 minutes ago</span>
                                                    </div>
                                                    <div
                                                        class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                        <a href="#" class="text-muted" title="delete"><i
                                                                class="fal fa-trash-alt"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center show-child-on-hover">
                                                    <!--<img src="img/demo/avatars/avatar-m.png" data-src="img/demo/avatars/avatar-k.png" class="profile-image rounded-circle" alt="k" />-->
                                                    <div class="d-flex flex-column flex-1">
                                                            <span class="name">
                                                                Troy Norman'<span class="fw-300">s new
                                                                    connections</span>
                                                            </span>
                                                        <div class="fs-sm d-flex align-items-center mt-2">
                                                                <span
                                                                    class="profile-image-md mr-1 rounded-circle d-inline-block"
                                                                    style="background-image:url('img/demo/avatars/avatar-a.png'); background-size: cover;"></span>
                                                            <span
                                                                class="profile-image-md mr-1 rounded-circle d-inline-block"
                                                                style="background-image:url('img/demo/avatars/avatar-b.png'); background-size: cover;"></span>
                                                            <span
                                                                class="profile-image-md mr-1 rounded-circle d-inline-block"
                                                                style="background-image:url('img/demo/avatars/avatar-c.png'); background-size: cover;"></span>
                                                            <span
                                                                class="profile-image-md mr-1 rounded-circle d-inline-block"
                                                                style="background-image:url('img/demo/avatars/avatar-e.png'); background-size: cover;"></span>
                                                            <div data-hasmore="+3"
                                                                 class="rounded-circle profile-image-md mr-1">
                                                                    <span
                                                                        class="profile-image-md mr-1 rounded-circle d-inline-block"
                                                                        style="background-image:url('img/demo/avatars/avatar-h.png'); background-size: cover;"></span>
                                                            </div>
                                                        </div>
                                                        <span class="fs-nano text-muted mt-1">55 minutes ago</span>
                                                    </div>
                                                    <div
                                                        class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                        <a href="#" class="text-muted" title="delete"><i
                                                                class="fal fa-trash-alt"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center show-child-on-hover">
                                                    <!--<img src="img/demo/avatars/avatar-m.png" data-src="img/demo/avatars/avatar-e.png" class="profile-image-sm rounded-circle align-self-start mt-1" alt="k" />-->
                                                    <div class="d-flex flex-column flex-1">
                                                            <span class="name">Dr John Cook <span class="fw-300">sent a
                                                                    <span class="text-danger">new
                                                                        signal</span></span></span>
                                                        <span class="msg-a fs-sm mt-2">Nanotechnology immersion
                                                                along the information highway will close the loop on
                                                                focusing solely on the bottom line.</span>
                                                        <span class="fs-nano text-muted mt-1">10 minutes ago</span>
                                                    </div>
                                                    <div
                                                        class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                        <a href="#" class="text-muted" title="delete"><i
                                                                class="fal fa-trash-alt"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center show-child-on-hover">
                                                    <div class="d-flex flex-column flex-1">
                                                            <span class="name">Lab Images <span class="fw-300">were
                                                                    updated!</span></span>
                                                        <div class="fs-sm d-flex align-items-center mt-1">
                                                            <a href="#" class="mr-1 mt-1" title="Cell A-0012">
                                                                    <span class="d-block img-share"
                                                                          style="background-image:url('img/thumbs/pic-7.png'); background-size: cover;"></span>
                                                            </a>
                                                            <a href="#" class="mr-1 mt-1"
                                                               title="Patient A-473 saliva">
                                                                    <span class="d-block img-share"
                                                                          style="background-image:url('img/thumbs/pic-8.png'); background-size: cover;"></span>
                                                            </a>
                                                            <a href="#" class="mr-1 mt-1"
                                                               title="Patient A-473 blood cells">
                                                                    <span class="d-block img-share"
                                                                          style="background-image:url('img/thumbs/pic-11.png'); background-size: cover;"></span>
                                                            </a>
                                                            <a href="#" class="mr-1 mt-1"
                                                               title="Patient A-473 Membrane O.C">
                                                                    <span class="d-block img-share"
                                                                          style="background-image:url('img/thumbs/pic-12.png'); background-size: cover;"></span>
                                                            </a>
                                                        </div>
                                                        <span class="fs-nano text-muted mt-1">55 minutes ago</span>
                                                    </div>
                                                    <div
                                                        class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                        <a href="#" class="text-muted" title="delete"><i
                                                                class="fal fa-trash-alt"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center show-child-on-hover">
                                                    <!--<img src="img/demo/avatars/avatar-m.png" data-src="img/demo/avatars/avatar-h.png" class="profile-image rounded-circle align-self-start mt-1" alt="k" />-->
                                                    <div class="d-flex flex-column flex-1">
                                                        <div class="name mb-2">
                                                            Lisa Lamar<span class="fw-300"> updated project</span>
                                                        </div>
                                                        <div class="row fs-b fw-300">
                                                            <div class="col text-left">
                                                                Progress
                                                            </div>
                                                            <div class="col text-right fw-500">
                                                                45%
                                                            </div>
                                                        </div>
                                                        <div class="progress progress-sm d-flex mt-1">
                                                                <span
                                                                    class="progress-bar bg-primary-500 progress-bar-striped"
                                                                    role="progressbar" style="width: 45%"
                                                                    aria-valuenow="45" aria-valuemin="0"
                                                                    aria-valuemax="100"></span>
                                                        </div>
                                                        <span class="fs-nano text-muted mt-1">2 hrs ago</span>
                                                        <div
                                                            class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                            <a href="#" class="text-muted" title="delete"><i
                                                                    class="fal fa-trash-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-events" role="tabpanel">
                                    <div class="d-flex flex-column h-100">
                                        <div class="h-auto">
                                            <table
                                                class="table table-bordered table-calendar m-0 w-100 h-100 border-0">
                                                <tr>
                                                    <th colspan="7" class="pt-3 pb-2 pl-3 pr-3 text-center">
                                                        <div class="js-get-date h5 mb-2">[your date here]</div>
                                                    </th>
                                                </tr>
                                                <tr class="text-center">
                                                    <th>Sun</th>
                                                    <th>Mon</th>
                                                    <th>Tue</th>
                                                    <th>Wed</th>
                                                    <th>Thu</th>
                                                    <th>Fri</th>
                                                    <th>Sat</th>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted bg-faded">30</td>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>5</td>
                                                    <td><i
                                                            class="fal fa-birthday-cake mt-1 ml-1 position-absolute pos-left pos-top text-primary"></i>
                                                        6
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>8</td>
                                                    <td>9</td>
                                                    <td class="bg-primary-300 pattern-0">10</td>
                                                    <td>11</td>
                                                    <td>12</td>
                                                    <td>13</td>
                                                </tr>
                                                <tr>
                                                    <td>14</td>
                                                    <td>15</td>
                                                    <td>16</td>
                                                    <td>17</td>
                                                    <td>18</td>
                                                    <td>19</td>
                                                    <td>20</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>22</td>
                                                    <td>23</td>
                                                    <td>24</td>
                                                    <td>25</td>
                                                    <td>26</td>
                                                    <td>27</td>
                                                </tr>
                                                <tr>
                                                    <td>28</td>
                                                    <td>29</td>
                                                    <td>30</td>
                                                    <td>31</td>
                                                    <td class="text-muted bg-faded">1</td>
                                                    <td class="text-muted bg-faded">2</td>
                                                    <td class="text-muted bg-faded">3</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="flex-1 custom-scroll">
                                            <div class="p-2">
                                                <div class="d-flex align-items-center text-left mb-3">
                                                    <div
                                                        class="width-5 fw-300 text-primary l-h-n mr-1 align-self-start fs-xxl">
                                                        15
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="d-flex flex-column">
                                                                <span class="l-h-n fs-md fw-500 opacity-70">
                                                                    October 2020
                                                                </span>
                                                            <span class="l-h-n fs-nano fw-400 text-secondary">
                                                                    Friday
                                                                </span>
                                                        </div>
                                                        <div class="mt-3">
                                                            <p>
                                                                <strong>2:30PM</strong> - Doctor's appointment
                                                            </p>
                                                            <p>
                                                                <strong>3:30PM</strong> - Report overview
                                                            </p>
                                                            <p>
                                                                <strong>4:30PM</strong> - Meeting with Donnah V.
                                                            </p>
                                                            <p>
                                                                <strong>5:30PM</strong> - Late Lunch
                                                            </p>
                                                            <p>
                                                                <strong>6:30PM</strong> - Report Compression
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="py-2 px-3 bg-faded d-block rounded-bottom text-right border-faded border-bottom-0 border-right-0 border-left-0">
                                <a href="#" class="fs-xs fw-500 ml-auto">view all notifications</a>
                            </div>
                        </div>
                    </div> --}}
                    <!-- app user menu -->
                    <div>
                        <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com"
                           class="header-icon d-flex align-items-center justify-content-center ml-2">
                            {{-- <img src="{!! asset('templates/admin/img/demo/avatars/avatar-admin.png') !!}"
                                 class="profile-image rounded-circle"
                                 alt="Dr. Codex Lantern"> --}}
                            <!-- you can also add username next to the avatar with the codes below:-->
                            <i class="fal fa-user-circle profile-image rounded-circle"></i>
									{{-- <span class="ml-1 mr-1 hidden-xs-down">
                                        {!! Auth::getUser()->email !!}
                                    </span>
									<i class="ni ni-chevron-down hidden-xs-down profile-image rounded-circle"></i>  --}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                            <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                        {{-- <span class="mr-2">
                                            <img
                                                src="{!! asset('templates/admin/img/demo/avatars/avatar-admin.png') !!}"
                                                class="rounded-circle profile-image" alt="Dr. Codex Lantern">
                                        </span> --}}
                                    <div class="info-card-text">
                                        <div
                                            class="fs-lg text-truncate text-truncate-lg">{!! Auth::getUser()->getFullName() !!}</div>
                                        <span class="text-truncate text-truncate-md opacity-80">
                                            {!! Auth::getUser()->email !!}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider m-0"></div>
                            {{-- <a href="#" class="dropdown-item">
                                <span data-i18n="drpdwn.settings">Settings</span>
                            </a> --}}
                            <a class="dropdown-item fw-500 pt-3 pb-3" href="{!! route('access.logout') !!}">
                                <span data-i18n="drpdwn.page-logout">Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END Page Header -->
            <!-- BEGIN Page Content -->
            <!-- the #js-page-content id is needed for some plugins to initialize -->
            <main id="js-page-content" role="main" class="page-content">
                @yield('breadcrumb')

                @yield('header')

                @yield('content')
            </main>
            <!-- this overlay is activated only when mobile menu is triggered -->
            <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
            <!-- END Page Content -->
            <!-- BEGIN Page Footer -->
            <footer class="page-footer" role="contentinfo">
                <div class="d-flex align-items-center flex-1 text-muted">
                    <span class="hidden-md-down fw-700">2021 © Web Application</span>
                </div>
            </footer>
            <!-- END Page Footer -->
        </div>
    </div>
</div>
<!-- END Page Wrapper -->
<!-- BEGIN Quick Menu -->
<!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
<nav class="shortcut-menu d-none d-sm-block">
    <input type="checkbox" class="menu-open" name="menu-open" id="menu_open"/>
    <label for="menu_open" class="menu-open-button ">
        <span class="app-shortcut-icon d-block"></span>
    </label>
    <a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
        <i class="fal fa-arrow-up"></i>
    </a>
    <a href="{!! route('access.logout') !!}" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Logout">
        <i class="fal fa-sign-out"></i>
    </a>
    {{-- <a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left"
       title="Full Screen">
        <i class="fal fa-expand"></i>
    </a>
    <a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left"
       title="Print page">
        <i class="fal fa-print"></i>
    </a>
    <a href="#" class="menu-item btn" data-action="app-voice" data-toggle="tooltip" data-placement="left"
       title="Voice command">
        <i class="fal fa-microphone"></i>
    </a> --}}
</nav>
<!-- END Quick Menu -->

<script src="{!! asset('templates/admin/js/vendors.bundle.js') !!}"></script>
<script src="{!! asset('templates/admin/js/app.bundle.js') !!}"></script>
<!-- The order of scripts is irrelevant. Please check out the plugin pages for more details about these plugins below: -->
<script src="{!! asset('templates/admin/js/statistics/peity/peity.bundle.js') !!}"></script>
<script src="{!! asset('templates/admin/js/statistics/flot/flot.bundle.js') !!}"></script>
<script src="{!! asset('templates/admin/js/statistics/easypiechart/easypiechart.bundle.js') !!}"></script>
<script src="{!! asset('templates/admin/js/datagrid/datatables/datatables.bundle.js') !!}"></script>
<script src="{!! asset('templates/admin/js/formplugins/select2/select2.bundle.js') !!}"></script>
<script src="{!! asset('templates/admin/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('templates/admin/js/notifications/toastr/toastr.js') !!}"></script>
<script src="{!! asset('templates/admin/js/notifications/sweetalert2/sweetalert2.bundle.js') !!}"></script>
<script src="{!! asset('templates/admin/js/formplugins/bootbox/bootbox.all.min.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js"
        type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js"
        type="text/javascript"></script>
<script type="text/javascript" src="{!! asset('templates/admin/js/jquery-tree/js/jquery.tree.js') !!}"></script>

<script src="{!! asset('templates/admin/js/formplugins/select2/select2.bundle.js') !!}"></script>
<script src="{!! asset('templates/admin/js/plugin.js?v='.time()) !!}"></script>
<script src="{!! asset('js/app.js?v='.time()) !!}"></script>
<script type="text/javascript">
    /* Activate smart panels */
</script>
<script type="text/javascript">
    var baseDomain = "{!! url('/') !!}";
    var WCSEO = WCSEO || {},
        focused = false;
    var formHasChanged = false;

    WCSEO.showMessage = function (element, msg) {
        if ($(element).parent().find('.error').length > 0) {
            $(element).parent().find('.error').html(msg);
            $(element).addClass('has-error');
            $(element).parent().find('.error').show();
            setTimeout(function () {
                $(element).parent().find('.error').hide();
            }, 3000);
        }
    };
    WCSEO.setFocus = function (element) {
        if (focused === false) {
            focused = true;
            $(element).focus();
        }
    };

    WCSEO.hideMessage = function (element) {
        if ($(element).parent().find('.error').length > 0) {
            $(element).removeClass('has-error');
            $(element).parent().find('.error').delay(3500).hide();
        }
    };

    WCSEO.isEmail = function (a) {
        var b = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return b.test(a);
    };

    WCSEO.isPhoneNumber = function (b) {
        var flag = false;
        b = b.replace('(+84)', '0');
        b = b.replace('+84', '0');
        b = b.replace('0084', '0');
        b = b.replace(/ /g, '');
        if (b !== '') {
            var firstNumber = b.substring(0, 2);
            if ((firstNumber === '09' || firstNumber === '08' || firstNumber === '05' || firstNumber === '03' || firstNumber === '07') && b.length === 10) {
                if (b.match(/^\d{10}/)) {
                    flag = true;
                }
            }
        }
        return flag;
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 100,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    $(function () {
        @if(session('success_msg'))
            toastr["success"]("{!! session('success_msg') !!}");
        @endif
            @if(session('error_msg'))
            toastr["error"]("{!! session('error_msg') !!}");
        @endif
    });

    $(window).scroll(function () {
        'use strict';
        let subheader = $('div.subheader');
        if ($(this).scrollTop() > 210) {
            subheader.addClass("fixSubHeader");
        } else {
            subheader.removeClass("fixSubHeader");
        }
    });

    (function ($) {
        "use strict";
        $(document).on('change', 'form input, form select, form textarea, button.close', function (e) {
            formHasChanged = true;
        });
        $(document).on('change', 'form input[type=submit], form button[type=submit]', function (e) {
            formHasChanged = false;
        });

        // $(document).ready(function () {
        //     window.onbeforeunload = function (e) {
        //         if (formHasChanged) {
        //             var message = "You have not saved your changes.", e = e || window.event;
        //             if (e) {
        //                 e.returnValue = message;
        //             }
        //             return message;
        //         }
        //     }
        // });
    })(jQuery);

    var handleValidationError = function (errors, form) {
        let message = '';
        $.each(errors, (index, item) => {
            message += item + '<br />';
        });
        $(form).find('.show-text-success .text-success').html('').hide();
        $(form).find('.show-text-danger .text-danger').html('').hide();
        $(form).find('.show-text-danger .text-danger').html(message).show();
    };

    var handleError = function (data, form) {
        if (typeof (data.errors) !== 'undefined' && !_.isArray(data.errors)) {
            handleValidationError(data.errors, form);
        } else {
            if (typeof (data.responseJSON) !== 'undefined') {
                if (typeof (data.responseJSON.errors) !== 'undefined') {
                    if (data.status === 422) {
                        handleValidationError(data.responseJSON.errors, form);
                    }
                } else if (typeof (data.responseJSON.message) !== 'undefined') {
                    $(form).find('.show-text-danger').html(data.responseJSON.message).show();
                } else {
                    var message = '';
                    $.each(data.responseJSON, (index, el) => {
                        $.each(el, (key, item) => {
                            message += item + '<br />';
                        });
                    });

                    $(form).find('.show-text-danger').html(message).show();
                }
            } else {
                $(form).find('.show-text-danger').html(data.statusText).show();
            }
        }
    };
</script>
@yield('javascript')
@stack('footer')
</body>

</html>
