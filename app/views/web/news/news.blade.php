@extends('web.layout')

@section('title', 'Profile')

@section('content')
    @if ($news->newsDetails->mime_type)
    <section style="background-color:#68845c; color:#ffffff;">
        <div class="">
            <div class="">
                <div class="">
                    <div class="carousel slide">
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="first-slide" src="{{url($news->newsDetails->guid)}}" alt="{{$news->name}}">
                                <div class="container">
                                    <div class="carousel-caption" style="text-align:center;bottom:0%; left:0%; right:0%;">
                                        <h1 style="color:#ffffff;font-size:36px;"><span class="title">{{$news->title}}</span></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section style="background-color:#fff; color:#000;">
        <div class="area container">
            <div class="header-content">
                <h1 class="font-blue-dark">{{$news->title}}</h1>
            </div>
            {{$news->newsDetails->content}}
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
