@extends('web.layout')

@section('title', 'Login')

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
                            'url' => '/login',
                            'method' => 'post',
                            'class' => 'login-form'
                        )
                    )
                }}
                <h3 class="form-title font-green"><strong>PLEASE LOGIN</strong></h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                @if ($errors->count() > 0)
                    <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button>
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li>{{$message}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">

                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    {{
                        Form::text(
                            'username',
                            null,
                            array(
                                'placeholder' => 'Username as Email',
                                'require',
                                'autocomplete' => 'off',
                                'class'=>'form-control form-control-solid placeholder-no-fix'
                            )
                        )
                    }}
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    {{
                        Form::password(
                            'password',
                            array(
                                'placeholder' => 'Password',
                                'require',
                                'autocomplete' => 'off',
                                'class'=>'form-control form-control-solid placeholder-no-fix'
                            )
                        )
                    }}
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn green uppercase">Login</button>
                    <label class="rememberme check">
                        <input type="checkbox" name="remember" value="1" />Remember
                    </label>
                    <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                </div>
                <div class="create-account">
                    <p>
                        <a href="{{url('/registration')}}" id="register-btn" class="uppercase">
                            Create an account
                        </a>
                    </p>
                </div>
                {{
                    Form::close()
                }}
                <!-- END LOGIN FORM -->
                <!-- BEGIN FORGOT PASSWORD FORM -->
                {{
                    Form::open(
                        array(
                            'url' => '/forgotten',
                            'method' => 'post',
                            'class' => 'forget-form'
                        )
                    )
                }}
                <h3 class="font-green">Forget Password ?</h3>
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="email" autocomplete="off"
                           placeholder="Email as your user name" name="email" /> </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn btn-default">Back</button>
                    <button type="submit" class="btn green uppercase pull-right">Submit</button>
                </div>
                {{
                    Form::close()
                }}
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

