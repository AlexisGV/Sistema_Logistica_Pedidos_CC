/*=============================================
VER DETALLES DEL PEDIDO
=============================================*/
$(document).on("click", ".btnVerDetallePedido", function () {

    var idPedido = $(this).attr("idPedido");

    var datos = new FormData();
    datos.append('verPedidoId', idPedido);

    $.ajax({

        url: "ajax/pedidos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log(respuesta);
            let idPedidoSeleccionado = respuesta["Id_Pedido"];

            $("#viewNumeroPedido").html(idPedidoSeleccionado);

            /*=============================================
            FECHAS
            =============================================*/
            var fechaInicio = new Date(respuesta["Fecha_Inicio"]);
            var fechaCompromiso = new Date(respuesta["Fecha_Compromiso"]);
            var options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            $("#fechasPedido").append('<div class="text-center text-xl-left"><span class="font-weight-bold mr-1">Inicio:</span>' + fechaInicio.toLocaleDateString("es-MX", options) + '</div>');
            $("#fechasPedido").append('<div class="text-center"><span class="font-weight-bold mr-1">Compromiso:</span>' + fechaCompromiso.toLocaleDateString("es-MX", options) + '</div>');

            if (respuesta["Fecha_Entrega"] != "" && respuesta["Fecha_Entrega"] != null) {
                var fechaEntrega = new Date(respuesta["Fecha_Entrega"]);

                $("#fechasPedido").append('<div class="text-center text-xl-right"><span class="font-weight-bold mr-1">Entrega:</span>' + fechaEntrega.toLocaleDateString("es-MX", options) + '</div>');
            } else {
                $("#fechasPedido").append('<div class="text-center text-xl-right"><span class="font-weight-bold mr-1">Entrega:</span>El pedido aún no se entrega</div>');
            }

            /*=============================================
            DATOS DEL CLIENTE
            =============================================*/
            $("#datosCliente").append('<div class="text-center text-xl-left"><span class="font-weight-bold mr-1">Nombre:</span>' + respuesta["Nombre_Cliente"] + '</div>');

            if (respuesta["Correo_Cliente"] != "" && respuesta["Correo_Cliente"] != null) {
                $("#datosCliente").append('<div class="text-center"><span class="font-weight-bold mr-1">Correo:</span>' + respuesta["Correo_Cliente"] + '</div>');
            } else {
                $("#datosCliente").append('<div class="text-center"><span class="font-weight-bold mr-1">Correo:</span>No se capturó el correo del cliente</div>');
            }

            $("#datosCliente").append('<div class="text-center text-xl-right"><span class="font-weight-bold mr-1">Teléfono:</span>' + respuesta["Telefono_Cliente"] + '</div>');

            /*=============================================
            MOSTRAR PRODUCTOS
            =============================================*/
            var datos2 = new FormData();
            datos2.append('verProdsPedidoId', idPedidoSeleccionado);

            $.ajax({

                url: "ajax/pedidos.ajax.php",
                method: "POST",
                data: datos2,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    // console.log(respuesta);

                    for (var i = 0; i < respuesta.length; i++) {

                        if (respuesta[i]["descuento"] > 0) {
                            badgeDescuento = '<span class="badge bg-indigo ml-2 ml-xl-0" style="font-size: 1rem;">- ' + respuesta[i]["descuento"] + '%</span>';
                        } else {
                            badgeDescuento = "";
                        }

                        $("#contenedorProductosModal").append(
                            '<div class="productoNuevo row py-3 border-top border-secondary">' +
                            '<div class="col-12 col-xl-10 pb-2 pb-xl-0"><span class="d-block font-weight-bold text-center d-xl-none">Descripción del producto:</span>' + respuesta[i]["descripcion"] + '</div>' +
                            '<div class="col-4 col-xl-1 text-left text-xl-center"><span class="d-inline-block d-xl-none font-weight-bold mr-1">Cantidad:</span>' + respuesta[i]["cantidad"] + '</div>' +
                            '<div class="col-6 col-xl-1 text-right text-xl-center"><span class="d-inline-block d-xl-none font-weight-bold mr-1">Precio:</span>' + Number(respuesta[i]["importe"]).toFixed(2) + badgeDescuento + '</div>' +
                            '</div>'
                        );
                    }
                }

            });

            /*=============================================
            TOTALES
            =============================================*/
            $("#totalesPedido").append('<div class="text-right"><span class="font-weight-bold mr-1">Subtotal:</span>$ ' + Number(respuesta["Subtotal"]).toFixed(2) + '</div>');
            $("#totalesPedido").append('<div class="text-right"><span class="font-weight-bold mr-1">IVA Aplicado:</span>' + respuesta["IVA"] + ' %</div>');
            $("#totalesPedido").append('<div class="text-right"><span class="font-weight-bold mr-1">Total:</span>$ ' + Number(respuesta["Total"]).toFixed(2) + '</div>');

            if (Number(respuesta["Anticipo"]) < Number(respuesta["Total"])) {
                $("#totalesPedido").append('<div class="text-right mt-2 mt-xl-0"><span class="font-weight-bold mr-1">Anticipo:</span>$ ' + Number(respuesta["Anticipo"]).toFixed(2) + '</div>');
                $("#totalesPedido").append('<div class="text-right"><span class="font-weight-bold mr-1">Debe:</span><span class="badge badge-danger" style="font-size: 1rem;">$ ' + (Number(respuesta["Total"]) - Number(respuesta["Anticipo"])).toFixed(2) + '</span></div>');
            } else if (Number(respuesta["Anticipo"]) > Number(respuesta["Total"])) {
                $("#totalesPedido").append('<div class="text-right mt-2 mt-xl-0"><span class="font-weight-bold mr-1">Anticipo:</span>$ ' + Number(respuesta["Anticipo"]).toFixed(2) + '</div>');
                $("#totalesPedido").append('<div class="text-right"><span class="font-weight-bold mr-1">Devolver:</span><span class="badge badge-warning" style="font-size: 1rem;">$ ' + (Number(respuesta["Anticipo"]) - Number(respuesta["Total"])).toFixed(2) + '</span></div>');
            } else {
                $("#totalesPedido").append('<div class="text-right"><span class="font-weight-bold"><span class="badge badge-primary" style="font-size: 1rem;">PAGAGO</span></div>');
            }

        }

    });

});

