<!-- MODAL SHOW : Create Menu-->
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Create</h4>
        </div>
        {{
            Form::open(
                array(
                    'url' => '/~super/pages/menu/create',
                    'method' => 'post',
                    'class' => ''
                )
            )
        }}
        <div class="modal-body">
            <div class="col-md-12">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label">
                            Under which Page<span class="required">*</span>
                        </label>
                        <select name="page" id="page" class="form-control" required>
                            <option value="" selected disabled>Please select a Page</option>
                            @foreach ($pages as $id => $title)
                                <option value="{{$id}}">
                                    {{$title}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            Placement Order<span class="required">*</span>
                        </label>
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
                    <div class="form-group">
                        <label class="control-label">
                            Menu Title<span class="required">*</span>
                        </label>
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
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
        {{
            Form::close()
        }}
    </div>
</div>
