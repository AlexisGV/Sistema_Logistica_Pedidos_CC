<?php

require_once "../controllers/pedidos.controlador.php";
require_once "../models/pedidos.modelo.php";

class AjaxPedidos
{

    /*=============================================
    AGREGAR PRODUCTOS - AL LEVANTAR PEDIDO
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

    public function ajaxAgregarProductoToPedido()
    {
        $valores = $this->datosSimples;
        $cortesSelect = $this->cortes;
        $acabadosSelect = $this->acabados;

        $respuesta = ControladorPedidos::ctrAgregarProductoToPedido($valores, $cortesSelect, $acabadosSelect);
        echo json_encode($respuesta);
    }

    /*=============================================
    TRAER INFORMACION DEL PEDIDO
    =============================================*/
    public $idPedido;

    public function ajaxVerPedido()
    {

        $tabla = "pedido";
        $item = "Id_Pedido";
        $verPedidoId = $this->idPedido;

        $informacionPedido = ControladorPedidos::ctrTraerInformacionPedido($tabla, $item, $verPedidoId);

        echo json_encode($informacionPedido);
    }

    /*=============================================
    TRAER PRODUCTOS DEL PEDIDO
    =============================================*/
    public function ajaxVerProductosPedido()
    {

        $tabla = "detalle_pedido";
        $item = "Id_Pedido1";
        $verPedidoId = $this->idPedido;

        $productosPedido = ControladorPedidos::ctrTraerProductosPedido($tabla, $item, $verPedidoId);

        echo json_encode($productosPedido);
    }

    /*=============================================
    ELIMINAR PRODUCTO DEL PEDIDO
    =============================================*/
    public $idProducto;

    public function ajaxEliminarProductoPedido()
    {

        $idDetallePedido = $this->idProducto;

        $eliminarProducto = ControladorPedidos::ctrEliminarProducto($idDetallePedido);

        echo json_encode($eliminarProducto);
    }

    /*=============================================
    ELIMINAR PRODUCTO DEL PEDIDO
    =============================================*/
    public $tipo;

    public function ajaxActualizarCantidad()
    {

        $idDetallePedido = $this->idProducto;
        $accion = $this->tipo;

        $actualizarCantidad = ControladorPedidos::ctrActualizarCantidad($idDetallePedido, $accion);

        echo json_encode($actualizarCantidad);
    }

    /*=============================================
    SUBIR FOTO DE PRODUCTO
    =============================================*/
    public $campoFoto;
    public $fotoSubida;
    
    public function ajaxSubirImagenProducto(){

        $idPedido = $this->idPedido;
        $idDetallePedido = $this->idProducto;
        $campoFotografia = $this->campoFoto;
        $imagen = $this->fotoSubida;

        $subirImagen = ControladorPedidos::ctrSubirImagenProducto($idPedido, $idDetallePedido, $campoFotografia, $imagen);

        echo $subirImagen;

    }

    /*=============================================
    TRAER INFORMACION DE LOS CAMPOS DE IMAGEN DEL PRODUCTO
    =============================================*/
    public function ajaxTrearCamposFotoProducto(){
        
        $idDetallePedido = $this->idProducto;
    
        $imagenes = ControladorPedidos::ctrTraerFotosProducto($idDetallePedido);
        echo json_encode($imagenes);

    }

    /*=============================================
    ELIMINAR FOTO DE PRODUCTO
    =============================================*/
    public function ajaxEliminarFotoProducto(){

        $idPedido = $this->idPedido;
        $idDetallePedido = $this->idProducto;
        $campoFotografia = $this->campoFoto;
        $imagen = $this->fotoSubida;

        $eliminarFoto = ControladorPedidos::ctrEliminarFotoProducto($idPedido, $idDetallePedido, $campoFotografia, $imagen);

        echo $eliminarFoto;

    }
    
}

