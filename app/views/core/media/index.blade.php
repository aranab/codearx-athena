@extends('core.layout')

@section('title', 'Media Gallery')

@section('bar')
<ul class="page-breadcrumb cus-std-study-page-breadcrumb">
    <li>
        <a href="{{url('/core/')}}">
            <span>Dashboard</span>
        </a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Media Gallery</span>
    </li>
</ul>
@stop

@section('content')
<!-- BEGIN : Media Gallery -->
<div class="row">
    <div id="loading" class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">
                            Data View : Media Gallery
                    </span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="btn-group">
                                <a class="btn sbold green"
                                   href="javascript:;"
                                   onclick="javascript:ajaxCall();">
                                    <i class="fa fa-plus"></i>
                                    Add New
                                </a>
                            </div>
                        </div>
                        <div class="col-md-10 text-center">
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
                    </div>
                </div>
                <?php $inc = 1; ?>
                @foreach ($media as $key => $file)
                    @if ($inc == 1)
                        <div class="row">
                    @endif
                    <div id="r_{{$file->id}}" class="col-md-3">
                        <div class="thumbnail">
                            <img src="{{asset($file->guid)}}" alt="Lights" style="width:500px; height: 200px">
                            <div class="caption">
                                <p>Title: <strong>{{$file->title}}</strong></p>
                                <p>URL: <strong>{{url('/').$file->guid}}</strong></p>
                                <p>
                                    <a id="{{$file->id}}" href="javascript:;" onclick="javascript:fileDelete(id);"
                                       class="btn btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        Delete
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php $inc++; ?>
                    @if ($inc == 5)
                        <?php $inc = 1;?>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- END : Media Gallery  -->
@stop

@section('modal')
    <div id="ajaxModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="600">
    </div>

    <div id="confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input id="refresh" type="hidden" value="0">
                    <h4 class="modal-title">Alert !!</h4>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h4 id="cBodyText" class=""></h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnClose" type="button" class="btn btn-default">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scriptFile')
    <script>
        var $modal = $('#ajaxModal');

        $(function () {
            $('#btnClose').on('click', function () {
                $('#confirm').modal('hide');
                if($('#refresh').val()) {
                    location.reload(true);
                }
            });
        });

        function ajaxCall()
        {
            var url = '{{url('/core/media/create')}}';
            // create the backdrop and wait for next modal to be triggered
            $('body').modalmanager('loading');
            setTimeout(function () {
                $modal.load(url, null, function () {
                    $modal.modal();
                });
            }, 1000);
        }

        function fileDelete(id)
        {
            if (confirm('Do you delete? please confirm!!')) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });

                $.ajax({
                    url: '{{url('/core/media/delete')}}/' + id,
                    type: 'GET',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (e) {

                        App.unblockUI('#loading');
                        var css = 'font-red-thunderbird';
                        if (e.status == 'ok') {
                            $('#r_'+id).remove();
                            css = 'font-green-jungle';
                        }
                        $('#cBodyText').addClass(css).html(e.msg);
                        $('#confirm').modal('show');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                        App.unblockUI('#loading');
                        $('#cBodyText').addClass('font-red-thunderbird')
                            .html('Some thing is wrong, please contact to administrator!!');
                        $('#confirm').modal('show');
                    },
                    // Form data
                });
            }
        }
    </script>
@stop