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
            <a href="{{url('/~super/pages/sections')}}">
                <span>Sections</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>{{$sec->title}} details</span>
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
                        <span class="caption-subject bold uppercase">Details View : {{$sec->title}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width:35%">
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Section Title</strong>
                                    </div>
                                </td>
                                <td style="width:65%">
                                    <a href="javascript:;"
                                       id="title"
                                       data-type="text"
                                       data-original-title="Enter section title"
                                       data-pk="{{$sec->id}}">{{$sec->title}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Order Number</strong>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:;"
                                       id="orderNo"
                                       data-type="select"
                                       data-original-title="Select order no"
                                       data-pk="{{$sec->id}}">{{$sec->section_order}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Column</strong>
                                    </div>
                                </td>
                                <td>{{$layout['l']}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Section CSS Class</strong>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:;"
                                       id="cls"
                                       data-type="text"
                                       data-original-title="Enter CSS class separate by space"
                                       data-pk="{{$sec->id}}">{{$layout['cls']}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Section Background Color</strong>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:;"
                                       id="bColor"
                                       class="sColor"
                                       data-type="text"
                                       data-original-title="Select a color"
                                       data-pk="{{$sec->id}}">{{$layout['bc']}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Has Any Bottom Separation?</strong>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                        $name = 'Inactive';
                                        if ($layout['bs']) {
                                            $name = 'Active';
                                        }
                                    ?>
                                    <a href="javascript:;"
                                       id="bs"
                                       data-type="select"
                                       data-original-title="Select status"
                                       data-pk="{{$sec->id}}">{{$name}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Section Font Color</strong>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:;"
                                       id="fColor"
                                       class="sColor"
                                       data-type="text"
                                       data-original-title="Select a color"
                                       data-pk="{{$sec->id}}">{{$layout['fc']}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>GUID</strong>
                                    </div>
                                </td>
                                <td>{{$siteUrl.$sec->guid}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Status</strong>
                                    </div>
                                </td>
                                <td><?php
                                    $name = 'Inactive';
                                    if ($sec->status) {
                                        $name = 'Active';
                                    }
                                    ?>
                                    <a href="javascript:;"
                                       id="status"
                                       data-type="select"
                                       data-original-title="Select one"
                                       data-pk="{{$sec->id}}">{{$name}}</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-header-fixed">
                        <thead>
                            <tr>
                                <th>SL NO.</th>
                                <th>Item Title</th>
                                <th>Header Title</th>
                                <th>Column</th>
                                <th>Color</th>
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
                                <td>{{$itemLayout['t']}}</td>
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
                                    <a href="{{url('/~super/pages/items', [$item->id])}}"
                                       id="{{$item->id}}"
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
    <!-- END : Sections Grid Lists -->
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
    <script src="{{asset('js/section/sec-editable.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl = '{{url('/~super/pages/sections/update', [$sec->id])}}';
        $(function () {
            FormEditable.init(baseUrl);
        });
    </script>
@stop