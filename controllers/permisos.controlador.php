<?php

class ControladorPermisos{

    /*=============================================
    OBTENER PERMISOS DEL MODULO
    =============================================*/
    static public function ctrObtenerPermisos($modulo)
    {
        $tabla = "modulo";
        $usuario = $_SESSION["idUsuario"];
        $tipoUsuario = $_SESSION["tipoUsuario"];

        $permisos = ModeloPermisos::mdlObtenerPermisos($tabla, $modulo, $usuario, $tipoUsuario);

        return $permisos;
    }
    

}

?>