/*=============================================
AGREGAR PRODUCTOS - AL LEVANTAR PEDIDO
=============================================*/
if (isset($_POST["ingNomProducto"]) || isset($_POST["ingNomProductoPedido"])) {
    $agregarProducto = new AjaxPedidos();

    #Informacion básica del producto
    if (isset($_POST["ingNomProducto"])) :
        $agregarProducto->datosSimples += ["titulo" => $_POST["ingNomProducto"]];
    elseif (isset($_POST["ingNomProductoPedido"])) :
        $agregarProducto->datosSimples += ["idPedido" => $_POST["idPedido"]];
        $agregarProducto->datosSimples += ["titulo" => $_POST["ingNomProductoPedido"]];
    endif;

    $agregarProducto->datosSimples += ["precioInicial" => $_POST["ingPrecioInicial"]];
    $agregarProducto->datosSimples += ["cantidad" => $_POST["ingCantidad"]];
    $agregarProducto->datosSimples += ["descuento" => $_POST["ingDescuento"]];
    $agregarProducto->datosSimples += ["precioFinal" => $_POST["ingPrecioFinal"]];
    $agregarProducto->datosSimples += ["observacion" => $_POST["ingObvProducto"]];

    #Marca
    if (isset($_POST["ingMarcaProducto"])) {
        $agregarProducto->datosSimples += ["marca" => $_POST["ingMarcaProducto"]];
    } else {
        $agregarProducto->datosSimples += ["marca" => "Otra marca"];
    }
    if (isset($_POST["ingCheckOtraMarcaProd"])) {
        $agregarProducto->datosSimples += ["checkMarca" => $_POST["ingCheckOtraMarcaProd"]];
    } else {
        $agregarProducto->datosSimples += ["checkMarca" => "off"];
    }
    $agregarProducto->datosSimples += ["otraMarca" => $_POST["ingOtraMarcaProd"]];

    #Forma
    if (isset($_POST["ingFormaProducto"])) {
        $agregarProducto->datosSimples += ["forma" => $_POST["ingFormaProducto"]];
    } else {
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

    #Ejecucion de los metodos
    if (isset($_POST["ingNomProducto"])) :
        /* EJECUTAR METODO PARA AGREGAR PRODUCTO AL LEVANTAR PEDIDO
        -------------------------------------------------- */
        $agregarProducto->ajaxAgregarProducto();
    elseif (isset($_POST["ingNomProductoPedido"])) :
        /* EJECUTAR METODO PARA AGREGAR PRODUCTO A PEDIDO EXISTENTE
        -------------------------------------------------- */
        $agregarProducto->ajaxAgregarProductoToPedido();
    endif;
    
}

/*=============================================
TRAER INFORMACION DEL PEDIDO
=============================================*/
if (isset($_POST["verPedidoId"])) {
    $verPedido = new AjaxPedidos();
    $verPedido->idPedido = $_POST["verPedidoId"];
    $verPedido->ajaxVerPedido();
}

/*=============================================
TRAER PRODUCTOS DEL PEDIDO
=============================================*/
if (isset($_POST["verProdsPedidoId"])) {
    $verProdsPedido = new AjaxPedidos();
    $verProdsPedido->idPedido = $_POST["verProdsPedidoId"];
    $verProdsPedido->ajaxVerProductosPedido();
}

/*=============================================
ELIMINAR PRODUCTOS DEL PEDIDO
=============================================*/
if (isset($_POST["idDetallePedido"])) {
    $eliminarProducto = new AjaxPedidos();
    $eliminarProducto->idProducto = $_POST["idDetallePedido"];
    $eliminarProducto->ajaxEliminarProductoPedido();
}

/*=============================================
ACTUALIZAR CANTIDAD DE PRODUCTO
=============================================*/
if (isset($_POST["idDetallePedidoCantidad"])) {
    $actualizarCantidad = new AjaxPedidos();
    $actualizarCantidad->idProducto = $_POST["idDetallePedidoCantidad"];
    $actualizarCantidad->tipo = $_POST["accion"];
    $actualizarCantidad->ajaxActualizarCantidad();
}

/*=============================================
SUBIR FOTO DE PRODUCTO
=============================================*/
if ( isset($_POST['fotoSubida']) ) {

    $subidaDeImagen = new AjaxPedidos();
    $subidaDeImagen->idPedido = $_POST['idPedido'];
    $subidaDeImagen->campoFoto = $_POST['campoFoto'];
    $subidaDeImagen->idProducto = $_POST['idProducto'];
    $subidaDeImagen->fotoSubida = $_POST['fotoSubida'];
    $subidaDeImagen->ajaxSubirImagenProducto();

}

/*=============================================
TRAER INFORMACION DE LOS CAMPOS DE IMAGEN DEL PRODUCTO
=============================================*/
if ( isset($_POST['idProductoForPhoto']) ) {

    $obtenerFotos = new AjaxPedidos();
    $obtenerFotos->idProducto = $_POST['idProductoForPhoto'];
    $obtenerFotos->ajaxTrearCamposFotoProducto();

}

/*=============================================
ELIMINAR FOTO DE PRODUCTO
=============================================*/
if ( isset($_POST['fotoAEliminar']) ) {

    $eliminarImagen = new AjaxPedidos();
    $eliminarImagen->idPedido = $_POST['idPedido'];
    $eliminarImagen->campoFoto = $_POST['campoFoto'];
    $eliminarImagen->idProducto = $_POST['idProducto'];
    $eliminarImagen->fotoSubida = $_POST['fotoAEliminar'];
    $eliminarImagen->ajaxEliminarFotoProducto();
    
}