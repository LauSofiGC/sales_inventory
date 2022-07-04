$(function () {

    $("#usuario").focus();

    $("#frmlogin").validate({
        rules: {
            usuario: {
                required: true,
                email: true
            },
            clave: {
                required: true,
                maxlength: 15,
                minlength: 3
            }
        },
        messages: {
            usuario: {
                required: "*Este campo es requerido",
                email: "El formato del correo es incorrecto"
            },
            clave: {
                required: "*Este campo es requerido",
                maxlength: "Máximo 15 caracteres",
                minlength: "Mínimo 3 caracteres"
            }
        },
        errorClass: "text-danger",

        errorPlacement: function (error, element) {
            error.appendTo(element.parent().find("span"));
        }
        ,

        highlight: function (element) {
            $(element).addClass("alert-danger text-danger");
        }
        ,

        unhighlight: function (element) {
            $(element).removeClass("alert-danger text-danger");
        },

        submitHandler: function (form) {
            form.clave.value = SHA512(form.clave.value);
            form.submit();
        }
    }
    )
})