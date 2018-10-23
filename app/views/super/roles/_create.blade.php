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
                    'url' => '/~super/roles/create',
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
                            Role Name<span class="required">*</span>
                        </label>
                        {{
                            Form::text(
                                'title',
                                null,
                                array(
                                    'placeholder' => 'Enter Role',
                                    'required',
                                    'class'=>'form-control'
                                )
                            )
                        }}
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            Type<span class="required">*</span>
                        </label>
                        {{
                            Form::select(
                                'type',
                                array(
                                    null => 'Please Select',
                                    'SC' => 'Super Controller',
                                    'WDC' => 'Web Dashboard Controller',
                                    'UDC' => 'User Dashboard Controller'
                                ),
                                null,
                                array(
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
            <button type="submit" class="btn btn-primary">Save Change</button>
        </div>
        {{
            Form::close()
        }}
    </div>
</div>
