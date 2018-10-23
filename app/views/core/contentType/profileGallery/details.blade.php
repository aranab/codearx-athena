@extends('core.layout')

@section('title', 'Profile Details')

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
            <a href="{{url('/core/pages', [$pageId, $secId, $itemId, 'profile'])}}">
                <span>Profile Gallery List</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>"{{$prf->title}}" Details </span>
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
                            Data View : "{{$prf->title}}" Details
                        </span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php $prfDetails = json_decode($prf->content, true); ?>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td style="width:25%">
                                <input id="pageId" name="pageId" type="hidden" value="{{$pageId}}">
                                <input id="secId" name="secId" type="hidden" value="{{$secId}}">
                                <input id="itemId" name="itemId" type="hidden" value="{{$itemId}}">
                                <input id="pId" name="pId" type="hidden" value="{{$prf->id}}">
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Name/Title</strong>
                                </div>
                            </td>
                            <td style="width:75%">
                                <a href="javascript:;"
                                   id="title"
                                   data-type="text"
                                   data-original-title="Enter profile name/title"
                                   data-pk="{{$prf->id}}">{{$prf->title}}</a><br/>
                                Font Color:
                                <a href="javascript:;"
                                   id="ttc"
                                   class="sColor"
                                   data-type="text"
                                   data-original-title="Select a color"
                                   data-pk="{{$prf->id}}">{{$prfDetails['ttc']}}</a><br/>
                                Font Size:
                                <a href="javascript:;"
                                   id="tts"
                                   data-type="text"
                                   data-original-title="Enter font size"
                                   data-pk="{{$prf->id}}">{{$prfDetails['tts']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Short Description</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="sDes"
                                   data-type="textarea"
                                   data-original-title="Enter short description"
                                   data-pk="{{$prf->id}}">{{$prfDetails['sDes']}}</a><br/>
                                Font Color:
                                <a href="javascript:;"
                                   id="stc"
                                   class="sColor"
                                   data-type="text"
                                   data-original-title="Select a color"
                                   data-pk="{{$prf->id}}">{{$prfDetails['stc']}}</a><br/>
                                Font Size:
                                <a href="javascript:;"
                                   id="sts"
                                   data-type="text"
                                   data-original-title="Enter font size"
                                   data-pk="{{$prf->id}}">{{$prfDetails['sts']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Long Description</strong>
                                </div>
                            </td>
                            <td>
                                <textarea name="lDes" id="lDes" required>
                                    {{$prfDetails['lDes']}}
                                </textarea>
                                <a href="javascript:void(0);" id="updateLdes" class="btn btn-primary">Update</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Is linkable for details page?</strong>
                                </div>
                            </td>
                            <td>
                                <?php
                                $name = 'Inactive';
                                if ($prfDetails['ilp']) {
                                    $name = 'Active';
                                }
                                ?>
                                <a href="javascript:;"
                                   id="ilp"
                                   data-type="select"
                                   data-original-title="Select one"
                                   data-pk="{{$prf->id}}">{{$name}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Is Circle Thumbnail?</strong>
                                </div>
                            </td>
                            <td>
                                <?php
                                $name = 'Inactive';
                                if ($prfDetails['ict']) {
                                    $name = 'Active';
                                }
                                ?>
                                <a href="javascript:;"
                                   id="ict"
                                   data-type="select"
                                   data-original-title="Select one"
                                   data-pk="{{$prf->id}}">{{$name}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Text Align</strong>
                                </div>
                            </td>
                            <td>
                                <?php
                                $name = 'Left';
                                if ($prfDetails['ta'] == 'center') {
                                    $name = 'Center';
                                }
                                if($prfDetails['ta'] == 'right')
                                    $name = 'Right';
                                ?>
                                <a href="javascript:;"
                                   id="ta"
                                   data-type="select"
                                   data-original-title="Select text align"
                                   data-pk="{{$prf->id}}">{{$name}}</a>
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
                                   id="order"
                                   data-type="text"
                                   data-original-title="Enter order number"
                                   data-pk="{{$prf->id}}">{{$prf->section_order}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Layout Css Class</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="cls"
                                   data-type="text"
                                   data-original-title="Enter CSS class separate by space"
                                   data-pk="{{$prf->id}}">{{$prfDetails['cls']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Image</strong>
                                </div>
                            </td>
                            <td>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img id="imgFile" src="{{asset($prf->guid)}}"
                                             alt="{{$prf->name}}"/>
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
                                    <strong>Status</strong>
                                </div>
                            </td>
                            <td>
		                        <?php
		                        $name = 'Inactive';
		                        if ($prf->status) {
			                        $name = 'Active';
		                        }
		                        ?>
                                <a href="javascript:;"
                                   id="status"
                                   data-type="select"
                                   data-original-title="Select status"
                                   data-pk="{{$prf->id}}">{{$name}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Uploaded By</strong>
                                </div>
                            </td>
                            <td>
                                {{$prf->uploaded_by}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Uploaded Date</strong>
                                </div>
                            </td>
                            <td>
                                {{$prf->uploaded_date}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Modified By</strong>
                                </div>
                            </td>
                            <td>
                                {{$prf->modified_by}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Modified Date</strong>
                                </div>
                            </td>
                            <td>
                                {{$prf->modified_date}}
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
    <script src="{{asset('js/profile/profile-editable.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl = '{{url('/core/pages/profile/update', [$prf->id])}}';
        $(function () {
            FormEditable.init(baseUrl);
            $('#lDes').summernote({
                height: 300,
            });

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
        });
    </script>
@stop