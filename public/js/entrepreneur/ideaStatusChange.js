var IdeaStatusChange = function () {

    var handleValidationSubmit = function (e) {

        $('#status-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error required', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                'dropStatus': {
                    required: true
                }
            },
            messages: {
                'dropStatus': {
                    required: "Please select one status!!"
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
        init: function (e) {

            handleValidationSubmit(e);
        }
    }
}();
