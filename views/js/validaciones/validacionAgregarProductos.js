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
$(document).on("change", "#ingCheckOtroCorteProd", function () {
    if ($(this).is(":checked")) {
        $("#ingOtroCorteProd").removeClass("d-none");
    } else {
        $("#ingOtroCorteProd").addClass("d-none");
    }
});

$(document).on("change", "#ingCheckOtroAcabadoProd", function () {
    if ($(this).is(":checked")) {
        $("#ingOtroAcabadoProd").removeClass("d-none");
    } else {
        $("#ingOtroAcabadoProd").addClass("d-none");
    }
});

/*=============================================
OBTENER PRECIO DE ACABADOS Y CORTES
=============================================*/
$(document).on("change", "#ingCorteProducto", function (e) {
    let precioCorte = 0;

    if ($(this).find(":selected")) {
        // precioCorte = $(this).find(":selected").attr("precioCorte");
        precioCorte = $(this).find(":selected").text();
    } else if ($(this).find(":unselected")){
        // precioCorte = $(this).find(":unselected").attr("precioCorte");
        precioCorte = $(this).find(":unselected").text();
    }

    console.log(precioCorte);
});