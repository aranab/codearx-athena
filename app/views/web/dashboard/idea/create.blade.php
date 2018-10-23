@extends('web.layoutD')

@section('title', 'Idea-Submission')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb font-white">
        <li>
            <a href="{{url('/user/dashboard')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Idea-Submission</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Create Idea Submission -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-plus font-dark" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">
                            Idea Submission
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
                                        'url' => '/user/idea',
                                        'method' => 'post',
                                        'files' => true,
                                        'class' => '',
                                        'id' => 'idea-form'
                                    )
                                )
                            }}
                            <h5>Please answer the below queries:</h5>
                            <table id="user" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL NO.</th>
                                        <th>Queries</th>
                                        <th>Submission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $atqIds = ''; $inc = 1; $i = 0;?>
                                @if (count($txtQ))
                                    @foreach($txtQ as $q)
                                    <tr>
                                        <td style="width:8%">{{$inc}}</td>
                                        <td style="width:37%">
                                            <input type="hidden" name="qt[{{$i}}]" value="{{$q->id}}">
                                            <strong>{{$q->question}}</strong>
                                        </td>
                                        <td style="width:55%">
                                            {{
                                                Form::textarea(
                                                    "at[".$q->id."]",
                                                    null,
                                                    array(
                                                        'placeholder' => 'Please write here',
                                                        'rows' => '10',
                                                        'class'=>'form-control'
                                                    )
                                                )
                                            }}
                                            {{
                                                $errors->first(
                                                    "at.".$q->id,
                                                    '<span class="required">:message</span>'
                                                )
                                            }}
                                        </td>
                                    </tr>
                                    <?php $atqIds .= "$q->id,"; $inc++; $i++; ?>
                                    @endforeach
                                @else
                                    <tr><td colspan="3" class="text-center"><span class="cFont-red">Can't find any queries</span></td></tr>
                                @endif
                                <input type="hidden" id="atqIds" value="{{$atqIds}}">
                                </tbody>
                            </table>
                            <h5>Please attach the following documents-(PDF only):</h5>
                            <table id="user" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL NO.</th>
                                    <th>Queries</th>
                                    <th>Attachment</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $aaqIds = ''; $inc = 1; $i = 0; ?>
                                @if (count($fileQ))
                                    @foreach($fileQ as $q)
                                        <tr>
                                            <td style="width:8%">{{$inc}}</td>
                                            <td style="width:37%">
                                                <input type="hidden" name="qa[{{$i}}]" value="{{$q->id}}">
                                                <strong>{{$q->question}}</strong>
                                            </td>
                                            <td style="width:55%">
                                                {{
                                                    Form::file(
                                                        "aa[".$q->id."]",
                                                        array(
                                                            'accept' => 'application/pdf'
                                                        )
                                                    )
                                                }}
                                                {{
                                                    $errors->first(
                                                        "aa.".$q->id,
                                                        '<span class="required">:message</span>'
                                                    )
                                                }}
                                            </td>
                                        </tr>
                                        <?php $aaqIds .= "$q->id,"; $inc++; $i++; ?>
                                    @endforeach
                                @else
                                    <tr><td colspan="3" class="text-center"><span class="cFont-red">Can't find any queries</span></td></tr>
                                @endif
                                <input type="hidden" id="aaqIds" value="{{$aaqIds}}">
                                </tbody>
                            </table>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <button type="submit" class="btn green">
                                                    <i class="fa fa-check"></i>
                                                    Submit
                                                </button>
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
    <!-- END : Create Create Idea Submission -->
@stop

@section('pageLvScript')
    <script src="{{asset('assets/web/js/ideaFormValidation.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        $(function () {
            IdeaForm.init(rulesMsg());
        });
        function rulesMsg() {
            var atIds = $('#atqIds').val().split(',');
            var aaIds = $('#aaqIds').val().split(',');
            var jsonRules = {};
            var jsonMsg = {};
            $.each(atIds, function( index, value ) {
                if(value) {
                    jsonRules["at["+value+"]"] = {required: true,wordCount: ['250']};
                    jsonMsg["at["+value+"]"] = {required: "Please write some thing."};
                }
            });
            $.each(aaIds, function( index, value ) {
                if(value) {
                    jsonRules["aa["+value+"]"] = {required: true,accept: "application/pdf"};
                    jsonMsg["aa["+value+"]"] = {required: "Please upload your file",accept: "Please attach only pdf file"};
                }
            });
            return [JSON.stringify(jsonRules),JSON.stringify(jsonMsg)];
        }
    </script>
@stop