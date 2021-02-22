/*=============================================
GENERAR REPORTES PDF - LOGISTICA
=============================================*/
$(document).on("click", ".btnReporteLogistica", function(){

    let meses = Number($(this).attr("meses"));

    /* FECHAS CON HORA
    -------------------------------------------------- */
    let fechaActual = moment().format("YYYY-MM-DD 23:59:59");
    let fechaRange = moment().subtract(meses, "months").format("YYYY-MM-DD 00:00:00");

    console.log(fechaActual + " menos " + meses + " meses = " + fechaRange);

    window.open("extensiones/tcpdf/pdf/reporte_logistica_fechas.php?fechaInicio="+fechaRange+"&fechaFin="+fechaActual, "_blank");

});

/*=============================================
GENERAR REPORTES PERSONALIZADOS PDF - LOGISTICA
=============================================*/
$(document).on("click", ".btnObtenerReportePersonalizado", function(){

    let fechaInicio = $("#ingFechaInicioPersonalizada").val();
    let fechaTermino = $("#ingFechaTerminoPersonalizada").val();
    let expresion = /^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{4,4}$/;
    
    if ( fechaInicio.match(expresion) ) {
        $("#ingFechaInicioPersonalizada").removeClass("is-invalid");
        $("#ingFechaInicioPersonalizada").addClass("is-valid");

        var fechaInicioObtenida = moment(fechaInicio, "DD/MM/YYYY");
        // console.log(fechaInicioFormateada);
    } else {
        $("#ingFechaInicioPersonalizada").removeClass("is-valid");
        $("#ingFechaInicioPersonalizada").addClass("is-invalid");
        return false;
    }

    if ( fechaTermino.match(expresion) ) {
        $("#ingFechaTerminoPersonalizada").removeClass("is-invalid");
        $("#ingFechaTerminoPersonalizada").addClass("is-valid");

        var fechaTerminoObtenida = moment(fechaTermino, "DD/MM/YYYY");
    } else {
        $("#ingFechaTerminoPersonalizada").removeClass("is-valid");
        $("#ingFechaTerminoPersonalizada").addClass("is-invalid");
        return false;
    }

    if ( fechaInicioObtenida >= fechaTerminoObtenida ) {
        $("#errorIncongruentDate").show(); 
        return false;
    } else if( fechaTerminoObtenida > moment() ) {
        $("#errorIncongruentDate2").show(); 
        return false;
    } else {
        fechaInicioFormateada = fechaInicioObtenida.format("YYYY-MM-DD 00:00:00");
        fechaTerminoFormateada = fechaTerminoObtenida.format("YYYY-MM-DD 23:59:59");
        $("#errorIncongruentDate").hide();
        $("#errorIncongruentDate2").hide();
    }

    $(".btnCerrarModalReportePersonalizado").trigger("click");
    // $("#modalReportesLogistica").modal("hide");
    window.open("extensiones/tcpdf/pdf/reporte_logistica_fechas.php?fechaInicio="+fechaInicioFormateada+"&fechaFin="+fechaTerminoFormateada, "_blank");

});

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
VER LOGISTICA DEL PEDIDO
=============================================*/
$(document).on("click", ".btnVerLogisticaPedido", function () {

    var idPedido = $(this).attr("idPedido");

    var datos = new FormData();
    datos.append('verLogisticaPorId', idPedido);

    $("#viewNumPedido").html(idPedido);

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

            for (var i = 0; i < respuesta.length; i++) {

                // FECHA DE ACTUALIZACION
                var fechaInicio = new Date(respuesta[i]["Fecha_Actualizacion"]);
                var options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                    second: 'numeric',
                    hour12: "false"
                };

                // FONDO DE LOS TITULOS
                var background = "";
                if (respuesta[i]["Orden"] == 1 || respuesta[i]["Orden"] == 8) background = "bg-blue";
                else if (respuesta[i]["Orden"] == 2 || respuesta[i]["Orden"] == 7) background = "bg-green";
                else if (respuesta[i]["Orden"] == 3 || respuesta[i]["Orden"] == 6) background = "bg-red";
                else if (respuesta[i]["Orden"] == 4) background = "bg-indigo";
                else if (respuesta[i]["Orden"] == 5) background = "bg-navy";
                else if (respuesta[i]["Orden"] == 9) background = "bg-maroon";

                /* CUERPO DE LA LINEA DEL TIEMPO
                -------------------------------------------------- */
                let cuerpo = "";
                if (respuesta[i]["Estado"] == 0) {
                    cuerpo =
                        '    <!-- TIEMPO DE DIFERENCIA - ELEMENTO DE LINEA DEL TIEMPO -->' +
                        '    <div>' +
                        '        <i class="fas fa-exclamation-triangle bg-warning"></i>' +
                        '        <div class="timeline-item">' +
                        '            <h3 class="timeline-header"><span class="font-weight-bold text-black">Información no disponible</span> El pedido aun no llega a este estado</h3>' +
                        '        </div>' +
                        '    </div>';
                } else {

                    // COMENTARIO
                    let comentario = "";

                    if (respuesta[i]["Comentario"] != "" && respuesta[i]["Comentario"] != null) {
                        comentario = '<div class="timeline-body">' + respuesta[i]["Comentario"] + '</div>';
                    } else {
                        if (respuesta[i]["Orden"] != 1)
                            comentario = '<div class="timeline-body">Sin comentarios asignados al pedido</div>';
                    }

                    var diferencia;

                    if (respuesta[i]["Orden"] != 9) {
                        // DIFERENCIA DE DIAS
                        if (respuesta[i + 1]["Estado"] != 0) {
                            moment.locale('es');
                            var fechaC1 = moment(respuesta[i]["Fecha_Actualizacion"], "YYYY-MM-DD hh:mm:ss");
                            var fechaC2 = moment(respuesta[i + 1]["Fecha_Actualizacion"], "YYYY-MM-DD hh:mm:ss");
                            var fechaC3 = moment(respuesta[i]["Fecha_Compromiso"], "YYYY-MM-DD hh:mm:ss");

                            if ( fechaC3 > fechaC2 ) {
                                diferencia = '<span class="font-weight-bold text-black-50">' + moment.duration(fechaC2 - fechaC1).humanize() + '.</span> Entre "' + respuesta[i]["Nombre_Estatus"] + '" y "' + respuesta[i + 1]["Nombre_Estatus"] + '"';
                            } else {
                                diferencia = '<span class="font-weight-bold text-red">' + moment.duration(fechaC2 - fechaC1).humanize() + '.</span> Entre "' + respuesta[i]["Nombre_Estatus"] + '" y "' + respuesta[i + 1]["Nombre_Estatus"] + '"';
                            }

                        } else {
                            diferencia = '<span class="font-weight-bold text-black-50">Aun no es posible calcularlo</span>';
                        }

                    } else {
                        moment.locale('es');
                        var fechaC1 = moment(respuesta[i]["Fecha_Actualizacion"], "YYYY-MM-DD hh:mm:ss");
                        var fechaC2 = moment(respuesta[i]["Fecha_Compromiso"], "YYYY-MM-DD hh:mm:ss");

                        diferencia = moment.duration(fechaC2 - fechaC1).humanize();

                        if ( fechaC1 < fechaC2 ) {
                            diferencia = '<span class="font-weight-bold text-black-50">' + diferencia + ' a favor.</span> Entre la fecha de entrega y la fecha compromiso';
                        } else {
                            diferencia = '<span class="font-weight-bold text-red">' + diferencia + ' de retraso.</span> Entre la fecha de entrega y la fecha compromiso';
                        }

                    }

                    cuerpo =
                        '    <!-- USUARIO - ELEMENTO DE LINEA DEL TIEMPO -->' +
                        '    <div>' +
                        '        <i class="fas fa-user bg-lightblue"></i>' +
                        '        <div class="timeline-item">' +
                        '            <span class="time"><i class="fas fa-clock"></i> ' + fechaInicio.toLocaleDateString("es-MX", options) + '</span>' +
                        '            <h3 class="timeline-header"><span class="font-weight-bold text-blue">' + respuesta[i]["Nombre_Usuario"] + '</span> ' + respuesta[i]["Tipo_User"] + '</h3>' +

                        '            ' + comentario +
                        '        </div>' +
                        '    </div>' +

                        '    <!-- TIEMPO DE DIFERENCIA - ELEMENTO DE LINEA DEL TIEMPO -->' +
                        '    <div>' +
                        '        <i class="fas fa-clock bg-navy"></i>' +
                        '        <div class="timeline-item">' +
                        '            <h3 class="timeline-header"><span class="font-weight-bold text-navy">Diferencia de </span> ' + diferencia + '</h3>' +
                        '        </div>' +
                        '    </div>';

                }

                $("#contenedorEstadosPedido").append(
                    '<!-- TITULO -->' +
                    '    <div class="time-label">' +
                    '        <span class="' + background + '">' + respuesta[i]["Nombre_Estatus"] + '</span>' +
                    '    </div>' +
                    cuerpo
                );

            }
        }
    });

});

