@extends('core.layout')

@section('title', 'Pages')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/core/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{url('/core/pages')}}">
                <span>Pages</span>
            </a>
        </li>
        <li>
            <span>Page Name: {{$page->title}}</span>
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
                        <span class="caption-subject bold uppercase">Data View : {{$page->title}} Sections List</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <?php $seo = json_decode($page->content, true); ?>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td style="width:35%">
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Page Title</strong>
                                    </div>
                                </td>
                                <td style="width:65%">
                                    <a href="javascript:;"
                                       id="title"
                                       data-type="text"
                                       data-original-title="Enter page title"
                                       data-pk="{{$page->id}}">{{$seo['t']}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Meta Author</strong>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:;"
                                       id="mAuth"
                                       data-type="text"
                                       data-original-title="Enter page meta author"
                                       data-pk="{{$page->id}}">{{$seo['mAuth']}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Meta Description</strong>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:;"
                                       id="mDes"
                                       data-type="textarea"
                                       data-original-title="Enter page meta description"
                                       data-pk="{{$page->id}}">{{$seo['mDes']}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Canonical Link Tag URL</strong>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:;"
                                       id="cTag"
                                       data-type="textarea"
                                       data-original-title="Enter page canonical link tag"
                                       data-pk="{{$page->id}}">{{$seo['cTag']}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Is Footer Widget?</strong>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    $name = 'Inactive';
                                    if ($seo['fw']) {
                                        $name = 'Active';
                                    }
                                    ?>
                                    <a href="javascript:;"
                                       id="fw"
                                       data-type="select"
                                       data-original-title="Select one"
                                       data-pk="{{$page->id}}">{{$name}}</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_1">
                        <thead>
                        <tr>
                            <th style="width: 3%">SL NO.</th>
                            <th style="width: 10%">Title</th>
                            <th style="width: 10%">Status</th>
                            <th style="width: 60%">Items</th>
                            <th style="width: 3%">Column</th>
                            <th style="width: 4%">Css Class</th>
                            <th style="width: 5%">Background Color</th>
                            <th style="width: 5%">Bottom Separator</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($page->sections as $sec)
                            <?php $layout = json_decode($sec->content, true); ?>
                            <tr class="odd gradeX">
                                <td>{{$sec->section_order}}</td>
                                <td>{{$sec->title}}</td>
                                <td>
                                    <?php
                                        $name = 'Inactive';
                                        if ($sec->status) {
                                            $name = 'Active';
                                        }
                                    ?>
                                    <a href="javascript:;"
                                       class="status"
                                       data-type="select"
                                       data-url="{{url('/core/pages/sections/update', [$sec->id, 'status'])}}"
                                       data-original-title="Select one"
                                       data-pk="{{$sec->id}}">{{$name}}</a>
                                </td>
                                <td>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>SL NO.</th>
                                            <th>Item Title</th>
                                            <th>Column</th>
                                            <th>Background Color</th>
                                            <th>Content Type</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $inc = 1; ?>
                                        @foreach($sec->items as $item)
                                            <?php $itemLayout = json_decode($item->content, true); ?>
                                            <tr class="odd gradeX">
                                                <td>{{$inc}}</td>
                                                <td>{{$item->title}}</td>
                                                <td>{{$itemLayout['l']}}</td>
                                                <td>{{$itemLayout['bc']}}</td>
                                                <td>
                                                    <?php
                                                    switch ($item->content_type) {
                                                        case 'slider':
                                                            $name = 'Image Slider';
                                                            break;
                                                        case 'post':
                                                            $name = 'Content Post';
                                                            break;
                                                        case 'news':
                                                            $name = 'Newsletter';
                                                            break;
                                                        case 'gallery':
                                                            $name = 'Image Gallery';
                                                            break;
                                                        case 'profile':
                                                            $name = 'Image Gallery With Profile';
                                                            break;
                                                        case 'banner':
                                                            $name = 'Image Banner';
                                                            break;
                                                        case 'cForm':
                                                            $name = 'Contact Form';
                                                            break;
                                                        default:
                                                            $name = 'Not Defined Yet';
                                                    }
                                                    ?>
                                                    {{$name}}
                                                </td>
                                                <td>
                                                    <a href="{{url('/core/pages', array($page->id, $sec->id, $item->id, $item->content_type))}}"
                                                       target="_blank" class="btn btn-primary">
                                                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                        go for editing .....
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $inc++ ?>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td>{{$layout['l']}}</td>
                                <td>
                                    <?php
                                    $name = 'No Class';
                                    if ($layout['cls']) {
                                        $name = $layout['cls'];
                                    }
                                    ?>
                                    {{$name}}
                                </td>
                                <td>{{$layout['bc']}}</td>
                                <td>
                                    <?php
                                        $name = 'Inactive';
                                    if ($layout['bs']) {
                                        $name = 'Active';
                                    }
                                    ?>
                                    {{$name}}
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
    <!-- END : Sections Grid List -->
@stop

@section('modal')
    <div id="confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Alert !!</h4>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h4 id="cBodyText" class=""></h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('pageLvScript')
    <script src="{{asset('js/page/page-editable.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl = '{{url('/core/pages/update', [$page->id])}}';
        $(function () {
            FormEditable.init(baseUrl);
            $.fn.editable.defaults.mode = 'popup';
            $('.status').editable({
                prepend: "Select status",
                source: [{
                    value: 0,
                    text: 'Inactive'
                }, {
                    value: 1,
                    text: 'Active'
                }],
                name: 'data',
                validate: function(value) {
                    if($.trim(value) == '') {
                        return 'This status is required';
                    }
                },
                error: function(response, newValue) {
                    if(response.status === 500) {
                        return 'Service unavailable. Please try later.';
                    } else {
                        return response.responseText;
                    }
                },
                success: function(response, newValue) {

                    if (response.status == 'error') {
                        return response.msg;
                    }
                    $('#cBodyText').addClass('font-green-jungle').html(response.msg);
                    $('#confirm').modal('show');
                }
            });
        });
    </script>
@stop