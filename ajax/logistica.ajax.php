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
    public $avanceEstado;

    public function ajaxActualizarEstado(){

        $tabla = "pedido";
        $pedido = $this->idPedido;
        $orden = $this->ordenEstado;
        $avance = $this->avanceEstado;

        $respuesta = ControladorLogistica::ctrActualizarEstadoPedido($tabla, $pedido, $orden, $avance);

        echo json_encode($respuesta);

    }

    /*=============================================
    ACTUALIZAR COMENTARIO DE PEDIDO
    =============================================*/
    public $comentarioPedido;

    public function ajaxActualizarComentario(){

        $orden = $this->ordenEstado;
        $ordenNuevo = intval($orden)+1;

        $tabla = "pedido";
        $datos = array(
            "idPedido" => $this->idPedido,
            "orden" => $ordenNuevo,
            "comentario" => $this->comentarioPedido
        );

        $respuesta = ControladorLogistica::ctrActualizarComentarioPedido($tabla, $datos);

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
    $actualizarEstado->avanceEstado = $_POST["avance"];
    $actualizarEstado->ajaxActualizarEstado();
}

/*=============================================
ACTUALIZAR ESTADO DE PEDIDO
=============================================*/
if (isset($_POST["ingComentarioPedido"])) {
    $actualizarEstado = new AjaxLogistica();
    $actualizarEstado->idPedido = $_POST["ingCompedidoID"];
    $actualizarEstado->ordenEstado = $_POST["numEstado"];
    $actualizarEstado->comentarioPedido = $_POST["ingComentarioPedido"];
    $actualizarEstado->ajaxActualizarComentario();
}