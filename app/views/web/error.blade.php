@extends('web.layout')

@section('title', 'Error')

@section('pageLvStyle')
    <link href="{{asset('assets/pages/css/login.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('content')
    <!-- BEGIN: Message show -->
    <section  style="background-color:#68845c;">
        <div class="area container">
            <div class="col-md-12 text-center" style="margin-top: 40px;">
                @if($error)
                    <div class="alert alert-danger">
                        <strong>Error !! </strong> {{$error}}
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


<p>To us, an ideal Entrepreneur/Enterprise should have positive answers of the following gigs:</p>
<div class="row">
    <div class="col-xs-2 col-sm-1 col-md-1">
        <img class="entre-icon" src="http://athenaventure.com/upload/media/161.png">
    </div>
    <div class="col-xs-10 col-sm-11 col-md-11">
        <p class="entre-text">Prepared to take on the responsibility?</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-2 col-sm-1 col-md-1">
        <img class="entre-icon" src="http://athenaventure.com/upload/media/162.png">
    </div>
    <div class="col-xs-10 col-sm-11 col-md-11">
        <p class="entre-text">Ready to give-up part of the company's capital to a private investor?</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-2 col-sm-1 col-md-1">
        <img class="entre-icon" src="http://athenaventure.com/upload/media/163.png">
    </div>
    <div class="col-xs-10 col-sm-11 col-md-11">
        <p class="entre-text">The business operate in a growth market (growth more than 10%)?</p>
    </div>
</div>
<div class="entre-hand-img"><img class="" src="http://athenaventure.com/upload/media/170.png"></div>
<div class="row">
    <div class="col-xs-2 col-sm-1 col-md-1">
        <img class="entre-icon" src="http://athenaventure.com/upload/media/164.png">
    </div>
    <div class="col-xs-10 col-sm-11 col-md-11">
        <p class="entre-text">Is the business’s development prospect sufficiently ambitious?</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-2 col-sm-1 col-md-1">
        <img class="entre-icon" src="http://athenaventure.com/upload/media/165.png">
    </div>
    <div class="col-xs-10 col-sm-11 col-md-11">
        <p class="entre-text">Is the team experienced?</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-2 col-sm-1 col-md-1">
        <img class="entre-icon" src="http://athenaventure.com/upload/media/166.png">
    </div>
    <div class="col-xs-10 col-sm-11 col-md-11">
        <p class="entre-text">Competitive advantage that can be exploited?</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-2 col-sm-1 col-md-1">
        <img class="entre-icon" src="http://athenaventure.com/upload/media/167.png">
    </div>
    <div class="col-xs-10 col-sm-11 col-md-11">
        <p class="entre-text">Ready to share strategic decision outside of “inner cycle”?</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-2 col-sm-1 col-md-1">
        <img class="entre-icon" src="http://athenaventure.com/upload/media/168.png">
    </div>
    <div class="col-xs-10 col-sm-11 col-md-11">
        <p class="entre-text">A realistic exit strategy for all shareholders?</p>
    </div>
</div>
<p><br></p>
<h4><b>If you have agreed with all the above terms &amp; conditions, then you may submit your business proposal to us:</b></h4>
<div style="text-align:center; padding:10px;border:10px solid #68845c;"><a href="http://athenaventure.com/registration" class="btn btn-warning">Sign Up</a> <a href="http://athenaventure.com/login" class="btn btn-primary">login</a></div>
