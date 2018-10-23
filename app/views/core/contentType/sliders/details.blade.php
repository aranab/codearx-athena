@extends('core.layout')

@section('title', 'Slider Details')

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
            <a href="{{url('/core/pages', [$pageId, $secId, $itemId, 'slider'])}}">
                <span>Sliders List</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>"{{$slide->name}}" Details </span>
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
                            Data View : "{{$slide->name}}" Details
                        </span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php $txt = json_decode($slide->content, true); ?>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td style="width:25%">
                                <input id="pageId" name="pageId" type="hidden" value="{{$pageId}}">
                                <input id="secId" name="secId" type="hidden" value="{{$secId}}">
                                <input id="itemId" name="itemId" type="hidden" value="{{$itemId}}">
                                <input id="sliderId" name="sliderId" type="hidden" value="{{$slide->id}}">
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Slider Name</strong>
                                </div>
                            </td>
                            <td style="width:75%">
                                <a href="javascript:;"
                                   id="slideName"
                                   data-type="text"
                                   data-original-title="Enter slider name"
                                   data-pk="{{$slide->id}}">{{$slide->name}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Title</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="title"
                                   data-type="text"
                                   data-original-title="Enter content title"
                                   data-pk="{{$slide->id}}">{{$slide->title}}</a><br/>
                                Font Color:
                                <a href="javascript:;"
                                   id="tc"
                                   class="sColor"
                                   data-type="text"
                                   data-original-title="Select a color"
                                   data-pk="{{$slide->id}}">{{$txt['tc']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div  class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Description</strong>
                                </div>
                            </td>
                            <td>
                                <textarea name="question" id="summernote" required>
                                    {{$slide->description}}
                                </textarea>
                                <a href="javascript:void(0);" id="updateD" class="btn btn-primary">Update</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div  class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Text Position</strong>
                                </div>
                            </td>
                            <td>
                                bottom:
                                <a href="javascript:;"
                                   id="pb"
                                   data-type="text"
                                   data-original-title="Enter bottom: 0% or 0px"
                                   data-pk="{{$slide->id}}">{{$txt['pb']}}</a>
                                left:
                                <a href="javascript:;"
                                   id="pl"
                                   data-type="text"
                                   data-original-title="Enter left: 0% or 0px"
                                   data-pk="{{$slide->id}}">{{$txt['pl']}}</a>
                                right:
                                <a href="javascript:;"
                                   id="pr"
                                   data-type="text"
                                   data-original-title="Enter right: 0% or 0px"
                                   data-pk="{{$slide->id}}">{{$txt['pr']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Order No</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="orderNo"
                                   data-type="select"
                                   data-original-title="Select order no"
                                   data-pk="{{$slide->id}}">{{$slide->order_no}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Status</strong>
                                </div>
                            </td>
                            <td>
                                <?php
                                $name = 'Inactive';
                                if ($slide->status) {
                                    $name = 'Active';
                                }
                                ?>
                                <a href="javascript:;"
                                   id="status"
                                   data-type="select"
                                   data-original-title="Select status"
                                   data-pk="{{$slide->id}}">{{$name}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Slide Image</strong>
                                </div>
                            </td>
                            <td>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img id="imgFile" src="{{asset($slide->path.$slide->id.$slide->ext)}}"
                                             alt="{{$slide->pic_name}}"/>
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
                                    <strong>Uploaded By</strong>
                                </div>
                            </td>
                            <td>
                                {{$slide->uploaded_by}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Uploaded Date</strong>
                                </div>
                            </td>
                            <td>
                                {{$slide->uploaded_date}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Modified By</strong>
                                </div>
                            </td>
                            <td>
                                {{$slide->modified_by}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Modified Date</strong>
                                </div>
                            </td>
                            <td>
                                {{$slide->modified_date}}
                            </td>
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
    <script src="{{asset('js/slider/slider-editable.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl = '{{url('/core/pages/slider/update', [$slide->id])}}';
        $(function () {
            FormEditable.init(baseUrl);

            $('#saveFile').on('click', function () {

                var picFile = $('#pic')[0].files[0];
                var formData = new FormData();
                formData.append('pic', picFile);

                App.blockUI({
                    target: '#loading',
                    animate: true
                });

                $.ajax({
                    url: baseUrl + '/ext',
                    data: formData,
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (e) {

                        App.unblockUI('#loading');
                        var css = 'font-red-thunderbird';
                        if (e.status == 'ok') {
                            css = 'font-green-jungle';
                            $('#imgFile').attr("src", $('.fileinput-preview').children('img').attr('src'));
                        }
                        $('.fileinput').fileinput('reset');
                        $('#cBodyText').addClass(css).html(e.msg);
                        $('#confirm').modal('show');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                        App.unblockUI('#loading');
                        $('.fileinput').fileinput('reset');
                        $('#cBodyText').addClass('font-red-thunderbird')
                            .html('Some thing is wrong, please contact to administrator!!');
                        $('#confirm').modal('show');
                    },
                    // Form data
                });
            });

            $('#summernote').summernote({
                height: 200,
            });

            $('#updateD').on('click', function () {
                var content = $('#summernote').summernote('code').trim();
                $('#qError').removeClass('displayLock').empty();
                if (content == '<p><br></p>') {
                    content == ''
                }
                App.blockUI({
                    target: '#loading',
                    animate: true
                });

                $.ajax({
                    url: baseUrl + '/description',
                    data: JSON.stringify({value: content}),
                    type: 'POST',
                    cache: false,
                    contentType: "application/json",
                    dataType: 'json',
                    processData: false,
                    success: function (e) {

                        App.unblockUI('#loading');
                        var css = 'font-red-thunderbird';
                        if (e.status == 'ok') {
                            css = 'font-green-jungle';
                            $('#imgFile').attr("src", $('.fileinput-preview').children('img').attr('src'));
                        }
                        $('.fileinput').fileinput('reset');
                        $('#cBodyText').addClass(css).html(e.msg);
                        $('#confirm').modal('show');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                        App.unblockUI('#loading');
                        $('.fileinput').fileinput('reset');
                        $('#cBodyText').addClass('font-red-thunderbird')
                            .html('Some thing is wrong, please contact to administrator!!');
                        $('#confirm').modal('show');
                    },
                    // Form data
                });
            });
        });
    </script>
@stop