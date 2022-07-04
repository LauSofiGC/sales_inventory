$(function () {
    $("#ventanaBorrar").on("show.bs.modal", function (event) {
         var element = $(event.relatedTarget);
         var code = element.data("code");
         var message = element.data("message");
         var urlDelete = "/sales/app/ventas/controller/taxcontroller_borrarget.php?codigo="+code;
         
         var modal = $(this);
         modal.find(".modal-body").html("¿Desea eliminar el registro? <br/> <strong>"+message+"</strong>");
         modal.find("#enlaceBorrar").attr("href",urlDelete);
    });
});



