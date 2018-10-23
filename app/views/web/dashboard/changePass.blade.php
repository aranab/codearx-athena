@extends('web.layoutD')

@section('title', 'Change-Password')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb font-white">
        <li>
            <a href="{{url('/user/dashboard')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Change Password</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Password change -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-plus font-dark" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">
                            Change Password
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

                            @if ($errors->has())
                                <div class="alert alert-danger">
                                    <button class="close" data-dismiss="alert"></button>
                                    @foreach ($errors->all() as $error)
                                        <strong>Error!!</strong> {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <!-- BEGIN FORM-->
                            {{
                                Form::open(
                                    array(
                                        'url' => '/user/password',
                                        'method' => 'post',
                                        'class' => 'form-horizontal',
                                        'id' => 'changePass-form'
                                    )
                                )
                            }}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        Old Password
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        {{
                                            Form::password(
                                                'old_password',
                                                array(
                                                    'class'=>'form-control',
                                                    'required',
                                                    'id' => 'old_password'
                                                )
                                            )
                                        }}
                                        {{
                                            $errors->first(
                                                'old_password',
                                                '<span class="required">:message</span>'
                                            )
                                        }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        New Password
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        {{
                                            Form::password(
                                                'password',
                                                array(
                                                    'class'=>'form-control',
                                                    'required',
                                                    'id' => 'password'
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
                                        Confirm Password
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        {{
                                            Form::password(
                                                'confirm_password',
                                            array(
                                                'class'=>'form-control',
                                                'required',
                                                'id' => 'confirm_password'
                                                )
                                            )
                                        }}
                                        {{
                                            $errors->first(
                                                'confirm_password',
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
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">
                                                    <i class="fa fa-check"></i>
                                                    Submit
                                                </button>
                                                {{
                                                    link_to(
                                                        "/user/dashboard",
                                                        'Cancel',
                                                        array(
                                                            'class' => 'btn default'
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
    <!-- END : Password change -->
@stop

@section('pageLvScript')
    <script src="{{asset('js/user/changePassValidation.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        $(function () {
            ChangePassValidation.init();
        });
    </script>
@stop
