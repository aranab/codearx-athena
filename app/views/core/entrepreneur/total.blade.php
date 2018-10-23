@extends('core.layout')

@section('title', 'User Total Ideas')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb font-white">
        <li>
            <a href="{{url('/core/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>User Total Ideas List</span>
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
                        <span class="caption-subject bold uppercase">User Total Ideas List</span>
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
                    <h4>User's Details</h4>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td style="width:35%">
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>User Pic</strong>
                                </div>
                            </td>
                            <td style="width:65%">
                                <div class="thumbnail">
                                    <?php
                                        $src = asset('/assets/layouts/layout/img/avatar.png');
                                        if ($user->ext) {
                                            $src = asset($user->path.$user->id.$user->ext);
                                        }
                                    ?>
                                    <img src="{{$src}}" alt="{{$user->lname}}"
                                         style="width:200px; height: 200px">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:35%">
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>User Name</strong>
                                </div>
                            </td>
                            <td style="width:65%">{{$user->fullName()}}</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Company Name</strong>
                                </div>
                            </td>
                            <td>{{$user->company}}</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Designation</strong>
                                </div>
                            </td>
                            <td>{{$user->designation}}</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Mobile Number</strong>
                                </div>
                            </td>
                            <td>{{$user->mobile}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <h4>Submitted Ideas List</h4>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>SL NO.</th>
                            <th>Date of Submission</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $inc = 1; ?>
                        @foreach($user->ideas as $idea)
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
                                <td>
                                    <a href="{{url('/core/ideas', $idea->id)}}" id="{{$idea->id}}" target="_blank"
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
    <!-- END : Users idea List -->
@stop


