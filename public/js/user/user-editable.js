var FormEditable = function() {

    var initEditables = function(e) {

        //global settings
        $.fn.editable.defaults.mode = 'inline';
        jQuery.uniform.update('#inline');
        $.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = '/post';

        //editables element samples
        $('#fname').editable({
            url: e + '/fname',
            name: 'data',
            validate: function(value) {
                if($.trim(value) == '') {
                    return 'This first name is required';
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

        $('#lname').editable({
            url: e + '/lname',
            name: 'data',
            validate: function(value) {
                if($.trim(value) == '') {
                    return 'This last name is required';
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

        $('#company').editable({
            url: e + '/company',
            name: 'data',
            validate: function(value) {
                if($.trim(value) == '') {
                    return 'This company name is required';
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

        $('#designation').editable({
            url: e + '/designation',
            name: 'data',
            validate: function(value) {
                if($.trim(value) == '') {
                    return 'This designation name is required';
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

        $('#gender').editable({
            prepend: "Select Gender",
            url: e + '/gender',
            source: [{
                value: 'male',
                text: 'Male'
            }, {
                value: 'female',
                text: 'Female'
            }],
            name: 'data',
            validate: function(value) {
                if($.trim(value) == '') {
                    return 'This gender is required';
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

        $('#mobile').editable({
            url: e + '/mobile',
            name: 'data',
            validate: function(value) {
                if($.trim(value) == '') {
                    return 'This mobile number is required';
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

    }

    return {
        //main function to initiate the module
        init: function(e) {

            // init editable elements
            initEditables(e);
        }

    };

}();
