@extends('core.layout')

@section('title', 'Profile')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/core/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Profile</span>
        </li>
    </ul>
@stop

@section('content')
    <div class="row">
        <div id="loading" class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Details View : User Profile</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="user" class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td style="width:35%">
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Username</strong>
                                    </div>
                                </td>
                                <td style="width:65%">
                                    {{$userInfo->username}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Email</strong>
                                    </div>
                                </td>
                                <td>{{$userInfo->email}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>First Name</strong>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:;"
                                       id="fname"
                                       data-type="text"
                                       data-original-title="Enter first name"
                                       data-pk="{{$userInfo->id}}">{{$userInfo->fname}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Last Name</strong>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:;"
                                       id="lname"
                                       data-type="text"
                                       data-original-title="Enter last name"
                                       data-pk="{{$userInfo->id}}">{{$userInfo->lname}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Gender</strong>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                        $name = '';
                                        if ($userInfo->gender == 'male') {
                                            $name = 'Male';
                                        }
                                        if ($userInfo->gender == 'female') {
                                            $name = 'Female';
                                        }
                                    ?>
                                    <a href="javascript:;"
                                       id="gender"
                                       data-type="select"
                                       data-original-title="Select gender"
                                       data-pk="{{$userInfo->id}}">{{$name}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Mobile</strong>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:;"
                                       id="mobile"
                                       data-type="text"
                                       data-original-title="Enter mobile number"
                                       data-pk="{{$userInfo->id}}">{{$userInfo->mobile}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Profile Picture</strong>
                                    </div>
                                </td>
                                <td>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 180px; height: 180px;">
                                            <?php
                                                $src = asset('/img/no-img.jpg');
                                                if ($userInfo->ext) {
                                                    $src = asset($userInfo->path.$userInfo->id.$userInfo->ext);
                                                }
                                            ?>
                                            <img width="180" height="180" id="imgFile" src="{{$src}}" alt="img"/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                             style="max-width: 180px; max-height: 180px;"> </div>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new"> Select image </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" id="pic" name="pic" accept="image/*" required>
                                            </span>
                                            <a id="saveFile" href="javascript:;"
                                               class="btn blue fileinput-exists">
                                                Save
                                            </a>
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
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Status</strong>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    $name = 'Inactive';
                                    if ($userInfo->status) {
                                        $name = 'Active';
                                    }
                                    ?>
                                    <a href="javascript:;"
                                       id="status"
                                       data-type="select"
                                       data-original-title="Select status"
                                       data-pk="{{$userInfo->id}}">{{$name}}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('modal')
    <div id="confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Alert !!</h4>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h4 id="cBodyText" class=""></h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('pageLvScript')
    <script src="{{asset('js/user/user-editable.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>

        var baseUrl = '{{url('/core/users/update', [$userInfo->id])}}';
        $(function () {
            FormEditable.init(baseUrl);

            $('#saveFile').on('click', function () {

                var picFile = $('#pic')[0].files[0];
                var formData = new FormData();
                formData.append('pic', picFile);

                App.blockUI({
                    target: '#loading',
                    animate: true
                });

                $.ajax({
                    url: '{{url('/core/users/update', [$userInfo->id, 'ext'])}}',
                    data: formData,
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (e) {

                        App.unblockUI('#loading');
                        var css = 'font-red-thunderbird';
                        if (e.status == 'ok') {
                            css = 'font-green-jungle';
                            $('#imgFile').attr("src", $('.fileinput-preview').children('img').attr('src'));
                        }
                        $('.fileinput').fileinput('reset');
                        $('#cBodyText').addClass(css).html(e.msg);
                        $('#confirm').modal('show');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                        App.unblockUI('#loading');
                        $('.fileinput').fileinput('reset');
                        alert(jqXHR.statusText)
                        $('#cBodyText').addClass('font-red-thunderbird')
                            .html('Some thing is wrong, please contact to administrator!!');
                        $('#confirm').modal('show');
                    }
                    // Form data
                });
            });
        });
    </script>
@stop