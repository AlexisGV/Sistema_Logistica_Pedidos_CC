<?php

class ControladorLogistica
{

    /*=============================================
    SELECCIONAR COMENTARIO DE PEDIDO
    =============================================*/
    static public function ctrTraerComentario($idPedido, $orden)
    {
        $tabla = "actualizaciones_pedido";
        $item1 = "Id_Pedido2";
        $item2 = "Orden";
        $item3 = "Comentario";

        $comentario = ModeloLogistica::mdlTraerComentario($tabla, $item1, $idPedido, $item2, $orden, $item3, "");

        return $comentario;
    }

    /*=============================================
    TRAER PEDIDOS POR ESTADO
    =============================================*/
    static public function ctrTraerPedidosPorEstado($tabla, $item, $orden, $avance)
    {
        $pedidos = ModeloLogistica::mdlTraerPedidosPorEstado($tabla, $item, $orden, $avance, null);

        return $pedidos;
    }

    /*=============================================
    TRAER PEDIDOS POR ESTADO Y USUARIO
    =============================================*/
    static public function ctrTraerPedidosPorUsuario($tabla, $item, $orden, $avance, $idUsuario)
    {
        $pedidos = ModeloLogistica::mdlTraerPedidosPorEstado($tabla, $item, $orden, $avance, $idUsuario);

        return $pedidos;
    }

    /*=============================================
    VER LOGISTICA DEL PEDIDO
    =============================================*/
    static public function ctrVerLogisticaDePedido($item, $idPedido)
    {
        $pedidos = ModeloLogistica::mdlVerLogisticaDePedido($item, $idPedido);

        return $pedidos;
    }

    /*=============================================
    ACTUALIZAR ESTADO DE PEDIDO
    =============================================*/
    static public function ctrActualizarEstadoPedido($tabla, $idPedido, $orden, $avance, $usuario)
    {
        #Establecer región para la fecha y hora
        setlocale(LC_ALL, "es_MX.UTF-8");
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

        #Usuario para asignar pedido
        if ($usuario != null && $usuario != "") {
            $idUsuario2 = $usuario;
            $datos += ["idUsuario2" => $idUsuario2];
        }


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

    /*===================================================
    SELECCIONAR PEDIDOS ENTREGADOS - REPORTE DE LOGISTICA
    ===================================================*/
    static public function ctrTraerPedidosEntregados($fechaInicio, $fechaTermino)
    {

        $tabla = "pedido";
        $item = "Fecha_Entrega";
        $fechas = array(
            "fechaInicio" => $fechaInicio,
            "fechaTermino" => $fechaTermino
        );

        $pedidosEntregados = ModeloLogistica::mdlTraerPedidosEntregados($tabla, $item, $fechas);

        return $pedidosEntregados;
    }

    /*===================================================
    SELECCIONAR ESTADOS DE PEDIDO - REPORTE DE LOGISTICA
    ===================================================*/
    static public function ctrTraerEstadosPedido($tabla, $item1, $value1, $item2, $value2)
    {
        $consulta = ModeloLogistica::mdlTraerEstadosPedido($tabla, $item1, $value1, $item2, $value2);

        return $consulta;
    }
    
}
