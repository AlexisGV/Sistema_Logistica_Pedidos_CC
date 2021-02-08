<?php

require_once "conexion.php";

class ModeloUsuarios
{

    /*=============================================
    OBTENER TIPOS DE USUARIO PARA EL FORMULARIO DE AGREGAR
    =============================================*/
    static public function mdlObtenerTiposUsuario($tabla)
    {

        # Consulta para traer todos los tipos de usuarios a excepcion del usuario eliminado
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE Tipo_User != 'Usuario eliminado' AND Tipo_User != 'Usuario no asignado' ORDER BY Tipo_User ASC");
        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    SELECCIONAR TODOS LOS USUARIOS
    =============================================*/
    static public function mdlTraerUsuarios()
    {

        # Consulta para traer toda la lista de usuarios a excepcion del usuario eliminado
        $stmt = Conexion::conectar()->prepare(
            "SELECT * FROM usuario
             INNER JOIN tipo_usuario ON Id_Tipo_User=Id_Tipo_User1
             WHERE Tipo_User != 'Usuario eliminado' AND Tipo_User != 'Usuario no asignado'
             ORDER BY Nombre_Usuario ASC"
        );
        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    SELECCIONAR TODOS LOS USUARIOS - PARA ASIGNAR PEDIDOS
    =============================================*/
    static public function mdlTraerUsuariosParaAsignar()
    {

        # Consulta para traer toda la lista de usuarios a excepcion del usuario eliminado
        $stmt = Conexion::conectar()->prepare(
            "SELECT * FROM usuario
             INNER JOIN tipo_usuario ON Id_Tipo_User=Id_Tipo_User1
             WHERE Tipo_User != 'Usuario eliminado' AND Tipo_User != 'Usuario no asignado' AND Tipo_User != 'Administrador' AND Tipo_User != 'Ventas'
             ORDER BY Nombre_Usuario ASC"
        );
        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    BUSCAR UN USUARIO EN ESPECIFICO
    =============================================*/
    static public function mdlBuscarUsuario($tabla, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare(
            "SELECT * FROM $tabla 
             INNER JOIN tipo_usuario ON Id_Tipo_User=Id_Tipo_User1
             WHERE $item=:$item"
        );
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    VERIFICAR USUARIO DUPLICADO
    =============================================*/
    static public function mdlVerificarUsuario($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE REPLACE(Nombre_Usuario,' ','')=REPLACE(:nombre,' ','') OR Correo=:correo");
        $stmt->bindParam("nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam("correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    INSERTAR UN NUEVO USAURIO EN LA BASE DE DATOS
    =============================================*/
    static public function mdlCrearUsuario($tabla, $datos)
    {

        #Consulta para obtener la clave
        $obtenerClave = Conexion::conectar()->prepare("SELECT * FROM tipo_usuario WHERE Tipo_User=:tipoUser");
        $obtenerClave->bindParam(":tipoUser", $datos["tipoUsuario"], PDO::PARAM_STR);
        $obtenerClave->execute();

        #Guardando la clave obtenida
        $resultado = $obtenerClave->fetch();
        $claveTipoUser = $resultado["Id_Tipo_User"];

        $obtenerClave->closeCursor();
        $obtenerClave = null;

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Foto_User, Nombre_Usuario, Correo, Apodo, Password, Id_Tipo_User1) VALUES (:foto, :nombre, :correo, :apodo, :contrasenia, :tipoUsuario)");
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":apodo", $datos["apodo"], PDO::PARAM_STR);
        $stmt->bindParam(":contrasenia", $datos["contrasenia"], PDO::PARAM_STR);
        $stmt->bindParam(":tipoUsuario", $claveTipoUser, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR USAURIO
    =============================================*/
    static public function mdlActualizarUsuario($tabla, $datos)
    {

        #Consulta para obtener la clave
        $obtenerClave = Conexion::conectar()->prepare("SELECT * FROM tipo_usuario WHERE Tipo_User=:tipoUser");
        $obtenerClave->bindParam(":tipoUser", $datos["tipoUsuario"], PDO::PARAM_STR);
        $obtenerClave->execute();

        #Guardando la clave obtenida
        $resultado = $obtenerClave->fetch();
        $claveTipoUser = $resultado["Id_Tipo_User"];

        $obtenerClave->closeCursor();
        $obtenerClave = null;

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
             SET Foto_User=:foto,
                 Nombre_Usuario=:nombre,
                 Correo=:correo,
                 Apodo=:apodo,
                 Password=:contrasenia,
                 Id_Tipo_User1=:tipoUsuario
             WHERE Id_Usuario=:idUsuario"
        );
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":apodo", $datos["apodo"], PDO::PARAM_STR);
        $stmt->bindParam(":contrasenia", $datos["contrasenia"], PDO::PARAM_STR);
        $stmt->bindParam(":tipoUsuario", $claveTipoUser, PDO::PARAM_INT);
        $stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_INT);

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
    ACTUALIZAR USUARIO ELIMINADO
    =============================================*/
    static public function mdlActualizarUsuarioEliminado($tabla, $item, $valor)
    {
        $nulo = NULL;
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
             SET $item=:$item
             WHERE $item IS :nulo"
        );
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
        $stmt->bindParam(":nulo", $nulo, PDO::PARAM_INT);

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
    BORRAR USAURIO
    =============================================*/
    static public function mdlEliminarUsuario($tabla, $item, $valor)
    {

        $stmt =  Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item=:$item");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }
}
