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

$(document).on("change keyup blur", "#editCliente", function () {
    let expresion = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;
    validarExpresion($(this), expresion);
});

$(document).on("change keyup blur", "#editCorreo", function () {
    let expresion = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}$/;
    if ($(this).val() != "" && $(this).val() != null) {
        validarExpresion($(this), expresion);
    }
});

$(document).on("change keyup blur", "#editTelefono", function () {
    let expresion = /^5+[5-6]+[0-9]{8,8}$/;
    validarExpresion($(this), expresion);
});

$(document).on("keyup change", "#editAnticipo", function () {
    let expresion = /^[0-9]+$/,
        expresion3 = /^[0-9]+\.[0-9]{1,2}$/;

    if ($("#editTotal").val() != "" && $("#editTotal").val() != null) {

        if ($(this).val().match(expresion)) {
            if (Number($("#editTotal").val()) >= Number($(this).val())) {
                $(this).removeClass("is-invalid");
                $("#errorEditAnticipoMenorPedido").hide();
                validarExpresion($(this), expresion);
                listarProductos();
            } else {
                $(this).addClass("is-invalid");
                $("#errorEditAnticipoMenorPedido").show();
            }
        } else {

            if (Number($("#editTotal").val()) >= Number($(this).val())) {
                $(this).removeClass("is-invalid");
                $("#errorEditAnticipoMenorPedido").hide();
                if (validarExpresion($(this), expresion3)) {
                    $("#errorEditAnticipoPedido").hide();
                } else {
                    if ($(this).val() != "") $("#errorEditAnticipoPedido").show();
                    else $("#errorEditAnticipoPedido").hide();
                }
                listarProductos();
            } else {
                $(this).addClass("is-invalid");
                $("#errorEditAnticipoMenorPedido").show();
            }

        }

    }

});

$(document).on("submit", "#formEditPedido", function (e) {
    let expNombre = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/,
        expEmail = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}$/,
        expTelf = /^5+[5-6]+[0-9]{8,8}$/;

    if (!validarExpresion($("#editCliente"), expNombre)) {
        e.preventDefault();
    }
    if (!validarExpresion($("#editTelefono"), expTelf)) {
        e.preventDefault();
    }

    if ($("#editCorreo").val() != "" && $("#editCorreo").val() != null) {
        if (!validarExpresion($("#editCorreo"), expEmail)) {
            e.preventDefault();
        }
    }

});

/*=============================================
AGREGAR UN PRODUCTO A PEDIDO EXISTENTE
=============================================*/
$(document).on("click", "#addProductoToPedido", function () {
    var idPedido = $("#editIdPedido").val();

    $("#viewNumberPedido").html(idPedido);
    $("#idNumberPedidoAddProd").val(idPedido);
});

