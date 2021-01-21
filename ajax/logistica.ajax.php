<?php

session_start();
require_once "../controllers/logistica.controlador.php";
require_once "../models/logistica.modelo.php";

class AjaxLogistica
{

    /*=============================================
    ACTUALIZAR ESTADO DE PEDIDO
    =============================================*/
    public $idPedido;
    public $ordenEstado;

    public function ajaxActualizarEstado(){

        $tabla = "pedido";
        $pedido = $this->idPedido;
        $orden = $this->ordenEstado;

        $respuesta = ControladorLogistica::ctrActualizarEstadoPedido($tabla, $pedido, $orden);

        echo json_encode($respuesta);

    }

}

/*=============================================
ACTUALIZAR ESTADO DE PEDIDO
=============================================*/
if (isset($_POST["idPedido"])) {
    $actualizarEstado = new AjaxLogistica();
    $actualizarEstado->idPedido = $_POST["idPedido"];
    $actualizarEstado->ordenEstado = $_POST["numOrden"];
    $actualizarEstado->ajaxActualizarEstado();
}