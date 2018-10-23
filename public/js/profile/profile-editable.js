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
                    return 'This Profile name/title is required';
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

        $('#ttc').editable({
            url: e + '/content/ttc',
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

        $('#tts').editable({
            url: e + '/content/tts',
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

        $('#sDes').editable({
            url: e + '/content/sDes',
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

        $('#stc').editable({
            url: e + '/content/stc',
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

        $('#sts').editable({
            url: e + '/content/sts',
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

        $('#updateLdes').on('click', function () {
            var content = $('#lDes').summernote('code').trim();

            App.blockUI({
                target: '#loading',
                animate: true
            });

            $.ajax({
                url: e + '/content/lDes',
                data: JSON.stringify ({value: content}),
                type: 'POST',
                cache: false,
                contentType: "application/json",
                dataType: 'json',
                processData: false,
                success: function (e) {

                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (e.status == 'ok') {
                        css = 'font-green-jungle';
                        $('#imgFile').attr("src", $('.fileinput-preview').children('img').attr('src'));
                    }
                    $('.fileinput').fileinput('reset');
                    $('#cBodyText').addClass(css).html(e.msg);
                    $('#confirm').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {

                    App.unblockUI('#loading');
                    $('.fileinput').fileinput('reset');
                    $('#cBodyText').addClass('font-red-thunderbird')
                        .html('Some thing is wrong, please contact to administrator!!');
                    $('#confirm').modal('show');
                },
                // Form data
            });
        });

        $('#ilp').editable({
            prepend: "not selected",
            url: e + '/content/ilp',
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
        })
    }

    return {
        //main function to initiate the module
        init: function(e) {

            // init editable elements
            initEditables(e);
        }

    };

}();