$(document).on("click", ".btnAñadirProductoPedido", function (e) {
    let expTit = /^[A-Za-z0-9ñÑáÁéÉíÍóÓúÚ,.\s]+$/,
        expOMOCObv = /^[A-Za-z0-9ñÑáÁéÉíÍóÓúÚ,.\s]+$/,
        expOFOA = /^[A-Za-zñÑáÁéÉíÍóÓúÚ,.\s]+$/,
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
    } else {
        if ($("#ingMarcaProducto").val() == null || $("#ingMarcaProducto").val() == "") {
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
    } else {
        if ($("#ingFormaProducto").val() == null || $("#ingFormaProducto").val() == "") {
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

    if (($("#ingCorteProducto").val() == null || $("#ingCorteProducto").val() == "") && $("#ingCheckOtroCorteProd").prop("checked") == false) {
        $("#errorNingunCorte").show();
        return false;
    }

    if (($("#ingAcabadoProducto").val() == null || $("#ingAcabadoProducto").val() == "") && $("#ingCheckOtroAcabadoProd").prop("checked") == false) {
        $("#errorNingunAcabado").show();
        return false;
    }

    // VALIDAR OBSERVACION
    if ($("#ingObvProducto").val() != "") {
        if (!validarExpresion($("#ingObvProducto"), expOMOCObv))
            return false;
    }

    swal({
        title: "Agregar producto al pedido \""+$("#editIdPedido").val()+"\"",
        text: "¿Estas seguro de que quieres agregar este producto a la lista? Esta acción modificará los totales de forma automática sin necesidad de dar clic en el botón \"Guardar cambios\" . Si deseas continuar da clic en el botón \"Confirmar\"",
        icon: "warning",
        buttons: {
            cancel: {
                text: "Cancelar",
                value: null,
                visible: true,
                className: "bg-danger",
            },
            confirm: {
                text: "Confirmar",
                value: true,
                visible: true,
                className: "bg-primary",
            }
        },
    }).then((result) => {
        if (result) {
            $.ajax({
                url: "ajax/pedidos.ajax.php",
                type: "POST",
                data: $("#formAgregarProductoPedido").serialize(),
                dataType: "json",
                success: function (respuesta) {
        
                    // console.log(respuesta);
        
                    $(".closeModalProducto").trigger("click");
        
                    if (respuesta == "errorProducto") {
                        swal({
                            title: "Error al ingresar el producto!",
                            text: "No se puedo agregar el producto a la lista, intente de nuevo.",
                            icon: "error",
                            closeOnClickOutside: false,
                        });
                    } else if (respuesta == "errorTotales") {
                        swal({
                            title: "Error al actualizar totales!",
                            text: "El producto se ingresó, pero hubo un problema al actualizar los totales.",
                            icon: "error",
                            closeOnClickOutside: false,
                        });
                    } else {
                        var badgeDescuento = "";
                        if (Number(respuesta["descuento"]) > 0) {
                            badgeDescuento = '<span class="badge bg-indigo ml-2 ml-xl-0" style="font-size: 1rem;">- ' + respuesta["descuento"] + '%</span>';
                        }
        
                        $("#editContenedorProductos").append(
                            '<div class="productoNuevo row py-3 border-top border-secondary" idProducto="' + respuesta["idProducto"] + '">' +
                            '    <div class="col-12 col-xl-8 pb-2 pb-xl-0">' +
                            '        <span class="d-block font-weight-bold text-center d-xl-none">Descripción del producto:</span>' + respuesta["descripcion"] +
                            '    </div>' +
                            '    <div class="col-6 col-xl-2 text-center"><span class="d-inline-block d-xl-none font-weight-bold mr-1">Cantidad:</span>' +
                            '       <div class="btn-group">' +
                            '           <button type="button" class="btn btn-outline-info btnAddOne" idProducto="' + respuesta["idProducto"] + '" idPedido="' + respuesta["idPedido"] + '"><i class="fas fa-plus"></i></button>' +
                            '           <div class="btn border border-info px-3 font-weight-bold cantidadProducto">' + respuesta["cantidad"] + '</div>' +
                            '           <button type="button" class="btn btn-outline-info btnRemoveOne" idProducto="' + respuesta["idProducto"] + '" idPedido="' + respuesta["idPedido"] + '"><i class="fas fa-minus"></i></button>' +
                            '       </div>' +
                            '   </div>' +
                            '    <div class="col-6 col-xl-1 text-center contenedorPrecioProducto"><span class="d-inline-block d-xl-none font-weight-bold mr-1">Precio:</span>$ <span class="precioProducto">' + Number(respuesta["importe"]).toFixed(2) + badgeDescuento + '</span></div>' +
                            '    <div class="col-12 col-xl-1 py-2 py-xl-0">' +
                            '       <div class="btn-group w-100">' +
                            '<button type="button" class="btn btn-danger btnEliminarDetallePedido" idProducto="' + respuesta["idProducto"] + '"><i class="fas fa-trash-alt mr-1 mr-xl-0"></i><span class="d-inline-block d-xl-none font-weight-bold">Eliminar</span></button>' +
                            '       </div>' +
                            '   </div>' +
                            '</div>'
                        );
        
                        $("#editSubtotal").val(Number(respuesta["subtotal"]).toFixed(2));
                        $("#editIVA").val(respuesta["IVA"]);
                        $("#editTotal").val(Number(respuesta["total"]).toFixed(2));
        
                        if (respuesta["anticipo"] == respuesta["total"]) {
                            $("#editPagoCompleto").prop("checked", true).trigger("change");
                        } else {
                            $("#editPagoCompleto").prop("checked", false).trigger("change");
                            $("#editAnticipo").val(Number(respuesta["anticipo"]).toFixed(2));
                        }
        
                        swal({
                            title: "Producto añadido con éxito!",
                            text: "El producto se agrego de forma correcta a la lista del pedido.",
                            icon: "success",
                        });
                    }
        
                }
            });
        }
    });


    return false;

});