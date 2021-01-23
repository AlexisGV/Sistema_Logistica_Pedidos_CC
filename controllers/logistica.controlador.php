<?php

class ControladorLogistica
{

    /*=============================================
    TRAER PEDIDOS POR ESTADO
    =============================================*/
    static public function ctrTraerPedidosPorEstado($tabla, $item, $orden, $avance)
    {
        $pedidos = ModeloLogistica::mdlTraerPedidosPorEstado($tabla, $item, $orden, $avance);

        return $pedidos;
    }

    /*=============================================
    ACTUALIZAR ESTADO DE PEDIDO
    =============================================*/
    static public function ctrActualizarEstadoPedido($tabla, $idPedido, $orden, $avance)
    {
        #Establecer región para la fecha y hora
        setlocale(LC_ALL, "spanish.utf8");
        date_default_timezone_set('UTC');
        date_default_timezone_set("America/Mexico_City");

        #Obtener fecha actual y futura
        $fechaActual = date('Y-m-d H:i:s');
        $idUsuario = $_SESSION["idUsuario"];
        $ordenNuevo = intval($orden) + 1;
        $estado = 1;

        $datos = array(
            "idPedido" => $idPedido,
            "idUsuario" => $idUsuario,
            "fecha" => $fechaActual,
            "orden" => $ordenNuevo,
            "estado" => $estado,
            "avance" => $avance
        );

        $actualizarEstado = ModeloLogistica::mdlActualizarEstadoPedido($tabla, $datos);

        return $actualizarEstado;
    }

    /*=============================================
    ACTUALIZAR COMENTARIO DE PEDIDO
    =============================================*/
    static public function ctrActualizarComentarioPedido($tabla, $datos)
    {
        $actualizarComentario = ModeloLogistica::mdlActualizarComentarioPedido($tabla, $datos);

        return $actualizarComentario;
    }
}
