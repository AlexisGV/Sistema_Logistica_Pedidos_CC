<?php

    require_once "../controllers/marcas.controlador.php";
    require_once "../models/marcas.modelo.php";

    class AjaxMarcas{

        /*=============================================
        EDITAR MARCAS
        =============================================*/
        public $idMarca;

        public function ajaxEditarMarca(){

            $tabla = "marca";
            $item = "Id_Marca";
            $idEditMarca = $this->idMarca;

            $respuesta = ControladorMarca::ctrTraerMarca($tabla, $item, $idEditMarca);

            echo json_encode($respuesta);

        }

    }

    /*=============================================
    EDITAR MARCAS
    =============================================*/
    if ( isset($_POST["idMarca"]) ){
        $editarMarca = new AjaxMarcas();
        $editarMarca->idMarca = $_POST["idMarca"];
        $editarMarca->ajaxEditarMarca();
    }