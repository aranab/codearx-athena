@extends('core.layout')

@section('title', 'Users List')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/core/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Users List</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Users Grid Lists -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Data View : Users List</span>
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
                                    <a class="btn sbold green" href="{{url('/core/users/create')}}">
                                        <i class="fa fa-plus"></i>
                                        Add User
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
                    <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_1">
                        <thead>
                        <tr>
                            <th>SL NO.</th>
                            <th>Name</th>
                            <th>Picture</th>
                            <th>User Name/Email</th>
                            <th>Mobile</th>
                            <th>Roles</th>
                            <th>User Type</th>
                            <th>Uploaded by</th>
                            <th>Modify by</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $inc = 1 ?>
                        @foreach($users as $user)
                            <tr class="odd gradeX">
                                <td>{{$inc}}</td>
                                <td>{{$user->fullName()}}</td>
                                <td>
                                    @if($user->ext)
                                        <img width="100"
                                             height="75"
                                             src="{{url($user->path.$user->id.$user->ext)}}"
                                             alt="{{$user->pic_name}}"/>
                                    @else
                                        <img width="100"
                                             height="75"
                                             src="{{url('img/no-img.jpg')}}"
                                             alt="{{$user->username}}"/>
                                    @endif
                                </td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->mobile}}</td>
                                <td>
                                    <?php
                                    $rolesList = $user->roles;
                                    $name = '';
                                    $count = 0;
                                    foreach ($rolesList as $role) {
                                        if($count) {
                                            $name .= ', ';
                                        }
                                        $name .= $role->name;
                                        $count++;
                                    }
                                    ?>
                                    {{$name}}
                                </td>
                                <td>
                                    <?php
                                    switch ($user->user_type) {
                                        case 'WDC':
                                            $name = 'Web Dashboard Controller';
                                            break;
                                        case 'UDC':
                                            $name = 'User Dashboard Controller';
                                            break;
                                        default:
                                            $name = 'Not Defined Yet';
                                    }
                                    ?>
                                    {{$name}}
                                </td>
                                <td>{{$user->uploaded_by}}</td>
                                <td>{{$user->modify_by}}</td>
                                <td>
                                    <a href="{{url('/core/profile', $user->id )}}" id="{{$user->id}}"
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
    <!-- END : Users Grid Lists -->
@stop

@section('scriptFile')
    <script>
    </script>
@stop