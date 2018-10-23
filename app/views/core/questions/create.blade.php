@extends('core.layout')

@section('title', 'Create Question')

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
            <span>Create</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Create Question -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus font-blue-hoki" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">
                            Create New Question
                        </span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
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
                    <div class="row">
                        <!-- BEGIN FORM-->
                        {{
                            Form::open(
                                array(
                                    'url' => '/core/questions/create',
                                    'method' => 'post',
                                    'files' => true,
                                    'class' => 'form-horizontal',
                                    'id' => 'question-form'
                                )
                            )
                        }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Input Format<span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    {{
                                        Form::select(
                                            'format',
                                            array(
                                                null => 'Please Select',
                                                'txt' => 'Text Base Input',
                                                'file' => 'File Upload Base Input'
                                            ),
                                            null,
                                            array(
                                                'required',
                                                'class' => 'form-control'
                                            )
                                        )
                                    }}
                                    {{
                                        $errors->first(
                                            'format',
                                            '<span class="required">:message</span>'
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Order Number<span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    <input id="txtOrder" type="text" value="" name="order" required>
                                    {{
                                        $errors->first(
                                            'order',
                                            '<span class="required">:message</span>'
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Question<span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    <textarea name="question" id="summernote" required></textarea>
                                    {{
                                        $errors->first(
                                            'question',
                                            '<span class="required">:message</span>'
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-4">
                                            <button type="submit" class="btn green">
                                                <i class="fa fa-check"></i>
                                                Submit
                                            </button>

                                            {{
                                                link_to(
                                                    "/core/questions",
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
    <!-- END : Create Question -->
@stop

@section('pageLvScript')
    <script src="{{asset('js/question/questionValidation.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        $(function () {
            QuestionUpload.init();
            $('#summernote').summernote({
                height: 200,
            });

            $('#txtOrder').TouchSpin({
                initval: 1,
                min: 1,
                max: 2000,
            });
        });
    </script>
@stop