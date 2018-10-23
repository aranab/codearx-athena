@extends('super.layout')

@section('title', 'CMS Configurations')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/~super/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>CMS Configurations</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Configurations panel -->
    <div class="row">
        <div id='loading' class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Data View : Configurations</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td style="width:35%">
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Site URL</strong>
                                </div>
                            </td>
                            <td style="width:65%">
                                <div class="row">
                                    <div class="col-md-9">
                                        <input id="siteUName" type="text" class="form-control"
                                               value="{{$configs[0]->value}}">
                                    </div>
                                    <div class="col-md-3">
                                        <button id="siteUrl" class="btn btn-primary">
                                            <i class="fa fa-upload" aria-hidden="true"></i>
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Home Page URL</strong>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-9">
                                        <input id="siteHName" type="text" class="form-control"
                                               value="{{$configs[1]->value}}">
                                    </div>
                                    <div class="col-md-3">
                                        <button id="homeUrl" class="btn btn-primary">
                                            <i class="fa fa-upload" aria-hidden="true"></i>
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div  class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Front Page Selection</strong>
                                </div>
                            </td>
                            <td>
                                <select id="frontPage" class="form-control">
                                    <option value="" selected disabled>Please select a Page</option>
                                    @foreach ($pages as $id => $title)
                                        <?php
                                        $select = '';
                                        if ($configs[2]->value == $id) {
                                            $select = 'selected';
                                        }
                                        ?>
                                        <option value="{{$id}}" {{$select}}>
                                            {{$title}}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Post Page Selection</strong>
                                </div>
                            </td>
                            <td>
                                <select id="postPage" class="form-control">
                                    <option value="" selected disabled>Please select a Page</option>
                                    @foreach ($pages as $id => $title)
                                        <?php
                                        $select = '';
                                        if ($configs[3]->value == $id) {
                                            $select = 'selected';
                                        }
                                        ?>
                                        <option value="{{$id}}" {{$select}}>
                                            {{$title}}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Auth Page</strong>
                                </div>
                            </td>
                            <td>
                                <select id="authPage" class="form-control">
                                    <option value="" selected disabled>Please select a Page</option>
                                    @foreach ($pages as $id => $title)
                                        <?php
                                        $select = '';
                                        if ($configs[4]->value == $id) {
                                            $select = 'selected';
                                        }
                                        ?>
                                        <option value="{{$id}}" {{$select}}>
                                            {{$title}}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Site Logo</strong>
                                </div>
                            </td>
                            <td>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <?php
                                            $src= '/img/no-img.jpg';
                                            if ($configs[5]->value) {
                                                $src = $configs[5]->value;
                                            }
                                        ?>
                                        <img id="logo" src="{{asset($src)}}" width="150" height="150"
                                             alt="logo"/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"> </div>
                                    <div>
                                        <span class="btn red btn-outline btn-file">
                                            <span class="fileinput-new"> Select image </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" id="logoPic" name="pic" accept="image/*" required>
                                        </span>
                                        <a id="saveLogo" href="javascript:;"
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
                                    <strong>Site Favicon</strong>
                                </div>
                            </td>
                            <td>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <?php
                                            $src= '/img/no-img.jpg';
                                            if ($configs[6]->value) {
                                                $src = $configs[6]->value;
                                            }
                                        ?>
                                        <img id="fav" src="{{asset($src)}}" width="100" height="100"
                                             alt="favicon"/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"> </div>
                                    <div>
                                        <span class="btn red btn-outline btn-file">
                                            <span class="fileinput-new"> Select image </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" id="favPic" name="pic" accept="image/*" required>
                                        </span>
                                        <a id="saveFav" href="javascript:;"
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
                                    Please Upload .jpeg, .jpg, .png, .ico
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END : Configurations panel -->
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
    <script src="{{asset('js/superConfig/config.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl = '{{url('/~super/configs/update')}}';
        $(function () {
            ConfigUpload.init(baseUrl);
        });
    </script>
@stop