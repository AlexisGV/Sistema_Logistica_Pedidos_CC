/*=============================================
VALIDAR CHECKS PARA AGREGAR OTRA MARCA / FORMA
=============================================*/
$(document).on("change", "#ingCheckOtraMarcaProd", function () {
    if ($(this).is(":checked")) {
        $("#ingOtraMarcaProd").removeClass("d-none is-valid is-invalid");
        $("#ingMarcaProducto").prop("disabled", true);
        $("#ingMarcaProducto").val(null).trigger("change");
    } else {
        $("#ingOtraMarcaProd").addClass("d-none");
        $("#ingMarcaProducto").prop("disabled", false);
    }
});

$(document).on("change", "#ingCheckOtraFormaProd", function () {
    if ($(this).is(":checked")) {
        $("#ingOtraFormaProd").removeClass("d-none");
        $("#ingFormaProducto").prop("disabled", true);
        $("#ingFormaProducto").val(null).trigger("change");
    } else {
        $("#ingOtraFormaProd").addClass("d-none");
        $("#ingFormaProducto").prop("disabled", false);
    }
});

/*=============================================
VALIDAR CHECKS PARA AGREGAR OTRO ACABADO / CORTE
=============================================*/
$(document).on("change", "#ingCorteProducto", function () {
    
});