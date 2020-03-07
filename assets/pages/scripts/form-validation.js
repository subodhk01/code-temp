if($('#add_report_form').length > 0){
    var data = {
        rules: {
            title:{
                required:true
            },
            meta_title:{
                required:true
            },
            meta_description:{
                required:true
            },
            meta_keywords:{
                required:true
            }
        },
        element : $('#add_report_form')
    }
    validation_form(data);
}

if($('#add_blog_form').length > 0){
    var data = {
        rules: {
            title:{
                required:true
            },
            meta_title:{
                required:true
            },
            meta_description:{
                required:true
            },
            meta_keywords:{
                required:true
            }
        },
        element : $('#add_blog_form')
    }
    validation_form(data);
}

if($('#add_page_form').length > 0){
    var data = {
        rules: {
            title:{
                required:true
            },
            meta_title:{
                required:true
            },
            meta_description:{
                required:true
            },
            meta_keywords:{
                required:true
            }
        },
        element : $('#add_page_form')
    }
    validation_form(data);
}
if($('#add_user_form').length > 0){
    var data = {
        rules: {
            username:{
                required:true
            },
            email:{
                required:true
            },
            password:{
                required:true
            },
        },
        element : $('#add_user_form')
    }
    validation_form(data);
}

if($('#login_form').length > 0){
    var data = {
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
            }
        },
        element : $('#login_form')
    }
    validation_form(data);
}

if($('#forget_form').length > 0){
    var data = {
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        element : $('#forget_form')
    }
    validation_form(data);
}
function validation_form(data){

    var form1 = data.element;
    var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);

    form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
        rules: data.rules,

        invalidHandler: function (event, validator) { //display error alert on form submit              
            success1.hide();
            error1.show();
            // App.scrollTo(error1, -200);
            var errors = validator.numberOfInvalids();
            if (errors) {
                validator.errorList[0].element.focus();
            }
        },

        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        unhighlight: function (element) { // revert the change done by hightlight
            $(element)
                .closest('.form-group').removeClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label
                .closest('.form-group').removeClass('has-error'); // set success class to the control group
        },

        submitHandler: function (form) {
            success1.show();
            error1.hide();
            form.submit(); // submit the form
        }
    });
}