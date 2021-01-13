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
        success: function(respuesta){
            console.log(respuesta);

            $("#viewNumeroPedido").html(respuesta["Id_Pedido"]);

            /*=============================================
            FECHAS
            =============================================*/
            var fechaInicio = new Date(respuesta["Fecha_Inicio"]);
            var fechaCompromiso = new Date(respuesta["Fecha_Compromiso"]);
            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

            $("#fechasPedido").append('<div class="text-center text-xl-left"><span class="font-weight-bold mr-1">Inicio:</span>'+fechaInicio.toLocaleDateString("es-MX", options)+'</div>');
            $("#fechasPedido").append('<div class="text-center"><span class="font-weight-bold mr-1">Compromiso:</span>'+fechaCompromiso.toLocaleDateString("es-MX", options)+'</div>');

            if ( respuesta["Fecha_Entrega"] != "" && respuesta["Fecha_Entrega"] != null ) {
                var fechaEntrega = new Date(respuesta["Fecha_Entrega"]);

                $("#fechasPedido").append('<div class="text-center text-xl-right"><span class="font-weight-bold mr-1">Entrega:</span>'+fechaEntrega.toLocaleDateString("es-MX", options)+'</div>');
            } else {
                $("#fechasPedido").append('<div class="text-center text-xl-right"><span class="font-weight-bold mr-1">Entrega:</span>El pedido aún no se entrega</div>');
            }

            /*=============================================
            DATOS DEL CLIENTE
            =============================================*/
            $("#datosCliente").append('<div class="text-center text-xl-left"><span class="font-weight-bold mr-1">Nombre:</span>'+respuesta["Nombre_Cliente"]+'</div>');

            if ( respuesta["Correo_Cliente"] != "" && respuesta["Correo_Cliente"] != null ) {
                $("#datosCliente").append('<div class="text-center"><span class="font-weight-bold mr-1">Correo:</span>'+respuesta["Correo_Cliente"]+'</div>');
            } else {
                $("#datosCliente").append('<div class="text-center"><span class="font-weight-bold mr-1">Correo:</span>No se capturó el correo del cliente</div>');
            }

            $("#datosCliente").append('<div class="text-center text-xl-right"><span class="font-weight-bold mr-1">Teléfono:</span>'+respuesta["Telefono_Cliente"]+'</div>');

            /*=============================================
            TOTALES
            =============================================*/
            $("#totalesPedido").append('<div class="text-right"><span class="font-weight-bold mr-1">Subtotal:</span>$ '+Number(respuesta["Subtotal"]).toFixed(2)+'</div>');
            $("#totalesPedido").append('<div class="text-right"><span class="font-weight-bold mr-1">IVA Aplicado:</span>'+respuesta["IVA"]+' %</div>');
            $("#totalesPedido").append('<div class="text-right"><span class="font-weight-bold mr-1">Total:</span>$ '+Number(respuesta["Total"]).toFixed(2)+'</div>');

            if ( respuesta["Anticipo"] != respuesta["Total"] ) {
                $("#totalesPedido").append('<div class="text-right mt-2 mt-xl-0"><span class="font-weight-bold mr-1">Anticipo:</span>$ '+Number(respuesta["Anticipo"]).toFixed(2)+'</div>');
                $("#totalesPedido").append('<div class="text-right badge badge-danger" style="font-size: 1rem;"><span class="font-weight-bold mr-1">Debe:</span>$ '+(Number(respuesta["Total"]) - Number(respuesta["Anticipo"])).toFixed(2) +'</div>');
            }else{
                $("#totalesPedido").append('<div class="text-right badge badge-primary"><span class="font-weight-bold" style="font-size: 1rem;">PAGAGO</div>');
            }

        }

    });

});

/*=============================================
LIMPIAR MODAL PARA VER DETALLES DEL PEDIDO
=============================================*/
$(document).on("click", ".closeModalVerDetallePedido", function(){

    $("#fechasPedido").html("");
    $("#datosCliente").html("");
    $("#totalesPedido").html("");

});