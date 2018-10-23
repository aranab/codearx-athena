@extends('core.layout')

@section('title', 'Questions Log')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/core/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{url('/core/questions')}}">
                <span>Questions List</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Questions Log</span>
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
                        <span class="caption-subject bold uppercase">Data View : Questions Log</span>
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
                    <table class="table table-striped table-bordered table-hover table-header-fixed dbTbFixedHeader">
                        <thead>
                        <tr>
                            <th>SL NO.</th>
                            <th>Question</th>
                            <th>Input Format</th>
                            <th>Status</th>
                            <th>Uploaded Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $inc = 1; ?>
                        @foreach($questions as $q)
                            <tr class="odd gradeX">
                                <td>{{$inc}}</td>
                                <td>{{$q->question}}</td>
                                <td>
                                    <?php
                                        $name = 'Text Base Input';
                                        if ($q->format == 'file') {
                                            $name = 'File Upload Base Input';
                                        }
                                    ?>
                                    <span>{{$name}}</span>
                                </td>
                                <td>
                                    <?php
                                        $name = 'Deleted';
                                        $cls = 'font-red';
                                        if ($q->status) {
                                            $name = 'Live';
                                            $cls = 'font-green';
                                        }
                                    ?>
                                    <span class="{{$cls}}">{{$name}}</span>
                                </td>
                                <td>{{$q->uploaded_date}}</td>
                                <td>
                                    <a href="{{url('/core/questions', $q->id)}}" id="{{$q->id}}"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                        Details
                                    </a>
                                </td>
                            </tr>
                            <?php $inc++ ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END : Questions Grid List -->
@stop

@section('scriptFile')
    <script>
    </script>
@stop