/*=============================================
CHANGE PARA CHECKBOX DE PAGO COMPLETO
=============================================*/
$(document).on("change", "#editPagoCompleto", function () {
    if ($(this).is(":checked")) {
        $("#editAnticipo").removeClass("is-valid is-invalid");
        $("#editAnticipo").prop("readonly", true);
        $("#editAnticipo").val("");
    } else {
        $("#editAnticipo").prop("readonly", false);
    }
});

/*=============================================
EDITAR PEDIDO
=============================================*/
$(document).on("click", ".btnEditarPedido", function () {

    var idPedido = $(this).attr("idPedido");

    var datos = new FormData();
    datos.append('verPedidoId', idPedido);

    $.ajax({
        url: "ajax/pedidos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log(respuesta);

            let idPedidoSeleccionado = respuesta["Id_Pedido"];

            $("#viewEditNumeroPedido").html(idPedidoSeleccionado);
            $("#editIdPedido").val(idPedidoSeleccionado);

            /*=============================================
            FECHAS
            =============================================*/
            var fechaInicio = new Date(respuesta["Fecha_Inicio"]);
            var fechaCompromiso = new Date(respuesta["Fecha_Compromiso"]);
            var options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            $("#editFechaInicioPedido").val(fechaInicio.toLocaleDateString("es-MX", options));
            $("#editFechaCompromisoPedido").val(fechaCompromiso.toLocaleDateString("es-MX", options));

            if (respuesta["Fecha_Entrega"] != null && respuesta["Fecha_Entrega"] != "") {
                var fechaEntrega = new Date(respuesta["Fecha_Compromiso"]);
                $("#editFechaEntregaPedido").val(fechaEntrega.toLocaleDateString("es-MX", options));
            } else {
                $("#editFechaEntregaPedido").val("Aún no se entrega");
            }

            /*=============================================
            DATOS DEL CLIENTE
            =============================================*/
            $("#editCliente").val(respuesta["Nombre_Cliente"]);
            $("#editCorreo").val(respuesta["Correo_Cliente"]);
            $("#editTelefono").val(respuesta["Telefono_Cliente"]);

            /*=============================================
            PRODUCTOS
            =============================================*/
            var datos2 = new FormData();
            datos2.append('verProdsPedidoId', idPedidoSeleccionado);

            $.ajax({

                url: "ajax/pedidos.ajax.php",
                method: "POST",
                data: datos2,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    // console.log(respuesta);

                    for (var i = 0; i < respuesta.length; i++) {

                        if (respuesta[i]["descuento"] > 0) {
                            var badgeDescuento = '<span class="badge bg-indigo ml-2 ml-xl-1" style="font-size: 1rem;">- ' + respuesta[i]["descuento"] + '%</span>';
                        } else {
                            var badgeDescuento = "";
                        }

                        $("#editContenedorProductos").append(
                            '<div class="productoNuevo row py-3 border-top border-secondary" idProducto="' + respuesta[i]["idProducto"] + '">' +
                            '    <div class="col-12 col-xl-8 pb-2 pb-xl-0">' +
                            '        <span class="d-block font-weight-bold text-center d-xl-none">Descripción del producto:</span>' + respuesta[i]["descripcion"] +
                            '    </div>' +
                            '    <div class="col-6 col-xl-2 text-center"><span class="d-inline-block d-xl-none font-weight-bold mr-1">Cantidad:</span>' +
                            '       <div class="btn-group">' +
                            '           <button type="button" class="btn btn-outline-info btnAddOne" idProducto="' + respuesta[i]["idProducto"] + '" idPedido="' + idPedidoSeleccionado + '"><i class="fas fa-plus"></i></button>' +
                            '           <div class="btn border border-info px-3 font-weight-bold cantidadProducto">' + respuesta[i]["cantidad"] + '</div>' +
                            '           <button type="button" class="btn btn-outline-info btnRemoveOne" idProducto="' + respuesta[i]["idProducto"] + '" idPedido="' + idPedidoSeleccionado + '"><i class="fas fa-minus"></i></button>' +
                            '       </div>' +
                            '   </div>' +
                            '    <div class="col-6 col-xl-1 text-center contenedorPrecioProducto"><span class="d-inline-block d-xl-none font-weight-bold mr-1">Precio:</span>$ <span class="precioProducto" precio="' + respuesta[i]["precioUnitario"] + '">' + Number(respuesta[i]["importe"]).toFixed(2) + badgeDescuento + '</span></div>' +
                            '    <div class="col-12 col-xl-1 py-2 py-xl-0">' +
                            '       <div class="btn-group w-100">' +
                            '<button type="button" class="btn btn-danger btnEliminarDetallePedido" idProducto="' + respuesta[i]["idProducto"] + '"><i class="fas fa-trash-alt mr-1 mr-xl-0"></i><span class="d-inline-block d-xl-none font-weight-bold">Eliminar</span></button>' +
                            '       </div>' +
                            '   </div>' +
                            '</div>'
                        );

                    }

                }

            });

            /*=============================================
            TOTALES
            =============================================*/
            $("#editSubtotal").val(Number(respuesta["Subtotal"]).toFixed(2));
            $("#editIVA").val(respuesta["IVA"]);
            $("#editTotal").val(Number(respuesta["Total"]).toFixed(2));

            if (respuesta["Anticipo"] == respuesta["Total"]) {
                $("#editPagoCompleto").prop("checked", true).trigger("change");
            } else {
                $("#editPagoCompleto").prop("checked", false).trigger("change");
                $("#editAnticipo").val(Number(respuesta["Anticipo"]).toFixed(2));
            }

        }
    });

});

