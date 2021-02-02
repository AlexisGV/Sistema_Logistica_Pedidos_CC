<?php

require_once "../controllers/roles.controlador.php";
require_once "../models/roles.modelo.php";

class AjaxRoles
{

    public $idRol;
    public $item;

    /*=============================================
    EDITAR ROL DE USUARIO
    =============================================*/
    public function ajaxEditarRol()
    {
        $campo = $this->item;
        $valor = $this->idRol;

        $respuesta = ControladorRoles::ctrObtenerRoles($campo, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
    OBTENER PERMISOS POR ROL DE USUARIO
    =============================================*/
    public function ajaxObtenerPermisos()
    {
        $valor = $this->idRol;

        $respuesta = ControladorRoles::ctrObtenerPermisos($valor);

        echo json_encode($respuesta);
    }

    /*=============================================
    ACTUALIZAR PERMISO
    =============================================*/
    public $idModulo;
    public $tipoPermiso;
    public $permiso;

    public function ajaxActualizarPermiso()
    {
        $permisoActual = intval($this->permiso);

        if ( $permisoActual == 1 ) {
            $newPermiso = 0;
        } else {
            $newPermiso = 1;
        }

        $datos = array(
            "idRol" => $this->idRol,
            "idModulo" => $this->idModulo,
            "tipoPermiso" => $this->tipoPermiso,
            "permiso" => $newPermiso
        );

        $respuesta = ControladorRoles::ctrActualizarPermiso($datos);

        echo json_encode($respuesta);
    }
}

/*=============================================
EDITAR ROL DE USUARIO
=============================================*/
if (isset($_POST["idRol"])) {
    $editarRol = new AjaxRoles();
    $editarRol->item = "Id_Tipo_User";
    $editarRol->idRol = $_POST["idRol"];
    $editarRol->ajaxEditarRol();
}

/*=============================================
OBTENER PERMISOS POR ROL DE USUARIO
=============================================*/
if (isset($_POST["idRolForModules"])) {
    $obtenerModulos = new AjaxRoles();
    $obtenerModulos->idRol = $_POST["idRolForModules"];
    $obtenerModulos->ajaxObtenerPermisos();
}

/*=============================================
ACTUALIZAR PERMISO
=============================================*/
if (isset($_POST["idModulo"])) {
    $actualizarPermiso = new AjaxRoles();
    $actualizarPermiso->idRol = $_POST["idRol"];
    $actualizarPermiso->idModulo = $_POST["idModulo"];
    $actualizarPermiso->tipoPermiso = $_POST["tipoPermiso"];
    $actualizarPermiso->permiso = $_POST["permiso"];
    $actualizarPermiso->ajaxActualizarPermiso();
}