/*=============================================
VISUALIZAR COMENTARIO DE PEDIDO
=============================================*/
$(document).on("click", ".btnViewComentario", function(){

    let idPedido = $(this).attr("idPedido");
    let orden = $(this).attr("orden");

    var datos = new FormData();
    datos.append('verComentarioId', idPedido);
    datos.append('verComentarioOrden', orden);

    $.ajax({

        url: "ajax/logistica.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);

            $("#viewIdPedidoForMC").html(idPedido);
            $("#comentarioPedido").text(respuesta["Comentario"]);
            $("#autorComentario").html(respuesta["Nombre_Usuario"]+' <cite title="'+respuesta["Tipo_User"]+'"> | '+respuesta["Tipo_User"]+'</cite>');
        }
    });

});


/*=============================================
ACTUALIZAR ESTADO DE PEDIDO - BOTONES
=============================================*/
$(document).on("click", ".btnActualizarEstado", function () {

    var idPedido = $(this).attr("idPedido"),
        numOrden = $(this).attr("ordenEstado"),
        avance = $(this).attr("avanceEstado");

    /* OBTENER FILA A ELIMINAR
    -------------------------------------------------- */
    var table = $(this).closest('table').DataTable();  
    var filaPedido;

    if($(this).closest('table').hasClass("collapsed")) {
        var child = $(this).parents("tr.child");
        filaPedido = $(child).prevAll(".parent");
    } else {
        filaPedido = $(this).parents('tr');
    }

    var textModulo = "";
    var titulo = "";
    var textComplementario = "";
    if (Number(numOrden) == 1) {
        titulo = "Recolectar pedido";
        textModulo = "Descarga en taller";
    } else if (Number(numOrden) == 2) {
        titulo = "Descargar pedido en taller";
        textModulo = "Asignación de pedidos";
    } else if (Number(numOrden) == 4) {
        titulo = "Empezar a producir";
        textModulo = "Producción de pedidos";
    } else if (Number(numOrden) == 5) {
        titulo = "Finalizar pedido";
        textModulo = "Recolección en taller";
    } else if (Number(numOrden) == 6) {
        titulo = "Recoger pedido para enviar a tienda";
        textModulo = "Descarga en tienda";
    } else if (Number(numOrden) == 7) {
        titulo = "Descargar pedido en tienda";
        textModulo = "Entrega final";
        textComplementario = ", sección que solo puede ver el encargado de tienda.";
    } else if (Number(numOrden) == 8) {
        titulo = "Entregar pedido";
        textModulo = "Administrar pedidos";
    }

    swal({
        title: "¿" + titulo + "?",
        text: "El estado del pedido \"" + idPedido + "\" se actualizará y cuando esto pase se eliminara de esta ventana y aparecerá en la sección \"" + textModulo + "\"" + textComplementario + ". ¿Deseas continuar?",
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
                        table.row(filaPedido).remove().draw();

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
ACTUALIZAR ESTADO DE PEDIDO - ASIGNAR USUARIO
=============================================*/
$(document).on("click", ".btnAsignarUsuario", function () {
    var campo = $(this).parent().children(".optionResponsable").children(),
        idUsuario = $(this).parent().children(".optionResponsable").children().val(),
        data = $(this).parent().children(".optionResponsable").children(".responsable").select2('data');
        usuario = data[0].text,
        idPedido = $(this).attr("idPedido"),
        numOrden = $(this).attr("ordenEstado"),
        avance = $(this).attr("avanceEstado");

        /* OBTENER FILA A ELIMINAR
        -------------------------------------------------- */
        var table = $(this).closest('table').DataTable();  
        var filaPedido;

        if($(this).closest('table').hasClass("collapsed")) {
            var child = $(this).parents("tr.child");
            filaPedido = $(child).prevAll(".parent");
        } else {
            filaPedido = $(this).parents('tr');
        }

    // Evaluar si el usaurio esta vacio para poder actualizar el estado
    if (idUsuario != null && idUsuario != "") {

        swal({
            title: "¿Asignar pedido a " + usuario + "?",
            text: "El estado del pedido \"" + idPedido + "\" se actualizará y cuando esto pase se eliminara de esta ventana y aparecerá en la sección \"Pedidos en espera\". ¿Deseas continuar?",
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
                datos.append('idUsuario', idUsuario);
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
                            table.row(filaPedido).remove().draw();

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

            } else {
                campo.val(null).trigger("change");
            }
        });

    } else {
        swal({
            title: "¡Selecciona un responsable!",
            text: "Debes elegir un usuario de la lista al cual le deseas asignar el pedido \"" + idPedido + "\"",
            icon: "error",
            closeOnClickOutside: false,
            closeOnEsc: false,
        });
    }
});

/*=============================================
VALIDAR COMENTARIO
=============================================*/
$(document).on("keyup change blur", "#ingComentarioPedido", function () {
    let expresion = /^[A-Za-z0-9ñÑáÁéÉíÍóÓúÚ,.\s]+$/;
    validarExpresion($(this), expresion)
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

            if (respuesta == "ok") {
                swal({
                    title: "¡Comentario añadido!",
                    text: "El comentario se añadio con exito al pedido \"" + idPedido + "\"",
                    icon: "success",
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                });
            } else {
                swal({
                    title: "¡Error!",
                    text: "Ocurrió un error al intentar añadir el comentario al pedido \"" + idPedido + "\"",
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

/*=============================================
LIMPIAR MODAL - LOGISTICA DE PRODUCTO
=============================================*/
$(document).on("click", ".closeModalVerLogisticaPedido", function () {
    $("#viewNumPedido").html("");
    $("#contenedorEstadosPedido").html("");
});

/*=============================================
LIMPIAR MODAL - COMENTARIO DE PEDIDO
=============================================*/
$(document).on("click", ".closeModalViewComentario", function () {
    $("#viewIdPedidoForMC").html("");
    $("#comentarioPedido").text("");
    $("#autorComentario").html("");
});

/*=============================================
LIMPIAR MODAL REPORTES PERSONALIZADOS - LOGISTICA DE PRODUCTO
=============================================*/
$(document).on("click", ".btnCerrarModalReportePersonalizado", function () {
    $("#ingFechaInicioPersonalizada").val("");
    $("#ingFechaInicioPersonalizada").removeClass("is-valid is-invalid");
    $("#ingFechaTerminoPersonalizada").val("");
    $("#ingFechaTerminoPersonalizada").removeClass("is-valid is-invalid");
    $("#errorIncongruentDate").hide();
    $("#errorIncongruentDate2").hide();
});