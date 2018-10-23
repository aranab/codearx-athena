var QuestionUpload = function () {

    var handleQuestionUpload = function () {

        $('#question-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                'format': {
                    required: true
                },
                'question': {
                    required: true
                },
                'order': {
                    max: 2000
                }
            },
            messages: {
                'format': {
                    required: "Input Format is required"
                },
                'question': {
                    required: "Please write a question"
                },
                'order': {
                    required: "Order Number is required",
                    max: "Maximum Order Number is 2000",
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
                if (element.attr('name') == "question") {
                    error.insertAfter(".note-editor");
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

    return {
        init: function (e, part) {

            handleQuestionUpload();
        }
    }
}();

