@extends('core.layout')

@section('title', 'Ideas of Users')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/core/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Ideas of Users</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : List of ideas of users -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Data View : Ideas of Users List</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-header-fixed dbTbFixedHeader">
                        <thead>
                        <tr>
                            <th>SL NO.</th>
                            <th>Submitted Date</th>
                            <th>User Name</th>
                            <th>Company Name</th>
                            <th>Designation</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $inc = 1; ?>
                        @foreach($ideas as $idea)
                            <tr class="odd gradeX">
                                <td>{{$inc}}</td>
                                <td>{{$idea->uploaded_date}}</td>
                                <td>{{$idea->user->fullName()}}</td>
                                <td>{{$idea->user->company}}</td>
                                <td>{{$idea->user->designation}}</td>
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
                                <td>
                                    <a href="{{url('/core/ideas', $idea->id)}}" id="{{$idea->id}}"
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
    <!-- END : List of ideas of users -->
@stop
