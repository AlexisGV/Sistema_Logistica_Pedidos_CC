/*=============================================
VALIDAR CHECKS PARA AGREGAR OTRA MARCA / FORMA
=============================================*/
$(document).on("change", "#ingCheckOtraMarcaProd", function () {
    $("#ingOtraMarcaProd").removeClass("is-valid is-invalid");
    $("#ingOtraMarcaProd").val(null);
    if ($(this).is(":checked")) {
        $("#ingOtraMarcaProd").removeClass("d-none");
        $("#ingMarcaProducto").prop("disabled", true);
        $("#ingMarcaProducto").val(null).trigger("change");
        $("#errorIngMarcaProducto").hide();
    } else {
        $("#ingOtraMarcaProd").addClass("d-none");
        $("#ingMarcaProducto").prop("disabled", false);
    }
});

$(document).on("change", "#ingCheckOtraFormaProd", function () {
    $("#ingOtraFormaProd").removeClass("is-valid is-invalid");
    $("#ingOtraFormaProd").val(null);
    if ($(this).is(":checked")) {
        $("#ingOtraFormaProd").removeClass("d-none");
        $("#ingFormaProducto").prop("disabled", true);
        $("#ingFormaProducto").val(null).trigger("change");
        $("#errorIngFormaProducto").hide();
    } else {
        $("#ingOtraFormaProd").addClass("d-none");
        $("#ingFormaProducto").prop("disabled", false);
    }
});

/*=============================================
VALIDAR CHECKS PARA AGREGAR OTRO ACABADO / CORTE
=============================================*/
$(document).on("change", "#ingCheckOtroCorteProd", function () {
    $("#ingOtroCorteProd").removeClass("is-valid is-invalid");
    $("#ingOtroCorteProd").val(null);
    if ($(this).is(":checked")) {
        $("#ingOtroCorteProd").removeClass("d-none");
    } else {
        $("#ingOtroCorteProd").addClass("d-none");
    }
});

$(document).on("change", "#ingCheckOtroAcabadoProd", function () {
    $("#ingOtroAcabadoProd").removeClass("is-valid is-invalid");
    $("#ingOtroAcabadoProd").val(null);
    if ($(this).is(":checked")) {
        $("#ingOtroAcabadoProd").removeClass("d-none");
    } else {
        $("#ingOtroAcabadoProd").addClass("d-none");
    }
});

/*=============================================
OBTENER PRECIO DE ACABADOS Y CORTES
=============================================*/
$(document).on("change", "#ingCorteProducto", function () {
    let valores = [];

    valores = $(this).val();

    console.log(valores);
});

/*=============================================
FUNCION PARA EVALUAR EXPRESIONES
=============================================*/
function validarExpresion(campo, expresion) {

    if (campo.val().match(expresion)) {
        campo.removeClass("is-invalid");
        campo.addClass("is-valid");

        return true;
    } else {
        campo.removeClass("is-valid");
        campo.addClass("is-invalid");

        return false;
    }

}

/*=============================================
FUNCION PARA OBTENER EL PRECIO FINAL
=============================================*/
function obtenerPrecioFinal() {
    let precioFinal = 0,
        precioInicial = 0,
        cantidad = 0,
        descuento = 0;

    if ($("#ingCantidad").val() != "")
        cantidad = $("#ingCantidad").val();

    if ($("#ingDescuento").val() != "")
        descuento = $("#ingDescuento").val();

    if ($("#ingPrecioInicial").val() != "") {
        precioInicial = $("#ingPrecioInicial").val();
        precioFinal = (precioInicial - ((precioInicial * descuento) / 100)) * cantidad;
        $("#ingPrecioFinal").val(precioFinal.toFixed(2));

        /* VALIDAR PRECIO FINAL
        -------------------------------------------------- */
        let expInt = /^[0-9]+$/,
            expDec = /^[0-9]+\.[0-9]{2,2}$/;


        if ($("#ingPrecioFinal").val().match(expInt)) {
            validarExpresion($("#ingPrecioFinal"), expInt);
        } else {

            if (isNaN($("#ingPrecioFinal").val())) {
                $("#errorIngPrecioFinal").html("Ingrese un valor númerico");
                validarExpresion($("#ingPrecioFinal"), expDec);
                $("#errorIngPrecioFinal").show();
            } else {
                $("#errorIngPrecioInicial").html("El valor debe tener 2 decimales.");
                if (validarExpresion($("#ingPrecioFinal"), expDec)) {
                    $("#errorIngPrecioFinal").hide();
                } else {
                    if ($("#ingPrecioFinal").val() != "") $("#errorIngPrecioFinal").show();
                    else $("#errorIngPrecioFinal").hide();
                }
            }
        }
        /* FIN - VALIDAR PRECIO FINAL
        -------------------------------------------------- */

    } else {
        $("#ingPrecioFinal").val("");
    }

}

