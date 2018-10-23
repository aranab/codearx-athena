
var sliderUpload = function () {

    var handleSliderUpload = function () {

        $('#slider-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                'name': {
                    minlength: 3,
                    maxlength: 50
                },
                'order': {
                },
                'title': {
                    maxlength: 50
                },
                'description': {
                    maxlength: 255
                },
                'pic': {
                    extension: "jpg|jpeg|png"
                },

            },
            messages: {
                'name': {
                    required: "Please write slider name!!",
                    minlength: "Please write minimum 3 character",
                    maxlength: "Please write maximum 50 character",
                },
                'order': {
                    required: "Please select one of order number!!",
                },
                'title': {
                    maxlength: "Please write maximum 50 character",
                },
                'description': {
                    maxlength: "Please write maximum 255 character",
                },
                'pic': {
                    required: "Please select one of image!!",
                    extension: "please select only jpg, jpeg, png extension type image!!" ,
                },
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
               if (element.parent(".btn-file").size() > 0) {

                    error.insertAfter(element.parents("#up-img"));
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

            handleSliderUpload();
        }
    }
}();
