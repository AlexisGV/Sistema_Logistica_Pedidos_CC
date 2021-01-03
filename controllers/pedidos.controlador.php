<?php

    class ControladorPedidos{

        /*=========================================================
        TREAR TODOS LOS REGISTROS DE (MARCA, FORMA, ACABADO, CORTE)
        =========================================================*/
        static public function ctrTraerRegistros($tabla, $item, $excepcion){

            $consulta = ModeloPedidos::mdlTraerRegistros($tabla, $item, $excepcion);
            return $consulta;

        }

    }

?>