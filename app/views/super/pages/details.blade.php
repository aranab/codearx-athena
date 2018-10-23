@extends('super.layout')

@section('title', 'Page')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/~super/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{url('/~super/pages')}}">
                <span>Pages</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>{{$page->title}} SEO details</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Page SEO List -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">SEO Details View : {{$page->title}}</span>
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
                                    <strong>Page Title</strong>
                                </div>
                            </td>
                            <td style="width:65%">
                                <a href="javascript:;"
                                   id="title"
                                   data-type="text"
                                   data-original-title="Enter page title"
                                   data-pk="{{$page->id}}">{{$seo['t']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Meta Author</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="mAuth"
                                   data-type="text"
                                   data-original-title="Enter page meta author"
                                   data-pk="{{$page->id}}">{{$seo['mAuth']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Meta Description</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="mDes"
                                   data-type="textarea"
                                   data-original-title="Enter page meta description"
                                   data-pk="{{$page->id}}">{{$seo['mDes']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Canonical Link Tag URL</strong>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:;"
                                   id="cTag"
                                   data-type="text"
                                   data-original-title="Enter page canonical link tag"
                                   data-pk="{{$page->id}}">{{$seo['cTag']}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Is Footer Widget?</strong>
                                </div>
                            </td>
                            <td>
                                <?php
                                $name = 'Inactive';
                                if ($seo['fw']) {
                                    $name = 'Active';
                                }
                                ?>
                                <a href="javascript:;"
                                   id="fw"
                                   data-type="select"
                                   data-original-title="Select one"
                                   data-pk="{{$page->id}}">{{$name}}</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END : Page SEO List -->
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
    <script src="{{asset('js/page/page-editable.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl = '{{url('/~super/pages/update', [$page->id])}}';
        $(function () {
            FormEditable.init(baseUrl);
        });
    </script>
@stop