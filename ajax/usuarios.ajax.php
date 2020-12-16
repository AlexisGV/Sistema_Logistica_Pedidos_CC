<?php

    require_once "../controllers/usuarios.controlador.php";
    require_once "../models/usuarios.modelo.php";;

    class AjaxUsuarios{

        /*=============================================
        EDITAR USUARIOS
        =============================================*/
        public $idUsuario;

        public function ajaxEditarUsuario(){

            $tabla = "usuario";
            $item = "Id_Usuario";
            $valor = $this->idUsuario;

            $respuesta = ControladorUsuarios::ctrBuscarUsuario($tabla, $item, $valor);

            echo json_encode($respuesta);

        }
        

    }

    /*=============================================
    EDITAR USUARIOS
    =============================================*/
    if(isset($_POST["idUsuario"])){
        $editar = new AjaxUsuarios();
        $editar->idUsuario = $_POST["idUsuario"];
        $editar->ajaxEditarUsuario();
    }