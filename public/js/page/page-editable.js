var FormEditable = function() {

    var initEditables = function(e) {

        //global settings
        $.fn.editable.defaults.mode = 'inline';
        jQuery.uniform.update('#inline');
        $.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = '/post';

        //editables element samples
        $('#title').editable({
            url: e + '/content/t',
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

        $('#mAuth').editable({
            url: e + '/content/mAuth',
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

        $('#mDes').editable({
            url: e + '/content/mDes',
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

        $('#cTag').editable({
            url: e + '/content/cTag',
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

        $('#fw').editable({
            prepend: "not selected",
            url: e + '/content/fw',
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

    }

    return {
        //main function to initiate the module
        init: function(e) {

            // init editable elements
            initEditables(e);
        }

    };

}();

