<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Athena Venture | @yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"
          rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}"
          rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}"
          rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}"
          rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/uniform/css/uniform.default.css') }}"
          rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}"
          rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!--DataTable-->
    <link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}"
          rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}"
          rel="stylesheet" type="text/css" />
    <!--Modal-->
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}"
          rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}"
          rel="stylesheet" type="text/css" />
    <!--File Input-->
    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}"
          rel="stylesheet" type="text/css" />
    <!-- In place editable -->
    <link href="{{asset('/assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')}}"
          rel="stylesheet" type="text/css" />
    @yield('pageLvStylePlugin')
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('assets/global/css/components.css')}}" rel='stylesheet' type='text/css' />
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    @yield('pageLvStyle')
    <!-- END PAGE LEVEL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('assets/layouts/layout/css/layout.min.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('assets/layouts/layout/css/custom.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('assets/web/css/custom.css')}}" rel='stylesheet' type='text/css' />
    <!-- END THEME LAYOUT STYLES -->

    @yield('styleFile')

    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}"/>
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-sidebar-closed-hide-logo page-boxed">

<!-- BEGIN HEADER -->
<header class="page-header navbar">

    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner container">

        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{url('/')}}">
                <img src="{{asset('img/logo.png')}}" alt="logo" class="logo-default" />
            </a>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;"
           class="menu-toggler responsive-toggler"
           data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->

        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div id="menu" class="top-menu">
                <ul class="nav navbar-nav pull-right">
                @foreach ($topMenu as $link)
                    <!-- BEGIN MENU -->
                        <li class="separator hide"> </li>
                        <li class="dropdown">
                            <a href="{{url($link->guid)}}" class="dropdown-toggle">
                                <strong>{{$link->title}}</strong>
                            </a>
                        </li>
                        <!-- END MENU -->
                    @endforeach
                    <li class="separator hide"></li>
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->

    </div>
    <!-- END HEADER INNER -->

</header>
<!-- END HEADER -->

<!-- BEGIN CONTAINER -->
<div class="page-container">

    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">

        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <ul class="page-sidebar-menu page-header-fixed"
                data-keep-expanded="false"
                data-auto-scroll="true"
                data-slide-speed="200"
                style="background: #81af6e;padding-top: 0px;">

                <li class="sidebar-toggler-wrapper hide">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler"> </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>

                <!-- BEGIN SIDEBAR USER INFO -->
                <li class="nav-item sidebar-profile-wrapper">
                    <div class="sidebar2-profile-inner-wrapper">
                        <div class="sidebar2-portfolio">
                            <a href="{{url('/user/profile')}}">
                                <?php
                                $src = asset('/assets/layouts/layout/img/avatar.png');
                                if (Auth::user()->ext) {
                                    $src = asset(Auth::user()->path.Auth::user()->id.Auth::user()->ext);
                                }
                                ?>
                                <img alt="{{Auth::user()->username}}"
                                     src="{{$src}}"
                                     class="img-circle cus2-pro-img"/>
                            </a>
                            <h2 class="cus2-sidebar-portfolio-title" style="margin-top: 10px;">Welcome,</h2>
                            <p class="cus2-sidebar-portfolio-name">
                                <?php
                                $name = 'Unknown';
                                if (Auth::user()->fname) {
                                    $name = Auth::user()->fname;
                                }
                                ?>
                                {{$name}}
                            </p>
                            <p class="cus2-sidebar-portfolio-status font-white">
                                <em>(Visitor)</em>
                            </p>
                        </div>
                    </div>
                </li>
                <!-- END SIDEBAR USER INFO -->

                <!-- BEGIN SIDE NAVIGATION BAR -->
            @include('web.partials._sideBarPartial')
            <!-- END SIDE NAVIGATION BAR -->
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->

            <!-- BEGIN HEADER -->
            <div class="page-header navbar" style="margin-top: 0px; background-color: #68845c;">

                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">

                    <!-- BEGIN SEARCH BAR -->
                    <div class="col-sm-6" style="margin-top:10px">
                        <h4 class="font-white">
                            Visiting IP : ({{Auth::user()->last_visit_ip}})
                        </h4>
                    </div>
                    <!-- END SEARCH BAR -->

                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;"
                       class="menu-toggler responsive-toggler"
                       data-toggle="collapse"
                       data-target=".navbar-collapse">
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->

            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                @yield('bar')
            </div>
            <!-- END PAGE BAR -->

            <!-- END PAGE HEADER-->
            <div class="page-inner-content-wrapper">
                @yield('content')
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
<footer class="page-footer">
    <div class="container">

        <div class="row">

            <!--BEGIN COPY RIGHT-->
            <div class="col-md-4">
                <div class="page-footer-inner pull-left">
                    © Copyright {{date('Y')}}, Athena Venture All Rights Reserved
                </div>
            </div>
            <!--END COPY RIGHT-->

            <!--BEGIN FOOTER MENU-->
            <div class="col-md-offset-2 col-md-6">
                <ul class="list-inline pull-right">
                    <li>
                        <span>
                            <a href="http://www.orbitinformatics.com" target="_blank">
                                <img width="70px" height="35px" src="{{asset('img/orbit/logo.png')}}" alt="orbit"/>
                            </a>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <!--END FOOTER MENU-->

        <div class="scroll-to-top" style="display: block;">
            <i class="icon-arrow-up font-white"></i>
        </div>
    </div>
</footer>
<!-- BEGIN FOOTER -->

<!--[if lt IE 9]>
<script src="{{asset('assets/global/plugins/respond.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/excanvas.min.js')}}"
        type="text/javascript"></script>
<![endif]-->

<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('assets/web/plugins/jquery.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/uniform/jquery.uniform.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
        type="text/javascript"></script>
<!--Datatable-->
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
        type="text/javascript"></script>
<!--Modal-->
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}"
        type="text/javascript"></script>
<!--File Input-->
<script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}"
        type="text/javascript"></script>
<!-- In place editable -->
<script src="{{asset('/assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js')}}"
        type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('assets/global/scripts/app.min.js') }}"
        type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- Datatable -->
<script src="{{asset('assets/pages/scripts/table-datatables-fixedheader.js')}}"
        type="text/javascript"></script>
@yield("pageLvScript")
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{asset('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/layouts/global/scripts/custom.js')}}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

@yield('scriptFile')
</body>
</html>