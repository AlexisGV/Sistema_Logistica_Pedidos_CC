<?php

require_once "conexion.php";

class ModeloLogistica
{

    /*=============================================
    SELECCIONAR COMENTARIO DE PEDIDO
    =============================================*/
    static public function mdlTraerComentario($tabla, $item1, $val1, $item2, $val2, $item3, $val3){

        $stmt = Conexion::conectar()->prepare(
            "SELECT $item3, Nombre_Usuario, Tipo_User FROM $tabla 
             INNER JOIN estatus_pedido ON Id_Estatus=Id_Estatus1
             INNER JOIN usuario ON Id_Usuario=Id_Usuario1
             INNER JOIN tipo_usuario ON Id_Tipo_User=Id_Tipo_User1
             WHERE $item1=:$item1 AND $item2=:$item2 AND $item3!=:$item3");
        $stmt->bindParam(":".$item1, $val1, PDO::PARAM_INT);
        $stmt->bindParam(":".$item2, $val2, PDO::PARAM_INT);
        $stmt->bindParam(":".$item3, $val3, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;

    }
    

    /*=============================================
    TRAER PEDIDOS POR ESTADO
    =============================================*/
    static public function mdlTraerPedidosPorEstado($tabla, $item, $orden, $avance, $idUsuario)
    {
        #Estado desactivo
        $estado = 0;

        #Mostrar pedido del estado siguiente
        $ordenNuevo = intval($orden) + 1;
        // var_dump($ordenNuevo);

        if ($idUsuario == null) :

            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM $tabla
             INNER JOIN actualizaciones_pedido ON Id_Pedido=Id_Pedido2
             INNER JOIN estatus_pedido ON Id_Estatus=Id_Estatus1
             INNER JOIN usuario ON Id_Usuario=Id_Usuario1
             WHERE $item=:$item AND Estado=:estado AND Avance_Estado=:avance
             ORDER BY Fecha_Compromiso ASC"
            );
            $stmt->bindParam(":" . $item, $ordenNuevo, PDO::PARAM_INT);
            $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
            $stmt->bindParam(":avance", $avance, PDO::PARAM_INT);

        else :

            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM $tabla
                 INNER JOIN actualizaciones_pedido ON Id_Pedido=Id_Pedido2
                 INNER JOIN estatus_pedido ON Id_Estatus=Id_Estatus1
                 INNER JOIN usuario ON Id_Usuario=Id_Usuario1
                 WHERE $item=:$item AND Estado=:estado AND Avance_Estado=:avance AND Id_Usuario=:idUsuario
                 ORDER BY Fecha_Compromiso ASC"
            );
            $stmt->bindParam(":" . $item, $ordenNuevo, PDO::PARAM_INT);
            $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
            $stmt->bindParam(":avance", $avance, PDO::PARAM_INT);
            $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);

