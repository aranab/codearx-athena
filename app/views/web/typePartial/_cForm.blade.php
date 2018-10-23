<!-- BEGIN : CONTACT FORM-->
@if (count($contents))
    @if ($contents[0]->title)
        <div class="header-content">
            <h1>{{$contents[0]->title}}</h1>
        </div>
    @endif
    <p>{{$contents[0]->content}}</p>
    <div class="row">
        <div class="col-md-12 text-center">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert"></button
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
            <!-- BEGIN: FORM-->
            {{
                Form::open(
                    array(
                        'url' => '/contact',
                        'method' => 'post',
                        'files' => true,
                        'class' => 'horizontal-form',
                        'id' => 'contact-form'
                    )
                )
            }}
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label">Your Name<span class="required">*</span></label>
                    {{
                        Form::text(
                            'name',
                            null,
                            array(
                                'placeholder' => 'Enter your name',
                                'class'=>'form-control',
                            )
                        )
                    }}
                    {{
                        $errors->first(
                            'name',
                            '<span class="required">:message</span>'
                        )
                    }}
                </div>
                <div class="form-group">
                    <label class="control-label">Your Email<span class="required">*</span></label>
                    {{
                        Form::text(
                            'email',
                            null,
                            array(
                                'placeholder' => 'Enter your email address',
                                'class'=>'form-control',
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
                    <label class="control-label">Your Mobile<span class="required">*</span></label>
                    {{
                        Form::text(
                            'mobile',
                            null,
                            array(
                                'placeholder' => 'Enter your mobile number',
                                'class'=>'form-control',
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
                <div class="form-group">
                    <label class="control-label">Your Message<span class="required">*</span></label>
                    {{
                        Form::textarea(
                            'msg',
                            null,
                            array(
                                'placeholder' => 'Enter your message here.....',
                                'rows' => '2',
                                'class'=>'form-control'
                            )
                        )
                    }}
                    {{
                        $errors->first(
                            'msg',
                            '<span class="required">:message</span>'
                        )
                    }}
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" id="btnContact" class="btn green">
                    <i class="fa fa-check"></i>
                    Submit
                </button>
            </div>
        {{
            Form::close()
        }}
        <!-- END: FORM-->
        </div>
    </div>
@endif
<!-- END : CONTACT FORM -->

@section('pageLvScript')
    <script src="{{asset('assets/web/js/cFormValidation.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        $(function () {
            ContactForm.init();
        });
    </script>
@stop