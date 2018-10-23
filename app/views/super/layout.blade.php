<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Super Admin Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/color-picker/spectrum.min.css')}}" rel="stylesheet" type="text/css" />
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
    <link href="{{asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')}}"
          rel="stylesheet" type="text/css" />
    @yield('pageLvStylePlugin')
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('assets/global/css/components.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    @yield('pageLvStyle')
    <!-- END PAGE LEVEL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('assets/layouts/layout/css/layout.min.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('assets/layouts/layout/css/themes/darkblue.min.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('assets/layouts/layout/css/custom.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('assets/layouts/layout/css/custom-responsive.css')}}" rel='stylesheet' type='text/css' />
    <!-- END THEME LAYOUT STYLES -->

    @yield('styleFile')
    <link rel="shortcut icon" href="{{asset('img/orbit/favicon.png')}}"/>
</head>
<!-- END HEAD -->

<body class="">

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
                style="background: #374150;padding-top: 0px;">

                <li class="sidebar-toggler-wrapper hide">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler"> </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>

                <!-- BEGIN SIDEBAR ORBIT LOGO -->
                <li class="sidebar-search-wrapper cus-sidebar-search-wrapper">
                    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                    <a href="{{url('/~super/')}}" class="pull-left">
                        <img src="{{asset('img/orbit/logo.png')}}"
                             style="width: 130px; height: 45px;"
                             alt="logo"
                             class="logo-default" />
                    </a>
                    <!-- END RESPONSIVE QUICK SEARCH FORM -->
                </li>
                <!-- END SIDEBAR ORBIT LOGO -->

                <!-- BEGIN SIDEBAR USER INFO -->
                <li class="nav-item sidebar-profile-wrapper">
                    <div class="sidebar2-profile-inner-wrapper">
                        <div class="sidebar2-portfolio">
                            <a href="#">
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
                            <p class="cus2-sidebar-portfolio-status"><em>(Super Admin)</em></p>
                        </div>
                    </div>
                </li>
                <!-- END SIDEBAR USER INFO -->

                <!-- BEGIN SIDE NAVIGATION BAR -->
                @include('super.partials._sideBarPartial')
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
            <div class="page-header navbar">

                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">

                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;"
                       class="menu-toggler responsive-toggler"
                       data-toggle="collapse"
                       data-target=".navbar-collapse">
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->

                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu col-sm-6">
                        <ul class="nav navbar-nav pull-right">

                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        @include('super.partials._userLoginPartial')
                        <!-- END USER LOGIN DROPDOWN -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->

                </div>
                <!-- END HEADER INNER -->

            </div>
            <!-- END HEADER -->

            <!-- BEGIN PAGE BAR -->
            <div class="page-bar cus-page-bar">
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
<div class="page-footer">
    <div class="page-footer-inner pull-right">
        <?php echo date('Y'); ?> &copy; Orbit Controller. |
        <a href="http://www.orbitinformatics.com" target="_blank">Orbit Informatics</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->

<!-- BEGIN MODAL BODY -->
@yield('modal')
<!-- END MODAL BODY -->

<!--[if lt IE 9]>
<script src="{{asset('assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->

<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/color-picker/spectrum.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"  type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"  type="text/javascript"></script>
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
@yield('pageLvsScriptPlugin')
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/global/scripts/app.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/pages/scripts/dashboard.js')}}" type="text/javascript"></script>
<!--Datatable-->
<script src="{{asset('assets/pages/scripts/table-datatables-fixedheader.js')}}"
        type="text/javascript"></script>
@yield("pageLvScript")
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{asset('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/layouts/global/scripts/custom.js')}}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

@yield("scriptFile")
</body>
</html>