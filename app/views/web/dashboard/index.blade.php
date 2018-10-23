@extends('web.layoutD')

@section('title', 'Dashboard')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb font-white">
        <li>
            <span>Dashboard</span>
            <i class="fa fa-angle-right"></i>
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
                        <span class="caption-subject bold uppercase">Idea Submission Logs</span>
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
                            <th>SL NO.</th>
                            <th>Date of Submission</th>
                            <th>status</th>
                            <th>Comments</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $inc = 1 ?>
                        @if (count($ideas))
                        @foreach($ideas as $idea)
                            <tr class="odd gradeX">
                                <td>{{$inc}}</td>
                                <td>{{$idea->uploaded_date}}</td>
                                <td>
                                    <?php
                                        $name = 'Pending...';
                                        $cls = 'cFont-blue';
                                        if ($idea->status == 0) {
                                            $name = 'Rejected';
                                            $cls = 'cFont-red';
                                        }
                                        if ($idea->status == 2) {
                                            $name = 'Viewing...';
                                            $cls = 'cFont-yellow';
                                        }
                                        if ($idea->status == 3) {
                                            $name = 'Accepted';
                                            $cls = 'cFont-green';
                                        }
                                    ?>
                                    <h4 class="{{$cls}} text-center">{{$name}}</h4>
                                </td>
                                <td>{{$idea->remarks}}</td>
                                <td>
                                    <a href="{{url('/user/idea', $idea->id )}}" id="{{$idea->id}}"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                        Details....
                                    </a>
                                </td>
                            </tr>
                            <?php $inc++ ?>
                        @endforeach
                        @else
                            <tr><td colspan="5" class="text-center"><span class="cFont-red">You have not submitted any idea</span></td></tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END : Users idea List -->
@stop


