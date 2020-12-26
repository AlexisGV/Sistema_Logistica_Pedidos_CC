<?php

    require_once "../controllers/cortes.controlador.php";
    require_once "../models/cortes.modelo.php";

    class AjaxCortes{

        /*=============================================
        EDITAR ACABADOS
        =============================================*/
        public $idCorte;

        public function ajaxEditarCorte(){

            $tabla = "corte";
            $item = "Id_Corte";
            $idEditCorte = $this->idCorte;

            $respuesta = ControladorCorte::ctrTraerCorte($tabla, $item, $idEditCorte);

            echo json_encode($respuesta);

        }

    }

    /*=============================================
    EDITAR ACABADOS
    =============================================*/
    if ( isset($_POST["idCorte"]) ){
        $editarCorte = new AjaxCortes();
        $editarCorte->idCorte = $_POST["idCorte"];
        $editarCorte->ajaxEditarCorte();
    }