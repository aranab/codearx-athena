@extends('web.layoutD')

@section('title', 'Dashboard')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb font-white">
        <li>
            <a href="{{url('/user/dashboard')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Warning</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN: Warning -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-yellow-saffron">
                        <i class="fa fa-exclamation-triangle font-yellow-saffron" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">Warning</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10 text-center">
                            @if(Session::has('warning'))
                                <div class="alert alert-danger">
                                    <strong>Warning!!</strong> {{Session::get('warning')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Warning -->
@stop


