@extends('web.layoutD')

@section('title', 'Idea Details')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb font-white">
        <li>
            <a href="{{url('/user/dashboard')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Idea-Details</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Users idea List -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Idea Details</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="text-center">
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
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 1%">SL NO.</th>
                            <th style="width: 1%">Date of Submission</th>
                            <th style="width: 4%">Query</th>
                            <th style="width: 5%">Submitted</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $inc = 1; $ideaUserId = $idea->id; ?>
                        @foreach($idea->answers as $detail)
                            <tr class="odd gradeX">
                                <td>{{$inc}}</td>
                                <td>{{$idea->uploaded_date}}</td>
                                <td>{{$detail->question->question}}</td>
                                <td>
                                    @if ($detail->question->format == 'file')
                                        <a href="{{url("/user/idea/$ideaUserId/download", $detail->id )}}"
                                           class="btn btn-info btn-sm">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            Download Attachment...
                                        </a>
                                    @else
                                        {{$detail->content}}
                                    @endif
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
    <!-- END : Users idea List -->
@stop


