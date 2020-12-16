<?php

require_once "conexion.php";

class ModeloRoles
{

    /*=============================================
    CONSULTA Y BUSQUEDA DE ROLES
    =============================================*/
    static public function mdlObtenerRoles($tabla, $item, $valor)
    {

        #Mostrar consulta general
        if ($valor == null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $item ASC");
            $stmt->execute();

            return $stmt->fetchAll();

            #Cerrar la conexion
            $stmt->closeCursor();
            $stmt = null;
        } else { #Realizar una busqueda

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();

            #Cerrar la conexion
            $stmt->closeCursor();
            $stmt = null;
        }
    }

    /*=============================================
    AGREGAR ROL DE USUARIO
    =============================================*/
    static public function mdlCrearRol($tabla, $valor)
    {

        #Verificar duplicado
        $duplicado = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE REPLACE(REPLACE(REPLACE(REPLACE(Tipo_User,' ',''),'_',''),'.',''),'-','')=REPLACE(REPLACE(REPLACE(REPLACE(:rol,' ',''),'_',''),'.',''),'-','')");
        $duplicado->bindParam(":rol", $valor, PDO::PARAM_STR);
        $duplicado->execute();

        if ($duplicado->fetch()) {
            return "duplicado";
        } else {
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Tipo_User) VALUES (:nuevoRol)");
            $stmt->bindParam(":nuevoRol", $valor, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }

            $stmt->closeCursor();
            $stmt = null;
        }

        $duplicado->closeCursor();
        $duplicado = null;
    }

    /*=============================================
    ACTUALIZAR ROL DE USUARIO
    =============================================*/
    static public function mdlActualizarRol($tabla, $item, $datos)
    {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
            SET Tipo_User=:rol
            WHERE $item=:$item"
        );
        $stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
        $stmt->bindParam(":" . $item, $datos["idRol"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    ELIMINAR ROL DE USUARIO
    =============================================*/
    static public function mdlEliminarRol($tabla, $item, $id)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item=:$item");
        $stmt->bindParam(":" . $item, $id, PDO::PARAM_INT);

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
