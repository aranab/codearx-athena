@extends('web.layout')

@section('title', 'Registration')

@section('pageLvStyle')
    <link href="{{asset('assets/pages/css/login.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('content')
    <!-- BEGIN: Registration Section -->
    <section  style="background-color:#68845c;">
        <div class="container login">
            <div class="content">
                <!-- BEGIN REGISTRATION FORM -->
                {{
                    Form::open(
                        array(
                            'url' => '/registration',
                            'method' => 'post',
                            'files' => true,
                            'class' => 'register-form'
                        )
                    )
                }}
                <h3 class="form-title font-green"><strong>SIGN UP</strong></h3>
                <div class="col-md-12 text-center">
                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            <button class="close" data-dismiss="alert"></button>
                            <strong>Error!!</strong> {{Session::get('error')}}
                        </div>
                    @endif
                </div>
                <p class="hint"> Enter your personal details below: </p>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">
                        First Name<span class="required">*</span>
                    </label>
                    {{
                        Form::text(
                            'fname',
                            null,
                            array(
                                'placeholder' => 'First Name',
                                'class'=>'form-control placeholder-no-fix'
                            )
                        )
                    }}
                    {{
                        $errors->first(
                            'fname',
                            '<span class="required">:message</span>'
                        )
                    }}
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">
                        Last Name<span class="required">*</span>
                    </label>
                    {{
                        Form::text(
                            'lname',
                            null,
                            array(
                                'placeholder' => 'Last Name',
                                'class'=>'form-control placeholder-no-fix'
                            )
                        )
                    }}
                    {{
                        $errors->first(
                            'lname',
                            '<span class="required">:message</span>'
                        )
                    }}
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">
                        Name of Company<span class="required">*</span>
                    </label>
                    {{
                        Form::text(
                            'company',
                            null,
                            array(
                                'placeholder' => 'Company Name',
                                'class'=>'form-control placeholder-no-fix'
                            )
                        )
                    }}
                    {{
                        $errors->first(
                            'company',
                            '<span class="required">:message</span>'
                        )
                    }}
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">
                        Designation<span class="required">*</span>
                    </label>
                    {{
                        Form::text(
                            'designation',
                            null,
                            array(
                                'placeholder' => 'Designation',
                                'class'=>'form-control placeholder-no-fix'
                            )
                        )
                    }}
                    {{
                        $errors->first(
                            'designation',
                            '<span class="required">:message</span>'
                        )
                    }}
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">
                        Mobile/Phone Number<span class="required">*</span>
                    </label>
                    {{
                        Form::text(
                            'mobile',
                            null,
                            array(
                                'placeholder' => 'Phone or Mobile Number',
                                'required',
                                'class'=>'form-control placeholder-no-fix'
                            )
                        )
                    }}
                    {{
                        $errors->first(
                            'mobile',
                            '<span class="required">:message</span>'
                        )
                    }}
                </div>
                <p class="hint"> Enter your account details below: </p>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">
                        Username<span class="required">*</span>
                    </label>
                    {{
                        Form::email(
                            'email',
                            null,
                            array(
                                'placeholder' => 'Email As User Name',
                                'class'=>'form-control placeholder-no-fix'
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
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">
                        Password<span class="required">*</span>
                    </label>
                    {{
                        Form::password(
                            'password',
                            array(
                                'id'=>'password',
                                'placeholder' => 'Password',
                                'class'=>'form-control placeholder-no-fix',
                                'autocomplete' => 'off'
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
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">
                        Re-type Your Password
                    </label>
                    {{
                        Form::password(
                            'password_confirmation',
                            array(
                                'placeholder' => 'Please Re-type Your Password',
                                'class' => 'form-control placeholder-no-fix',
                                'autocomplete' => 'off',
                                'id' => ''
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

                <div class="form-actions">
                    <a href="{{url('/login')}}" type="button" class="btn btn-default">
                        Back
                    </a>
                    <button type="submit" id="register-submit-btn" class="btn green uppercase pull-right">
                        Submit
                    </button>
                </div>
                {{
                    form::close()
                }}
                <!-- END REGISTRATION FORM -->
            </div>
        </div>
    </section>
    <!-- END: Registration Section -->

    <!-- BEGIN SEPARATOR -->
    <div class="web-separator web-green"></div>
    <!-- END SEPARATOR -->

    <!-- BEGIN: Footer Widget -->
    <section class="web-white">
        <div class="area container">
            <div class="header-content">
                <h1 class="font-blue-dark">{{$widget->title}}</h1>
            </div>
            <div class="row">{{$widget->content}}</div>
        </div>
    </section>
    <!-- END: Footer Widget -->
@stop

@section('pageLvScript')
    <script src="{{ asset('assets/web/js/regiValidation.js') }}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        $(function () {
            UserRegistration.init();
        });
    </script>
@stop

