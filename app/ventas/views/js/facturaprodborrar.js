$(function () {
    $("#ventanaBorrar").on("show.bs.modal", function (event) {
         var element = $(event.relatedTarget);
         var code = element.data("code");
         var message = element.data("message");
         var urlDelete = "../../controller/faccontroller_borrarget.php?cod="+code;
         
         var modal = $(this);
         modal.find(".modal-body").html("¿Desea quitar el producto de su factura? <br/> <strong>"+message+"</strong>");
         modal.find("#enlaceBorrar").attr("href",urlDelete);
    });
});


