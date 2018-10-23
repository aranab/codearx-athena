@extends('core.layout')

@section('title', 'New Image')

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
            <a href="{{url('/core/pages', [$pageId, $secId, $itemId, 'gallery'])}}">
                <span>Gallery Image List</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>New Image Entry</span>
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
                            Create New Image
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
                                    'url' => '/core/pages/gallery/create',
                                    'method' => 'post',
                                    'files' => true,
                                    'class' => 'form-horizontal',
                                    'id' => 'gallery-form'
                                )
                            )
                        }}
                        <div class="form-body">
                            <input id="pageId" name="pageId" type="hidden" value="{{$pageId}}">
                            <input id="secId" name="secId" type="hidden" value="{{$secId}}">
                            <input id="itemId" name="itemId" type="hidden" value="{{$itemId}}">
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Image Title<span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    {{
                                        Form::text(
                                            'title',
                                            null,
                                            array(
                                                'placeholder' => 'Enter Image Title',
                                                'class'=>'form-control',
                                                'required'
                                            )
                                        )
                                    }}

                                    {{
                                        $errors->first(
                                            'title',
                                            '<span class="required">:message</span>'
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Image Description
                                </label>
                                <div class="col-md-6">
                                    {{
                                        Form::textarea(
                                            'des',
                                            null,
                                            array(
                                                'placeholder' => 'Enter image description...',
                                                'rows' => '2',
                                                'class'=>'form-control'
                                            )
                                        )
                                    }}

                                    {{
                                        $errors->first(
                                            'des',
                                            '<span class="required">:message</span>'
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Is Circle Thumbnail?
                                </label>
                                <div class="col-md-6">
                                    {{
                                        Form::select(
                                            'ict',
                                            array(
                                                '0' => 'Inactive',
                                                '1' => 'Active'
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
                                <label class="control-label col-md-3">
                                    Font Color
                                </label>
                                <div class="col-md-6">
                                    <input type="text" name="fColor" class="sColor"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
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
                                <label class="control-label col-md-3">
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
                                        <div class="col-md-offset-3 col-md-4">
                                            <button type="submit" class="btn green">
                                                <i class="fa fa-check"></i>
                                                Submit
                                            </button>

                                            {{
                                                link_to(
                                                    "/core/pages/$pageId/$secId/$itemId/slider",
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

@section('modal')
@stop

@section('pageLvScriptPlugin')
@stop

@section('pageLvScript')
    <script src="{{asset('js/gallery/galleryValidation.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl = '{{url('/')}}';
        $(function () {
            GalleryUpload.init();
        });
    </script>
@stop