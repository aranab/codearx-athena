@extends('core.layout')

@section('title', 'New Profile')

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
            <span>New Profile Entry</span>
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
                            Create New Profile
                        </span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
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
                                        'url' => '/core/pages/profile/create',
                                        'method' => 'post',
                                        'files' => true,
                                        'class' => 'form-horizontal',
                                        'id' => 'profile-form'
                                    )
                                )
                            }}
                            <div class="form-body">
                                <input id="pageId" name="pageId" type="hidden" value="{{$pageId}}">
                                <input id="secId" name="secId" type="hidden" value="{{$secId}}">
                                <input id="itemId" name="itemId" type="hidden" value="{{$itemId}}">
                                <div class="form-group">
                                    <div class="control-label col-md-3">
                                        Name/Title<span class="required">*</span>
                                    </div>
                                    <div class="col-md-5">

                                        {{
                                            Form::text(
                                                'title',
                                                null,
                                                array(
                                                    'placeholder' => 'Enter Profile Name/Title',
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
                                    <div class="col-md-1">
                                        <input type="text" class="sColor" name="ttc">
                                    </div>
                                    <div class="col-md-2">
                                        <input class="txtSize" type="text" value="" name="tts">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Short Description
                                    </label>
                                    <div class="col-md-5">
                                        {{
                                            Form::textarea(
                                                'sDes',
                                                null,
                                                array(
                                                    'placeholder' => 'Enter short description...',
                                                    'rows' => '2',
                                                    'class'=>'form-control'
                                                )
                                            )
                                        }}
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" class="sColor" name="stc">
                                    </div>
                                    <div class="col-md-2">
                                        <input class="txtSize" type="text" value="" name="sts">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Long Description
                                    </label>
                                    <div class="col-md-9">
                                        <textarea name="lDes" id="ldes"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Is linkable for details page?
                                    </label>
                                    <div class="col-md-6">
                                        {{
                                            Form::select(
                                                'ilp',
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
                                        Order Number
                                    </label>
                                    <div class="col-md-6">
                                        <input id="txtOrder" type="text" value="" name="order" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Layout Css Class
                                    </label>
                                    <div class="col-md-6">
                                        {{
                                            Form::text(
                                                'cls',
                                                null,
                                                array(
                                                    'placeholder' => 'Enter css class separately by space',
                                                    'class'=>'form-control'
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
    </div>
    <!-- END : Create Slider Part -->
@stop

@section('pageLvScript')
    <script src="{{asset('js/profile/profileValidation.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl = '{{url('/')}}';
        $(function () {
            ProfileUpload.init();
            $('#ldes').summernote({
                height: 300,
            });
            $('.txtSize').TouchSpin({
                initval: 12,
                min: 9,
                max: 100,
            });
            $('#txtOrder').TouchSpin({
                initval: 1,
                min: 1,
                max: 2000,
            });
        });
    </script>
@stop