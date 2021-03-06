@extends('super.layout')

@section('title', 'Menu')

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
            <span>Menu</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Menu Grid List -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Data View : Menu List</span>
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
                                        Add Menu
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
                            <th>Menu Title</th>
                            <th>GUID/Link</th>
                            <th>Order</th>
                            <th>Uploaded By</th>
                            <th>Modified By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $inc = 1; ?>
                        @foreach($menu as $link)
                            <tr class="odd gradeX">
                                <td>{{$inc}}</td>
                                <td>{{$link->page->title}}</td>
                                <td>{{$link->title}}</td>
                                <td>{{$siteUrl.$link->guid}}</td>
                                <td>{{$link->menu_order}}</td>
                                <td>{{$link->uploaded_by}}</td>
                                <td>{{$link->modified_by}}</td>
                                <td>
                                    <a href="javascript:;"
                                       id="{{$link->id}}"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                        details
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
    <!-- END : Menu Grid Lists -->
@stop

@section('modal')
    <div id="ajaxModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="600">
    </div>
@stop

@section('scriptFile')
    <script>
        var $modal = $('#ajaxModal');

        function ajaxCall()
        {
            var url = '{{url('/~super/pages/menu/create')}}';
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