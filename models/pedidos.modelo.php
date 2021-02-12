<?php

require_once "conexion.php";

class ModeloPedidos
{

    /*=============================================
    OBTENER SIGUIENTE NUMERO DE PEDIDO / PRODUCTO
    =============================================*/
    static public function mdlObtenerSiguienteId($tabla, $item)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $item DESC LIMIT 1");
        $stmt->execute();

        return $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=========================================================
    TRAER TODOS LOS REGISTROS DE (MARCA, FORMA, ACABADO, CORTE)
    =========================================================*/
    static public function mdlTraerRegistros($tabla, $item, $excepcion)
    {

        if ($excepcion != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item != :$item ORDER BY $item ASC");
            $stmt->bindParam(":" . $item, $excepcion, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $item ASC");

            $stmt->execute();

            return $stmt->fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        }
    }

    /*=========================================================
    TRAER REGISTROS DE FORMA DESCENDENTE
    =========================================================*/
    static public function mdlTraerRegistrosAscendentes($tabla, $item, $item2, $val2, $operador)
    {
        if($operador == "non-equal") :
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item2!=:$item2 ORDER BY $item ASC");
        elseif ($operador == "equal") :
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item2=:$item2 ORDER BY $item ASC");
        endif;
        
        $stmt->bindParam(":".$item2, $val2, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=========================================================
    SELECCIONAR ESTADO MAS RECIENTE DEL PEDIDO
    =========================================================*/
    static public function mdlTraerEstadoPedido($tabla, $idPedido, $itemOrden)
    {
        $estado = 1;
        $stmt = Conexion::conectar()->prepare(
            "SELECT * FROM $tabla
             INNER JOIN estatus_pedido ON Id_Estatus=Id_Estatus1
             WHERE Id_Pedido2=:idPedido AND Estado=:estado
             ORDER BY $itemOrden DESC
             LIMIT 1"
        );
        $stmt->bindParam(":idPedido", $idPedido, PDO::PARAM_INT);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    SELECCIONAR USUARIO QUE LEVANTO EL PEDIDO
    =============================================*/
    static public function mdlTraerUsuarioPedido($tabla, $idPedido, $orden)
    {
        $estado = 1;
        $stmt = Conexion::conectar()->prepare(
            "SELECT Nombre_Usuario FROM $tabla
             INNER JOIN estatus_pedido ON Id_Estatus=Id_Estatus1
             INNER JOIN usuario ON Id_Usuario=Id_Usuario1
             WHERE Id_Pedido2=:idPedido AND Estado=:estado AND Orden=:orden"
        );
        $stmt->bindParam(":idPedido", $idPedido, PDO::PARAM_INT);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
        $stmt->bindParam(":orden", $orden, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=========================================================
    TRAER INFORMACION DEL PEDIDO - BUSQUEDA
    =========================================================*/
    static public function mdlTraerInformacionPedido($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=========================================================
    TRAER PRODUCTOS DEL PEDIDO - BUSQUEDA
    =========================================================*/
    static public function mdlTraerProductosPedido($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item ORDER BY Id_Detalle_Pedido ASC");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=========================================================
    TRAER INFORMACION DEL PRODUCTO JUNTOS CON LAS DEL PEDIDO
    =========================================================*/
    static public function mdlTraerProductoConPedido($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare(
            "SELECT * FROM $tabla
             INNER JOIN pedido ON Id_Pedido=Id_Pedido1 
             WHERE $item=:$item");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    TRAER CARACTERISTICAS DEL PRODUCTO
    =============================================*/
    static public function mdlTraerCaracteristicasProducto($tabla, $tabla2, $campo1, $campo2, $item, $valor, $itemOrden)
    {
        $stmt = Conexion::conectar()->prepare(
            "SELECT * FROM $tabla
             INNER JOIN $tabla2 ON $campo1=$campo2
             WHERE $item=:$item
             ORDER BY $itemOrden ASC"
        );
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    VERIFICAR DUPLICADO DE PEDIDO
    =============================================*/
    static public function mdlVerificarDuplicado($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    TRAER REGISTRO DE USUARIOS ESPECIALES
    =============================================*/
    static public function mdlTraerRegistroUnico($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    TRAER REGISTRO UNICO POR CLAVE
    =============================================*/
    static public function mdlTraerRegistroUnicoPorClave($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    REGISTRAR PEDIDO
    =============================================*/
    static public function mdlRegistrarPedido($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Id_Pedido, Fecha_Compromiso, Nombre_Cliente, Telefono_Cliente, Correo_Cliente, Anticipo, Subtotal, IVA, Total, Avance_Estado) VALUES (:idPedido, :fechaCompromiso, :nombreCliente, :telefonoCliente, :correoCliente, :anticipo, :subtotal, :iva, :total, :avance)");
        $stmt->bindParam(":idPedido", $datos["idPedido"], PDO::PARAM_INT);
        $stmt->bindParam(":fechaCompromiso", $datos["fechaCompromiso"], PDO::PARAM_STR);
        $stmt->bindParam(":nombreCliente", $datos["nombreCliente"], PDO::PARAM_STR);
        $stmt->bindParam(":telefonoCliente", $datos["telefonoCliente"], PDO::PARAM_STR);
        $stmt->bindParam(":correoCliente", $datos["correoCliente"], PDO::PARAM_STR);
        $stmt->bindParam(":anticipo", $datos["anticipo"], PDO::PARAM_STR);
        $stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
        $stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_INT);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":avance", $datos["avance"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    REGISTRO DE ESTADOS DE PEDIDO
    =============================================*/
    static public function mdlRegistrarEstados($tabla, $idPedido, $idEstado, $idUsuario)
    {
        $estado = 0;
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Id_Pedido2, Id_Estatus1, Id_Usuario1, Estado) VALUES (:idPedido, :idEstado, :idUsuario, :estado)");
        $stmt->bindParam(":idPedido", $idPedido, PDO::PARAM_INT);
        $stmt->bindParam(":idEstado", $idEstado, PDO::PARAM_INT);
        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    REGISTRO DE PRODUCTOS
    =============================================*/
    static public function mdlRegistrarProducto($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Id_Detalle_Pedido, Cantidad, Descripcion, Precio_Uni, Descuento, Precio_CDescuento, Importe, Observacion, Id_Pedido1, Id_Marca1, Id_Forma1, Otra_Marca, Otra_Forma, Otro_Corte, Otro_Acabado) VALUE (:idProducto, :cantidad, :descripcion, :precioInicial, :descuento, :precioConDescuento, :importe, :observacion, :idPedido, :idMarca, :idForma, :otraMarca, :otraForma, :otroCorte, :otroAcabado)");
        $stmt->bindParam(":idProducto", $datos["idProducto"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":precioInicial", $datos["precioInicial"], PDO::PARAM_STR);
        $stmt->bindParam(":precioConDescuento", $datos["precioConDescuento"], PDO::PARAM_STR);
        $stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_INT);
        $stmt->bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
        $stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
        $stmt->bindParam(":idPedido", $datos["idPedido"], PDO::PARAM_INT);
        $stmt->bindParam(":idMarca", $datos["idMarca"], PDO::PARAM_INT);
        $stmt->bindParam(":idForma", $datos["idForma"], PDO::PARAM_INT);
        $stmt->bindParam(":otraMarca", $datos["otraMarca"], PDO::PARAM_STR);
        $stmt->bindParam(":otraForma", $datos["otraForma"], PDO::PARAM_STR);
        $stmt->bindParam(":otroCorte", $datos["otroCorte"], PDO::PARAM_STR);
        $stmt->bindParam(":otroAcabado", $datos["otroAcabado"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r($stmt->errorInfo());
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR CAMPO NUMERICO (CLAVES)
    =============================================*/
    static public function mdlActualizarCampoNumerico($tabla, $item, $valor, $item2, $idProducto)
    {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
                 SET $item = :$item
                 WHERE $item2 = :$item2"
        );
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
        $stmt->bindParam(":" . $item2, $idProducto, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r($stmt->errorInfo());
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR CAMPO DE CADENA (OTROS DATOS)
    =============================================*/
    static public function mdlActualizarCampoCadena($tabla, $item, $valor, $item2, $idProducto)
    {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
                 SET $item = :$item
                 WHERE $item2 = :$item2"
        );
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $idProducto, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r($stmt->errorInfo());
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    INSERSICIÓN DE CORTES / ACABADOS
    =============================================*/
    static public function mdlInsertarCaracteristicas($tabla, $item, $valor, $item2, $valor2)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ($item, $item2) VALUES (:$item, :$item2)");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r($stmt->errorInfo());
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR ESTADO DE PEDIDO
    =============================================*/
    static public function mdlActualizarEstadoPedido($tabla, $item, $fecha, $idPedido, $idEsatado, $item2, $idUsuario)
    {
        $estado = "1";
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
             SET $item=:$item,
                 $item2=:$item2,
                 Estado=:estado
             WHERE Id_Pedido2=:idPedido AND Id_Estatus1=:idEstado"
        );
        $stmt->bindParam(":" . $item, $fecha, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
        $stmt->bindParam(":idPedido", $idPedido, PDO::PARAM_INT);
        $stmt->bindParam(":idEstado", $idEsatado, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r($stmt->errorInfo());
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR PEDIDO
    =============================================*/
    static public function mdlActualizarPedido($tabla, $item, $datos)
    {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
             SET Nombre_Cliente=:cliente,
                 Correo_Cliente=:correo,
                 Telefono_Cliente=:telefono,
                 Fecha_Compromiso=:fechaCompromiso,
                 Anticipo=:anticipo,
                 Subtotal=:subtotal,
                 IVA=:iva,
                 Total=:total
             WHERE $item=:$item"
        );
        $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaCompromiso", $datos["fechaCompromiso"], PDO::PARAM_STR);
        $stmt->bindParam(":anticipo", $datos["anticipo"], PDO::PARAM_STR);
        $stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
        $stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_INT);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":" . $item, $datos["idPedido"], PDO::PARAM_INT);

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
    ACTUALIZAR CANTIDAD
    =============================================*/
    static public function mdlActualizarCantidad($tabla, $idProducto, $cantidad, $precio, $tipo)
    {

        if ($tipo == "suma") :
            $cantidadNueva = intval($cantidad) + 1;
        elseif ($tipo == "resta") :
            $cantidadNueva = intval($cantidad) - 1;
        endif;

        $precioFinal = floatval($precio) * $cantidadNueva;

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
             SET Cantidad=:cantidad,
                 Importe=:precio
             WHERE Id_Detalle_Pedido=:idProducto"
        );
        $stmt->bindParam(":cantidad", $cantidadNueva, PDO::PARAM_INT);
        $stmt->bindParam(":precio", $precioFinal, PDO::PARAM_STR);
        $stmt->bindParam(":idProducto", $idProducto, PDO::PARAM_INT);

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
    ACTUALIZAR TOTALES
    =============================================*/
    static public function mdlActualizarTotales($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
             SET Subtotal=:subtotal,
                 IVA=:iva,
                 Total=:total
             WHERE Id_Pedido=:idPedido"
        );
        $stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
        $stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_INT);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":idPedido", $datos["idPedido"], PDO::PARAM_INT);

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
    ELIMINAR PEDIDO / PRODUCTO
    =============================================*/
    static public function mdlEliminarPedido($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item=:$item");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r($stmt->errorInfo());
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }
}
