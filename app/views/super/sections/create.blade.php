@extends('super.layout')

@section('title', 'Create Section')

@section('pageLvStylePlugin')
@stop

@section('bar')
    <ul class="page-breadcrumb cus-std-study-page-breadcrumb">
        <li>
            <a href="{{url('/~super/')}}">
                <span>Dashboard</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{url('/~super/pages/sections')}}">
                <span>Sections List</span>
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Create</span>
        </li>
    </ul>
@stop

@section('content')
    <!-- BEGIN : Create Section Part -->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-plus font-dark" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">
                            Create New Section
                        </span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
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
                    </div>
                    <div class="row">
                        <!-- BEGIN FORM-->
                        {{
                            Form::open(
                                array(
                                    'url' => '/~super/pages/sections/create',
                                    'method' => 'post',
                                    'class' => '',
                                    'files' => true,
                                    'class' => 'form-horizontal',
                                    'id' => 'section-form'
                                )
                            )
                        }}
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Under which Page<span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    <select name="page" id="page" class="form-control" required>
                                        <option value="" selected disabled>Please select a Page</option>
                                        @foreach ($pages as $id => $title)
                                            <option value="{{$id}}">
                                                {{$title}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Placement Order<span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    {{
                                        Form::select(
                                            'order',
                                            array(
                                                null => 'Please Select a Placement Order',
                                                '1' => '1',
                                                '2' => '2',
                                                '3' => '3',
                                                '4' => '4',
                                                '5' => '5',
                                                '6' => '6',
                                                '7' => '7',
                                                '8' => '8',
                                                '9' => '9',
                                                '10' => '10',
                                                '11' => '11',
                                                '12' => '12',
                                                '13' => '13',
                                                '14' => '14',
                                                '15' => '15',
                                                '16' => '16',
                                                '17' => '17',
                                                '18' => '18',
                                                '19' => '19',
                                                '20' => '20',
                                            ),
                                            null,
                                            array(
                                                'required',
                                                'class' => 'form-control'
                                            )
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Section Title<span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    {{
                                        Form::text(
                                            'title',
                                            null,
                                            array(
                                                'placeholder' => 'Enter Title',
                                                'required',
                                                'class'=>'form-control'
                                            )
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Background Color
                                </label>
                                <div class="col-md-6">
                                    <input type="text" name="bColor" class="sColor"/>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Font Color
                                </label>
                                <div class="col-md-6">
                                    <input type="text" name="fColor" class="sColor"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Bottom Separation
                                </label>
                                <div class="col-md-6">
                                    {{
                                        Form::select(
                                            'bs',
                                            array(
                                                '0' => 'Inactive',
                                                '1' => 'Active'
                                            ),
                                            null,
                                            array(
                                                'class' => 'form-control'
                                            )
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Layout CSS Class
                                </label>
                                <div class="col-md-6">
                                    {{
                                        Form::text(
                                            'cls',
                                            null,
                                            array(
                                                'placeholder' => 'Enter css class separately by space',
                                                'class'=>'form-control'
                                            )
                                        )
                                    }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">
                                    Item Bootstrap Column Allocation<span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    {{
                                        Form::select(
                                            'col',
                                            array(
                                                null => 'Please Select a Column',
                                                'col-1' => 'Column 1 as col-md-12',
                                                'col-2' => 'Column 2 as each col-md-6',
                                                'col-3' => 'Column 3 as each col-md-4',
                                                'col-4' => 'Column 4 as each col-md-3',
                                                'col-6' => 'Column 6 as each col-md-2',
                                                'col-93' => 'First Column 9 and End Column 3',
                                                'col-39' => 'First Column 3 and End Column 9',
                                                'col-84' => 'First Column 8 and End Column 4',
                                                'col-48' => 'First Column 4 and End Column 8'
                                            ),
                                            null,
                                            array(
                                                'id' => 'col',
                                                'required',
                                                'class' => 'form-control'
                                            )
                                        )
                                    }}
                                </div>
                            </div>
                            <div id="fetchTemplate">
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-4">
                                            <button type="submit" class="btn green">
                                                <i class="fa fa-check"></i>
                                                Submit
                                            </button>

                                            {{
                                                link_to(
                                                    '/~super/pages/sections',
                                                    'Cancel',
                                                    array(
                                                        'class' => 'btn default',
                                                    )
                                                )
                                            }}
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
    <!-- END : Create Section Part -->
@stop

@section('scriptFile')
    <script>
        $(function () {
            $('#col').on('change', function () {
                $('#fetchTemplate').empty();
                var value = $(this).val().trim().split('-')[1];
                var arr = ['93', '39', '84', '48'];
                var html = '';
                if (arr.indexOf(value) > -1) {
                    value = value.split('');
                    for (j=0; j<=1; j++) {
                        html += '<div class="form-group">' +
                            '<label class="control-label col-md-3">' +
                            'Column ' + value[j] +' Content Type<span class="required">*</span>' +
                            '<input type="hidden" name="colName['+j+']" value="column-'+value[j]+'">' +
                            '</label>' +
                            '<div class="col-md-2">' +
                            '<select name="type['+j+']" class="form-control" required>' +
                            '<option value="" selected="selected">Please Select a Content Type</option>' +
                            '<option value="slider">Image Slider</option>' +
                            '<option value="post">Content Post</option>' +
                            '<option value="news">Newsletter</option>' +
                            '<option value="gallery">Image Gallery</option>' +
                            '<option value="profile">Image Gallery With Profile</option>' +
                            '<option value="banner">Image Banner</option>' +
                            '<option value="cForm">Contact Form</option>' +
                            '</select>' +
                            '</div>' +
                            '<label class="control-label col-md-2">' +
                            'Background Color' +
                            '</label>' +
                            '<div class="col-md-3">' +
                            '<input type="text" class="sColor" name="colColor['+(j)+']"/>' +
                            '</div>' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label class="control-label col-md-3">' +
                            'Column ' + value[j] +' Title' +
                            '</label>' +
                            '<div class="col-md-6">' +
                            '<input placeholder="Enter column title" class="form-control" name="colTitle['+(j)+']" type="text">' +
                            '</div>'+
                            '</div>'
                    }
                    $('#fetchTemplate').html(html);
                    App.colorSeparateInit();
                    return;
                }

                for (j=1; j<=value; j++) {
                    html +=  '<div class="form-group">' +
                        '<label class="control-label col-md-3">' +
                        'Column '+j+' Content Type<span class="required">*</span>' +
                        '<input type="hidden" name="colName['+(j - 1)+']" value="column-'+j+'">' +
                        '</label>' +
                        '<div class="col-md-2">' +
                        '<select name="type['+(j - 1)+']" class="form-control" required>' +
                        '<option value="" selected="selected">Please Select a Content Type</option>' +
                        '<option value="slider">Image Slider</option>' +
                        '<option value="post">Content Post</option>' +
                        '<option value="news">Newsletter</option>' +
                        '<option value="gallery">Image Gallery</option>' +
                        '<option value="profile">Image Gallery With Profile</option>' +
                        '<option value="banner">Image Banner</option>' +
                        '<option value="cForm">Contact Form</option>' +
                        '</select>' +
                        '</div>' +
                        '<label class="control-label col-md-2">' +
                        'Background Color' +
                        '</label>' +
                        '<div class="col-md-2">' +
                        '<input type="text" class="sColor" name="colColor['+(j - 1)+']"/>' +
                        '</div>' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label class="control-label col-md-3">' +
                        'Column '+j+' Title' +
                        '</label>' +
                        '<div class="col-md-6">' +
                        '<input placeholder="Enter column title" class="form-control" name="colTitle['+(j - 1)+']" type="text">' +
                        '</div>'+
                        '</div>'
                }
                $('#fetchTemplate').html(html);
                App.colorSeparateInit();
            });

        });
    </script>
@stop
