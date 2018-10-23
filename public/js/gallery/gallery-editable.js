var FormEditable = function() {

    var initEditables = function(e) {

        //global settings
        $.fn.editable.defaults.mode = 'inline';
        jQuery.uniform.update('#inline');
        $.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = '/post';

        //editables element samples
        $('#title').editable({
            url: e + '/title',
            name: 'data',
            validate: function(value) {
                if($.trim(value) == '') {
                    return 'This gallery title is required';
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

        $('#status').editable({
            prepend: "Select Status",
            url: e + '/status',
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

        $('#des').editable({
            url: e + '/content/des',
            row: 2,
            showbuttons: 'bottom',
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

        $('#ict').editable({
            prepend: "not selected",
            url: e + '/content/ict',
            source: [{
                value: 0,
                text: 'Inactive'
            }, {
                value: 1,
                text: 'Active'
            }],
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

        $('#fc').editable({
            url: e + '/content/fc',
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

        $('#ta').editable({
            prepend: "Select one",
            url: e + '/content/ta',
            source: [{
                value: 'left',
                text: 'Left'
            }, {
                value: 'center',
                text: 'Center'
            }, {
                value: 'right',
                text: 'Right'
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
