@extends('web.layout')

@section('title', 'Message')

@section('pageLvStyle')
    <link href="{{asset('assets/pages/css/login.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('content')
    <!-- BEGIN: Message show -->
    <section  style="background-color:#68845c;">
        <div class="area container">
            <div class="col-md-12 text-center" style="margin-top: 40px;">
                @if($state == 'error')
                    <div class="alert alert-danger">
                        <strong>Error !!</strong> {{$msg}}
                    </div>
                @endif
                @if($state == 'success')
                    <div class="alert alert-success">
                        <strong>Congratulation !!</strong> {{$msg}}
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- END: Message show -->

    <!-- BEGIN SEPARATOR -->
    <div class="web-separator web-green"></div>
    <!-- END SEPARATOR -->

    <!-- BEGIN: Footer Widget -->
    <section class="web-white">
        <div class="area container">
            <div class="header-content">
                <h1 class="font-blue-dark">{{$widget->title}}</h1>
            </div>
            <div class="row">{{$widget->content}}</div>
        </div>
    </section>
    <!-- END: Footer Widget -->
@stop

