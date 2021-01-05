<?php

    class ControladorPedidos{

        /*=========================================================
        TREAR TODOS LOS REGISTROS DE (MARCA, FORMA, ACABADO, CORTE)
        =========================================================*/
        static public function ctrTraerRegistros($tabla, $item, $excepcion){

            $consulta = ModeloPedidos::mdlTraerRegistros($tabla, $item, $excepcion);
            return $consulta;

        }

        /*=============================================
        AGREGAR PRODUCTOS AL LEVANTAR PEDIDO
        =============================================*/
        static public function ctrAgregarProducto(){

            if ( isset($_POST["ingNomProducto"]) ){
                return "HOLA";
            }

        }

    }

?>