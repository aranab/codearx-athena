@extends('core.layout')

@section('title', 'Idea Details')

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb font-white">
        <li>
            <a href="{{url('/core/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{url('/core/ideas')}}">
                <span>Idea Submitted List</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Idea Details</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Users idea List -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Idea Details</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="text-center">
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
                    <h4>User's Details</h4>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td style="width:35%">
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>User Picture</strong>
                                </div>
                            </td>
                            <td style="width:65%">
                                <div class="thumbnail">
                                    <?php
                                        $src = asset('/assets/layouts/layout/img/avatar.png');
                                        if ($idea->user->ext) {
                                            $src = asset($idea->user->path.$idea->user->id.$idea->user->ext);
                                        }
                                    ?>
                                    <img src="{{$src}}" alt="{{$idea->user->lname}}"
                                         style="width:200px; height: 200px">

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:35%">
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>User Name</strong>
                                </div>
                            </td>
                            <td style="width:65%">{{$idea->user->fullName()}}</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Company Name</strong>
                                </div>
                            </td>
                            <td>{{$idea->user->company}}</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Designation</strong>
                                </div>
                            </td>
                            <td>{{$idea->user->designation}}</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Mobile Number</strong>
                                </div>
                            </td>
                            <td>{{$idea->user->mobile}}</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Total Idea Submission</strong>
                                </div>
                            </td>
                            <td>
                                @if ($count)
                                    <a href="{{url("/core/ideas/user", $idea->user->id)}}" class="">
                                        {{$count}}
                                    </a>
                                @else
                                    {{$count}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                    <strong>Status</strong>
                                </div>
                            </td>
                            <td>
                                @if ($idea->status == 1)
                                    <span class="cFont-blue">Pending</span>
                                @elseif($idea->status == 2)
                                    <a href="javascript:void(0);" id="{{$idea->id}}"
                                       onclick="javascript:changeStatus(id);"
                                       class="btn btn-default">
                                        <span class="cFont-yellow">Viewing</span>
                                    </a>
                                @elseif($idea->status == 3)
                                    <span class="cFont-green">Accepted</span>
                                @else
                                    <span class="cFont-red">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <h4>Submission Details</h4>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 5%">SL NO.</th>
                            <th style="width: 10%">Date of Submission</th>
                            <th style="width: 30%">Query</th>
                            <th style="width: 50%">Submitted</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $inc = 1; $ideaUserId = $idea->id; ?>
                        @foreach($idea->answers as $detail)
                            <tr class="odd gradeX">
                                <td>{{$inc}}</td>
                                <td>{{$idea->uploaded_date}}</td>
                                <td>{{$detail->question->question}}</td>
                                <td>
                                    @if ($detail->question->format == 'file')
                                        <a href="{{url("/user/idea/$ideaUserId/download", $detail->id )}}"
                                           class="btn btn-info btn-sm">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            Download Attachment...
                                        </a>
                                    @else
                                        {{$detail->content}}
                                    @endif
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
    <!-- END : Users idea List -->
@stop

@section('modal')
    <div id="doConfirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Do change status!!</h4>
                </div>
                <!-- BEGIN FORM-->
                {{
                    Form::open(
                        array(
                            'url' => "/core/ideas/update/$idea->id",
                            'method' => 'post',
                            'files' => true,
                            'class' => '',
                            'id' => 'status-form'
                        )
                    )
                }}
                <div class="modal-body">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tr>
                                <td style="width:35%">
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong> Status<span class="required">*</span></strong>
                                    </div>
                                </td>
                                <td style="width: 65%">
                                    <select id="dropStatus" name="dropStatus" class="form-control" required>
                                        <option value="">Please Select One..</option>
                                        <option value="3">Accept</option>
                                        <option value="0">Reject</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="alert alert-info text-right" style="margin-bottom: 0px;">
                                        <strong>Remarks/Comments</strong>
                                    </div>
                                </td>
                                <td>
                                    <textarea id="remark" name="remark" class="form-control" rows="4"></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                {{
                    Form::close()
                }}
                <!-- END FORM-->
            </div>
        </div>
    </div>
@stop

@section('pageLvScript')
    <script src="{{asset('js/entrepreneur/ideaStatusChange.js')}}"
            type="text/javascript"></script>
@stop

@section('scriptFile')
    <script>
        var baseUrl = '{{url('/core/ideas/update', [$idea->id])}}';
        $(function () {
            IdeaStatusChange.init();
        });
        function changeStatus(id) {
            if(id) {
                $('#doConfirm').modal('show');
            }
            return;
        }
    </script>
@stop



