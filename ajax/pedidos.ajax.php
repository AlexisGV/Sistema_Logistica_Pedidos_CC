<?php

require_once "../controllers/pedidos.controlador.php";
// require_once "../models/acabados.modelo.php";

class AjaxPedidos
{

    /*=============================================
    AGREGAR PRODUCTOS
    =============================================*/
    public $datosSimples = [],
        $cortes = [],
        $acabados = [];

    public function ajaxAgregarProducto()
    {
        $valores = $this->datosSimples;

        $respuesta = ControladorPedidos::ctrAgregarProducto($valores);
        echo $respuesta;
    }
}

/*=============================================
AGREGAR PRODUCTOS
=============================================*/
if (isset($_POST["ingNomProducto"])) {
    $agregarProducto = new AjaxPedidos();

    #Informacion básica del producto
    $agregarProducto->datosSimples += ["titulo" => $_POST["ingNomProducto"]];
    $agregarProducto->datosSimples += ["precioInicial" => $_POST["ingPrecioInicial"]];
    $agregarProducto->datosSimples += ["cantidad" => $_POST["ingCantidad"]];
    $agregarProducto->datosSimples += ["descuento" => $_POST["ingDescuento"]];
    $agregarProducto->datosSimples += ["precioFinal" => $_POST["ingPrecioFinal"]];
    $agregarProducto->datosSimples += ["observacion" => $_POST["ingObvProducto"]];

    #Marca
    $agregarProducto->datosSimples += ["marca" => $_POST["ingMarcaProducto"]];
    if (isset($_POST["ingCheckOtraMarcaProd"])) {
        $agregarProducto->datosSimples += ["checkMarca" => $_POST["ingCheckOtraMarcaProd"]];
    } else {
        $agregarProducto->datosSimples += ["checkMarca" => 0];
    }
    $agregarProducto->datosSimples += ["otraMarca" => $_POST["ingOtraMarcaProd"]];

    #Forma
    $agregarProducto->datosSimples += ["forma" => $_POST["ingFormaProducto"]];
    if (isset($_POST["ingCheckOtraFormaProd"])) {
        $agregarProducto->datosSimples += ["checkForma" => $_POST["ingCheckOtraFormaProd"]];
    } else {
        $agregarProducto->datosSimples += ["checkForma" => 0];
    }
    $agregarProducto->datosSimples += ["otraForma" => $_POST["ingOtraFormaProd"]];

    #Cortes
    if (isset($_POST["ingCorteProducto"])) {
        $agregarProducto->cortes = $_POST["ingCorteProducto"];
    }
    if (isset($_POST["ingCheckOtroCorteProd"])) {
        $agregarProducto->datosSimples += ["checkCorte" => $_POST["ingCheckOtroCorteProd"]];
    } else {
        $agregarProducto->datosSimples += ["checkCorte" => 0];
    }
    $agregarProducto->datosSimples += ["otroCorte" => $_POST["ingOtroCorteProd"]];

    #Acabados
    if (isset($_POST["ingAcabadoProducto"])) {
        $agregarProducto->acabados = $_POST["ingAcabadoProducto"];
    }
    if (isset($_POST["ingCheckOtroAcabadoProd"])) {
        $agregarProducto->datosSimples += ["checkAcabado" => $_POST["ingCheckOtroAcabadoProd"]];
    } else {
        $agregarProducto->datosSimples += ["checkAcabado" => 0];
    }
    $agregarProducto->datosSimples += ["otroAcabado" => $_POST["ingOtroAcabadoProd"]];

    $agregarProducto->ajaxAgregarProducto();
}
