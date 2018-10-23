var FormEditable = function() {

    var initEditables = function(e) {

        //global settings
        $.fn.editable.defaults.mode = 'inline';
        jQuery.uniform.update('#inline');
        $.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = '/post';

        //editables element samples
        $('#format').editable({
            prepend: "Select input format",
            url: e + '/format',
            source: [{
                value: 'txt',
                text: 'Text Base Input'
            }, {
                value: 'file',
                text: 'File Upload Base Input'
            }],
            name: 'data',
            validate: function(value) {
                if($.trim(value) == '') {
                    return 'This input format is required';
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

        $('#order').editable({
            url: e + '/order',
            name: 'data',
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

        $('#status').editable({
            prepend: "Select status",
            url: e + '/status',
            source: [{
                value: 0,
                text: 'Deleted'
            }, {
                value: 1,
                text: 'Live'
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

    }

    return {
        //main function to initiate the module
        init: function(e) {

            // init editable elements
            initEditables(e);
        }

    };

}();


