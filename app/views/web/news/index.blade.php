@extends('web.layout')

@section('title', 'All News')

@section('pageLvStylePlugin')
    <!--DataTable-->
    <link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}"
          rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}"
          rel="stylesheet" type="text/css" />
@stop

@section('content')
    <section style="background-color:#68845c; color:#ffffff;">
        <div class="">
            <div class="">
                <div class="">
                    <div class="carousel slide">
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="first-slide" src="{{url('/upload/media/196.jpeg')}}" alt="news">
                                <div class="container">
                                    <div class="carousel-caption" style="text-align:center;bottom:0%; left:0%; right:0%;">
                                        <h1 style="color:#68845c;font-size:36px;">
                                            <span class="title"></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="background-color:#fff; color:#000;">
        <div class="area container">
            <div class="header-content">
                <h1 style="color:#000;font-size:36px;">
                    <span>News/Blog/Research</span>
                </h1>
            </div>
            <table id="newsDT" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th style="width: 5%;">SL NO.</th>
                    <th style="width: 10%;">Title</th>
                    <th style="width: 70%;">Short Details</th>
                    <th style="width: 15%;">Published Date</th>
                </tr>
                </thead>
                <tbody>
                <?php $inc = 1 ?>
                @foreach($newses as $news)
                    <tr class="odd gradeX">
                        <td>{{$inc}}</td>
                        <td>{{$news->title}}</td>
                        <td>{{Str::limit($news->content, $limit = 200, $end = '....')}}<a class="" href="{{url('/news', $news->id)}}">...Read More</a></td>
                        <td>{{$news->uploaded_date}}</td>
                    </tr>
                    <?php $inc++ ?>
                @endforeach
                </tbody>
            </table>
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

@section('pageLvsScriptPlugin')
    <!--Datatable-->
    <script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <!-- Datatable -->
    <script>
        $('#newsDT').DataTable( {
            responsive: true
        } );
    </script>
@stop
