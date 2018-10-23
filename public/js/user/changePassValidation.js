var ChangePassValidation = function () {

    var handleValidation = function () {

        $('#changePass-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                old_password: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 5,
                    notEqualTo:"#old_password"
                },
                confirm_password: {
                    required: true,
                    minlength: 3,
                    equalTo:"#password"
                }
            },
            messages: {
                old_password: {
                    required: "Please enter a old password"
                },
                password: {
                    required: "Please enter a new password",
                    minlength: "Your password must be at least 3 characters long",
                    notEqualTo: "Please enter different password than old password"
                },
                confirm_password: {
                    required: "Please enter confirm password",
                    minlength: "Your password must be at least 3 characters long",
                    equalTo: "Please enter the same password as above"
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
                error.insertAfter(element);
            },

            submitHandler: function(form) {
                form.submit();
            }
        });
    }

    return {
        init: function (e, part) {

            handleValidation();
        }
    }
}();
