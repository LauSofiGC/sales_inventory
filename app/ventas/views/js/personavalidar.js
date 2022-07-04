$(function () {
    $("#miFormulario").validate({
        rules: {
            cajaCodigoRol: {
                required: true
            },
            cajaDocPersona: {
                required: true,
                minlength: 5,
                maxlength: 25
            },
            cajaEmailPersona: {
                required: true
            },
            cajaClave: {
                required: true,
                minlength: 3,
                maxlength: 20
            }
        },
        messages: {

            cajaCodigoRol: {
                required: "*Por favor elija un rol"
            },
            cajaDocPersona: {
                required: "*Por favor digita el documento de la persona",
                minlength: "*Por favor digita un mínimo de 3 caracteres",
                maxlength: "*Por favor digita un máximo de 15 caracteres"
            },
            cajaEmailPersona: {
                required: "*Este campo es requerido"
            },
            cajaClave: {
                required: "*Este campo es requerido",
                minlength: "Mínimo 3 caracteres",
                maxlength: "Máximo 20 caracteres"
            }
        },
        submitHandler: function (form) {
            form.cajaClave.value = SHA512(form.cajaClave.value);
            form.submit();
        }
    });
});