/*=============================================
AGREGAR NUEVA CANTIDAD
=============================================*/
$(document).on("click", ".btnAddOne", function () {
    let idProducto = $(this).attr("idProducto");

    let campoCantidad = $(this).parent().children(".cantidadProducto");
    let campoPrecio = $(this).parent().parent().parent().children(".contenedorPrecioProducto").children(".precioProducto");

    swal({
        title: "Agregar uno más al producto",
        text: "¿Estas seguro de que quieres agregar uno a la cantidad del producto? Esta acción cambiará los precios de forma automática sin necesidad de dar clic en el botón \"Guardar cambios\" . Si deseas continuar da clic en el botón \"Confirmar\"",
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

            let accion = "suma";
            var datos = new FormData();
            datos.append('idDetallePedidoCantidad', idProducto);
            datos.append('accion', accion);

            $.ajax({
                url: "ajax/pedidos.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    // console.log(respuesta);

                    var badgeDescuento = "";
                    if (respuesta["Descuento"] > 0) {
                        badgeDescuento = '<span class="badge bg-indigo ml-2 ml-xl-1" style="font-size: 1rem;">- ' + respuesta["Descuento"] + '%</span>';
                    }

                    campoCantidad.text(respuesta["Cantidad"]);
                    campoPrecio.html(Number(respuesta["Importe"]).toFixed(2)+badgeDescuento);
                    $("#editSubtotal").val(Number(respuesta["Subtotal"]).toFixed(2));
                    $("#editIVA").val(respuesta["IVA"]);
                    $("#editTotal").val(Number(respuesta["Total"]).toFixed(2));

                    if (respuesta["Anticipo"] == respuesta["Total"]) {
                        $("#editPagoCompleto").prop("checked", true).trigger("change");
                    } else {
                        $("#editPagoCompleto").prop("checked", false).trigger("change");
                        $("#editAnticipo").val(Number(respuesta["Anticipo"]).toFixed(2));
                    }

                    if (respuesta == "errorCantidad") {
                        swal({
                            title: "Error al actualizar la cantidad!",
                            text: "No se puedo aumentar la cantidad del producto, intente de nuevo.",
                            icon: "error",
                            closeOnClickOutside: false,
                        });
                    } else if (respuesta == "errorTotales") {
                        swal({
                            title: "Error al actualizar totales!",
                            text: "La cantidad y los precios se cambiaron, pero hubo un problema al actualizar los totales.",
                            icon: "error",
                            closeOnClickOutside: false,
                        });
                    } else {
                        swal({
                            title: "Cantidad aumentada",
                            text: "Se sumo uno a la cantidad del producto seleccionado de forma exitosa.",
                            icon: "success",
                            closeOnClickOutside: false,
                        });
                    }
                }
            });
        }
    });

});

