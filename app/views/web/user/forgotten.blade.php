@extends('web.layout')

@section('title', 'Forgotten Password')

@section('pageLvStyle')
    <link href="{{asset('assets/pages/css/login.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('content')
    <!-- BEGIN: Login -->
    <section  style="background-color:#68845c;">
        <div class="container login">
            <div class="content">
                <!-- BEGIN LOGIN FORM -->
                {{
                    Form::open(
                        array(
                            'url' => '/change',
                            'method' => 'post',
                            'class' => 'forgotten-form'
                        )
                    )
                }}
                <h3 class="form-title font-green"><strong>Reset Password</strong></h3>
                <div class="col-md-12 text-center">
                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            <button class="close" data-dismiss="alert"></button>
                            <strong>Error!!</strong> {{Session::get('error')}}
                        </div>
                    @endif
                </div>
                <input type="hidden" name="email" value="{{$user->email}}">
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
                    <button type="submit" class="btn green uppercase">Submit</button>
                </div>
                {{
                    Form::close()
                }}
                <!-- END LOGIN FORM -->

            <!-- END FORGOT PASSWORD FORM -->
            </div>
            <!-- END LOGIN -->
        </div>
    </section>

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
    <script src="{{ asset('assets/web/js/loginValidation.js') }}" type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        $(function () {
            Login.init();
        });
    </script>
@stop

