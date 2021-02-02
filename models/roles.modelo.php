<?php

require_once "conexion.php";

class ModeloRoles
{

    /*=============================================
    OBTENER SIGUIENTE ID DEL ROL
    =============================================*/
    static public function mdlObtenerSiguienteId($tabla, $item)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $item DESC LIMIT 1");
        $stmt->execute();

        return $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    CONSULTA Y BUSQUEDA DE ROLES
    =============================================*/
    static public function mdlObtenerRoles($tabla, $item, $valor)
    {

        #Mostrar consulta general
        if ($valor == null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE Tipo_User != 'Usuario eliminado' AND Tipo_User != 'Usuario no asignado' ORDER BY $item ASC");
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
    CONSULTA DE MODULOS Y PERMISOS
    =============================================*/
    static public function mdlObtenerModulos()
    {
        $tabla = "modulo";
        $orderItem = "Id_Modulo";
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orderItem ASC");
        $stmt->execute();

        return $stmt->fetchAll();

        #Cerrar la conexion
        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    CONSULTA DE MODULOS Y PERMISOS
    =============================================*/
    static public function mdlObtenerPermisos($tabla, $item, $valor, $orderItem)
    {
        $stmt = Conexion::conectar()->prepare(
            "SELECT * FROM $tabla
             INNER JOIN permisos ON Id_Modulo=Id_Modulo1
             INNER JOIN tipo_usuario ON Id_Tipo_User=Id_Tipo_User2
             WHERE $item=:$item
             ORDER BY $orderItem ASC");
        $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();

        #Cerrar la conexion
        $stmt->closeCursor();
        $stmt = null;
    }


    /*=============================================
    AGREGAR ROL DE USUARIO
    =============================================*/
    static public function mdlCrearRol($tabla, $datos)
    {

        #Verificar duplicado
        $duplicado = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE REPLACE(REPLACE(REPLACE(REPLACE(Tipo_User,' ',''),'_',''),'.',''),'-','')=REPLACE(REPLACE(REPLACE(REPLACE(:rol,' ',''),'_',''),'.',''),'-','')");
        $duplicado->bindParam(":rol", $valor, PDO::PARAM_STR);
        $duplicado->execute();

        if ($duplicado->fetch()) {
            return "duplicado";
        } else {
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Id_Tipo_User, Tipo_User, Descripcion_Tipo_User) VALUES (:id, :nombre, :descripcion)");
            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "ok";
            } else {
                $stmt->errorInfo();
                return "error";
            }

            $stmt->closeCursor();
            $stmt = null;
        }

        $duplicado->closeCursor();
        $duplicado = null;
    }

    static public function mdlRegistrarPermisos($tabla, $modulo, $rol)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Id_Tipo_User2, Id_Modulo1) VALUES (:rol, :modulo)");
        $stmt->bindParam(":modulo", $modulo, PDO::PARAM_INT);
        $stmt->bindParam(":rol", $rol, PDO::PARAM_INT);

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
    ACTUALIZAR ROL DE USUARIO
    =============================================*/
    static public function mdlActualizarRol($tabla, $item, $datos)
    {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
            SET Tipo_User=:nombre,
                Descripcion_Tipo_User=:descripcion
            WHERE $item=:$item"
        );
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":" . $item, $datos["idRol"], PDO::PARAM_INT);

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
    ACTULIZAR PERMISO DEL ROL DE USUARIO
    =============================================*/
    static public function mdlActualizarPermiso($tabla, $datos)
    {
        $item = $datos["tipoPermiso"];

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
             SET $item=:$item
             WHERE Id_Tipo_User2=:idRol AND Id_Modulo1=:idModulo"
        );
        $stmt->bindParam(":".$item, $datos["permiso"], PDO::PARAM_INT);
        $stmt->bindParam(":idRol", $datos["idRol"], PDO::PARAM_INT);
        $stmt->bindParam(":idModulo", $datos["idModulo"], PDO::PARAM_INT);

        if ( $stmt->execute() ) {
            return "ok";
        } else {
            $stmt->errorInfo();
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
