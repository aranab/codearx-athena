@extends('core.layout')

@section('title', 'Footer-Widget')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/core/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Footer Widget</span>
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
                            Data View : Footer Widget
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
                                        'url' => '/core/widget',
                                        'method' => 'post',
                                        'files' => true,
                                        'class' => '',
                                        'id' => 'widget-form',
                                        'onsubmit'=>'javascript:return postForm();'
                                    )
                                )
                            }}
                            <div class="form-body">
                                <input id="wId" name="wId" type="hidden" value="{{$widget->id}}">
                                <div class="form-group">
                                    <label class="control-label">
                                        Title
                                    </label>
                                    {{
                                        Form::text(
                                            'title',
                                            $widget->title,
                                            array(
                                                'placeholder' => 'Enter title',
                                                'class'=>'form-control'
                                            )
                                        )
                                    }}
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        Content<span class="required">*</span>
                                    </label>
                                    <textarea name="content" class="summernote" required>
                                        {{$widget->content}}
                                    </textarea>
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
                                                        "/core/",
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

@section('scriptFile')
    <script>
        $(function () {
            $('.summernote').summernote({
                height: 500,
            });

            var postForm = function() {
                var content = $('textarea[name="content"]').html($('.summernote').code());
            }
        });
    </script>
@stop