/*=============================================
DISMINUIR CANTIDAD DEL PRODUCTO
=============================================*/
$(document).on("click", ".btnRemoveOne", function () {
    let idProducto = $(this).attr("idProducto");

    let campoCantidad = $(this).parent().children(".cantidadProducto");
    let campoPrecio = $(this).parent().parent().parent().children(".contenedorPrecioProducto").children(".precioProducto");

    if ((Number(campoCantidad.text()) - 1) == 0) {
        swal({
            title: "Error!",
            text: "No puedes tener productos con cantidad en 0. Si deseas eliminar el producto da clic sobre el botón correspondiente, el cual puedes identificar con color rojo.",
            icon: "error",
            closeOnClickOutside: false,
        });
    } else {
        swal({
            title: "Disminuir uno al producto",
            text: "¿Estas seguro de que quieres descontar uno a la cantidad del producto? Esta acción cambiará los precios de forma automática sin necesidad de dar clic en el botón \"Guardar cambios\" . Si deseas continuar da clic en el botón \"Confirmar\"",
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

                let accion = "resta";
                var datos = new FormData();
                datos.append('idDetallePedidoCantidad', idProducto);
                datos.append('accion', accion);

                $.ajax({
                    url: "ajax/pedidos.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (respuesta) {
                        // console.log(respuesta);

                        var badgeDescuento = "";
                        if (respuesta["Descuento"] > 0) {
                            badgeDescuento = '<span class="badge bg-indigo ml-2 ml-xl-1" style="font-size: 1rem;">- ' + respuesta["Descuento"] + '%</span>';
                        }

                        campoCantidad.text(respuesta["Cantidad"]);
                        campoPrecio.html(Number(respuesta["Importe"]).toFixed(2)+badgeDescuento);
                        $("#editSubtotal").val(Number(respuesta["Subtotal"]).toFixed(2));
                        $("#editIVA").val(respuesta["IVA"]);
                        $("#editTotal").val(Number(respuesta["Total"]).toFixed(2));

                        if (respuesta["Anticipo"] == respuesta["Total"]) {
                            $("#editPagoCompleto").prop("checked", true).trigger("change");
                        } else {
                            $("#editPagoCompleto").prop("checked", false).trigger("change");
                            $("#editAnticipo").val(Number(respuesta["Anticipo"]).toFixed(2));
                        }

                        if (respuesta == "errorCantidad") {
                            swal({
                                title: "Error al actualizar la cantidad!",
                                text: "No se puedo aumentar la cantidad del producto, intente de nuevo.",
                                icon: "error",
                                closeOnClickOutside: false,
                            });
                        } else if (respuesta == "errorTotales") {
                            swal({
                                title: "Error al actualizar totales!",
                                text: "La cantidad y los precios se cambiaron, pero hubo un problema al actualizar los totales.",
                                icon: "error",
                                closeOnClickOutside: false,
                            });
                        } else {
                            swal({
                                title: "Cantidad descontada",
                                text: "Se restó uno a la cantidad del producto seleccionado de forma exitosa.",
                                icon: "success",
                                closeOnClickOutside: false,
                            });
                        }
                    }
                });
            }
        });
    }


});

