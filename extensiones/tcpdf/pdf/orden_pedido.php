<?php

setlocale(LC_ALL,"spanish.utf8");
date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");

require_once "../../../controllers/pedidos.controlador.php";
require_once "../../../models/pedidos.modelo.php";

require_once('tcpdf_include.php');

class imprimirOrdenPedido extends TCPDF{

public $idPedido;

public function traerOrdenPedido(){

#FECHAS DE INICIO Y FIN PARA TRAER REPORTE
$idPedido = $this->idPedido;

#FECHAS HUMANIZADAS PARA MOSTRAR EN EL ENCABEZADO DEL PDF
// $fchInicialHumanice = strftime("%A, %d de %B del %Y", strtotime($fechaInicial));
// $fchTerminoHumanice = strftime("%A, %d de %B del %Y", strtotime($fechaTermino));
        
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetTitle('Orden de Pedido - N° ' . $idPedido);
        
# Indica que el PDF puede tener varias páginas
$pdf->startPageGroup();
        
# Agrega una nueva página
$pdf->AddPage();

$tabla = "pedido";
$item = "Id_Pedido";
$informacionPedido = ControladorPedidos::ctrTraerInformacionPedido($tabla, $item, $idPedido);

$tabla = "detalle_pedido";
$item = "Id_Pedido1";
$productosPedido = ControladorPedidos::ctrTraerProductosPedido($tabla, $item, $idPedido);

# FECHAS DEL PEDIDO
$fechaInicioHumanize = strftime("%A, %d de %B del %Y a las %r", strtotime($informacionPedido["Fecha_Inicio"]));
$fechaCompromisoHumanize = strftime("%A, %d de %B del %Y", strtotime($informacionPedido["Fecha_Compromiso"]));

if ( $informacionPedido["Fecha_Entrega"] != null && $informacionPedido["Fecha_Entrega"] != "" ) :
    $fechaEntregaHumanize = strftime("%A, %d de %B del %Y", strtotime($informacionPedido["Fecha_Entrega"]));
else :
    $fechaEntregaHumanize = "Información aún no disponible.";
endif;

# DATOS DEL CLIENTE
$nombreCliente = $informacionPedido["Nombre_Cliente"];
$telefonoCliente = $informacionPedido["Telefono_Cliente"];

if ( $informacionPedido["Correo_Cliente"] != null && $informacionPedido["Correo_Cliente"] != "" ) :
    $correoCliente = $informacionPedido["Correo_Cliente"];
else :
    $correoCliente = "No se especificó";
endif;

# TOTALES DEL PEDIDO
$subtotalPedido = number_format($informacionPedido["Subtotal"],2);
$ivaPedido = $informacionPedido["IVA"];
$totalPedido = number_format(floatval($informacionPedido["Total"]),2);

# EVALUAR SI FUE PAGO COMPLETO, DEBE O HAY QUE DEVOLVER
$anticipoPedido = floatval($informacionPedido["Anticipo"]);

if ( $anticipoPedido < $totalPedido ) :
    $valorDeber = floatval($totalPedido) - floatval($anticipoPedido);
    $etiqutaEvaluacion = 
        '<tr>
            <td style="text-align:right; border-top:0.5px solid #666;"><span style="font-weight:bold;">Anticipo:</span> $ '.$anticipoPedido.'</td>
         </tr>
         <tr>
            <td style="text-align:right;"><span style="font-weight:bold;">Debe:</span> $ '.$valorDeber.'</td>
         </tr>';
elseif ( $anticipoPedido == $totalPedido ) :
    $etiqutaEvaluacion = 
        '<tr>
            <td style="text-align:right; font-size: 14px;"><span style="font-weight:bold; border: 0.5px solid #666;">PAGADO</span></td>
         </tr>';
elseif ( $anticipoPedido > $totalPedido ) :
    $valorDevolver = $anticipoPedido - $totalPedido;
    $etiqutaEvaluacion = 
        '<tr>
            <td style="text-align:right; border-top:0.5px solid #666;"><span style="font-weight:bold;">Anticipo:</span> $ '.$anticipoPedido.'</td>
         </tr>
         <tr>
            <td style="text-align:right;"><span style="font-weight:bold;">Devolver:</span> $ '.$valorDevolver.'</td>
         </tr>';
endif;

/*=============================================
ENCABEZADO DEL PDF
=============================================*/
$bloque1 = <<<EOF
        
    <table>
        <tr>
            <td style="width:120px; text-align:center;">
                <br><br>
                <div style="display:flex; flex-direction:row; justify-content: center; align-content: center;">
                    <img style="width:60px;" src="images/Logo-CC-Largo.png">
                </div>
            </td>
            <td style="width:300px; text-align:center;">
                            
                <div style="display:flex; flex-direction:row; justify-content: center; align-content: center;">
                    <span style="font-size:13px; font-weight:bold;">Orden de Pedido - N° $idPedido</span><br>
                    <span style="font-size:9px; font-style:italic;">Fecha de inicio: $fechaInicioHumanize</span><br>
                    <span style="font-size:9px; font-style:italic;">Fecha compromiso: $fechaCompromisoHumanize</span><br>
                    <span style="font-size:9px; font-style:italic;">Fecha de entrega: $fechaEntregaHumanize</span><br>
                </div>
        
            </td>
            <td style="width:120px; text-align:center;">
                <br><br>
                <div style="display:flex; flex-direction:row; justify-content: center; align-content: center;">
                    <img style="width:60px;" src="images/Logo-CC-Largo.png">
                </div>
            </td>
        </tr>
    </table>

    <hr>

    <h3 style="text-align: center;">Datos del cliente</h3>
    <table style="font-size: 10.5px; padding: 5px 10px; border-top: 0.5px solid #666;">
        <tr>
            <td style="text-align:left;"><span style="font-weight: bold;">Nombre:</span> $nombreCliente</td>
            <td style="text-align:center;"><span style="font-weight: bold;">Correo:</span> $correoCliente</td>
            <td style="text-align:right;"><span style="font-weight: bold;">Teléfono:</span> $telefonoCliente</td>
        </tr>
    </table>

    <br>
    <h3 style="text-align: center;">Detalles del pedido</h3>
    <table style="font-size: 10.5px; padding: 5px 10px; font-weight:bold; border-bottom: 0.5px solid #666; border-top: 0.5px solid #666;">
        <tr>
            <td style="width: 310px;">Descripción</td>
            <td style="width: 65px; text-align:center;">Cantidad</td>
            <td style="width: 75px; text-align:center;">Descuento</td>
            <td style="width: 80px; text-align:center;">Total</td>
        </tr>
    </table>

        
EOF;
        
# Escribe el HTML en PDF
$pdf->writeHTML($bloque1, false, false, false, false, '');

/*=============================================
CUERPO DEL PDF
=============================================*/

foreach ( $productosPedido as $key => $value ) {

$descripcionProducto = $value["descripcion"];
$canitdadProducto = $value["cantidad"];
$descuentoProducto = $value["descuento"];
$totalProducto = number_format($value["importe"],2);

$bloque2 = <<<EOF

    <table style="font-size: 10.5px; padding: 5px 10px;">
        <tr>
            <td style="width: 310px;">$descripcionProducto</td>
            <td style="width: 65px; text-align:center;">$canitdadProducto</td>
            <td style="width: 75px; text-align:center;">$descuentoProducto %</td>
            <td style="width: 80px; text-align:center;">$ $totalProducto</td>
        </tr>
    </table>

EOF;

# Escribe el HTML en PDF
$pdf->writeHTML($bloque2, false, false, false, false, '');

}

$bloque3 = <<<EOF

    <table style="font-size: 10.5px; padding: 5px 10px; border-top: 0.5px solid $666; border-bottom: 0.5px solid #666;">
        <tr>
            <td style="text-align:right;"><span style="font-weight:bold;">Subtotal:</span> $ $subtotalPedido</td>
        </tr>
        <tr>
            <td style="text-align:right;"><span style="font-weight:bold;">IVA Aplicado:</span> $ivaPedido %</td>
        </tr>
        <tr>
            <td style="text-align:right;"><span style="font-weight:bold;">Total a pagar:</span> $ $totalPedido</td>
        </tr>
        $etiqutaEvaluacion
    </table>

EOF;

# Escribe el HTML en PDF
$pdf->writeHTML($bloque3, false, false, false, false, '');

$footer = <<<EOF

    <br><br>
    <table style="font-size: 8.5px; padding: 5px 0x; text-align:justify;">
        <tr>
            <td style="text-align:justify;"><span style="font-weight: bold;">IMPORTANTE:</span> Aunque somos muy cuidadosos en los procesos que realizamos, todo trabajo con botellas de vidrio tiene un riesgo de ruptura, al aceptar nuestra propuesta está de acuerdo en que Cerrando el Ciclo A.C. no se responsabiliza si la botella se rompe durante el proceso, pero tampoco aplicará cobro alguno por el mismo. Todo trabajo requiere %50 de anticipo para comenzar su elaboración.</td>
        </tr>
        <tr>
            <td style="text-align:center;">"Después de 30 naturales días NO nos hacemos responsbales por los trabajos que no hayan sido recogidos."</td>
        </tr>
    </table>

EOF;

# Escribe el HTML en PDF
$pdf->writeHTML($footer, false, false, false, false, '');
       
# Salida del archivo
$pdf->Output('orden_pedido_n'.$idPedido);

}


}

$ordenPedido = new imprimirOrdenPedido();
$ordenPedido->idPedido = $_GET["idPedido"];
$ordenPedido->traerOrdenPedido();