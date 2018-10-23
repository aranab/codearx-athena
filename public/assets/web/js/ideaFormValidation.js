var IdeaForm = function() {

    var handleValidation = function(e) {

        //add the custom validation method
        jQuery.validator.addMethod("wordCount",
            function(value, element, params) {
                var count = getWordCount(value);
                if(count <= params[0]) {
                    return true;
                }
            },
            jQuery.validator.format("Please write maximum {0} word")
        );

        $('#idea-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block required', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: JSON.parse(e[0]),
            messages: JSON.parse(e[1]),

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
    }

    return {
        //main function to initiate the module
        init: function(e) {
            handleValidation(e);
        }
    };

}();

function getWordCount(wordString) {
    var words = wordString.split(" ");
    words = words.filter(function(words) {
        return words.length > 0
    }).length;
    return words;
}


