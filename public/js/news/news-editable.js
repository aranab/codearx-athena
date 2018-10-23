var FormEditable = function() {

    var initEditable = function(e1, e2) {

        //global settings
        $.fn.editable.defaults.mode = 'inline';
        jQuery.uniform.update('#inline');
        $.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = '/post';

        //editables element samples
        $('#title').editable({
            url: e1 + '/title',
            name: 'data',
            validate: function(value) {
                if($.trim(value) == '') {
                    return 'This news title is required';
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

        $('#updateDes').on('click', function () {
            var content = $('#des').summernote('code').trim();
            $('#desError').removeClass('displayLock').empty();
            if (content == '' || content == '<p><br></p>') {
                $('#desError').addClass('displayUnlock').html("Short description can't be empty.");
                return;
            }

            App.blockUI({
                target: '#loading',
                animate: true
            });

            $.ajax({
                url: e1 + '/content',
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

        $('#saveFile').on('click', function () {

            var picFile = $('#pic')[0].files[0];
            var formData = new FormData();
            formData.append('pic', picFile);

            App.blockUI({
                target: '#loading',
                animate: true
            });

            $.ajax({
                url: e2 + '/ext',
                data: formData,
                type: 'POST',
                cache: false,
                contentType: false,
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

        $('#updateC').on('click', function () {
            var content = $('#content').summernote('code').trim();
            $('#cError').removeClass('displayLock').empty();
            if (content == '' || content == '<p><br></p>') {
                $('#cError').addClass('displayUnlock').html("Content can't be empty.");
                return;
            }

            App.blockUI({
                target: '#loading',
                animate: true
            });

            $.ajax({
                url: e2 + '/content',
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

    }

    return {
        //main function to initiate the module
        init: function(e1, e2) {

            // init editable elements
            initEditable(e1, e2);
        }

    };

}();


