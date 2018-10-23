@extends('core.layout')

@section('title', 'Css Code Edit')

@section('pageLvStylePlugin')
    <!-- 'codemirror' Code Editor -->
    <link href="{{asset('assets/global/plugins/codemirror/lib/codemirror.css')}}"
          rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/codemirror/theme/material.css')}}"
          rel="stylesheet" type="text/css" />
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
            <span>CSS Code Editor</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Code Editor Panel -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Data View : CSS CODE</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
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
                        </div>
                    </div>
                    <div class="">
                        <!-- BEGIN FORM-->
                        {{
                            Form::open(
                            array(
                                'url' => '/core/code',
                                'method' => 'post',
                                'files' => true,
                                'class' => 'form-horizontal',
                                'id' => 'code-form'
                            )
                        )
                        }}
                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-md-12" style="max-height: 400px; overflow: auto;">
                                    <textarea id="cssCode" name="cssCode">{{$code}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-1 col-md-4">
                                            <button type="submit" class="btn green">
                                                <i class="fa fa-check"></i>
                                                Submit
                                            </button>

                                            {{
                                                link_to(
                                                    '/core/',
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
    <!-- END : Code Editor Panel -->
@stop

@section('pageLvsScriptPlugin')
    <!-- 'codemirror' Code Editor -->
    <script src="{{asset('assets/global/plugins/codemirror/lib/codemirror.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/codemirror/mode/css/css.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        $(function () {
            var myCodeMirror = CodeMirror.fromTextArea(document.getElementById('cssCode'), {
                lineNumbers: true,
                matchBrackets: true,
                styleActiveLine: true,
                theme:"material",
                mode: 'css'
            });
        })
    </script>
@stop