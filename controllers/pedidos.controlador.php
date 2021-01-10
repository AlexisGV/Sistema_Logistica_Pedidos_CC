<?php

class ControladorPedidos
{

    /*=============================================
        OBTENER NUMERO DE PEDIDO
        =============================================*/
    static public function ctrObtenerNumeroPedido()
    {

        $tabla = "pedido";
        $item = "Id_Pedido";

        $numeroPedido = ModeloPedidos::mdlObtenerNumeroPedido($tabla, $item);

        if ($numeroPedido) {
            $numeroPedidoNuevo = intval($numeroPedido["Id_Pedido"]) + 1;
        } else {
            $numeroPedidoNuevo = "10001";
        }

        return $numeroPedidoNuevo;
    }

    /*=========================================================
    TRAER TODOS LOS REGISTROS DE (MARCA, FORMA, ACABADO, CORTE)
    =========================================================*/
    static public function ctrTraerRegistros($tabla, $item, $excepcion)
    {

        $consulta = ModeloPedidos::mdlTraerRegistros($tabla, $item, $excepcion);
        return $consulta;
    }

    /*=============================================
    AGREGAR PRODUCTOS AL LEVANTAR PEDIDO - AJAX
    =============================================*/
    static public function ctrAgregarProducto($datos, $cortes, $acabados)
    {

        $datosProducto = [];
        $descripcionProducto = "";

        #Marca
        if ($datos["checkMarca"] == "off") :
            $abvMarca = "Marca";
            $marca = $datos["marca"];
        else :
            $abvMarca = "Otra marca";
            $marca = $datos["otraMarca"];
        endif;

        #Forma
        if ($datos["checkForma"] == "off") :
            $abvForma = "Forma";
            $forma = $datos["forma"];
        else :
            $abvForma = "Otra forma";
            $forma = $datos["otraForma"];
        endif;

        #Cortes
        $corte = "";
        if ($cortes) :
            for ($i = 0; $i < count($cortes); $i++) {
                if ( ($i+1) == count($cortes)){
                    $corte .= $cortes[$i];
                } else{
                    $corte .= $cortes[$i] . "; ";
                }
            }
        else :
            $corte = "No especifica;";
        endif;

        if ($datos["checkCorte"] == "off") :
            $otroCorte = "No";
        else :
            $otroCorte = $datos["otroCorte"];
        endif;

        #Acabados
        $acabado = "";
        if ($acabados) :
            for ($i = 0; $i < count($acabados); $i++) {
                if ( ($i+1) == count($acabados) ) {
                    $acabado .= $acabados[$i];
                } else {
                    $acabado .= $acabados[$i] . "; ";
                }
            }
        else :
            $acabado = "No especifica;";
        endif;

        if ($datos["checkAcabado"] == "off") :
            $otroAcabado = "No";
        else :
            $otroAcabado = $datos["otroAcabado"];
        endif;

        #Observacion
        if ($datos["observacion"] != null && $datos["observacion"] != "") :
            $observacion = $datos["observacion"];
        else :
            $observacion = "Sin observaciones";
        endif;

        $descripcionProducto = $datos["titulo"] . " | " . $abvMarca . ": " . $marca . " | " . $abvForma . ": " . $forma . " | Corte(s): " . $corte . " | Otro corte: " . $otroCorte . " | Acabado(s): " . $acabado . " | Otro acabado: " . $otroAcabado . " | Observación: " . $observacion;

        $datosProducto += ["descripcion" => $descripcionProducto];
        $datosProducto += ["precioInicial" => $datos["precioInicial"]];
        $datosProducto += ["cantidad" => $datos["cantidad"]];
        $datosProducto += ["descuento" => $datos["descuento"]];
        $datosProducto += ["precioFinal" => $datos["precioFinal"]];

        return $datosProducto;
    }

