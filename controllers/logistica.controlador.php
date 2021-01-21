<?php

class ControladorLogistica
{

    /*=============================================
        TRAER PEDIDOS POR ESTADO
        =============================================*/
    static public function ctrTraerPedidosPorEstado($tabla, $item, $orden)
    {

        $pedidos = ModeloLogistica::mdlTraerPedidosPorEstado($tabla, $item, $orden);

        return $pedidos;
    }

    /*=============================================
    ACTUALIZAR ESTADO DE PEDIDO
    =============================================*/
    static public function ctrActualizarEstadoPedido($tabla, $idPedido, $orden)
    {
        #Establecer región para la fecha y hora
        setlocale(LC_ALL, "spanish.utf8");
        date_default_timezone_set('UTC');
        date_default_timezone_set("America/Mexico_City");

        #Obtener fecha actual y futura
        $fechaActual = date('Y-m-d H:i:s');
        $idUsuario = $_SESSION["idUsuario"];
        $orden = $orden + 1;
        $estado = 1;

        $datos = array(
            "idPedido" => $idPedido,
            "idUsuario" => $idUsuario,
            "fecha" => $fechaActual,
            "orden" => $orden,
            "estado" => $estado
        );

        $actualizarEstado = ModeloLogistica::mdlActualizarEstadoPedido($tabla, $datos);

        return $actualizarEstado;
    }
}
