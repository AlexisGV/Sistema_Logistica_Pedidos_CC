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
        $cortesSelect = $this->cortes; 
        $acabadosSelect = $this->acabados; 

        $respuesta = ControladorPedidos::ctrAgregarProducto($valores, $cortesSelect, $acabadosSelect);
        echo json_encode($respuesta);
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
    if ( isset($_POST["ingMarcaProducto"]) ){
        $agregarProducto->datosSimples += ["marca" => $_POST["ingMarcaProducto"]];
    }else{
        $agregarProducto->datosSimples += ["marca" => "Otra marca"];
    }
    if (isset($_POST["ingCheckOtraMarcaProd"])) {
        $agregarProducto->datosSimples += ["checkMarca" => $_POST["ingCheckOtraMarcaProd"]];
    } else {
        $agregarProducto->datosSimples += ["checkMarca" => "off"];
    }
    $agregarProducto->datosSimples += ["otraMarca" => $_POST["ingOtraMarcaProd"]];

    #Forma
    if (isset($_POST["ingFormaProducto"])){
        $agregarProducto->datosSimples += ["forma" => $_POST["ingFormaProducto"]];
    }else{
        $agregarProducto->datosSimples += ["forma" => "Otra forma"];
    }
    if (isset($_POST["ingCheckOtraFormaProd"])) {
        $agregarProducto->datosSimples += ["checkForma" => $_POST["ingCheckOtraFormaProd"]];
    } else {
        $agregarProducto->datosSimples += ["checkForma" => "off"];
    }
    $agregarProducto->datosSimples += ["otraForma" => $_POST["ingOtraFormaProd"]];

    #Cortes
    if (isset($_POST["ingCorteProducto"])) {
        $agregarProducto->cortes = $_POST["ingCorteProducto"];
    }
    if (isset($_POST["ingCheckOtroCorteProd"])) {
        $agregarProducto->datosSimples += ["checkCorte" => $_POST["ingCheckOtroCorteProd"]];
    } else {
        $agregarProducto->datosSimples += ["checkCorte" => "off"];
    }
    $agregarProducto->datosSimples += ["otroCorte" => $_POST["ingOtroCorteProd"]];

    #Acabados
    if (isset($_POST["ingAcabadoProducto"])) {
        $agregarProducto->acabados = $_POST["ingAcabadoProducto"];
    }
    if (isset($_POST["ingCheckOtroAcabadoProd"])) {
        $agregarProducto->datosSimples += ["checkAcabado" => $_POST["ingCheckOtroAcabadoProd"]];
    } else {
        $agregarProducto->datosSimples += ["checkAcabado" => "off"];
    }
    $agregarProducto->datosSimples += ["otroAcabado" => $_POST["ingOtroAcabadoProd"]];

    $agregarProducto->ajaxAgregarProducto();
}
