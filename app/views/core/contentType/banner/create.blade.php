@extends('core.layout')

@section('title', 'New Banner Image')

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
            <a href="{{url('/core/pages', [$pageId, $secId, $itemId, 'banner'])}}">
                <span>Section Banner</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>New Banner Entry</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Create Slider Part -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-plus font-dark" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">
                            Create New Banner Image
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
                                    'url' => '/core/pages/banner/create',
                                    'method' => 'post',
                                    'files' => true,
                                    'class' => 'form-horizontal',
                                    'id' => 'banner-form'
                                )
                            )
                        }}
                        <div class="form-body">
                            <input id="pageId" name="pageId" type="hidden" value="{{$pageId}}">
                            <input id="secId" name="secId" type="hidden" value="{{$secId}}">
                            <input id="itemId" name="itemId" type="hidden" value="{{$itemId}}">
                            <div class="form-group">
                                <label class="control-label col-md-2">
                                    Banner Content Title
                                </label>
                                <div class="col-md-4">
                                    <label>Title</label>
                                    {{
                                        Form::text(
                                            'title',
                                            null,
                                            array(
                                                'placeholder' => 'Enter slider content title',
                                                'class'=>'form-control',
                                            )
                                        )
                                    }}
                                </div>
                                <div class="col-md-2">
                                    <label>Tag</label><br/>
                                    {{
                                        Form::select(
                                            'tTag',
                                            array(
                                                null => 'Please title text html tag',
                                                'h1' => 'h1',
                                                'h2' => 'h2',
                                                'h3' => 'h3',
                                                'h4' => 'h4',
                                                'h5' => 'h5',
                                                'h6' => 'h6',
                                                'p' => 'p'
                                            ),
                                            null,
                                            array(
                                                'class' => 'form-control'
                                            )
                                        )
                                    }}
                                </div>
                                <div class="col-md-2">
                                    <label>Font Size</label><br/>
                                    <input class="txtSize" type="text" value="" name="tfs">
                                </div>
                                <div class="col-md-2">
                                    <label>Font Color</label><br/>
                                    <input name="tfc" class="sColor"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">
                                    Banner Content Description
                                </label>
                                <div class="col-md-4">
                                    <label>Description</label>
                                    {{
                                        Form::textarea(
                                            'des',
                                            null,
                                            array(
                                                'placeholder' => 'Enter slider content description...',
                                                'rows' => '2',
                                                'class'=>'form-control'
                                            )
                                        )
                                    }}
                                </div>
                                <div class="col-md-2">
                                    <label>Tag</label><br/>
                                    {{
                                        Form::select(
                                            'dTag',
                                            array(
                                                null => 'Please title text html tag',
                                                'h1' => 'h1',
                                                'h2' => 'h2',
                                                'h3' => 'h3',
                                                'h4' => 'h4',
                                                'h5' => 'h5',
                                                'h6' => 'h6',
                                                'p' => 'p'
                                            ),
                                            null,
                                            array(
                                                'class' => 'form-control'
                                            )
                                        )
                                    }}
                                </div>
                                <div class="col-md-2">
                                    <label>Font Size</label><br/>
                                    <input class="txtSize" type="text" value="" name="dfs">
                                </div>
                                <div class="col-md-2">
                                    <label>Font Color</label><br/>
                                    <input name="dfc" class="sColor"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">
                                    Text Align
                                </label>
                                <div class="col-md-6">
                                    {{
                                        Form::select(
                                            'ta',
                                            array(
                                                'left' => 'Left',
                                                'center' => 'Center',
                                                'right' => 'Right'
                                            ),
                                            null,
                                            array(
                                                'class' => 'form-control'
                                            )
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">
                                    Text Position
                                </label>
                                <div class="col-md-2">
                                    <label>Bottom</label>
                                    <input type="text" class="form-control" name="pb" placeholder="bottom : 0% or 0px">
                                </div>
                                <div class="col-md-2">
                                    <label>Left</label>
                                    <input type="text" class="form-control" name="pl" placeholder="left : 0% or 0px">
                                </div>
                                <div class="col-md-2">
                                    <label>Right</label>
                                    <input type="text" class="form-control" name="pr" placeholder="right : 0% or 0px">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">
                                    Upload Image File<span class="required">*</span>
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
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-4">
                                            <button type="submit" class="btn green">
                                                <i class="fa fa-check"></i>
                                                Submit
                                            </button>

                                            {{
                                                link_to(
                                                    "/core/pages/$pageId/$secId/$itemId/banner",
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
    <!-- END : Create Slider Part -->
@stop

@section('pageLvScript')
    <script src="{{asset('js/banner/bannerValidation.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl = '{{url('/')}}';
        $(function () {
            BannerUpload.init();
            $('.txtSize').TouchSpin({
                initval: 12,
                min: 9,
                max: 100,
            });
        });
    </script>
@stop