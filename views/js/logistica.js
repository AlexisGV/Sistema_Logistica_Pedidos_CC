/*=============================================
VER DETALLES DEL PEDIDO - LOGISTICA
=============================================*/
$(document).on("click", ".btnVerDetallePedidoParaLogistica", function () {

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

                        var badgeCantidad = "";
                        if (Number(respuesta[i]["cantidad"]) == 1) {
                            badgeCantidad = '<span class="badge bg-indigo" style="font-size: 1rem;">' + respuesta[i]["cantidad"] + '</span>';
                        } else if (Number(respuesta[i]["cantidad"]) == 2) {
                            badgeCantidad = '<span class="badge bg-success" style="font-size: 1rem;">' + respuesta[i]["cantidad"] + '</span>';
                        } else if (Number(respuesta[i]["cantidad"]) == 3) {
                            badgeCantidad = '<span class="badge bg-fuchsia" style="font-size: 1rem;">' + respuesta[i]["cantidad"] + '</span>';
                        } else if (Number(respuesta[i]["cantidad"]) == 4) {
                            badgeCantidad = '<span class="badge bg-lightblue" style="font-size: 1rem;">' + respuesta[i]["cantidad"] + '</span>';
                        } else if (Number(respuesta[i]["cantidad"]) == 5) {
                            badgeCantidad = '<span class="badge bg-olive" style="font-size: 1rem;">' + respuesta[i]["cantidad"] + '</span>';
                        } else if (Number(respuesta[i]["cantidad"]) == 6) {
                            badgeCantidad = '<span class="badge bg-orange" style="font-size: 1rem;">' + respuesta[i]["cantidad"] + '</span>';
                        } else if (Number(respuesta[i]["cantidad"]) >= 7) {
                            badgeCantidad = '<span class="badge bg-danger" style="font-size: 1rem;">' + respuesta[i]["cantidad"] + '</span>';
                        }

                        $("#contenedorProductosModal").append(
                            '<div class="productoNuevo row py-3 border-top border-secondary">' +
                            '<div class="col-12 col-xl-11 pb-2 pb-xl-0"><span class="d-block font-weight-bold text-center d-xl-none">Descripción del producto:</span>' + respuesta[i]["descripcion"] + '</div>' +
                            '<div class="col-12 col-xl-1 text-center"><span class="d-inline-block d-xl-none font-weight-bold mr-1">Cantidad:</span>' + badgeCantidad + '</div>' +
                            '</div>'
                        );
                    }
                }

            });

        }

    });

});

/*=============================================
ACTUALIZAR ESTADO DE PEDIDO
=============================================*/
$(document).on("click", ".btnActualizarEstado", function () {

    var idPedido = $(this).attr("idPedido"),
        numOrden = $(this).attr("ordenEstado"),
        avance = $(this).attr("avanceEstado");

    var filaPedido = $(this).parent().parent().parent();

    var textModulo = "";
    if (Number(numOrden) == 1) {
        textModulo = "Descarga en taller";
    } else if (Number(numOrden) == 2) {
        textModulo = "Asignación de pedidos";
    }

    swal({
        title: "¿Recolectar pedido?",
        text: "El estado del pedido \"" + idPedido + "\" se actualizará y cuando esto pase se eliminara de esta ventana y aparecerá en la sección \"" + textModulo + "\". ¿Deseas continuar?",
        icon: "info",
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

            var datos = new FormData();
            datos.append('idPedido', idPedido);
            datos.append('numOrden', numOrden);
            datos.append('avance', avance);

            $.ajax({

                url: "ajax/logistica.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    // console.log(respuesta);

                    if (respuesta == "ok") {
                        filaPedido.remove();

                        swal({
                            title: "¡Actualización exitosa! ¿Agregar comentario?",
                            text: "El estado del pedido \"" + idPedido + "\" se actualizó de forma correcta. ¿Deseas agregar un comentario?",
                            icon: "success",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                            buttons: {
                                cancel: {
                                    text: "Cancelar",
                                    value: null,
                                    visible: true,
                                    className: "bg-danger",
                                },
                                confirm: {
                                    text: "Agregar comentario",
                                    value: true,
                                    visible: true,
                                    className: "bg-primary",
                                }
                            },
                        }).then((result) => {
                            if (result) {
                                $("#viewComIdPedido").html(idPedido);
                                $("#ingCompedidoID").val(idPedido);
                                $("#numEstado").val(numOrden);
                                $("#modalAddComentario").modal("show");
                            }
                        });
                    }
                }

            });

        }
    });


});

/*=============================================
AGREGAR COMENTARIO DE PEDIDO
=============================================*/
$(document).on("click", ".btnAgregarComentario", function () {
    let expresion = /^[A-Za-z0-9ñÑáÁéÉíÍóÓúÚ,.\s]+$/;

    if (!validarExpresion($("#ingComentarioPedido"), expresion)) {
        return false;
    }

    $.ajax({
        url: "ajax/logistica.ajax.php",
        type: "POST",
        data: $("#formAgregarComentario").serialize(),
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            var idPedido = $("#ingCompedidoID").val();
            $(".closeModalComentario").trigger("click");

            if(respuesta == "ok"){
                swal({
                    title: "¡Comentario añadido!",
                    text: "El comentario se añadio con exito al pedido \""+idPedido+"\"",
                    icon: "success",
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                });
            }else{
                swal({
                    title: "¡Error!",
                    text: "Ocurrió un error al intentar añadir el comentario al pedido \""+idPedido+"\"",
                    icon: "error",
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                });
            }
        }
    });


});

/*=============================================
LIMPIAR MODAL - AGREGAR COMENTARIO
=============================================*/
$(document).on("click", ".closeModalComentario", function () {

    $("#viewComIdPedido").html("");
    $("#ingCompedidoID").val("");
    $("#numEstado").val("");
    $("#ingComentarioPedido").val("");
    $("#ingComentarioPedido").attr("rows", 1);
    $("#ingComentarioPedido").attr("style", "overflow: hidden; overflow-wrap: break-word; resize: none;");
    $("#ingComentarioPedido").removeClass("is-valid is-invalid");

});