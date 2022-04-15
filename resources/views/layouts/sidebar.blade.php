<aside class="page-sidebar">
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
           data-toggle="modal" data-target="#modal-shortcut">
            <img src="{!! asset('templates/home/images/nr-logo.svg') !!}" alt="Web Application"
                 aria-roledescription="logo">
            <span class="page-logo-text mr-1">MUSC NOIR ROSE</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">

        <ul id="js-nav-menu" class="nav-menu">
            <li>
                <a href="{!! route('dashboard.index') !!}" title="Application Intel">
                    <i class="fal fa-info-circle"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{!! route('customer.index') !!}" title="Application Intel">
                    <i class="fal fa-info-circle"></i>
                    <span class="nav-link-text">Customer</span>
                </a>
            </li>
            
            

            
            @if(Auth::user()->isSuperUser())
                <li class="nav-title">System</li>
                <li>
                    <a href="#" title="Administration " data-filter-tags="pages">
                        <i class="fal fa-flag"></i>
                        <span class="nav-link-text" data-i18n="nav.pages">Administration </span>
                    </a>
                    <ul>
                        <li>
                            <a href="{!! route('roles.index') !!}" title="Chat"
                               data-filter-tags="pages roles and permissions">
                                <span class="nav-link-text" data-i18n="nav.pages_chat">Roles and Permissions</span>
                            </a>
                        </li>
                        <li>
                            <a href="{!! route('users.index') !!}" title="Contacts" data-filter-tags="pages users">
                                <span class="nav-link-text" data-i18n="nav.pages_contacts">Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="{!! route('audit-log.index') !!}" title="Inbox"
                               data-filter-tags="pages activities logs">
                                <span class="nav-link-text" data-i18n="nav.audit-logs">Activities Logs</span>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- General master data --}}
                {{-- End general master data --}}
                {{--<li>
                    <a href="#" title="Settings" data-filter-tags="statistics chart graphs">
                        <i class="fal fa-cog"></i>
                        <span class="nav-link-text" data-i18n="nav.statistics">Settings</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{!! route('settings.options') !!}" title="Setting General"
                               data-filter-tags="statistics chart graphs flot bar pie">
                                <span class="nav-link-text" data-i18n="nav.statistics_flot">General</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="Email"
                               data-filter-tags="statistics chart graphs chart.js bar pie">
                                <span class="nav-link-text" data-i18n="nav.statistics_chart.js">Email</span>
                            </a>
                        </li>
                        <li>
                            <a href="{!! route('log-viewer::logs.list') !!}" title="Email"
                               data-filter-tags="statistics chart graphs chart.js bar pie">
                                <span class="nav-link-text" data-i18n="nav.statistics_chart.js">Log Viewer</span>
                            </a>
                        </li>
                    </ul>
                </li>--}}

            @endif
        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->
    <!-- NAV FOOTER -->

<!-- END NAV FOOTER -->
</aside>
