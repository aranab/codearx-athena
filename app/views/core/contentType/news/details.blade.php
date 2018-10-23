@extends('core.layout')

@section('title', 'News Details')

@section('pageLvStylePlugin')
@stop

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/core/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{url('/core/pages', [$pageId, $secId, $itemId, 'news'])}}">
                <span>Newsletters List</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>"{{$news->title}}" Details </span>
        </li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div id="loading" class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">
                            Data View : "{{$news->title}}" Details
                        </span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>News uploaded Date Time</strong>
                                </div>
                            </td>
                            <td>{{$news->uploaded_date}}</td>
                        </tr>
                        <tr>
                            <td style="width:25%">
                                <input id="pageId" name="pageId" type="hidden" value="{{$pageId}}">
                                <input id="secId" name="secId" type="hidden" value="{{$secId}}">
                                <input id="itemId" name="itemId" type="hidden" value="{{$itemId}}">
                                <input id="newsId" name="newsId" type="hidden" value="{{$news->id}}">
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>News Title<span class="required">*</span></strong>
                                </div>
                            </td>
                            <td style="width:75%">
                                <a href="javascript:;"
                                   id="title"
                                   data-type="text"
                                   data-original-title="Enter title name"
                                   data-pk="{{$news->id}}">{{$news->title}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>News Short Description<span class="required">*</span></strong>
                                </div>
                            </td>
                            <td>
                                <textarea name="description" id="des" required>
                                    {{$news->content}}
                                </textarea>
                                <span id="desError" class="help-block required displayLock"></span>
                                <a href="javascript:void(0);" id="updateDes" class="btn btn-primary">Update</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Banner<span class="required">*</span></strong>
                                </div>
                            </td>
                            <td>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img id="imgFile" src="{{asset($news->newsDetails->guid)}}"
                                             alt="{{$news->name}}"/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"> </div>
                                    <div>
                                        <span class="btn red btn-outline btn-file">
                                            <span class="fileinput-new"> Select image </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" id="pic" name="pic" accept="image/*" required>
                                        </span>
                                        <a id="saveFile" href="javascript:;"
                                           class="btn blue fileinput-exists">
                                            Save
                                        </a>
                                        <a href="javascript:;"
                                           class="btn red fileinput-exists"
                                           data-dismiss="fileinput">
                                            Remove
                                        </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                    <span class="label label-danger">NOTE!</span>
                                    Please Upload .jpeg, .jpg, .png
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Content<span class="required">*</span></strong>
                                </div>
                            </td>
                            <td>
                                <textarea name="content" id="content" required>
                                    {{$news->newsDetails->content}}
                                </textarea>
                                <span id="cError" class="help-block required displayLock"></span>
                                <a href="javascript:void(0);" id="updateC" class="btn btn-primary">Update</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Uploaded By</strong>
                                </div>
                            </td>
                            <td>{{$news->uploaded_by}}</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Uploaded Date</strong>
                                </div>
                            </td>
                            <td>{{$news->uploaded_date}}</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Modified By</strong>
                                </div>
                            </td>
                            <td>{{$news->modified_by}}</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Modified Date</strong>
                                </div>
                            </td>
                            <td>{{$news->modified_date}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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

@section('pageLvScriptPlugin')
@stop

@section('pageLvScript')
    <script src="{{asset('js/news/news-editable.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl1 = '{{url('/core/pages/news/update', [$news->id])}}';
        var baseUrl2 = '{{url('/core/pages/news/update', [$news->newsDetails->id])}}'
        $(function () {
            FormEditable.init(baseUrl1, baseUrl2);
            $('#des').summernote({
                height: 100,
            });
            $('#content').summernote({
                height: 300,
            });
        });
    </script>
@stop