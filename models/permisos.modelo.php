<?php

require_once "conexion.php";

class ModeloPermisos{

    /*=============================================
    OBTENER PERMISOS DEL MODULO
    =============================================*/
    static public function mdlObtenerPermisos($tabla, $modulo, $usuario , $tipoUsuario)
    {
        $stmt = Conexion::conectar()->prepare(
            "SELECT * FROM $tabla 
             INNER JOIN permisos ON Id_Modulo=Id_Modulo1
             INNER JOIN tipo_usuario ON Id_Tipo_User=Id_Tipo_User2
             INNER JOIN usuario ON Id_Tipo_User=Id_Tipo_User1
             WHERE Nombre_Modulo=:modulo AND Id_Usuario=:usuario AND Id_Tipo_User=:tipoUsuario");
        $stmt->bindParam(":modulo", $modulo, PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
        $stmt->bindParam(":tipoUsuario", $tipoUsuario, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;
    }

}

?>