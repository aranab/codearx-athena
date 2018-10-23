@extends('super.layout')

@section('title', "Section's Item")

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/~super/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{url('/~super/pages/sections', $item->parent_id)}}">
                <span>Section</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>{{$item->title}} item details</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Item Grid List -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Details View : {{$item->title}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php $itemDetails = json_decode($item->content, true) ?>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td style="width:35%">
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Content Type</strong>
                                </div>
                            </td>
                            <td style="width:65%">
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
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Layout Column</strong>
                                </div>
                            </td>
                            <td>{{$itemDetails['l']}}</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Header Title</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="title"
                                   data-type="text"
                                   data-original-title="Enter item header title"
                                   data-pk="{{$item->id}}">{{$itemDetails['t']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Header Title Tag</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="tag"
                                   data-type="select"
                                   data-original-title="Section one"
                                   data-pk="{{$item->id}}">{{$itemDetails['tag']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Item CSS Class</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="cls"
                                   data-type="text"
                                   data-original-title="Enter CSS class separate by space"
                                   data-pk="{{$item->id}}">{{$itemDetails['cls']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Item Background Color</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="bColor"
                                   class="sColor"
                                   data-type="text"
                                   data-original-title="Select a color"
                                   data-pk="{{$item->id}}">{{$itemDetails['bc']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Each Row Image Shows (Only for gallery/profile gallery)</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="rwc"
                                   data-type="select"
                                   data-original-title="Select one"
                                   data-pk="{{$item->id}}">{{$itemDetails['rwc']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>GUID</strong>
                                </div>
                            </td>
                            <td>{{$siteUrl.$item->guid}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END : Item Grid Lists -->
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
    <script src="{{asset('js/section/item-editable.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl = '{{url('/~super/pages/items/update', [$item->id])}}';
        $(function () {
            FormEditable.init(baseUrl);
        });
    </script>
@stop