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
        static public function ctrAgregarProducto($datos, $cortes, $acabados){

            $datosProducto = [];
            $descripcionProducto = "";

            #Marca
            if ( $datos["checkMarca"] == "off" ):
                $abvMarca = "M";
                $marca = $datos["marca"];
            else :
                $abvMarca = "OM";
                $marca = $datos["otraMarca"];
            endif;

            #Forma
            if ( $datos["checkForma"] == "off" ):
                $abvForma = "F";
                $forma = $datos["forma"];
            else :
                $abvForma = "OF";
                $forma = $datos["otraForma"];
            endif;

            #Cortes
            $corte = "";
            if ( $cortes ) :
                for ( $i=0; $i < count($cortes) ; $i++ ){
                    $corte .= $cortes[$i] . "; ";
                }
            else :
                $corte = "No especifica;";
            endif;

            if ( $datos["checkCorte"] == "off" ):
                $otroCorte = "No";
            else:
                $otroCorte = $datos["otroCorte"];
            endif;

            #Acabados
            $acabado = "";
            if ( $acabados ) :
                for ( $i=0; $i < count($acabados) ; $i++ ){
                    $acabado .= $acabados[$i] . "; ";
                }
            else :
                $acabado = "No especifica;";
            endif;

            if ( $datos["checkAcabado"] == "off" ):
                $otroAcabado = "No";
            else:
                $otroAcabado = $datos["otroAcabado"];
            endif;

            #Observacion
            if ( $datos["observacion"] != null && $datos["observacion"] != "" ) :
                $observacion = $datos["observacion"];
            else :
                $observacion = "Sin observaciones";
            endif;

            $descripcionProducto = $datos["titulo"] . " | " . $abvMarca . "-" . $marca . " | " . $abvForma . "-" . $forma . " | C[" . $corte ."] | OC-" . $otroCorte . " | A[" . $acabado . "] | OA-" . $otroAcabado . " | Observación: " . $observacion;

            $datosProducto += [ "descripcion" => $descripcionProducto ];
            $datosProducto += [ "precioInicial" => $datos["precioFinal"] ];
            $datosProducto += [ "cantidad" => $datos["cantidad"] ];
            $datosProducto += [ "descuento" => $datos["descuento"] ];
            $datosProducto += [ "precioFinal" => $datos["precioFinal"] ];

            return $datosProducto;

        }

    }

?>