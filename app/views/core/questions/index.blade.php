@extends('core.layout')

@section('title', 'Questions')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/core/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Questions</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Questions Grid List -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Data View : Questions List</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="btn-group">
                                    <a class="btn sbold green"
                                       href="{{url('/core/questions/create')}}">
                                        <i class="fa fa-plus"></i>
                                        Add Question
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-10 text-center">
                                @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        <button class="close" data-dismiss="alert"></button>
                                        <strong>Success!!</strong> {{Session::get('success')}}
                                    </div>
                                @endif
                                @if(Session::has('error'))
                                    <div class="alert alert-danger">
                                        <button class="close" data-dismiss="alert"></button>
                                        <strong>Error!!</strong> {{Session::get('error')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <h3>Text Input Base Question</h3>
                    <table class="table table-striped table-bordered table-hover table-header-fixed dbTbFixedHeader">
                        <thead>
                        <tr>
                            <th>ORDER NO.</th>
                            <th>Question</th>
                            <th>Uploaded Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($txtQ as $q)
                            <tr class="odd gradeX">
                                <td>{{$q->order_no}}</td>
                                <td>{{$q->question}}</td>
                                <td>{{$q->uploaded_date}}</td>
                                <td>
                                    <a href="{{url('/core/questions', $q->id)}}" id="{{$q->id}}"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                        Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <h3>Pdf File Upload Base Question</h3>
                    <table class="table table-striped table-bordered table-hover table-header-fixed dbTbFixedHeader">
                        <thead>
                        <tr>
                            <th>ORDER NO.</th>
                            <th>Question</th>
                            <th>Uploaded Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fileQ as $q)
                            <tr class="odd gradeX">
                                <td>{{$q->order_no}}</td>
                                <td>{{$q->question}}</td>
                                <td>{{$q->uploaded_date}}</td>
                                <td>
                                    <a href="{{url('/core/questions', $q->id)}}" id="{{$q->id}}"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                        Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END : Questions Grid List -->
@stop

@section('modal')
    <div id="ajaxModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="600">
    </div>
@stop

@section('scriptFile')
    <script>
    </script>
@stop