    /*=============================================
    CREAR UN PEDIDO
    =============================================*/
    static public function ctrLevantarPedido()
    {

        if (isset($_POST["ingFolioPedido"])) {

            #Establecer región para la fecha y hora
            setlocale(LC_ALL, "spanish.utf8");
            date_default_timezone_set('UTC');
            date_default_timezone_set("America/Mexico_City");

            #Obtener fecha actual y futura
            $fechaActual = date('Y-m-d H:i:s');
            $fechaFutura = date('Y-m-d H:i:s', strtotime($fechaActual . "+ 3 week"));

            #Informacion y detalles del pedido
            $informacionPedido = json_decode($_POST["informacionPedido"], true);
            $listaProductos = json_decode($_POST["listaProductos"], true);

            #Verificar pedido duplicado
            $tabla = "pedido";
            $item = "Id_Pedido";
            $idPedido = $informacionPedido[0]["idPedido"];
            $resultadoDuplicado = ModeloPedidos::mdlVerificarDuplicado($tabla, $item, $idPedido);

            if ( $resultadoDuplicado ) {
                echo '<script>
                        swal({
                            title: "Registro duplicado",
                            text: "Ha ocurrido un error al intentar levantar el pedido, tal parece que tienes otro pedido registrado con el mismo "Número de pedido" y por eso no se ha podido realizar el registro exitosamente.",
                            icon: "info",
                            closeOnClickOutside: false,
                        }).then( (result) => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, window.location.href);
                            }
                        });
                      </script>';
            } else {

                $informacionGeneralPedido = array(
                    "idPedido" => $idPedido,
                    "fechaCompromiso" => $fechaFutura,
                    "nombreCliente" => $informacionPedido[0]["nomCliente"],
                    "telefonoCliente" => $informacionPedido[0]["telefonoCliente"],
                    "correoCliente" => $informacionPedido[0]["correoCliente"],
                    "anticipo" => $informacionPedido[0]["anticipo"],
                    "subtotal" => $informacionPedido[0]["subtotal"],
                    "iva" => $informacionPedido[0]["iva"],
                    "total" => $informacionPedido[0]["total"]
                );

                /* REGISTRAR PEDIDO
                -------------------------------------------------- */
                $tabla = "pedido";
                $registrarPedido = ModeloPedidos::mdlRegistrarPedido($tabla, $informacionGeneralPedido);

                if ( $registrarPedido == "error" ){
                    echo '<script>
                        swal({
                            title: "Error al registrar pedido",
                            text: "Ha ocurrido un error al intentar registrar el pedido. Verifique que los datos ingresados tengan el formato correcto.",
                            icon: "info",
                            closeOnClickOutside: false,
                        }).then( (result) => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, window.location.href);
                            }
                        });
                      </script>';
                } else {
                    /* REGISTRAR ESTADOS DEL PEDIDO
                    -------------------------------------------------- */
                    #Traer estados
                    $tabla = "estatus_pedido";
                    $item = "Orden";
                    $estados = ModeloPedidos::mdlTraerRegistros($tabla, $item, null);
                    $errorRegistroEstado = 0;

                    #Traer clave del usuario no asignado
                    $tabla = "usuario";
                    $item = "Nombre_Usuario";
                    $valor = "Usuario no asignado";
                    $usuario = ModeloPedidos::mdlTraerRegistroUnico($tabla, $item, $valor);
                    $idUsuario = $usuario["Id_Usuario"];

                    foreach ( $estados as $key => $value ) {

                        #Registrar estado
                        $tabla = "actualizaciones_pedido";

                        $registrarEstado = ModeloPedidos::mdlRegistrarEstados($tabla, $idPedido, $value["Id_Estatus"], $idUsuario);

                        if ( $registrarEstado == "error") {
                            $errorRegistroEstado++;
                            echo '<script>
                                    swal({
                                        title: "Error al registrar estado de pedido",
                                        text: "Ha ocurrido un error al intentar registrar el estado de pedido con el número de orden: '.$value["Id_Estatus"].' para el pedido con el número: '.$idPedido.'.",
                                        icon: "info",
                                        closeOnClickOutside: false,
                                    }).then( (result) => {
                                        if (window.history.replaceState) {
                                            window.history.replaceState(null, null, window.location.href);
                                        }
                                    });
                                  </script>';
                        }

                    }

                    /* REGISTRAR PRODUCTOS DEL PEDIDO
                    -------------------------------------------------- */
                    if ($errorRegistroEstado > 0){
                        #Error al registrar estados - Borrar pedido ingresado
                        echo '<script>
                                swal({
                                    title: "Error al registrar estado de pedido",
                                    text: "Ha ocurrido un error al intentar registrar los estados del pedido, por lo que no se registro el pedido de forma exitosa. Intente de nuevo",
                                    icon: "info",
                                    closeOnClickOutside: false,
                                }).then( (result) => {
                                    if (window.history.replaceState) {
                                        window.history.replaceState(null, null, window.location.href);
                                    }
                                });
                              </script>';
                    } else {

                        echo "<div class='p-5 text-center'>";
                        echo "<pre>"; print_r($estados); echo "</pre>";
                        echo "<pre>"; print_r($informacionPedido); echo "</pre>";
                        echo "<pre>"; print_r($listaProductos); echo "</pre>";
            
                        for ( $i = 0; $i < count($listaProductos); $i++ ) {
                            #Extraer datos de la descripcion
                            $arrayDescripcion = explode(" | ", $listaProductos[$i]["descripcion"]);
                
                            #Contenido marca
                            $arrayMarca = explode(": ", $arrayDescripcion[1]);
                
                            #Contenido forma
                            $arrayForma = explode(": ", $arrayDescripcion[2]);
                
                            #Contenido corte(s)
                            $arrayCortes = explode(": ", $arrayDescripcion[3]);
                            #Obtener los cortes
                            $cortesObtenidos = explode("; ", $arrayCortes[1]);
                
                            #Contenido otro corte
                            $arrayOtroCorte = explode(": ", $arrayDescripcion[4]);
                
                            #Contenido acabado(s)
                            $arrayAcabados = explode(": ", $arrayDescripcion[5]);
                            #Obtener los cortes
                            $acabadosObtenidos = explode("; ", $arrayAcabados[1]);
                
                            #Contenido otro acabado
                            $arrayOtroAcabado = explode(": ", $arrayDescripcion[6]);
                
                            #Contenido observación
                            $arrayObservacion = explode(": ", $arrayDescripcion[7]);
                
                            echo "<pre>"; print_r($arrayDescripcion); echo "</pre>";
                            echo "<pre>"; print_r($arrayMarca); echo "</pre>";
                            echo "<pre>"; print_r($arrayForma); echo "</pre>";
                            echo "<pre>"; print_r($arrayCortes); echo "</pre>";
                            echo "<pre>"; print_r($cortesObtenidos); echo "</pre>";
                            echo "<pre>"; print_r($arrayOtroCorte); echo "</pre>";
                            echo "<pre>"; print_r($arrayAcabados); echo "</pre>";
                            echo "<pre>"; print_r($acabadosObtenidos); echo "</pre>";
                            echo "<pre>"; print_r($arrayOtroAcabado); echo "</pre>";
                            echo "<pre>"; print_r($arrayObservacion); echo "</pre>";
                        }
            
                        echo "</div>";
                    }
        
                }

            }


        }
    }
}
