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

        $numeroPedido = ModeloPedidos::mdlObtenerSiguienteId($tabla, $item);

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

    /*=========================================================
    TRAER REGISTROS DE FORMA DESCENDENTE
    =========================================================*/
    static public function ctrTraerRegistrosDescendentes($tabla, $item)
    {

        $consulta = ModeloPedidos::mdlTraerRegistrosDescendentes($tabla, $item);
        return $consulta;
    }

    /*=========================================================
    SELECCIONAR ESTADO MAS RECIENTE DEL PEDIDO
    =========================================================*/
    static public function ctrTraerEstadoPedido($tabla, $idPedido, $itemOrden)
    {
        $estadosPedido = ModeloPedidos::mdlTraerEstadoPedido($tabla, $idPedido, $itemOrden);
        return $estadosPedido;
    }

    /*=========================================================
    TRAER INFORMACION DEL PEDIDO - BUSQUEDA
    =========================================================*/
    static public function ctrTraerInformacionPedido($tabla, $item, $valor)
    {
        $infoPedido = ModeloPedidos::mdlTraerInformacionPedido($tabla, $item, $valor);
        return $infoPedido;
    }

    /*=========================================================
    TRAER PRODUCTOS DEL PEDIDO - BUSQUEDA
    =========================================================*/
    static public function ctrTraerProductosPedido($tabla, $item, $valor)
    {
        $productos = [];
        $infoPedido = ModeloPedidos::mdlTraerProductosPedido($tabla, $item, $valor);

        foreach ($infoPedido as $key => $value) {

            $descripcion = "";

            /* OBTENER LA MARCA DEL PRODUCTO
            -------------------------------------------------- */
            if ($value["Otra_Marca"] != "" && $value["Otra_Marca"] != null) {
                $abvMarca = "Otra marca";
                $marca = $value["Otra_Marca"];
            } else {
                $abvMarca = "Marca";

                #Traer nombre de la marca
                $tabla = "marca";
                $item = "Id_Marca";
                $valor = $value["Id_Marca1"];
                $registroMarca = ModeloPedidos::mdlTraerRegistroUnicoPorClave($tabla, $item, $valor);
                $marca = $registroMarca["Marca"];
            }

            /* OBTENER LA FORMA DEL PRODUCTO
            -------------------------------------------------- */
            if ($value["Otra_Forma"] != "" && $value["Otra_Forma"] != null) {
                $abvForma = "Otra forma";
                $forma = $value["Otra_Forma"];
            } else {
                $abvForma = "Forma";

                #Traer nombre de la forma
                $tabla = "forma";
                $item = "Id_Forma";
                $valor = $value["Id_Forma1"];
                $registroForma = ModeloPedidos::mdlTraerRegistroUnicoPorClave($tabla, $item, $valor);
                $forma = $registroForma["Forma"];
            }

            /* OBTENER LOS CORTES DEL PRODUCTO
            -------------------------------------------------- */
            $tabla = "corte";
            $tabla2 = "corte_dpedido";
            $campo1 = "Id_Corte";
            $campo2 = "Id_Corte1";
            $item = "Id_Detalle_Pedido2";
            $valor = $value["Id_Detalle_Pedido"];
            $itemOrden = "Corte";
            $registrosCortes = ModeloPedidos::mdlTraerCaracteristicasProducto($tabla, $tabla2, $campo1, $campo2, $item, $valor, $itemOrden);

            $cortes = "";
            if ($registrosCortes) {
                foreach ($registrosCortes as $i => $value2) {
                    if (($i + 1) == count($registrosCortes)) :
                        $cortes .= $value2["Corte"];
                    else :
                        $cortes .= $value2["Corte"] . "; ";
                    endif;
                }
            } else {
                $cortes = "No especifica";
            }

            /* OBTENER OTRO CORTE DEL PRODUCTO
            -------------------------------------------------- */
            if ($value["Otro_Corte"] != "" && $value["Otro_Corte"] != null) {
                $otroCorte = $value["Otro_Corte"];
            } else {
                $otroCorte = "No";
            }

            /* OBTENER LOS ACABADOS DEL PRODUCTO
            -------------------------------------------------- */
            $tabla = "acabado";
            $tabla2 = "acabado_dpedido";
            $campo1 = "Id_Acabado";
            $campo2 = "Id_Acabado1";
            $item = "Id_Detalle_Pedido1";
            $valor = $value["Id_Detalle_Pedido"];
            $itemOrden = "Acabado";
            $registrosAcabados = ModeloPedidos::mdlTraerCaracteristicasProducto($tabla, $tabla2, $campo1, $campo2, $item, $valor, $itemOrden);

            $acabados = "";
            if ($registrosAcabados) {
                foreach ($registrosAcabados as $i => $value2) {
                    if (($i + 1) == count($registrosAcabados)) :
                        $acabados .= $value2["Acabado"];
                    else :
                        $acabados .= $value2["Acabado"] . "; ";
                    endif;
                }
            } else {
                $acabados = "No especifica";
            }

            /* OBTENER OTRO ACABADO DEL PRODUCTO
            -------------------------------------------------- */
            if ($value["Otro_Acabado"] != "" && $value["Otro_Acabado"] != null) {
                $otroAcabado = $value["Otro_Acabado"];
            } else {
                $otroAcabado = "No";
            }

            $descripcion = $value["Descripcion"] . " | " . $abvMarca . ": " . $marca . " | " . $abvForma . ": " . $forma . " | Corte(s): " . $cortes . " | Otro corte: " . $otroCorte . " | Acabado(s): " . $acabados . " | Otro acabado: " . $otroAcabado . " | Observación: " . $value["Observacion"];

            array_push(
                $productos,
                array(
                    "idProducto" => $value["Id_Detalle_Pedido"],
                    "descripcion" => $descripcion,
                    "precioUnitario" => $value["Precio_Uni"],
                    "cantidad" => $value["Cantidad"],
                    "descuento" => $value["Descuento"],
                    "importe" => $value["Importe"]
                )
            );
        }

        return $productos;
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
                if (($i + 1) == count($cortes)) {
                    $corte .= $cortes[$i];
                } else {
                    $corte .= $cortes[$i] . "; ";
                }
            }
        else :
            $corte = "No especifica";
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
                if (($i + 1) == count($acabados)) {
                    $acabado .= $acabados[$i];
                } else {
                    $acabado .= $acabados[$i] . "; ";
                }
            }
        else :
            $acabado = "No especifica";
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

            if ($resultadoDuplicado) {
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
                    "total" => $informacionPedido[0]["total"],
                    "avance" => 10
                );

                /* REGISTRAR PEDIDO
                -------------------------------------------------- */
                $tabla = "pedido";
                $registrarPedido = ModeloPedidos::mdlRegistrarPedido($tabla, $informacionGeneralPedido);

                if ($registrarPedido == "error") {
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

                    foreach ($estados as $key => $value) {

                        #Registrar estado
                        $tabla = "actualizaciones_pedido";

                        $registrarEstado = ModeloPedidos::mdlRegistrarEstados($tabla, $idPedido, $value["Id_Estatus"], $idUsuario);

                        if ($registrarEstado == "error") {
                            $errorRegistroEstado++;
                            echo '<script>
                                    swal({
                                        title: "Error al registrar estado de pedido",
                                        text: "Ha ocurrido un error al intentar registrar el estado de pedido con el número de orden: ' . $value["Id_Estatus"] . ' para el pedido con el número: ' . $idPedido . '.",
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
                    if ($errorRegistroEstado > 0) {
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

                        $tabla = "pedido";
                        $item = "Id_Pedido";
                        $eliminarPedido = ModeloPedidos::mdlEliminarPedido($tabla, $item, $idPedido);

                        return false;
                    } else {

                        $regErroneo = 0;

                        /* ACTUALIZAR PRIMER ESTADO DEL PEDIDO
                        -------------------------------------------------- */
                        #Traer clave de estado 1
                        $tabla = "estatus_pedido";
                        $item = "Nombre_Estatus";
                        $valor = "Pedido en tienda";
                        $estatus = ModeloPedidos::mdlTraerRegistroUnico($tabla, $item, $valor);
                        $idEstatus = $estatus["Id_Estatus"];

                        $tabla = "actualizaciones_pedido";
                        $campoFecha = "Fecha_Actualizacion";
                        $campoUsuario = "Id_Usuario1";
                        $idUsuario = $_SESSION["idUsuario"];

                        $actualizarEstadoUno = ModeloPedidos::mdlActualizarEstadoPedido($tabla, $campoFecha, $fechaActual, $idPedido, $idEstatus, $campoUsuario, $idUsuario);

                        if ($actualizarEstadoUno == "error") {
                            $regErroneo++;
                        }


                        for ($i = 0; $i < count($listaProductos); $i++) {

                            #Estableciendo el ID del producto o detalle de pedido
                            $tabla = "detalle_pedido";
                            $item = "Id_Detalle_Pedido";

                            $idProducto = ModeloPedidos::mdlObtenerSiguienteId($tabla, $item);

                            if ($idProducto) {
                                $idProductoNuevo = intval($idProducto["Id_Detalle_Pedido"]) + 1;
                            } else {
                                $idProductoNuevo = "1";
                            }

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

                            #Traer clave de la marca "Otra marca"
                            $tabla = "marca";
                            $item = "Marca";
                            $valor = "Otra marca";
                            $marca = ModeloPedidos::mdlTraerRegistroUnico($tabla, $item, $valor);
                            $idMarca = $marca["Id_Marca"];

                            #Traer clave de la forma "Otra forma"
                            $tabla = "forma";
                            $item = "Forma";
                            $valor = "Otra forma";
                            $forma = ModeloPedidos::mdlTraerRegistroUnico($tabla, $item, $valor);
                            $idForma = $forma["Id_Forma"];

                            #Agrupar datos para ingreso
                            $datosProducto = array(
                                "idProducto" => $idProductoNuevo,
                                "cantidad" => $listaProductos[$i]["cantidad"],
                                "descripcion" =>  $arrayDescripcion[0],
                                "precioInicial" => $listaProductos[$i]["precioInicial"],
                                "precioConDescuento" => $listaProductos[$i]["precioConDescuento"],
                                "descuento" => $listaProductos[$i]["descuento"],
                                "importe" => $listaProductos[$i]["importe"],
                                "observacion" => $arrayObservacion[1],
                                "idPedido" => $idPedido,
                                "idMarca" => $idMarca,
                                "idForma" => $idForma
                            );

                            #Registrar producto
                            $tabla = "detalle_pedido";
                            $registrarProducto = ModeloPedidos::mdlRegistrarProducto($tabla, $datosProducto);

                            if ($registrarProducto == "ok") {

                                $item2 = "Id_Detalle_Pedido";

                                /* ACTUALIZAR MARCAS
                                -------------------------------------------------- */
                                $valorMarca = $arrayMarca[1];
                                if ($arrayMarca[0] == "Marca") {
                                    #Traer clave de la marca
                                    $tabla = "marca";
                                    $item = "Marca";
                                    $marca = ModeloPedidos::mdlTraerRegistroUnico($tabla, $item, $valorMarca);
                                    $idMarca = $marca["Id_Marca"];

                                    $tabla = "detalle_pedido";
                                    $item = "Id_Marca1";

                                    $actualizarMarca = ModeloPedidos::mdlActualizarCampoNumerico($tabla, $item, $idMarca, $item2, $idProductoNuevo);

                                    if ($actualizarMarca == "error") {
                                        #Error al actualizar la marca - Eliminar pedido
                                        $regErroneo++;
                                        break;
                                    }
                                } else if ($arrayMarca[0] == "Otra marca") {
                                    $tabla = "detalle_pedido";
                                    $item = "Otra_Marca";

                                    $actualizarMarca = ModeloPedidos::mdlActualizarCampoCadena($tabla, $item, $valorMarca, $item2, $idProductoNuevo);

                                    if ($actualizarMarca == "error") {
                                        #Error al actualizar la marca - Eliminar pedido
                                        $regErroneo++;
                                        break;
                                    }
                                }

                                /* ACTUALIZAR FORMAS
                                -------------------------------------------------- */
                                $valorForma = $arrayForma[1];
                                if ($arrayForma[0] == "Forma") {
                                    #Traer clave de la forma
                                    $tabla = "forma";
                                    $item = "Forma";
                                    $forma = ModeloPedidos::mdlTraerRegistroUnico($tabla, $item, $valorForma);
                                    $idForma = $forma["Id_Forma"];

                                    $tabla = "detalle_pedido";
                                    $item = "Id_Forma1";

                                    $actualizarForma = ModeloPedidos::mdlActualizarCampoNumerico($tabla, $item, $idForma, $item2, $idProductoNuevo);

                                    if ($actualizarForma == "error") {
                                        #Error al actualizar la marca - Eliminar pedido
                                        $regErroneo++;
                                        break;
                                    }
                                } else if ($arrayForma[0] == "Otra forma") {
                                    $tabla = "detalle_pedido";
                                    $item = "Otra_Forma";

                                    $actualizarForma = ModeloPedidos::mdlActualizarCampoCadena($tabla, $item, $valorForma, $item2, $idProductoNuevo);

                                    if ($actualizarForma == "error") {
                                        #Error al actualizar la marca - Eliminar pedido
                                        $regErroneo++;
                                        break;
                                    }
                                }

                                /* ACTUALIZAR / INGRESAR CORTE(S)
                                -------------------------------------------------- */
                                if ($cortesObtenidos[0] != "No especifica") {
                                    for ($j = 0; $j < count($cortesObtenidos); $j++) {
                                        #Traer clave del corte
                                        $tabla = "corte";
                                        $item = "Corte";
                                        $valorCorte = $cortesObtenidos[$j];
                                        $corte = ModeloPedidos::mdlTraerRegistroUnico($tabla, $item, $valorCorte);
                                        $idCorte = $corte["Id_Corte"];

                                        $tabla = "corte_dpedido";
                                        $item = "Id_Corte1";
                                        $item3 = "Id_Detalle_Pedido2";

                                        $registrarCorte = ModeloPedidos::mdlInsertarCaracteristicas($tabla, $item, $idCorte, $item3, $idProductoNuevo);

                                        if ($registrarCorte == "error") {
                                            #Error al ingresar cortes - Eliminar pedido
                                            $regErroneo++;
                                            break;
                                        }
                                    }
                                }

                                /* ACTUALIZAR OTRO CORTE
                                -------------------------------------------------- */
                                $valorOtroCorte = $arrayOtroCorte[1];
                                if ($valorOtroCorte != "No") {
                                    $tabla = "detalle_pedido";
                                    $item = "Otro_Corte";

                                    $actualizarOtroCorte = ModeloPedidos::mdlActualizarCampoCadena($tabla, $item, $valorOtroCorte, $item2, $idProductoNuevo);

                                    if ($actualizarOtroCorte == "error") {
                                        #Error al actualizar la marca - Eliminar pedido
                                        $regErroneo++;
                                        break;
                                    }
                                }

                                /* ACTUALIZAR / INGRESAR ACABADO(S)
                                -------------------------------------------------- */
                                if ($acabadosObtenidos[0] != "No especifica") {
                                    for ($j = 0; $j < count($acabadosObtenidos); $j++) {
                                        #Traer clave del acabado
                                        $tabla = "acabado";
                                        $item = "Acabado";
                                        $valorAcabado = $acabadosObtenidos[$j];
                                        $acabado = ModeloPedidos::mdlTraerRegistroUnico($tabla, $item, $valorAcabado);
                                        $idAcabado = $acabado["Id_Acabado"];

                                        $tabla = "acabado_dpedido";
                                        $item = "Id_Acabado1";
                                        $item3 = "Id_Detalle_Pedido1";

                                        $registrarAcabado = ModeloPedidos::mdlInsertarCaracteristicas($tabla, $item, $idAcabado, $item3, $idProductoNuevo);

                                        if ($registrarAcabado == "error") {
                                            #Error al ingresar acabados - Eliminar pedido
                                            $regErroneo++;
                                            break;
                                        }
                                    }
                                }

                                /* ACTUALIZAR OTRO ACABADO
                                -------------------------------------------------- */
                                $valorOtroAcabado = $arrayOtroAcabado[1];
                                if ($valorOtroAcabado != "No") {
                                    $tabla = "detalle_pedido";
                                    $item = "Otro_Acabado";

                                    $actualizarOtroAcabado = ModeloPedidos::mdlActualizarCampoCadena($tabla, $item, $valorOtroAcabado, $item2, $idProductoNuevo);

                                    if ($actualizarOtroAcabado == "error") {
                                        #Error al actualizar la marca - Eliminar pedido
                                        $regErroneo++;
                                        break;
                                    }
                                }
                            } else {
                                #Error al registrar un poducto - Borrar el pedido
                                echo '<script>
                                    swal({
                                        title: "Error al registrar un producto!",
                                        text: "Parace que hubo un error al registrar el producto.",
                                        icon: "error",
                                        closeOnClickOutside: false,
                                    }).then( (result) => {
                                        if (window.history.replaceState) {
                                            window.history.replaceState(null, null, window.location.href);
                                        }
                                    });
                                  </script>';

                                $tabla = "pedido";
                                $item = "Id_Pedido";
                                $eliminarPedido = ModeloPedidos::mdlEliminarPedido($tabla, $item, $idPedido);

                                return false;
                            }
                        }

                        /* EVALUAR SI HUBO ERRORES
                        -------------------------------------------------- */
                        if ($regErroneo > 0) {
                            echo '<script>
                                    swal({
                                        title: "Error al levantar el pedido!",
                                        text: "Parace que hubo algunos errores al registrar el pedido, intenta de nuevo.",
                                        icon: "error",
                                        closeOnClickOutside: false,
                                    }).then( (result) => {
                                        if (window.history.replaceState) {
                                            window.history.replaceState(null, null, window.location.href);
                                        }
                                    });
                                  </script>';

                            $tabla = "pedido";
                            $item = "Id_Pedido";
                            $eliminarPedido = ModeloPedidos::mdlEliminarPedido($tabla, $item, $idPedido);

                            return false;
                        } else {
                            echo '<script>
                                    swal({
                                        title: "Transacción exitosa!",
                                        text: "El pedido se levanto de forma correcta, puedes verlo en el apartado de: Admistrar pedido.",
                                        icon: "success",
                                        closeOnClickOutside: false,
                                    }).then( (result) => {
                                        window.location = "levantarPedido";
                                    });
                                  </script>';
                        }
                    }
                }
            }
        }
    }

    /*=============================================
    ACTUALIZAR PEDIDO
    =============================================*/
    static public function ctrActualizarPedido()
    {

        if (isset($_POST["editCliente"])) {

            /* EVALUAR SI HAY ANTICIPO
            -------------------------------------------------- */
            if (isset($_POST["editPagoCompleto"]) && isset($_POST["editPagoCompleto"]) == "on") {
                $anticipo = $_POST["editTotal"];
            } else {
                $anticipo = $_POST["editAnticipo"];
            }

            /* ORDENANDO LOS DATOS
            -------------------------------------------------- */
            $datos = array(
                "idPedido" => $_POST["editIdPedido"],
                "cliente" => $_POST["editCliente"],
                "correo" => $_POST["editCorreo"],
                "telefono" => $_POST["editTelefono"],
                "subtotal" => $_POST["editSubtotal"],
                "iva" => $_POST["editIVA"],
                "total" => $_POST["editTotal"],
                "anticipo" => $anticipo
            );

            $tabla = "pedido";
            $item = "Id_Pedido";
            $actualizarPedido = ModeloPedidos::mdlActualizarPedido($tabla, $item, $datos);

            if ($actualizarPedido == "ok") {
                echo '<script>
                        swal({
                            title: "Actualización de pedido exitosa!",
                            text: "Los datos del pedido ' . $datos["idPedido"] . ' se actualizaron de forma correcta.",
                            icon: "success",
                            closeOnClickOutside: false,
                        }).then( (result) => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, window.location.href);
                            }
                        });
                      </script>';
            } else {
                echo '<script>
                        swal({
                            title: "Error al intentar actualizar!",
                            text: "Ocurrió un error al actualizar los datos del pedido con número ' . $datos["idPedido"] . '. Intente de nuevo",
                            icon: "success",
                            closeOnClickOutside: false,
                        }).then( (result) => {
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, window.location.href);
                            }
                        });
                      </script>';
            }
        }
    }

    /*=============================================
    ACTUALIZAR CANTIDAD
    =============================================*/
    static public function ctrActualizarCantidad($idProducto, $tipo)
    {

        $tabla = "detalle_pedido";
        $item = "Id_Detalle_Pedido";
        $producto = ModeloPedidos::mdlTraerRegistroUnicoPorClave($tabla, $item, $idProducto);
        $cantidadActual = $producto["Cantidad"];
        $precioUnitario = $producto["Precio_CDescuento"];
        $idPedido = $producto["Id_Pedido1"];

        if ($cantidadActual == 1 && $tipo == "resta") {
            return "errorCantidadNula";
        } else {

            $actualizarCantidad = ModeloPedidos::mdlActualizarCantidad($tabla, $idProducto, $cantidadActual, $precioUnitario, $tipo);

            if ($actualizarCantidad == "ok") {

                $actualizarTotales = ControladorPedidos::actualizarTotales($idPedido);

                if ($actualizarTotales == "error") {
                    return "errorTotales";
                } else {
                    $datosPedido = ModeloPedidos::mdlTraerProductoConPedido($tabla, $item, $idProducto);
                    return $datosPedido;
                }
            } else {
                return "errorCantidad";
            }
        }
    }

    /*=============================================
    AGREGAR PRODUCTO A PEDIDO EXISTENTE
    =============================================*/
    static public function ctrAgregarProductoToPedido($datosSimples, $cortesSelect, $acabadosSelect)
    {

        #Estableciendo el ID del producto o detalle de pedido
        $tabla = "detalle_pedido";
        $item = "Id_Detalle_Pedido";
        $idPedido = $datosSimples["idPedido"];

        $idProducto = ModeloPedidos::mdlObtenerSiguienteId($tabla, $item);

        if ($idProducto) {
            $idProductoNuevo = intval($idProducto["Id_Detalle_Pedido"]) + 1;
        } else {
            $idProductoNuevo = "1";
        }

        #Traer clave de la marca
        $tabla = "marca";
        $item = "Marca";
        if ($datosSimples["checkMarca"] == "off") {
            $valor = $datosSimples["marca"];
        } else {
            $valor = "Otra marca";
        }
        $marca = ModeloPedidos::mdlTraerRegistroUnico($tabla, $item, $valor);
        $idMarca = $marca["Id_Marca"];

        #Traer clave de la forma
        $tabla = "forma";
        $item = "Forma";
        if ($datosSimples["checkForma"] == "off") {
            $valor = $datosSimples["forma"];
        } else {
            $valor = "Otra forma";
        }
        $forma = ModeloPedidos::mdlTraerRegistroUnico($tabla, $item, $valor);
        $idForma = $forma["Id_Forma"];

        #Obteniendo precio con descuento
        $precioConDescuento = floatval($datosSimples["precioInicial"]) - ((floatval($datosSimples["precioInicial"]) * intval($datosSimples["descuento"])) / 100);

        #Estableciendo la observacion vacia
        if ($datosSimples["observacion"] == "") {
            $observacion = "Sin observaciones";
        } else {
            $observacion = $datosSimples["observacion"];
        }

        $tabla = "detalle_pedido";
        #Organizando los datos para guardar producto
        $datos = array(
            "idProducto" => $idProductoNuevo,
            "idPedido" => $idPedido,
            "descripcion" => $datosSimples["titulo"],
            "precioInicial" => $datosSimples["precioInicial"],
            "descuento" => $datosSimples["descuento"],
            "precioConDescuento" => $precioConDescuento,
            "cantidad" => $datosSimples["cantidad"],
            "importe" => $datosSimples["precioFinal"],
            "idMarca" => $idMarca,
            "idForma" => $idForma,
            "otraMarca" => $datosSimples["otraMarca"],
            "otraForma" => $datosSimples["otraForma"],
            "otroCorte" => $datosSimples["otroCorte"],
            "otroAcabado" => $datosSimples["otroAcabado"],
            "observacion" => $observacion
        );

        $insertarNuevoProducto = ModeloPedidos::mdlRegistrarProducto($tabla, $datos);

        if ($insertarNuevoProducto == "ok") {

            /* ACTUALIZAR / INGRESAR CORTE(S)
            -------------------------------------------------- */
            if ($cortesSelect) {
                for ($j = 0; $j < count($cortesSelect); $j++) {
                    #Traer clave del corte
                    $tabla = "corte";
                    $item = "Corte";
                    $valorCorte = $cortesSelect[$j];
                    $corte = ModeloPedidos::mdlTraerRegistroUnico($tabla, $item, $valorCorte);
                    $idCorte = $corte["Id_Corte"];

                    $tabla = "corte_dpedido";
                    $item = "Id_Corte1";
                    $item3 = "Id_Detalle_Pedido2";

                    $registrarCorte = ModeloPedidos::mdlInsertarCaracteristicas($tabla, $item, $idCorte, $item3, $idProductoNuevo);
                }
            }

            /* ACTUALIZAR / INGRESAR ACABADO(S)
            -------------------------------------------------- */
            if ($acabadosSelect) {
                for ($j = 0; $j < count($acabadosSelect); $j++) {
                    #Traer clave del acabado
                    $tabla = "acabado";
                    $item = "Acabado";
                    $valorAcabado = $acabadosSelect[$j];
                    $acabado = ModeloPedidos::mdlTraerRegistroUnico($tabla, $item, $valorAcabado);
                    $idAcabado = $acabado["Id_Acabado"];

                    $tabla = "acabado_dpedido";
                    $item = "Id_Acabado1";
                    $item3 = "Id_Detalle_Pedido1";

                    $registrarAcabado = ModeloPedidos::mdlInsertarCaracteristicas($tabla, $item, $idAcabado, $item3, $idProductoNuevo);
                }
            }

            #Actualiza totales
            $actualizarTotales = ControladorPedidos::actualizarTotales($idPedido);

            if ($actualizarTotales == "ok") {

                #Consulta que regresa el producto añadido y los totales
                $tabla = "detalle_pedido";
                $item = "Id_Detalle_Pedido";
                $datosPedido = ModeloPedidos::mdlTraerProductoConPedido($tabla, $item, $idProductoNuevo);

                $descripcion = "";

                /* OBTENER LA MARCA DEL PRODUCTO
                -------------------------------------------------- */
                if ($datosPedido["Otra_Marca"] != "" && $datosPedido["Otra_Marca"] != null) {
                    $abvMarca = "Otra marca";
                    $marca = $datosPedido["Otra_Marca"];
                } else {
                    $abvMarca = "Marca";

                    #Traer nombre de la marca
                    $tabla = "marca";
                    $item = "Id_Marca";
                    $valor = $datosPedido["Id_Marca1"];
                    $registroMarca = ModeloPedidos::mdlTraerRegistroUnicoPorClave($tabla, $item, $valor);
                    $marca = $registroMarca["Marca"];
                }

                /* OBTENER LA FORMA DEL PRODUCTO
                -------------------------------------------------- */
                if ($datosPedido["Otra_Forma"] != "" && $datosPedido["Otra_Forma"] != null) {
                    $abvForma = "Otra forma";
                    $forma = $datosPedido["Otra_Forma"];
                } else {
                    $abvForma = "Forma";

                    #Traer nombre de la forma
                    $tabla = "forma";
                    $item = "Id_Forma";
                    $valor = $datosPedido["Id_Forma1"];
                    $registroForma = ModeloPedidos::mdlTraerRegistroUnicoPorClave($tabla, $item, $valor);
                    $forma = $registroForma["Forma"];
                }

                /* OBTENER LOS CORTES DEL PRODUCTO
                -------------------------------------------------- */
                $tabla = "corte";
                $tabla2 = "corte_dpedido";
                $campo1 = "Id_Corte";
                $campo2 = "Id_Corte1";
                $item = "Id_Detalle_Pedido2";
                $valor = $datosPedido["Id_Detalle_Pedido"];
                $itemOrden = "Corte";
                $registrosCortes = ModeloPedidos::mdlTraerCaracteristicasProducto($tabla, $tabla2, $campo1, $campo2, $item, $valor, $itemOrden);

                $cortes = "";
                if ($registrosCortes) {
                    foreach ($registrosCortes as $i => $value2) {
                        if (($i + 1) == count($registrosCortes)) :
                            $cortes .= $value2["Corte"];
                        else :
                            $cortes .= $value2["Corte"] . "; ";
                        endif;
                    }
                } else {
                    $cortes = "No especifica";
                }

                /* OBTENER OTRO CORTE DEL PRODUCTO
                -------------------------------------------------- */
                if ($datosPedido["Otro_Corte"] != "" && $datosPedido["Otro_Corte"] != null) {
                    $otroCorte = $datosPedido["Otro_Corte"];
                } else {
                    $otroCorte = "No";
                }

                /* OBTENER LOS ACABADOS DEL PRODUCTO
                -------------------------------------------------- */
                $tabla = "acabado";
                $tabla2 = "acabado_dpedido";
                $campo1 = "Id_Acabado";
                $campo2 = "Id_Acabado1";
                $item = "Id_Detalle_Pedido1";
                $valor = $datosPedido["Id_Detalle_Pedido"];
                $itemOrden = "Acabado";
                $registrosAcabados = ModeloPedidos::mdlTraerCaracteristicasProducto($tabla, $tabla2, $campo1, $campo2, $item, $valor, $itemOrden);

                $acabados = "";
                if ($registrosAcabados) {
                    foreach ($registrosAcabados as $i => $value2) {
                        if (($i + 1) == count($registrosAcabados)) :
                            $acabados .= $value2["Acabado"];
                        else :
                            $acabados .= $value2["Acabado"] . "; ";
                        endif;
                    }
                } else {
                    $acabados = "No especifica";
                }

                /* OBTENER OTRO ACABADO DEL PRODUCTO
                -------------------------------------------------- */
                if ($datosPedido["Otro_Acabado"] != "" && $datosPedido["Otro_Acabado"] != null) {
                    $otroAcabado = $datosPedido["Otro_Acabado"];
                } else {
                    $otroAcabado = "No";
                }

                $descripcion = $datosPedido["Descripcion"] . " | " . $abvMarca . ": " . $marca . " | " . $abvForma . ": " . $forma . " | Corte(s): " . $cortes . " | Otro corte: " . $otroCorte . " | Acabado(s): " . $acabados . " | Otro acabado: " . $otroAcabado . " | Observación: " . $datosPedido["Observacion"];

                $datosProductoConPedido = array(
                    "descripcion" => $descripcion,
                    "cantidad" => $datosPedido["Cantidad"],
                    "descuento" => $datosPedido["Descuento"],
                    "importe" => $datosPedido["Importe"],
                    "subtotal" => $datosPedido["Subtotal"],
                    "IVA" => $datosPedido["IVA"],
                    "total" => $datosPedido["Total"],
                    "anticipo" => $datosPedido["Anticipo"],
                    "idProducto" => $datosPedido["Id_Detalle_Pedido"],
                    "idPedido" => $datosPedido["Id_Pedido1"],
                );

                return $datosProductoConPedido;
            } else {
                return "errorTotales";
            }
        } else {
            return "errorProducto";
        }

        return $cortesSelect;
    }

    /*=============================================
    ELIMINAR PRODUCTO
    =============================================*/
    static public function ctrEliminarProducto($idProducto)
    {
        $tabla = "detalle_pedido";
        $item = "Id_Detalle_Pedido";
        $valor = $idProducto;

        $registroProducto = ModeloPedidos::mdlTraerRegistroUnicoPorClave($tabla, $item, $valor);
        $idPedido = $registroProducto["Id_Pedido1"];

        $eliminarProducto = ModeloPedidos::mdlEliminarPedido($tabla, $item, $valor);

        if ($eliminarProducto == "ok") {

            $actualizarTotales = ControladorPedidos::actualizarTotales($idPedido);

            if ($actualizarTotales == "error") {
                return "errorActualizacion";
            } else {
                $tabla = "pedido";
                $item = "Id_Pedido";
                $valoresPedido = ModeloPedidos::mdlTraerInformacionPedido($tabla, $item, $idPedido);

                return $valoresPedido;
            }
        } else {
            return "error";
        }
    }

    /*=============================================
    ELIMINAR PEDIDO
    =============================================*/
    static public function ctrEliminarPedido()
    {
        if (isset($_GET["idPedido"]) && isset($_GET["idPedido"]) != "") {
            $tabla = "pedido";
            $item = "Id_Pedido";
            $valor = $_GET["idPedido"];

            $eliminarPedido = ModeloPedidos::mdlEliminarPedido($tabla, $item, $valor);

            if ($eliminarPedido == "ok") {
                echo '<script>
                        swal({
                            title: "Eliminación exitosa!",
                            text: "El pedido con número \"' . $valor . '\" se eliminó correctamente.",
                            icon: "success",
                            closeOnClickOutside: false,
                        }).then( (result) => {
                            window.location = "administrarPedidos";
                        });
                      </script>';
            } else {
                echo '<script>
                        swal({
                            title: "Error!",
                            text: "Ha ocurrido un error con la conexión a la base de datos.",
                            icon: "error",
                            closeOnClickOutside: false,
                        }).then( (result) => {
                            window.location = "administrarPedidos";
                        });
                      </script>';
            }
        }
    }

    /*=============================================
    ACTUALIZAR TOTALES DEL PEDIDO AL ACTUALIZAR
    =============================================*/
    static public function actualizarTotales($idPedido)
    {

        /* TRAER INFORMACION DEL PEDIDO
        -------------------------------------------------- */
        $tabla = "pedido";
        $item = "Id_Pedido";
        $informacionPedido = ModeloPedidos::mdlTraerRegistroUnicoPorClave($tabla, $item, $idPedido);

        $iva = $informacionPedido["IVA"];

        /* TRAER PRODUCTOS DEL PEDIDO
        -------------------------------------------------- */
        $tabla = "detalle_pedido";
        $item = "Id_Pedido1";
        $productos = ModeloPedidos::mdlTraerProductosPedido($tabla, $item, $idPedido);

        $sumaSubtotales = 0;
        $total = 0;

        if ($productos) {

            foreach ($productos as $key => $value) {
                $sumaSubtotales += floatval($value["Importe"]);
            }

            $total = $sumaSubtotales + (($sumaSubtotales * $iva) / 100);
        } else {
            $iva = 0;
        }

        /* ACTUALIZAR TOTALES
        -------------------------------------------------- */
        $tabla = "pedido";
        $datos = array(
            "idPedido" => $idPedido,
            "subtotal" => $sumaSubtotales,
            "iva" => $iva,
            "total" => $total
        );

        $actualizarPedido = ModeloPedidos::mdlActualizarTotales($tabla, $datos);

        return $actualizarPedido;
    }
}
