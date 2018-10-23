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

        $('#orderNo').editable({
            prepend: "not selected",
            url: e + '/sectionorder',
            source: [{
                value: 1,
                text: '1'
            }, {
                value: 2,
                text: '2'
            }, {
                value: 3,
                text: '3'
            }, {
                value: 4,
                text: '4'
            }, {
                value: 5,
                text: '5'
            }, {
                value: 6,
                text: '6'
            }, {
                value: 7,
                text: '7'
            }, {
                value: 8,
                text: '8'
            }, {
                value: 9,
                text: '9'
            }, {
                value: 10,
                text: '10'
            }, {
                value: 11,
                text: '11'
            }, {
                value: 12,
                text: '12'
            }, {
                value: 13,
                text: '13'
            }, {
                value: 14,
                text: '14'
            }, {
                value: 15,
                text: '15'
            }, {
                value: 16,
                text: '16'
            }, {
                value: 17,
                text: '17'
            }, {
                value: 18,
                text: '18'
            }, {
                value: 19,
                text: '19'
            }, {
                value: 20,
                text: '20'
            }],
            name: 'data',
            validate: function(value) {
                if($.trim(value) == '') {
                    return 'This Order No is required';
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
            prepend: "Select status",
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


        $('#bs').editable({
            prepend: "Select status",
            url: e + '/content/bs',
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

        $('#fColor').editable({
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
    }

    return {
        //main function to initiate the module
        init: function(e) {

            // init editable elements
            initEditables(e);
        }

    };

}();

