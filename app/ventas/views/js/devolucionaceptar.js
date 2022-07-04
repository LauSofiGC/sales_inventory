$(function () {
    $("#ventanaAceptar").on("show.bs.modal", function (event) {
        var element = $(event.relatedTarget);
        var code = element.data("code");
        var message = element.data("message");
        var urlAceptar = "/sales/app/ventas/controller/devolucioncontroller_aceptar.php?cod=" + code;

        var modal = $(this);
        modal.find(".modal-body").html("¿Desea aceptar la devolución del siguiente producto? <br/> <strong>" + message + "</strong>");
        modal.find("#enlaceAceptar").attr("href", urlAceptar);
    });
});