<?php

    // require_once "../controllers/acabados.controlador.php";
    // require_once "../models/acabados.modelo.php";

    class AjaxPedidos{

        /*=============================================
        AGREGAR PRODUCTOS
        =============================================*/
        public function ajaxAgregarProducto(){

            $respuesta = ControladorPedidos::ctrAgregarProducto();
            echo ($respuesta);

        }

    }

    /*=============================================
    EDITAR ACABADOS
    =============================================*/
    if ( isset($_POST["ingNomProducto"]) ){
        $agregarProducto = new AjaxPedidos();
        $agregarProducto->ajaxAgregarProducto();
    }