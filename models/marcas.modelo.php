<?php

require_once "conexion.php";

class ModeloMarca
{

    /*=============================================
    OBTENER LAS MARCAS
    =============================================*/
    static public function mdlTraerMarca($tabla, $item, $valor)
    {
        if ($valor == null) {
            # Consulta general
            $consulta = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item != 'Otra marca' ORDER BY $item");
            $consulta->execute();

            return $consulta->fetchAll();

            $consulta->closeCursor();
            $consulta = null;
        } else {
            # Busqueda especifica
            $busqueda = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");
            $busqueda->bindParam(":" . $item, $valor, PDO::PARAM_INT);
            $busqueda->execute();

            return $busqueda->fetch();

            $busqueda->closeCursor();
            $busqueda = null;
        }
    }

    /*=============================================
    VERIFICAR LA EXISTENCIA DE UNA MARCA
    =============================================*/
    static public function mdlVerificarMarca($tabla, $datos, $bandera)
    {
        if ( $bandera ) {
            # Verificar duplicado al ingresar
            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM $tabla
                 WHERE REPLACE(REPLACE(REPLACE(Marca,' ',''),'-',''),'_','')=REPLACE(REPLACE(REPLACE(:nombre,' ',''),'-',''),'_','')"
            );
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        } else {
            # Verificar duplicado al actualizar
            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM $tabla
                 WHERE REPLACE(REPLACE(REPLACE(Marca,' ',''),'-',''),'_','')=REPLACE(REPLACE(REPLACE(:nombre,' ',''),'-',''),'_','') AND Id_Marca!=:idMarca"
            );
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":idMarca", $datos["idMarca"], PDO::PARAM_INT);
        }

        # Ejecutar la consulta
        $stmt->execute();

        # Regresa el resultado de la consulta
        return $stmt->fetch();

        # Cerrar la conexión
        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    CREAR UNA NUEVA MARCA
    =============================================*/
    static public function mdlCrearMarca($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Foto_Marca, Marca) VALUES (:foto ,:nombre)");
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR MARCA
    =============================================*/
    static public function mdlActualizarMarca($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
            SET Foto_Marca=:foto,
                Marca=:nombre
            WHERE Id_Marca=:idMarca"
        );
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":idMarca", $datos["idMarca"], PDO::PARAM_INT);

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
    BORRAR MARCA
    =============================================*/
    static public function mdlEliminarMarca($tabla, $item, $valor)
    {

        $stmt =  Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item=:$item");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            $error = $stmt->errorInfo();
            if ($error[0] == "23000") {
                return "errorPadres";
            } else {
                return "error";
            }
        }

        $stmt->closeCursor();
        $stmt = null;
    }
}