/*=============================================
VALIDAR TITULO O DESCRIPCION
=============================================*/
$(document).on("keyup change", "#ingNomProducto", function () {
    let expresion = /^[A-Za-zñÑáÁéÉíÍóÓúÚ,.\s-]+$/;
    validarExpresion($(this), expresion);
});

/*=============================================
VALIDAR OBSERVACIONES
=============================================*/
$(document).on("keyup change", "#ingObvProducto", function () {
    let expresion = /^[A-Za-z0-9ñÑáÁéÉíÍóÓúÚ,.\s-]+$/;

    if ($(this).val() != "") {
        validarExpresion($(this), expresion);
    } else {
        $(this).removeClass("is-valid is-invalid");
    }
});

/*=============================================
VALIDAR PRECIO INICIAL
=============================================*/
$(document).on("keyup change blur", "#ingPrecioInicial", function () {
    var expresion = /^[0-9]+$/,
        expresion3 = /^[0-9]+\.[0-9]{2,2}$/;

    if ($(this).val().match(expresion)) {
        validarExpresion($(this), expresion);
    } else {

        if (isNaN($(this).val())) {
            $("#errorIngPrecioInicial").html("Ingrese un valor númerico");
            validarExpresion($(this), expresion3);
            $("#errorIngPrecioInicial").show();
        } else {
            $("#errorIngPrecioInicial").html("El valor debe tener 2 decimales.");
            if (validarExpresion($(this), expresion3)) {
                $("#errorIngPrecioInicial").hide();
            } else {
                if ($(this).val() != "") $("#errorIngPrecioInicial").show();
                else $("#errorIngPrecioInicial").hide();
            }
        }
    }

    obtenerPrecioFinal();
});

/*=============================================
VALIDAR CANTIDAD
=============================================*/
$(document).on("keyup change blur", "#ingCantidad", function () {
    var expresion = /^[0-9]+$/;
    validarExpresion($(this), expresion);
    obtenerPrecioFinal();
});

/*=============================================
VALIDAR DESCUENTO
=============================================*/
$(document).on("keyup change blur", "#ingDescuento", function () {
    var expresion = /^[0-9]+$/;
    validarExpresion($(this), expresion);
    obtenerPrecioFinal();
});

/*=============================================
VALIDAR OTRA MARCA
=============================================*/
$(document).on("keyup change blur", "#ingOtraMarcaProd", function () {
    let expresion = /^[A-Za-z0-9ñÑáÁéÉíÍóÓúÚ,.\s-]+$/;
    validarExpresion($(this), expresion);
});

/*=============================================
VALIDAR OTRA FORMA
=============================================*/
$(document).on("keyup change blur", "#ingOtraFormaProd", function () {
    let expresion = /^[A-Za-zñÑáÁéÉíÍóÓúÚ,.\s-]+$/;
    validarExpresion($(this), expresion);
});

/*=============================================
VALIDAR OTRO CORTE
=============================================*/
$(document).on("keyup change blur", "#ingOtroCorteProd", function () {
    let expresion = /^[A-Za-z0-9ñÑáÁéÉíÍóÓúÚ,.\s-]+$/;
    validarExpresion($(this), expresion);
});

/*=============================================
VALIDAR OTRO ACABADO
=============================================*/
$(document).on("keyup change blur", "#ingOtroAcabadoProd", function () {
    let expresion = /^[A-Za-zñÑáÁéÉíÍóÓúÚ,.\s-]+$/;
    validarExpresion($(this), expresion);
});