        endif;

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    VER LOGISTICA DEL PEDIDO
    =============================================*/
    static public function mdlVerLogisticaDePedido($item, $idPedido)
    {
        $stmt = Conexion::conectar()->prepare(
            "SELECT * FROM pedido
             INNER JOIN actualizaciones_pedido ON Id_Pedido=Id_Pedido2
             INNER JOIN estatus_pedido ON Id_Estatus=Id_Estatus1
             INNER JOIN usuario ON Id_Usuario=Id_Usuario1
             INNER JOIN tipo_usuario ON Id_Tipo_User=Id_Tipo_User1
             WHERE $item=:$item
             ORDER BY Orden ASC"
        );
        $stmt->bindParam(":" . $item, $idPedido, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR ESTADO DE PEDIDO
    =============================================*/
    static public function mdlActualizarEstadoPedido($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
             INNER JOIN actualizaciones_pedido ON Id_Pedido=Id_Pedido2
             INNER JOIN estatus_pedido ON Id_Estatus=Id_Estatus1
             SET Id_Usuario1=:idUsuario,
                 Fecha_Actualizacion=:fecha,
                 Estado=:estado,
                 Avance_Estado=:avance
             WHERE Id_Pedido2=:idPedido AND Orden=:orden"
        );
        $stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":avance", $datos["avance"], PDO::PARAM_INT);
        $stmt->bindParam(":idPedido", $datos["idPedido"], PDO::PARAM_INT);
        $stmt->bindParam(":orden", $datos["orden"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            if ($datos["orden"] == 9) :

                $actualizarFechaPedido = Conexion::conectar()->prepare(
                    "UPDATE $tabla
                     SET Fecha_Entrega=:fecha
                     WHERE Id_Pedido=:idPedido"
                );
                $actualizarFechaPedido->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
                $actualizarFechaPedido->bindParam(":idPedido", $datos["idPedido"], PDO::PARAM_INT);

                if ($actualizarFechaPedido->execute()) {
                    return "ok";
                } else {
                    $actualizarFechaPedido->errorInfo();
                    return "error";
                }

            elseif ($datos["orden"] == 4) :

                $errores = 0;

                for ($i = 5; $i < 7; $i++) {
                    $actualizarUsuario = Conexion::conectar()->prepare(
                        "UPDATE actualizaciones_pedido
                         INNER JOIN estatus_pedido ON Id_Estatus=Id_Estatus1
                         SET Id_Usuario1=:idUsuario
                         WHERE Id_Pedido2=:idPedido AND Orden=:orden"
                    );
                    $actualizarUsuario->bindParam(":idUsuario", $datos["idUsuario2"], PDO::PARAM_INT);
                    $actualizarUsuario->bindParam(":orden", $i, PDO::PARAM_INT);
                    $actualizarUsuario->bindParam(":idPedido", $datos["idPedido"], PDO::PARAM_INT);

                    if ($actualizarUsuario->execute()) {
                    } else {
                        $actualizarUsuario->errorInfo();
                        $errores++;
                    }
                }

                if ($errores == 0) {
                    return "ok";
                } else {
                    return "false";
                }

            else :
                return "ok";
            endif;
        } else {
            $stmt->errorInfo();
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR COMENTARIO DE PEDIDO
    =============================================*/
    static public function mdlActualizarComentarioPedido($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
             INNER JOIN actualizaciones_pedido ON Id_Pedido=Id_Pedido2
             INNER JOIN estatus_pedido ON Id_Estatus=Id_Estatus1
             SET Comentario=:comentario
             WHERE Id_Pedido2=:idPedido AND Orden=:orden"
        );
        $stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);
        $stmt->bindParam(":idPedido", $datos["idPedido"], PDO::PARAM_INT);
        $stmt->bindParam(":orden", $datos["orden"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            $stmt->errorInfo();
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*===================================================
    SELECCIONAR PEDIDOS ENTREGADOS - REPORTE DE LOGISTICA
    ===================================================*/
    static public function mdlTraerPedidosEntregados($tabla, $item, $fechas)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item BETWEEN :fechaInicio AND :fechaTermino");
        $stmt->bindParam(":fechaInicio", $fechas["fechaInicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaTermino", $fechas["fechaTermino"], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*===================================================
    SELECCIONAR ESTADOS DE PEDIDO - REPORTE DE LOGISTICA
    ===================================================*/
    static public function mdlTraerEstadosPedido($tabla, $item1, $value1, $item2, $value2)
    {
        if ( $item1 == null && $item2 == null ) {
            #Consulta general para traer todos los estados del pedido
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();

            return $stmt->fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        } else {
            #Consulta para traer pedidos por estado
            $stmt = Conexion::conectar()->prepare(
                "SELECT Id_Pedido, Nombre_Estatus, Fecha_Actualizacion, Fecha_Entrega FROM $tabla
                 INNER JOIN actualizaciones_pedido ON Id_Pedido=Id_Pedido2
                 INNER JOIN estatus_pedido ON Id_Estatus=Id_Estatus1
                 WHERE $item1=:$item1 AND $item2=:$item2");
            $stmt->bindParam(":".$item1, $value1, PDO::PARAM_INT);
            $stmt->bindParam(":".$item2, $value2, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;
        }
    }
}
