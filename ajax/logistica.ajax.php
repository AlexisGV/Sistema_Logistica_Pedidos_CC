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
    public $usuarioPedido = NULL;

    public function ajaxActualizarEstado()
    {

        $tabla = "pedido";
        $pedido = $this->idPedido;
        $orden = $this->ordenEstado;
        $avance = $this->avanceEstado;
        $usuario = $this->usuarioPedido;

        $respuesta = ControladorLogistica::ctrActualizarEstadoPedido($tabla, $pedido, $orden, $avance, $usuario);

        echo json_encode($respuesta);
    }

    /*=============================================
    VER LOGISTICA DE PEDIDO
    =============================================*/
    public function ajaxVerLogisticaPedido()
    {

        $item = "Id_Pedido";
        $pedido = $this->idPedido;

        $respuesta = ControladorLogistica::ctrVerLogisticaDePedido($item, $pedido);

        echo json_encode($respuesta);
    }

    /*=============================================
    VER COMENTARIO DE PEDIDO
    =============================================*/
    public function ajaxVerComentarioPedido()
    {

        $pedido = $this->idPedido;
        $estatus = $this->ordenEstado;

        $respuesta = ControladorLogistica::ctrTraerComentario($pedido, $estatus);

        echo json_encode($respuesta);
    }

    /*=============================================
    ACTUALIZAR COMENTARIO DE PEDIDO
    =============================================*/
    public $comentarioPedido;

    public function ajaxActualizarComentario()
    {

        $orden = $this->ordenEstado;
        $ordenNuevo = intval($orden) + 1;

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
VER LOGISTICA DE PEDIDO
=============================================*/
if (isset($_POST["verLogisticaPorId"])) {
    $actualizarEstado = new AjaxLogistica();
    $actualizarEstado->idPedido = $_POST["verLogisticaPorId"];
    $actualizarEstado->ajaxVerLogisticaPedido();
}

/*=============================================
VER COMENTARIO DE PEDIDO
=============================================*/
if (isset($_POST["verComentarioId"])) {
    $verComentario = new AjaxLogistica();
    $verComentario->idPedido = $_POST["verComentarioId"];
    $verComentario->ordenEstado = $_POST["verComentarioOrden"];
    $verComentario->ajaxVerComentarioPedido();
}

/*=============================================
ACTUALIZAR ESTADO DE PEDIDO
=============================================*/
if (isset($_POST["idPedido"])) {
    $actualizarEstado = new AjaxLogistica();
    $actualizarEstado->idPedido = $_POST["idPedido"];
    $actualizarEstado->ordenEstado = $_POST["numOrden"];
    $actualizarEstado->avanceEstado = $_POST["avance"];

    if (isset($_POST["idUsuario"])) {
        $actualizarEstado->usuarioPedido = $_POST["idUsuario"];
    }

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
