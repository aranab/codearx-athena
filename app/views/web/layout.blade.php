<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Athena Venture</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="@yield('mDes')" name="description" />
    <meta content="@yield('mAuth')" name="author" />
    @yield('cTag')

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
    <!-- Important Owl stylesheet -->
    <link href="{{asset('assets/web/plugins/owl-carousel/owl.custom.css')}}" rel="stylesheet" />
    @yield('pageLvStylePlugin')
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    @yield('pageLvStyle')
    <!-- END PAGE LEVEL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('assets/web/css/layout.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('assets/web/css/custom.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('assets/web/css/userCustom.css')}}" rel='stylesheet' type='text/css' />
    <!-- END THEME LAYOUT STYLES -->

    @yield('styleFile')

    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}"/>
</head>
<!-- END HEAD -->

<body class="">

<!-- BEGIN HEADER -->
<header class="page-header navbar">

    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner container">

        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{url('/')}}">
                <img src="{{asset('img/logo.png')}}" alt="logo" class="logo-default"/>
            </a>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!-- END RESPONSIVE MENU TOGGLER -->

        <!-- BEGIN PAGE TOP -->
        <div id="menu" class="collapse navbar-collapse">
            <!-- BEGIN TOP NAVIGATION MENU -->
            <ul class="nav navbar-nav">
            @foreach ($topMenu as $link)
                <!-- BEGIN MENU -->
                    <li class="separator"> </li>
                    <li class="dropdown">
                        <a href="{{url($link->guid)}}" class="dropdown-toggle">
                            <strong>{{$link->title}}</strong>
                        </a>
                    </li>
                    <!-- END MENU -->
                @endforeach
                <li class="separator"></li>
            </ul>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->

</header>
<!-- END HEADER -->

<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->

<!-- BEGIN BODY CONTAINER -->
@yield('content')
<!-- END BODY CONTAINER -->

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
                                <img class="orbit" src="{{asset('img/orbit/logo.png')}}" alt="orbit"/>
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
<script src="{{asset('assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->

<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('assets/web/plugins/jquery.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/web/plugins/owl-carousel/owl.plugin.js')}}"></script>
<!-- google MAP-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6e1cIOOcIf9WC8UfdXwc-Ggbt-DP--KY&amp;v=3.exp"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
@yield('pageLvsScriptPlugin')
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{asset('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
@yield('pageLvScript')
<script src="{{asset('assets/web/js/custom.js')}}"></script>
<!-- END PAGE LEVEL SCRIPTS -->
@yield('scriptFile')
</body>
</html>