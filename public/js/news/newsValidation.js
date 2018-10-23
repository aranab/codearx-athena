var NewsValidation= function () {

    var handleValidation = function () {

        $('#news-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                'title': {
                    minlength: 3,
                    maxlength: 50
                },
                'description': {
                    minlength: 20,
                    maxlength: 200
                },
                'pic': {
                    extension: "jpg|jpeg|png"
                },
                'content': {

                }
            },
            messages: {
                'title': {
                    required: "Please write title!!",
                    minlength: "Please write minimum 3 character",
                    maxlength: "Please write maximum 50 character",
                },
                'description': {
                    required: "Please write short description!!",
                    minlength: "Please write minimum 20 character",
                    maxlength: "Please write maximum 200 character",
                },
                'pic': {
                    required: "Please select one of image!!",
                    extension: "please select only jpg, jpeg, png extension type image!!" ,
                },
                'content': {
                    required: "Please write main content!!"
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

            handleValidation();
        }
    }
}();
