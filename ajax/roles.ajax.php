<?php

    require_once "../controllers/roles.controlador.php";
    require_once "../models/roles.modelo.php";

    class AjaxRoles{

        public $idRol;
        public $item;

        public function ajaxEditarRol(){

            $campo = $this->item;
            $valor = $this->idRol;

            $respuesta = ControladorRoles::ctrObtenerRoles($campo, $valor);

            echo json_encode($respuesta);

        }

    }

    if ( isset($_POST["idRol"]) ){
        $editarRol = new AjaxRoles();
        $editarRol->item = "Id_Tipo_User";
        $editarRol->idRol = $_POST["idRol"];
        $editarRol->ajaxEditarRol();
    }

?>