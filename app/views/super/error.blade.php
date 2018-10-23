@extends('super.layout')

@section('title', 'Error - Page Not Found')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/core/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Error - Page Not Found</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Error -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-question font-red"></i>
                        <span class="caption-subject bold uppercase">
                            Page Not Found
                        </span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                    </div>
                </div>
                <div class="portlet-body cus-courses-portlet-body">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10 text-center">
                            @if($error)
                                <div class="alert alert-danger">
                                    <strong>Error !! </strong> {{$error}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END : Error -->
@stop

@section('scriptFile')
    <script>
    </script>
@stop