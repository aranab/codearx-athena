@extends('web.layout')

@section('title', 'Profile')

@section('content')
    <?php $contents = json_decode($prf->content, true); ?>
    <section style="background-color:#68845C; color:#ffffff;">
        <div class="container">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <img class="profile-pic" src="{{asset($prf->guid)}}" alt="{{$prf->name}}"/>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-8">
                <div class="profile-text">
                    <h1>{{$prf->title}}</h1>
                    <p>{{$contents['sDes']}}</p>
                </div>
            </div>
        </div>
    </section>
    <section style="background-color:#fff; color:#000;">
        <div class="area container">
            {{$contents['lDes']}}
        </div>
    </section>

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
