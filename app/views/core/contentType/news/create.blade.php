@extends('core.layout')

@section('title', 'Newsletter-Section')

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
            <span>New Newsletter Entry</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Create Newsletter -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-plus font-dark" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">
                            Create New News
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
                            <!-- BEGIN FORM-->
                            {{
                                Form::open(
                                    array(
                                        'url' => '/core/pages/news/create',
                                        'method' => 'post',
                                        'files' => true,
                                        'class' => 'form-horizontal',
                                        'id' => 'news-form'
                                    )
                                )
                            }}
                            <div class="form-body">
                                <input id="pageId" name="pageId" type="hidden" value="{{$pageId}}">
                                <input id="secId" name="secId" type="hidden" value="{{$secId}}">
                                <input id="itemId" name="itemId" type="hidden" value="{{$itemId}}">
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Title<span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        {{
                                            Form::text(
                                                'title',
                                                null,
                                                array(
                                                    'placeholder' => 'Enter news title',
                                                    'class'=>'form-control',
                                                    'required'
                                                )
                                            )
                                        }}
                                        {{
                                            $errors->first(
                                                'name',
                                                '<span class="required">:message</span>'
                                            )
                                        }}
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Short Description<span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea name="description" id="des" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Banner<span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <div id="up-img">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"> </div>
                                                <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" id="pic" name="pic" accept="image/*" required>
                                                </span>
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
                                        </div>
                                        <br />
                                        {{
                                            $errors->first(
                                                'pic',
                                                '<span class="required">:message</span>'
                                            )
                                        }}
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Content<span class="required">*</span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea name="content" id="content" required></textarea>
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
                                                        "/core/pages/$pageId/$secId/$itemId/news",
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
    <!-- END : Create Newsletter -->
@stop

@section('pageLvScript')
    <script src="{{asset('js/news/newsValidation.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl = '{{url('/')}}';
        $(function () {
            NewsValidation.init();
            $('#des').summernote({
                height: 100,
            });
            $('#content').summernote({
                height: 300,
            });
        });
    </script>
@stop