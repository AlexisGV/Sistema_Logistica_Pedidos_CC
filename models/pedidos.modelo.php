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
    REGISTRAR PEDIDO
    =============================================*/
    static public function mdlRegistrarPedido($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Id_Pedido, Fecha_Compromiso, Nombre_Cliente, Telefono_Cliente, Correo_Cliente, Anticipo, Subtotal, IVA, Total) VALUES (:idPedido, :fechaCompromiso, :nombreCliente, :telefonoCliente, :correoCliente, :anticipo, :subtotal, :iva, :total)");
        $stmt->bindParam(":idPedido", $datos["idPedido"], PDO::PARAM_INT);
        $stmt->bindParam(":fechaCompromiso", $datos["fechaCompromiso"], PDO::PARAM_STR);
        $stmt->bindParam(":nombreCliente", $datos["nombreCliente"], PDO::PARAM_STR);
        $stmt->bindParam(":telefonoCliente", $datos["telefonoCliente"], PDO::PARAM_STR);
        $stmt->bindParam(":correoCliente", $datos["correoCliente"], PDO::PARAM_STR);
        $stmt->bindParam(":anticipo", $datos["anticipo"], PDO::PARAM_STR);
        $stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
        $stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_INT);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);

        if ( $stmt->execute() ){
            return "ok";
        }else{
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    REGISTRO DE ESTADOS DE PEDIDO
    =============================================*/
    static public function mdlRegistrarEstados($tabla, $idPedido, $idEstado, $idUsuario){
        $estado = 0;
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Id_Pedido2, Id_Estatus1, Id_Usuario1, Estado) VALUES (:idPedido, :idEstado, :idUsuario, :estado)");
        $stmt->bindParam(":idPedido", $idPedido, PDO::PARAM_INT);
        $stmt->bindParam(":idEstado", $idEstado, PDO::PARAM_INT);
        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);

        if ( $stmt->execute() ){
            return "ok";
        }else{
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    REGISTRO DE PRODUCTOS
    =============================================*/
    static public function mdlRegistrarProducto($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Id_Detalle_Pedido, Cantidad, Descripcion, Precio_Uni, Descuento, Importe, Observacion, Id_Pedido1, Id_Marca1, Id_Forma1) VALUE (:idProducto, :cantidad, :descripcion, :precioUnitario, :descuento, :importe, :observacion, :idPedido, :idMarca, :idForma)");
        $stmt->bindParam(":idProducto", $datos["idProducto"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":precioUnitario", $datos["precioUnitario"], PDO::PARAM_STR);
        $stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_INT);
        $stmt->bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
        $stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
        $stmt->bindParam(":idPedido", $datos["idPedido"], PDO::PARAM_INT);
        $stmt->bindParam(":idMarca", $datos["idMarca"], PDO::PARAM_INT);
        $stmt->bindParam(":idForma", $datos["idForma"], PDO::PARAM_INT);

        if ( $stmt->execute() ){
            return "ok";
        }else{
            print_r($stmt->errorInfo());
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;

    }

    /*=============================================
    ACTUALIZAR CAMPO NUMERICO (CLAVES)
    =============================================*/
    static public function mdlActualizarCampoNumerico($tabla, $item, $valor, $item2 ,$idProducto){
        $stmt = Conexion::conectar()->prepare(
                "UPDATE $tabla
                 SET $item = :$item
                 WHERE $item2 = :$item2");
        $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
        $stmt->bindParam(":".$item2, $idProducto, PDO::PARAM_INT);

        if ( $stmt->execute() ){
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
    static public function mdlActualizarCampoCadena($tabla, $item, $valor, $item2 ,$idProducto){
        $stmt = Conexion::conectar()->prepare(
                "UPDATE $tabla
                 SET $item = :$item
                 WHERE $item2 = :$item2");
        $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":".$item2, $idProducto, PDO::PARAM_INT);

        if ( $stmt->execute() ){
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
    static public function mdlInsertarCaracteristicas($tabla, $item, $valor, $item2, $valor2){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ($item, $item2) VALUES (:$item, :$item2)");
        $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
        $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_INT);

        if ( $stmt->execute() ){
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
    static public function mdlActualizarEstadoPedido($tabla, $item, $fecha, $idPedido, $idEsatado, $item2, $idUsuario){
        $estado = "1";
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
             SET $item=:$item,
                 $item2=:$item2,
                 Estado=:estado
             WHERE Id_Pedido2=:idPedido AND Id_Estatus1=:idEstado");
        $stmt->bindParam(":".$item, $fecha, PDO::PARAM_STR);
        $stmt->bindParam(":".$item2, $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
        $stmt->bindParam(":idPedido", $idPedido, PDO::PARAM_INT);
        $stmt->bindParam(":idEstado", $idEsatado, PDO::PARAM_INT);

        if ( $stmt->execute() ){
            return "ok";
        } else {
            print_r($stmt->errorInfo());
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

}
