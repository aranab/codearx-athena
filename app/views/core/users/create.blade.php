@extends('core.layout')

@section('title', 'Create User')

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
            <a href="{{url('/core/users')}}">
                <span>Users List</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Create</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Registration Part -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus font-blue-hoki" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">
                            Create New User
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
                                    'url' => '/core/users/create',
                                    'method' => 'post',
                                    'files' => true,
                                    'class' => 'form-horizontal',
                                    'id' => 'user-regi-form'
                                )
                            )
                        }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    User Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    {{
                                        Form::email(
                                            'email',
                                            null,
                                            array(
                                                'placeholder' => 'enter email as user name',
                                                'class'=>'form-control',
                                                'required'
                                            )
                                        )
                                    }}

                                    {{
                                        $errors->first(
                                            'email',
                                            '<span class="required">:message</span>'
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Password<span class="required">*</span></label>
                                <div class="col-md-6">
                                    {{
                                        Form::password(
                                            'password',
                                            array(
                                                'id' => 'password',
                                                'placeholder' => 'enter password',
                                                'class'=>'form-control',
                                                'required'
                                            )
                                        )
                                    }}
                                    {{
                                        $errors->first(
                                            'password',
                                            '<span class="required">:message</span>'
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Password Confirmation<span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    {{
                                        Form::password(
                                            'password_confirmation',
                                            array(
                                                'placeholder' => 'please re-enter password',
                                                'class'=>'form-control',
                                                'required'
                                            )
                                        )
                                    }}

                                    {{
                                        $errors->first(
                                            'password_confirmation',
                                            '<span class="required">:message</span>'
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Mobile Number<span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">+88</span>
                                        {{
                                            Form::text(
                                                'mobile',
                                                null,
                                                array(
                                                    'placeholder' => 'enter mobile number',
                                                    'required',
                                                    'class' => 'form-control'
                                                )
                                            )
                                        }}
                                    </div>
                                    {{
                                        $errors->first(
                                            'mobile',
                                            '<span class="required">:message</span>'
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    User Type<span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    {{
                                        Form::select(
                                            'type',
                                            array(
                                                null => 'Please Select',
                                                'WDC' => 'Web Dashboard Controller',
                                                'UDC' => 'User Dashboard Controller'
                                            ),
                                            null,
                                            array(
                                                'required',
                                                'id' => 'userType',
                                                'class' => 'form-control'
                                            )
                                        )
                                    }}
                                    {{
                                        $errors->first(
                                            'type',
                                            '<span class="required">:message</span>'
                                        )
                                    }}
                                </div>
                            </div>
                            <div id="rolesList" class="form-group hide">
                                <label class="control-label col-md-3">
                                    Role Name<span class="required">*</span>
                                </label>
                                <div class="col-md-9">
                                    <div id="roleCheckBox">
                                    </div>
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
                                                    "/core/users",
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
    <!-- END : Registration Part -->
@stop

@section('modal')
@stop

@section('pageLvScriptPlugin')
@stop

@section('pageLvScript')
    <script src="{{asset('js/user/userRegValidation.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl = '{{url('/')}}';
        jQuery(document).ready(function() {
            UserRegistration.init(baseUrl, 'w');
        });
    </script>
@stop