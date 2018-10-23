@extends('core.layout')

@section('title', 'Question Details')

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
            <a href="{{url('/core/questions')}}">
                <span>Questions List</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Question Details</span>
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
                            Data View : Question Details
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
                            <td style="width:25%">
                                <input id="qId" name="qId" type="hidden" value="{{$question->id}}">
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Input Format</strong>
                                </div>
                            </td>
                            <td style="width:75%">
                                <?php
                                    $name = 'Text Base Input';
                                    if ($question->format == 'file') {
                                        $name = 'File Upload Base Input';
                                    }
                                ?>
                                <a href="javascript:;"
                                   id="format"
                                   data-type="select"
                                   data-original-title="Select input format"
                                   data-pk="{{$question->id}}">{{$name}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div  class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Question</strong>
                                </div>
                            </td>
                            <td>
                                <textarea name="question" id="summernote" required>
                                    {{$question->question}}
                                </textarea>
                                <span id="qError" class="help-block required displayLock"></span>
                                <a href="javascript:void(0);" id="updateQ" class="btn btn-primary">Update</a>
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
                                   data-pk="{{$question->id}}">{{$question->order_no}}</a>
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
                                    $name = 'Deleted';
                                    if ($question->status) {
                                        $name = 'Live';
                                    }
                                ?>
                                <a href="javascript:;"
                                   id="status"
                                   data-type="select"
                                   data-original-title="Select status"
                                   data-pk="{{$question->id}}">{{$name}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Uploaded By</strong>
                                </div>
                            </td>
                            <td>
                                {{$question->uploaded_by}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Uploaded Date</strong>
                                </div>
                            </td>
                            <td>
                                {{$question->uploaded_date}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Modified By</strong>
                                </div>
                            </td>
                            <td>
                                {{$question->modified_by}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Modified Date</strong>
                                </div>
                            </td>
                            <td>
                                {{$question->modified_date}}
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
    <script src="{{asset('js/question/question-editable.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl = '{{url('/core/questions/update', [$question->id])}}';
        $(function () {
            FormEditable.init(baseUrl);

            $('#summernote').summernote({
                height: 200,
            });

            $('#updateQ').on('click', function () {
                var content = $('#summernote').summernote('code').trim();
                $('#qError').removeClass('displayLock').empty();
                if (content == '' || content == '<p><br></p>') {
                    $('#qError').addClass('displayUnlock').html("Question can't be empty.");
                    return;
                }

                App.blockUI({
                    target: '#loading',
                    animate: true
                });

                $.ajax({
                    url: baseUrl + '/question',
                    data: JSON.stringify ({value: content}),
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