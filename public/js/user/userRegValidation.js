var UserRegistration = function () {

    var handleRegistration = function () {

        $('#user-regi-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                'email': {
                    required: true,
                    email: true
                },
                'password': {
                    required: true,
                    minlength: 5,
                },
                'password_confirmation': {
                    required: true,
                    equalTo: "#password"
                },
                'mobile': {
                    required: true,
                    number: true,
                    digits: true,
                    minlength: 11,
                    maxlength: 11
                },
                'type': {
                    required: true
                },
                'roles[]': {
                    required: true
                }
            },
            messages: {
                'email': {
                    required: "Please write email as user name!!",
                    email: "Please write valid email address!!"
                },
                'password': {
                    required: "Please write a new password!!",
                    minlength: "Your password must be at least 5 characters long!!",
                },
                'password_confirmation': {
                    required: "Please write confirm password!!",
                    equalTo: "Please write the same password as above!!"
                },
                'mobile': {
                    required: "Please write valid mobile number!!",
                    number: "Only number is allow!!",
                    digits: "Only number is allow!!",
                    minlength: "Minimum 11 digit is required!!",
                    maxlength: "Maximum 11 digit is required!!"
                },
                'type': {
                    required: "Please select one of user type!!"
                },
                'roles[]': {
                    required: "please check at least one role!!"
                }
            },

            invalidHandler: function(event, validator) {
                //display error alert on form submit

            },

            highlight: function(element) {
                // hightlight error inputs
                // set error class to the control group
                $(element).closest('.form-group').addClass('has-error');
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                // render error placement for each input type
                if (element.parent(".input-group").size() > 0) {

                    error.insertAfter(element.parent(".input-group"));
                } else if (element.parents(".checkbox-list").size() > 0) {

                    error.insertAfter(element.parents(".checkbox-list"));
                } else {
                    // for other inputs, just perform default behavior
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                form.submit();
            }
        });
    }

    var handleSRolesList = function (e) {

        $("#userType" ).change(function() {
            var value = $(this).val();
            $('#roleCheckBox').empty();
            if (value) {
                var url = e + '/~super/users/roles';
                $('#rolesList').removeClass('has-error hide').addClass('open');

                App.blockUI({
                    target: '#roleCheckBox',
                    animate: true
                });
                $.get(url, {type: value}, function (result) {
                    App.unblockUI('#roleCheckBox');
                    var html = '<div class="checkbox-list">';
                    if (result == 'error') {
                        html += '<label class="checkbox-inline">' +
                            '<input type="checkbox" ' +
                            'name="roles" id="role" value="" ' +
                            'checked disabled>' +
                            'NaN' +
                            '</label></div>';
                        $('#roleCheckBox').html(html);
                        $("#role").uniform();
                        return;
                    }
                    $.each(result.id, function (idx, obj) {
                        html += '<label class="checkbox-inline">' +
                            '<input type="checkbox" ' +
                            'name="roles[]" class="role" value="'+obj+'">' +
                            result.name[idx] +
                            '</label>';
                    });
                    html += '</div>'
                    $('#roleCheckBox').html(html);
                    $(".role").uniform();
                }, "json");
                return;
            }
            $('#rolesList').removeClass('open').addClass('hide');
        });
    }

    var handleWRolesList = function (e) {

        $("#userType" ).change(function() {
            var value = $(this).val();
            $('#roleCheckBox').empty();
            if (value) {
                var url = e + '/core/users/roles';
                $('#rolesList').removeClass('has-error hide').addClass('open');

                App.blockUI({
                    target: '#roleCheckBox',
                    animate: true
                });
                $.get(url, {type: value}, function (result) {
                    App.unblockUI('#roleCheckBox');
                    var html = '<div class="checkbox-list">';
                    if (result == 'error') {
                        html += '<label class="checkbox-inline">' +
                            '<input type="checkbox" ' +
                            'name="roles" id="role" value="" ' +
                            'checked disabled>' +
                            'NaN' +
                            '</label></div>';
                        $('#roleCheckBox').html(html);
                        $("#role").uniform();
                        return;
                    }
                    $.each(result.id, function (idx, obj) {
                        html += '<label class="checkbox-inline">' +
                            '<input type="checkbox" ' +
                            'name="roles[]" class="role" value="'+obj+'">' +
                            result.name[idx] +
                            '</label>';
                    });
                    html += '</div>'
                    $('#roleCheckBox').html(html);
                    $(".role").uniform();
                }, "json");
                return;
            }
            $('#rolesList').removeClass('open').addClass('hide');
        });
    }

    return {
        init: function (e, part) {

            handleRegistration();
            if (part == 's') {
                handleSRolesList(e);
            }
            if (part == 'w') {
                handleWRolesList(e);
            }
        }
    }
}();
