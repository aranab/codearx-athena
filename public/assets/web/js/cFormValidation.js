var ContactForm = function() {

    var handleValidation = function() {

        $('#contact-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                'name': {
                    required: true,
                    maxlength: 100
                },
                'email': {
                    required: true,
                    email: true
                },
                'mobile': {
                    required: true,
                    maxlength: 20,
                    digits: true,
                    number: true
                },
                'msg': {
                    required: true,
                    maxlength: 5000
                }
            },

            messages: {
                'name': {
                    required: "Name is required.",
                    maxlength: "Please write maximum 100 character"
                },
                'email': {
                    required: "Please write your valid email address!!",
                    email: "Please write valid email address!!"
                },
                'mobile': {
                    required: "Please write valid mobile number!!",
                    number: "Only number is allow!!",
                    digits: "Only number is allow!!",
                    maxlength: "Maximum 20 digit is required!!"
                },
                'msg': {
                    required: "your message is required!!",
                    maxlength: "Please write maximum 5000 character"
                }
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

        $('#contact-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('#contact-form').validate().form()) {
                    $('#contact-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    return {
        //main function to initiate the module
        init: function() {
            handleValidation();
        }
    };

}();
