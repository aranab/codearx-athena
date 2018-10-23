var ConfigUpload = function () {

    var handleConfigUpload = function (url) {
        $('#siteUrl').on('click', function () {

            $value = $('#siteUName').val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'siteurl', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#homeUrl').on('click', function () {

            $value = $('#siteHName').val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'home', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#frontPage').on('change', function () {

            $value = $(this).val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'page_on_front', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#postPage').on('change', function () {

            $value = $(this).val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'page_for_posts', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#authPage').on('change', function () {

            $value = $(this).val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'page_for_auth', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#saveLogo').on('click', function () {

            var picFile = $('#logoPic')[0].files[0];
            var formData = new FormData();
            formData.append('pic', picFile);

            App.blockUI({
                target: '#loading',
                animate: true
            });

            $.ajax({
                url: url + '/logo',
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
                        $('#logo').attr("src", $('.fileinput-preview').children('img').attr('src'));
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

        $('#saveFav').on('click', function () {

            var picFile = $('#favPic')[0].files[0];
            var formData = new FormData();
            formData.append('pic', picFile);

            App.blockUI({
                target: '#loading',
                animate: true
            });

            $.ajax({
                url: url + '/fav',
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
                        $('#fav').attr("src", $('.fileinput-preview').children('img').attr('src'));
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

        $('#btnFb').on('click', function () {

            $value = $('#fbLink').val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'fb_link', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#btnTw').on('click', function () {

            $value = $('#twLink').val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'twitter_link', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#btnLd').on('click', function () {

            $value = $('#ldLink').val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'linkedin_link', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#btnIdeaSub').on('click', function () {

            $value = $('#ideaLimit').val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'idea_limit', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#btnHostUser').on('click', function () {

            $value = $('#hostingUser').val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'smtp_username', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#btnHostPass').on('click', function () {

            $value = $('#hostingPass').val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'smtp_password', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#btnHostName').on('click', function () {

            $value = $('#hostName').val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'smtp_host_name', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#btnHostPort').on('click', function () {

            $value = $('#hostPort').val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'smtp_host_port', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#btnFrmAddress').on('click', function () {

            $value = $('#frmAddress').val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'mail_from_address', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#btnFrmName').on('click', function () {

            $value = $('#frmName').val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'mail_from_name', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });

        $('#btncEmail').on('click', function () {

            $value = $('#cEmail').val().trim();
            if ($value) {
                App.blockUI({
                    target: '#loading',
                    animate: true
                });
                $.get(url, {opt: 'contact_mail_id', value: $value}, function (result) {
                    App.unblockUI('#loading');
                    var css = 'font-red-thunderbird';
                    if (result.status == 'ok') {
                        css = 'font-green-jungle';
                    }
                    $('#cBodyText').addClass(css).html(result.msg);
                    $('#confirm').modal('show');
                });
            }
        });
    }

    return {
        init: function (e) {

            handleConfigUpload(e);
        }
    }
}();
