var UserRegistration = function() {

    var handleRegistration = function() {

        $('.register-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                'fname': {
                    required: true,
                    maxlength: 100
                },
                'lname': {
                    required: true,
                    maxlength: 50
                },
                'company': {
                    required: true,
                    maxlength: 100
                },
                'designation': {
                    required: true,
                    maxlength: 100
                },
                'mobile': {
                    required: true,
                    maxlength: 20,
                    digits: true,
                    number: true
                },
                'email': {
                    required: true,
                    email: true
                },
                'password': {
                    required: true,
                    minlength: 5
                },
                'password_confirmation': {
                    required: true,
                    equalTo: "#password"
                }
            },

            messages: {
                'fname': {
                    required: "First name is required.",
                    maxlength: "Please write maximum 100 character"
                },
                'lname': {
                    required: "Last name is required.",
                    maxlength: "Please write maximum 50 character"
                },
                'company': {
                    required: "Company name is required.",
                    maxlength: "Please write maximum 100 character"
                },
                'designation': {
                    required: "Company name is required.",
                    maxlength: "Please write maximum 100 character"
                },
                'mobile': {
                    required: "Please write valid mobile number!!",
                    number: "Only number is allow!!",
                    digits: "Only number is allow!!",
                    maxlength: "Maximum 20 digit is required!!"
                },
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
            },

            invalidHandler: function(event, validator) { //display error alert on form submit
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },

            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });

        $('.register-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.register-form').validate().form()) {
                    $('.register-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    return {
        //main function to initiate the module
        init: function() {
            handleRegistration();
        }
    };

}();