/*=============================================
ELIMINAR PRODUCTO
=============================================*/
$(document).on("click", ".btnEliminarDetallePedido", function () {
    var idProducto = $(this).attr('idProducto');
    var producto = $(this).parent().parent().parent();

    swal({
        title: "Eliminar producto",
        text: "¿Estas seguro de que quieres eliminar este producto? No podrás recuperarlo en el futuro, se eliminará permanentemente. Si deseas continuar da clic en el botón \"Confirmar\"",
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

            var datos2 = new FormData();
            datos2.append('idDetallePedido', idProducto);

            $.ajax({

                url: "ajax/pedidos.ajax.php",
                method: "POST",
                data: datos2,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    // console.log(respuesta);

                    if (respuesta == "errorActualizacion") {
                        swal({
                            title: "Error al actualizar totales!",
                            text: "El producto fue removido del pedido correctamente, pero hubo un problema al actulizar los totales.",
                            icon: "error",
                            closeOnClickOutside: false,
                        });
                    } else if (respuesta == "error") {
                        swal({
                            title: "Error!",
                            text: "Ha ocurrido un error al intentar eliminar el producto.",
                            icon: "error",
                            closeOnClickOutside: false,
                        });
                    } else {
                        producto.remove();
                        $("#editSubtotal").val(Number(respuesta["Subtotal"]).toFixed(2));
                        $("#editIVA").val(respuesta["IVA"]);
                        $("#editTotal").val(Number(respuesta["Total"]).toFixed(2));

                        if (respuesta["Anticipo"] == respuesta["Total"]) {
                            $("#editPagoCompleto").prop("checked", true).trigger("change");
                        } else {
                            $("#editPagoCompleto").prop("checked", false).trigger("change");
                            $("#editAnticipo").val(Number(respuesta["Anticipo"]).toFixed(2));
                        }

                        swal({
                            title: "Eliminación exitosa!",
                            text: "El producto fue removido del pedido correctamente.",
                            icon: "success",
                            closeOnClickOutside: false,
                        });
                    }

                }

            });

        }
    });
});

/*=============================================
ELIMINAR PEDIDO
=============================================*/
$(document).on("click", ".btnEliminarPedido", function () {
    var idPedido = $(this).attr('idPedido');

    swal({
        title: "Eliminar pedido \"" + idPedido + "\"",
        text: "¿Estas seguro de que quieres eliminar este pedido? No podrás recuperarlo en el futuro, se eliminará permanentemente. Si deseas continuar da clic en el botón \"Confirmar\"",
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
            window.location = "index.php?pagina=administrarPedidos&idPedido=" + idPedido;
        }
    });
});

/*=============================================
CALCULAR IVA - EDITAR
=============================================*/
$(document).on("change keyup", "#editIVA", function () {
    if ($("#editSubtotal").val() != "" && $("#editSubtotal").val() != null) {
        let subtotal = Number($("#editSubtotal").val());
        let total = ((subtotal * $(this).val()) / 100) + subtotal;

        $("#editTotal").val(total.toFixed(2));
    }
});


/*=============================================
LIMPIAR MODAL PARA VER DETALLES DEL PEDIDO
=============================================*/
$(document).on("click", ".closeModalVerDetallePedido", function () {

    $("#viewNumeroPedido").html("");
    $("#fechasPedido").html("");
    $("#datosCliente").html("");
    $("#contenedorProductosModal").html("");
    $("#totalesPedido").html("");

});

/*=============================================
LIMPIAR MODAL PARA EDITAR PEDIDO
=============================================*/
$(document).on("click", ".closeModalEditPedido", function () {

    $("#viewEditNumeroPedido").html("");
    $("#editIdPedido").val("");
    $("#editFechaInicioPedido").val("");
    $("#editFechaCompromisoPedido").val("");
    $("#editFechaEntregaPedido").val("");
    $("#editCliente").val("");
    $("#editCliente").removeClass("is-valid is-invalid");
    $("#editCorreo").val("");
    $("#editCorreo").removeClass("is-valid is-invalid");
    $("#editContenedorProductos").html("");
    $("#editSubtotal").val("");
    $("#editIVA").val("");
    $("#editIVA").removeClass("is-valid is-invalid");
    $("#editTotal").val("");
    $("#editAnticipo").removeClass("is-valid is-invalid");
});