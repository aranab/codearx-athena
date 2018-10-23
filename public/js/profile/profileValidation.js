
var ProfileUpload = function () {

    var handleProfileUpload = function () {

        $('#profile-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                'title': {
                    maxlength: 50
                },
                'sDes': {
                    maxlength: 100
                },
                'order': {
                    max: 2000,
                },
                'pic': {
                    extension: "jpg|jpeg|png"
                },

            },
            messages: {
                'title': {
                    required: "Title is required",
                    maxlength: "Please write maximum 50 character",
                },
                'sDes': {
                    maxlength: "Please write maximum 100 character",
                },
                'order': {
                    required: "Order Number is required",
                    max: "Maximum Order Number is 2000",
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
                } else if (element.parents(".input-group").size() > 0){
                    error.insertAfter(element.parents(".input-group"));
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

            handleProfileUpload();
        }
    }
}();
