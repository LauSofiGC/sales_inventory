$(function () {
    $("#miFormulario").validate({
        rules: {
           
            cajaNombre: {
                required: true,
                minlength: 5,
                maxlength: 25
            }
        },
        messages:{
           
            cajaNombre:{
                required:"*Por favor digita un nombre de impuesto",
                minlength:"*Por favor digita un mínimo de 5 caracteres",
                maxlength:"*Por favor digita un máximo de 15 caracteres"
            }
        }
    });
});

