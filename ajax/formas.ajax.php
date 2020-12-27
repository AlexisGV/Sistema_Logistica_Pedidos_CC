<?php

    require_once "../controllers/formas.controlador.php";
    require_once "../models/formas.modelo.php";

    class AjaxFormas{

        /*=============================================
        EDITAR FORMAS
        =============================================*/
        public $idForma;

        public function ajaxEditarForma(){

            $tabla = "forma";
            $item = "Id_Forma";
            $idEditForma = $this->idForma;

            $respuesta = ControladorForma::ctrTraerForma($tabla, $item, $idEditForma);

            echo json_encode($respuesta);

        }

    }

    /*=============================================
    EDITAR ACABADOS
    =============================================*/
    if ( isset($_POST["idForma"]) ){
        $editarForma = new AjaxFormas();
        $editarForma->idForma = $_POST["idForma"];
        $editarForma->ajaxEditarForma();
    }