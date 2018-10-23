@extends('super.layout')

@section('title', 'Sections')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/~super/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{url('/~super/pages/')}}">
                <span>Pages</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Sections</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Sections Grid List -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Data View : Sections List</span>
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
                                       href="{{url('/~super/pages/sections/create')}}">
                                        <i class="fa fa-plus"></i>
                                        Add Section
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
                                <th>Page Title</th>
                                <th>Sections Title</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $inc = 1; ?>
                        @foreach($pages as $page)
                            <tr class="odd gradeX">
                                <td>{{$inc}}</td>
                                <td>{{$page->title}}</td>
                                <td>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Order</th>
                                                <th>Title</th>
                                                <th>GUID</th>
                                                <th>Uploaded By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($page->sections as $sec)
                                                <tr>
                                                    <td>{{$sec->section_order}}</td>
                                                    <td>{{$sec->title}}</td>
                                                    <td>{{$siteUrl.$sec->guid}}</td>
                                                    <td>{{$sec->uploaded_by}}</td>
                                                    <td>
                                                        <a href="{{url('/~super/pages/sections', [$sec->id])}}"
                                                           id="{{$sec->id}}"
                                                           class="btn btn-info btn-sm">
                                                            <i class="fa fa-info" aria-hidden="true"></i>
                                                            details
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
    <!-- END : Sections Grid Lists -->
@stop

@section('modal')
    <div id="ajaxModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="600">
    </div>
@stop

@section('scriptFile')
    <script>
    </script>
@stop