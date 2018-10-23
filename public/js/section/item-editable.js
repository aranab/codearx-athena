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

        $('#tag').editable({
            prepend: "not selected",
            url: e + '/content/tag',
            source: [{
                value: 'h1',
                text: 'h1'
            }, {
                value: 'h2',
                text: 'h2'
            }, {
                value: 'h3',
                text: 'h3'
            }, {
                value: 'h4',
                text: 'h4'
            }, {
                value: 'h5',
                text: 'h5'
            }, {
                value: 'h6',
                text: 'h6'
            }, {
                value: 'p',
                text: 'p'
            }],
            validate: function(value) {
                if($.trim(value) == '') {
                    return 'This tag is required';
                }
            },
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

        $('#cls').editable({
            url: e + '/content/cls',
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

        $('#bColor').editable({
            url: e + '/content/bc',
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

        $('#rwc').editable({
            prepend: "not selected",
            url: e + '/content/rwc',
            source: [{
                value: 2,
                text: '2'
            }, {
                value: 3,
                text: '3'
            }, {
                value: 4,
                text: '4'
            }, {
                value: 6,
                text: '6'
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
    }

    return {
        //main function to initiate the module
        init: function(e) {

            // init editable elements
            initEditables(e);
        }

    };

}();

