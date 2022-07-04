$(function () {
    $("#ventanaRechazar").on("show.bs.modal", function (event) {
        var element = $(event.relatedTarget);
        var code = element.data("code");
        var message = element.data("message");
        var urlDelete = "/sales/app/ventas/controller/devolucioncontroller_rechazar.php?cod=" + code;

        var modal = $(this);
        modal.find(".modal-body").html("¿Desea eliminar el registro? <br/> <strong>" + message + "</strong>");
        modal.find("#enlaceRechazar").attr("href", urlDelete);
    });
});

