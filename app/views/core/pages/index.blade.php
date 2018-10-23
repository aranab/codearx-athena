@extends('core.layout')

@section('title', 'Pages')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/core/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Pages</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Pages Grid List -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Data View : Pages List</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_1">
                        <thead>
                        <tr>
                            <th class="col-md-1">SL NO.</th>
                            <th class="col-md-2">Page Name</th>
                            <th class="col-md-7">Sections</th>
                            <th class="col-md-7">Is Footer Widget?</th>
                            <th class="col-md-2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $inc = 1; ?>
                        @foreach($pages as $page)
                            <?php $pageInfo = json_decode($page->content, true); ?>
                            <tr class="odd gradeX">
                                <td>{{$inc}}</td>
                                <td>{{$page->title}}</td>
                                <td>
                                    @foreach ($page->sections as $sec)
                                        <strong>#{{$sec->title}}</strong>; Order No: {{$sec->section_order}};
                                        Status: <?php
                                                $name = 'Inactive';
                                                if ($sec->status) {
                                                    $name = 'Active';
                                                }
                                                ?>
                                                <a href="javascript:;"
                                                   class="status"
                                                   data-type="select"
                                                   data-url="{{url('/core/pages/sections/update', [$sec->id, 'status'])}}"
                                                   data-original-title="Select one"
                                                   data-pk="{{$sec->id}}">{{$name}}</a>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>SL NO.</th>
                                                <th>Item Title</th>
                                                <th>Column</th>
                                                <th>Color</th>
                                                <th>Content Type</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $inc = 1; ?>
                                            @foreach($sec->items as $item)
                                                <?php $itemLayout = json_decode($item->content, true); ?>
                                                <tr class="odd gradeX">
                                                    <td>{{$inc}}</td>
                                                    <td>{{$item->title}}</td>
                                                    <td>{{$itemLayout['l']}}</td>
                                                    <td>{{$itemLayout['bc']}}</td>
                                                    <td>
                                                        <?php
                                                        switch ($item->content_type) {
                                                            case 'slider':
                                                                $name = 'Image Slider';
                                                                break;
                                                            case 'post':
                                                                $name = 'Content Post';
                                                                break;
                                                            case 'news':
                                                                $name = 'Newsletter';
                                                                break;
                                                            case 'gallery':
                                                                $name = 'Image Gallery';
                                                                break;
                                                            case 'profile':
                                                                $name = 'Image Gallery With Profile';
                                                                break;
                                                            case 'banner':
                                                                $name = 'Image Banner';
                                                                break;
                                                            case 'attachment':
                                                                $name = 'Image Banner';
                                                                break;
                                                            case 'link':
                                                                $name = 'Link For Another Page';
                                                                break;
                                                            case 'form':
                                                                $name = 'Submission Form';
                                                                break;
                                                            default:
                                                                $name = 'Not Defined Yet';
                                                        }
                                                        ?>
                                                        {{$name}}
                                                    </td>
                                                </tr>
                                                <?php $inc++ ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endforeach
                                </td>
                                <td>
                                    <?php
                                    $name = 'Inactive';
                                    if ($pageInfo['fw']) {
                                        $name = 'Active';
                                    }
                                    ?>
                                    {{$name}}
                                </td>
                                <td>
                                    <a href="{{url('/core/pages', $page->id)}}" target="_blank" class="btn btn-primary">
                                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                        go for editing .....
                                    </a>
                                </td>
                            </tr>
                            <?php $inc++ ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END : Pages Grid List -->
@stop

@section('scriptFile')
    <script>
        $(function () {
            $('.status').editable({
                prepend: "Select status",
                source: [{
                    value: 0,
                    text: 'Inactive'
                }, {
                    value: 1,
                    text: 'Active'
                }],
                name: 'data',
                validate: function(value) {
                    if($.trim(value) == '') {
                        return 'This status is required';
                    }
                },
                error: function(response, newValue) {
                    if(response.status === 500) {
                        return 'Service unavailable. Please try later.';
                    } else {
                        return response.responseText;
                    }
                },
                success: function(response, newValue) {

                    if (response.status == 'error') {
                        return response.msg;
                    }
                    $('#cBodyText').addClass('font-green-jungle').html(response.msg);
                    $('#confirm').modal('show');
                }
            });
        });
    </script>
@stop
