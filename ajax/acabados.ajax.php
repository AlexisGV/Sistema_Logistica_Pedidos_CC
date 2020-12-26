<?php

    require_once "../controllers/acabados.controlador.php";
    require_once "../models/acabados.modelo.php";

    class AjaxAcabados{

        /*=============================================
        EDITAR ACABADOS
        =============================================*/
        public $idAcabado;

        public function ajaxEditarAcabado(){

            $tabla = "acabado";
            $item = "Id_Acabado";
            $idEditAcabado = $this->idAcabado;

            $respuesta = ControladorAcabado::ctrTraerAcabado($tabla, $item, $idEditAcabado);

            echo json_encode($respuesta);

        }

    }

    /*=============================================
    EDITAR ACABADOS
    =============================================*/
    if ( isset($_POST["idAcabado"]) ){
        $editarAcabado = new AjaxAcabados();
        $editarAcabado->idAcabado = $_POST["idAcabado"];
        $editarAcabado->ajaxEditarAcabado();
    }