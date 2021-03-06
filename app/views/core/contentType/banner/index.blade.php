@extends('core.layout')

@section('title', 'Banner-Section')

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
            <span>{{$itemInfo->title}} : Banner</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Sections Newsletters Grid List -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">
                            Data View : {{$itemInfo->title}} Section Banner
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
                                    <strong>Banner Item Title</strong>
                                </div>
                            </td>
                            <td style="width:65%">
                                <a href="javascript:;"
                                   id="title"
                                   data-type="text"
                                   data-original-title="Enter section title"
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
                                    <strong>Layout Column</strong>
                                </div>
                            </td>
                            <td>{{$itemLayout['l']}}</td>
                        </tr>
                        @if (!$bn->id)
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Add New</strong>
                                </div>
                            </td>
                            <td>
                                <a class="btn sbold green"
                                   href="{{url('/core/pages/banner/create', array($pageId, $secId, $itemInfo->id))}}">
                                    <i class="fa fa-plus"></i>
                                    Add New
                                </a>
                            </td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-header-fixed">
                        <thead>
                        <tr>
                            <th class="col-md-1">SL NO.</th>
                            <th class="col-md-2">Image</th>
                            <th class="col-md-2">Title</th>
                            <th class="col-md-3">Description</th>
                            <th class="col-md-3">Uploaded By</th>
                            <th class="col-md-3">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if ($bn->id)
                            <?php $bnContent = json_decode($bn->content, true); ?>
                            <tr class="odd gradeX">
                                <td>1</td>
                                <td>
                                    <img width="200"
                                         height="70"
                                         src="{{url($bn->guid)}}"
                                         alt="{{$bn->name}}"/>
                                <td>{{$bn->title}}</td>
                                <td>{{$bnContent['des']}}</td>
                                <td>{{$bn->uploaded_by}}</td>
                                <td>
                                    <a href="{{url('/core/pages/banner/details', [$pageId, $secId, $itemInfo->id, $bn->id])}}"
                                       class="btn btn-primary">
                                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                        go for editing .....
                                    </a>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="6" class="text-center">No data available</td>
                            </tr>
                            @endif
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