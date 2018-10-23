@extends('core.layout')

@section('title', 'Contact-Form-Section')

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
            <span>{{$itemInfo->title}} : Contact Form</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Sections POST Data Viewer -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">
                            Data View : {{$itemInfo->title}} Section Contact Form Item
                            <input id="secId" type="hidden" value="{{$secId}}">
                            <input id="itemId" type="hidden" value="{{$itemInfo->id}}">
                        </span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
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
                        <div class="col-md-12">
                            <?php $itemLayout = json_decode($itemInfo->content, true); ?>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td style="width:35%">
                                        <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                            <strong>Contact Form Item Title</strong>
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
                                </tbody>
                            </table>
                            <!-- BEGIN FORM-->
                            {{
                                Form::open(
                                    array(
                                        'url' => '/core/pages/cform/create',
                                        'method' => 'post',
                                        'files' => true,
                                        'class' => '',
                                        'id' => 'contact-form'
                                    )
                                )
                            }}
                            <div class="form-body">
                                <input id="pageId" name="pageId" type="hidden" value="{{$pageId}}">
                                <input id="secId" name="secId" type="hidden" value="{{$secId}}">
                                <input id="itemId" name="itemId" type="hidden" value="{{$itemInfo->id}}">
                                <input id="cFormId" name="cFormId" type="hidden" value="{{$cForm->id}}">
                                <div class="form-group">
                                    <label class="control-label">
                                        Title
                                    </label>
                                    {{
                                        Form::text(
                                            'title',
                                            $cForm->title,
                                            array(
                                                'placeholder' => 'Enter title',
                                                'class'=>'form-control'
                                            )
                                        )
                                    }}
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        Short Description about Contact Form
                                    </label>
                                    {{
                                        Form::text(
                                            'content',
                                            $cForm->content,
                                            array(
                                                'placeholder' => 'Enter short description',
                                                'class'=>'form-control'
                                            )
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <button type="submit" class="btn green">
                                                    <i class="fa fa-check"></i>
                                                    Update
                                                </button>

                                                {{
                                                    link_to(
                                                        "/core/pages/$pageId",
                                                        'Cancel',
                                                        array(
                                                            'class' => 'btn default',
                                                        )
                                                    )
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{
                            Form::close()
                        }}
                        <!-- END FORM-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END : Sections POST Data Viewer -->
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