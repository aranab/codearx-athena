@extends('super.layout')

@section('title', 'Roles List')

@section('pageLvStylePlugin')
@stop

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/~super/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Roles List</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Roles Grid List -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Data View : Roles List</span>
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
                                       href="javascript:;"
                                        onclick="javascript:ajaxCall();">
                                        <i class="fa fa-plus"></i>
                                        Add Role
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
                            <th>Role Title</th>
                            <th>Type</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $inc = 1 ?>
                        @foreach($roles as $role)
                            <tr class="odd gradeX">
                                <td>{{$inc}}</td>
                                <td>{{$role->name}}</td>
                                <td>
                                    <?php
                                        switch ($role->type) {
                                            case 'SC':
                                                $name = 'Super Controller';
                                                break;
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
                                <td>{{$role->created_at}}</td>
                                <td>{{$role->updated_at}}</td>
                                <td></td>
                            </tr>
                            <?php $inc++ ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END : Roles Grid List -->
@stop

@section('modal')
    <div id="ajaxModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="600">
    </div>
@stop

@section('pageLvScriptPlugin')
@stop

@section('pageLvScript')
@stop

@section('scriptFile')
    <script>
        var $modal = $('#ajaxModal');

        function ajaxCall()
        {
            var url = '{{url('/~super/roles/create')}}';
            // create the backdrop and wait for next modal to be triggered
            $('body').modalmanager('loading');
            setTimeout(function () {
                $modal.load(url, null, function () {
                    $modal.modal();
                });
            }, 1000);
        }
    </script>
@stop