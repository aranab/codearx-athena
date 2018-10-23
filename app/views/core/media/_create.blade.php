<!-- MODAL SHOW : Upload Media -->
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Upload</h4>
        </div>
        {{
            Form::open(
                array(
                    'url' => '/core/media/create',
                    'method' => 'post',
                    'files' => true,
                    'class' => 'form-horizontal'
                )
            )
        }}
        <div class="modal-body">
            <div class="col-md-12">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">
                            Attachment<span class="required">*</span>
                        </label>
                        <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="input-group input-large">
                                    <div class="form-control uneditable-input input-fixed" data-trigger="fileinput">
                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                        <span class="fileinput-filename"> </span>
                                    </div>
                                    <span class="input-group-addon btn default btn-file">
                                    <span class="fileinput-new"> Select file </span>
                                    <span class="fileinput-exists"> Change </span>
                                        {{
                                            Form::file(
                                                'file',
                                                array(
                                                    'id' => 'file',
                                                    'accept' => 'video/*,image/*'
                                                )
                                            )
                                        }}
                                </span>
                                    <a href="javascript:;"
                                       class="input-group-addon btn red fileinput-exists"
                                       data-dismiss="fileinput">
                                        Remove
                                    </a>
                                </div>
                            </div>
                            {{
                                $errors->first(
                                    'file',
                                    '<span class="required">:message</span>'
                                )
                            }}
                        </div>
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
