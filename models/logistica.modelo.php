<?php

require_once "conexion.php";

class ModeloLogistica
{

    /*=============================================
    TRAER PEDIDOS POR ESTADO
    =============================================*/
    static public function mdlTraerPedidosPorEstado($tabla, $item, $orden, $avance)
    {
        #Estado desactivo
        $estado = 0;

        #Mostrar pedido del estado siguiente
        $ordenNuevo = intval($orden)+1;
        // var_dump($ordenNuevo);

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
            return "ok";
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
}