/*=============================================
VALIDAR ENVIO DE FORMULARIO
=============================================*/
$(document).on("click", ".btnAñadirProducto", function (e) {
    let expTit = /^[A-Za-zñÑáÁéÉíÍóÓúÚ,.\s-]+$/,
        expOMOCObv = /^[A-Za-z0-9ñÑáÁéÉíÍóÓúÚ,.\s-]+$/,
        expOFOA = /^[A-Za-zñÑáÁéÉíÍóÓúÚ,.\s-]+$/,
        expInt = /^[0-9]+$/,
        expDec = /^[0-9]+\.[0-9]{2,2}$/;

    if (!validarExpresion($("#ingNomProducto"), expTit)) return false;

    // VALIDAR PRECIO INICIAL
    if ($("#ingPrecioInicial").val().match(expInt)) {
        validarExpresion($("#ingPrecioInicial"), expInt);
    } else {

        if (isNaN($("#ingPrecioInicial").val())) {
            $("#errorIngPrecioInicial").html("Ingrese un valor númerico");
            validarExpresion($("#ingPrecioInicial"), expDec);
            $("#errorIngPrecioInicial").show();
            return false;
        } else {
            $("#errorIngPrecioInicial").html("El valor debe tener 2 decimales.");
            if (validarExpresion($("#ingPrecioInicial"), expDec)) {
                $("#errorIngPrecioInicial").hide();
            } else {
                if ($("#ingPrecioInicial").val() != "") $("#errorIngPrecioInicial").show();
                else $("#errorIngPrecioInicial").hide();
                return false;
            }
        }
    }

    // VALIDAR CANTIDAD Y DESCUENTO
    if (!validarExpresion($("#ingCantidad"), expInt)) return false;
    if (!validarExpresion($("#ingDescuento"), expInt)) return false;

    // VALIDAR PRECIO FINAL
    if ($("#ingPrecioFinal").val().match(expInt)) {
        validarExpresion($("#ingPrecioFinal"), expInt);
    } else {

        if (isNaN($("#ingPrecioFinal").val())) {
            $("#errorIngPrecioFinal").html("Ingrese un valor númerico");
            validarExpresion($("#ingPrecioFinal"), expDec);
            $("#errorIngPrecioFinal").show();
            return false;
        } else {
            $("#errorIngPrecioInicial").html("El valor debe tener 2 decimales.");
            if (validarExpresion($("#ingPrecioFinal"), expDec)) {
                $("#errorIngPrecioFinal").hide();
            } else {
                if ($("#ingPrecioFinal").val() != "") $("#errorIngPrecioFinal").show();
                else $("#errorIngPrecioFinal").hide();
                return false;
            }
        }
    }

    /* VALIDACION PARA LA MARCA
    -------------------------------------------------- */
    if ($("#ingCheckOtraMarcaProd").is(":checked")) {
        if (!validarExpresion($("#ingOtraMarcaProd"), expOMOCObv)) return false;
    } else{
        if( $("#ingMarcaProducto").val() == null || $("#ingMarcaProducto").val() == "" ) {
            $("#errorIngMarcaProducto").show();
            return false;
        } else {
            $("#errorIngMarcaProducto").hide();
        }
    }

    /* VALIDACION PARA LA FORMA
    -------------------------------------------------- */
    if ($("#ingCheckOtraFormaProd").is(":checked")) {
        if (!validarExpresion($("#ingOtraFormaProd"), expOFOA)) return false;
    } else{
        if( $("#ingFormaProducto").val() == null || $("#ingFormaProducto").val() == "" ) {
            $("#errorIngFormaProducto").show();
            return false;   
        } else {
            $("#errorIngFormaProducto").hide();
        }
    }

    if ($("#ingCheckOtroCorteProd").is(":checked")) {
        if (!validarExpresion($("#ingOtroCorteProd"), expOMOCObv))
            return false;
    }

    if ($("#ingCheckOtroAcabadoProd").is(":checked")) {
        if (!validarExpresion($("#ingOtroAcabadoProd"), expOFOA))
            return false;
    }

    // VALIDAR OBSERVACION
    if ($("#ingObvProducto").val() != "") {
        if (!validarExpresion($("#ingObvProducto"), expOMOCObv))
            return false;
    }
    
    $.ajax({
        url: "ajax/pedidos.ajax.php",
        type: "POST",
        data: $("#formAgregarProducto").serialize(),
        success: function (respuesta) {
            $("#ingNombreCliente").val(respuesta);
        }
    });

    return false;

});