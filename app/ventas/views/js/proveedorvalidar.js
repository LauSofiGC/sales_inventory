$(function () {
    $("#miFormulario").validate({
        rules: {
            cajaNomPro: {
                required: true,
                minlength: 5,
                maxlength: 25
            },
            cajaTelPro: {
                required: true,
                minlength: 3,
                maxlength: 20
            }
        },
        messages: {

            cajaNomPro: {
                required: "*Por favor digita el nombre del proveedor",
                minlength: "*Por favor digita un mínimo de 3 caracteres",
                maxlength: "*Por favor digita un máximo de 15 caracteres"
            },
            cajaTelPro: {
                required: "*Este campo es requerido",
                minlength: "Mínimo 3 caracteres",
                maxlength: "Máximo 20 caracteres"
            }
        }
    });
});

