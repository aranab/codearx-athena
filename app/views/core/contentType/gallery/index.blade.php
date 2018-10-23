@extends('core.layout')

@section('title', 'Gallery-Section')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/core/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{url('/core/pages', $pageId)}}">
                <span>page</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>{{$itemInfo->title}} : Gallery</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Sections Sliders Grid List -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">
                            Data View : {{$itemInfo->title}} Section Image List
                            <input id="secId" type="hidden" value="{{$secId}}">
                            <input id="itemId" type="hidden" value="{{$itemInfo->id}}">
                        </span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="col-md-12 text-center">
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
                    <?php $itemLayout = json_decode($itemInfo->content, true); ?>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td style="width:35%">
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Layout Column</strong>
                                </div>
                            </td>
                            <td  style="width:65%">{{$itemLayout['l']}}</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Gallery Item Title</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="title"
                                   data-type="text"
                                   data-original-title="Enter Gallery title"
                                   data-pk="{{$itemInfo->id}}">{{$itemLayout['t']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Title Size Tag</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="tag"
                                   data-type="select"
                                   data-original-title="Section one"
                                   data-pk="{{$itemInfo->id}}">{{$itemLayout['tag']}}</a>
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
                                   data-pk="{{$itemInfo->id}}">{{$itemLayout['cls']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Background Color</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="bColor"
                                   class="sColor"
                                   data-type="text"
                                   data-original-title="Select a color"
                                   data-pk="{{$itemInfo->id}}">{{$itemLayout['bc']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Each Row Image Shows</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="rwc"
                                   data-type="select"
                                   data-original-title="Select one"
                                   data-pk="{{$itemInfo->id}}">{{$itemLayout['rwc']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Add New</strong>
                                </div>
                            </td>
                            <td>
                                <a class="btn sbold green"
                                   href="{{url('/core/pages/gallery/create', array($pageId, $secId, $itemInfo->id))}}">
                                    <i class="fa fa-plus"></i>
                                    Add Image
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_1">
                        <thead>
                        <tr>
                            <th class="col-md-1">SL NO.</th>
                            <th class="col-md-3">Picture</th>
                            <th class="col-md-2">Title</th>
                            <th class="col-md-3">Description</th>
                            <th class="col-md-3">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $inc = 1; ?>
                        @foreach($images as $img)
                            <?php $imgDetails = json_decode($img->content, true); ?>
                            <tr class="odd gradeX">
                                <td>{{$inc}}</td>
                                <td>
                                    <img width="200"
                                         height="70"
                                         src="{{url($img->guid)}}"
                                         alt="{{$img->name}}"/>

                                </td>
                                <td>{{$img->title}}</td>
                                <td>{{$imgDetails['des']}}</td>
                                <td>
                                    <a href="{{url('/core/pages/gallery/details', [$pageId, $secId, $itemInfo->id, $img->id])}}"
                                       class="btn btn-primary">
                                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                        go for editing .....
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
    <!-- END : Pages Grid Lists -->
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
        var baseUrl = '{{url('/core/pages/items/update', [$itemInfo->id])}}';
        $(function () {
            FormEditable.init(baseUrl);
        });
    </script>
@stop