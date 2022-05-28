<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Century Real Estate Admin Panel</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ url('admin-panel-assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ url('admin-panel-assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('admin-panel-assets/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('admin-panel-assets/css/morris/morris.css') }}" rel="stylesheet">
    <link href="{{ url('admin-panel-assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('admin-panel-assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('admin-panel-assets/css/AdminLTE.css') }}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css" rel="stylesheet">
    <script src="{{ url('admin-panel-assets/js/app.js') }}"></script>
    <script src="{{ url('admin-panel-assets/js/jquery.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('admin-panel-assets/js/jquery-ui.js') }}"></script> 
    <script src="{{ url('admin-panel-assets/js/custom.js') }}?v={{time()}}"></script>
    <script src="{{ url('admin-panel-assets/js/AdminLTE/app.js') }}"></script>
    <script src="{{ url('admin-panel-assets/js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
</head>
<body class="skin-blue">
    <header class="header">
        <nav class="navbar navbar-static-top" role="navigation">
            <a class="navbar-brand" href="{{ Config::get('constants.admin_url') }}">Century Real Estate</a>
            @if (!Auth::guest())
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            @endif
            <div class="navbar-right">
               <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (!Auth::guest())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>
    <div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 582px">
        @if (Auth::check())
        <aside class="left-side sidebar-offcanvas" style="min-height:2110px;">
            <section class="sidebar">
                <div class="user-panel"></div>
                <ul class="sidebar-menu">
                    <li><a href="{{ Config::get('constants.admin_url') }}"><i class="fa fa-angle-double-right"></i>Dashboard</a></li>
                    <li class="treeview">
                        <a href="#">
                            <span>Home</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ Config::get('constants.admin_url')}}edit-home-page-video"><i class="fa fa-angle-double-right"></i>Video</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-home-page-sliders"><i class="fa fa-angle-double-right"></i>Sliders</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}edit-home-page-about-us"><i class="fa fa-angle-double-right"></i>About Us</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-testimonials"><i class="fa fa-angle-double-right"></i>Testimonials</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <span>About Us</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ Config::get('constants.admin_url')}}edit-home-page-about-us"><i class="fa fa-angle-double-right"></i>About Us</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-timelines"><i class="fa fa-angle-double-right"></i>Timelines</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-management"><i class="fa fa-angle-double-right"></i>Management</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <span>Projects</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-project-budgets"><i class="fa fa-angle-double-right"></i>Budgets</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-project-locations"><i class="fa fa-angle-double-right"></i>Locations</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-project-zones"><i class="fa fa-angle-double-right"></i>Zones</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-project-types"><i class="fa fa-angle-double-right"></i>Types</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-project-categories"><i class="fa fa-angle-double-right"></i>Categories</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-project-status"><i class="fa fa-angle-double-right"></i>Status</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-projects"><i class="fa fa-angle-double-right"></i>Projects</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <span>Commercial Projects</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ Config::get('constants.admin_url')}}commercial-projects-lists"><i class="fa fa-angle-double-right"></i>Commercial Projects</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <span>Social Responsbilities</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-social-responsibilities"><i class="fa fa-angle-double-right"></i>Sections</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-social-projects"><i class="fa fa-angle-double-right"></i>Projects</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-galleries"><i class="fa fa-angle-double-right"></i>Gallery</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <span>Media</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-media"><i class="fa fa-angle-double-right"></i>Media</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-reports"><i class="fa fa-angle-double-right"></i>Report</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-press"><i class="fa fa-angle-double-right"></i>Press</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-videos"><i class="fa fa-angle-double-right"></i>Videos</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}edit-media-kit"><i class="fa fa-angle-double-right"></i>Media Kit</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ Config::get('constants.admin_url')}}manage-why-us"><i class="fa fa-angle-double-right"></i>Why Us</a></li>
                    <li><a href="{{ Config::get('constants.admin_url')}}manage-awards"><i class="fa fa-angle-double-right"></i>Awards</a></li>
                    <li class="treeview">
                        <a href="#">
                            <span>Setting</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-meta-data"><i class="fa fa-angle-double-right"></i>Meta Data</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-banners"><i class="fa fa-angle-double-right"></i>Banners</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-enquiries"><i class="fa fa-angle-double-right"></i>Enquiries</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-contact-enquiries"><i class="fa fa-angle-double-right"></i>Contact Enquiries</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}manage-media-kit-enquiries"><i class="fa fa-angle-double-right"></i>Media Kit Enquiries</a></li>
                            <li><a href="{{ Config::get('constants.admin_url')}}edit-frontend-script"><i class="fa fa-angle-double-right"></i>Script</a></li>
                        </ul>
                    </li>
                </ul>
            </section>
        </aside>
        <aside class="right-side">
        @yield('content')
        </aside>
        @else
        <aside>
        @yield('content')
        </aside>
        @endif
    </div>
</body>
</html>