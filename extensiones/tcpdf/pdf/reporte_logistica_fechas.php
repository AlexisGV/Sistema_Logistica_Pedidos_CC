<?php

setlocale(LC_ALL,"spanish.utf8");
date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");

require_once "../../../controllers/logistica.controlador.php";
require_once "../../../models/logistica.modelo.php";

class imprimirReporteLogisticaPorFechas{

public $fechaInicio;
public $fechaFin;

public function traerReporteLogisticaPorFechas(){

#FECHAS DE INICIO Y FIN PARA TRAER REPORTE
$fechaInicial = $this->fechaInicio;
$fechaTermino = $this->fechaFin;

#FECHAS HUMANIZADAS PARA MOSTRAR EN EL ENCABEZADO DEL PDF
$fchInicialHumanice = strftime("%A, %d de %B del %Y", strtotime($fechaInicial));
$fchTerminoHumanice = strftime("%A, %d de %B del %Y", strtotime($fechaTermino));

require_once('tcpdf_include.php');
        
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
# Indica que el PDF puede tener varias páginas
$pdf->startPageGroup();
        
# Agrega una nueva página
$pdf->AddPage();

/*=============================================
ENCABEZADO DEL PDF
=============================================*/
$bloque1 = <<<EOF
        
    <table>
        <tr>
            <td style="width:130px; text-align:center;">
                <div style="display:flex; flex-direction:row; justify-content: center; align-content: center;">
                    <img style="width:60px;" src="images/Logo-CC-Largo.png">
                </div>
            </td>
            <td style="width:280px; text-align:center;">
                            
                <div style="display:flex; flex-direction:row; justify-content: center; align-content: center;">
                    <span style="font-size:13px; font-weight:bold;">Reporte de Logística</span><br>
                    <span style="font-size:9px; font-style:italic;">Del $fchInicialHumanice al $fchTerminoHumanice</span>
                </div>
        
            </td>
            <td style="width:130px; text-align:center;">
                <div style="display:flex; flex-direction:row; justify-content: center; align-content: center;">
                    <img style="width:60px;" src="images/Logo-CC-Largo.png">
                </div>
            </td>
        </tr>
    </table>
        
EOF;
        
# Escribe el HTML en PDF
$pdf->writeHTML($bloque1, false, false, false, false, '');

/*=============================================
CUERPO DEL PDF
=============================================*/

/* TOTAL DE PEDIDOS ENTREGADOS
-------------------------------------------------- */
$pedidosEntregados = ControladorLogistica::ctrTraerPedidosEntregados($fechaInicial, $fechaTermino);
$totalPedidosEntregados = count($pedidosEntregados);

/* ACUMULAR ID DE PEDIDOS ENTREGADOS
-------------------------------------------------- */
$idsPedidos = "Pedidos entregados (10 primeros): ";
foreach($pedidosEntregados as $key => $value){
    $idsPedidos .= $value["Id_Pedido"] . ", " ;

    # VALIDACION PARA IMPIRMIR SOLO 10 PEDIDOS
    if ( $key+1 == 10 && count($pedidosEntregados) > 10 ) {
        $idsPedidos .= "...";
        break;
    }
}

$bloque2 = <<<EOF

    <br>
    <table style="background-color: #D1ECF1; opacity: 0.5; font-size: 9.5px; color: #35747E; padding: 5px 10x; text-align:justify;">
        <tr>
            <td><span style="font-weight: bold;">Nota:</span> Este reporte únicamente muestra un resumen de todos los pedidos que ya han sido entregados. Por lo tanto, todo pedido que se encuentre en producción en estos momentos no se tomará en cuenta para las estadísticas mostradas en este reporte.</td>
        </tr>
    </table>

    <br><br>
    <table style="font-size: 9.5px; padding: 5px 10px;">
        <tr>
            <td style="border: 0.5px solid #666; width: 150px; font-weight: bold;">Total de pedidos entregados</td>
            <td style="border: 0.5px solid #666; width: 380px; text-align: center;">$totalPedidosEntregados pedidos entregados en total.</td>
        </tr>
        <tr>
            <td style="border: 0.5px solid #666;" colspan="2">$idsPedidos</td>
        </tr>
    </table>

    <br><br>

EOF;

# Escribe el HTML en PDF
$pdf->writeHTML($bloque2, false, false, false, false, '');

/*=============================================
ESTADOS DE LOS PEDIDOS
=============================================*/

/* TODOS LOS ESTADOS DEL PEDIDO
-------------------------------------------------- */
$tabla = "estatus_pedido";
$estadosPedido = ControladorLogistica::ctrTraerEstadosPedido($tabla, null, null, null, null);

$bloque3 = <<<EOF
    
    <table style="font-size: 9.5px; padding: 5px 10px;">
        <tr>
            <td style="border: 0.5px solid #666; font-weight: bold; text-align: center;">Estado de pedido</td>
            <td style="border: 0.5px solid #666; font-weight: bold; text-align: center;">Tiempo promedio transcurrido</td>
        </tr>
    </table>
    
EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

/* TRAER PEDIDOS POR ESTADO
-------------------------------------------------- */
$tabla = "pedido";
$item1 = "Id_Pedido2";
$item2 = "Id_Estatus1";

$estadosConRetraso = [];

foreach ( $estadosPedido as $key => $value ) {

$nombreEstatus = $value["Nombre_Estatus"];
$idEstatus = $value["Id_Estatus"];
$idEstatusSiguiente = intval($value["Id_Estatus"])+1;

$sumaDiff = new DateTime("0000-00-00 00:00:00");

foreach ( $pedidosEntregados as $key => $value2 ) {

$idPedido = $value2["Id_Pedido"];

$pedidoEstadoActual = ControladorLogistica::ctrTraerEstadosPedido($tabla, $item1, $idPedido, $item2, $idEstatus);
$pedidoEstadoSiguiente = ControladorLogistica::ctrTraerEstadosPedido($tabla, $item1, $idPedido, $item2, $idEstatusSiguiente);

#Evalua que se haga esto hasta el ultimo estado del pedido
if ( $idEstatusSiguiente < 9 ) {

    $fechaEntrega = new DateTime($pedidoEstadoActual["Fecha_Entrega"]);
    $fechaActualizacion1 = new DateTime($pedidoEstadoActual["Fecha_Actualizacion"]);
    $fechaActualizacion2 = new DateTime($pedidoEstadoSiguiente["Fecha_Actualizacion"]);

    $interval = $fechaActualizacion1->diff($fechaActualizacion2);
    $sumaDiff->add($interval);

}

}

$diferenciaObtenida = strftime("%A, %d de %B del %Y", strtotime($sumaDiff->format('Y-m-d H:i:s')));
echo "<pre>"; print_r($sumaDiff->format('Y-m-d H:i:s')); echo "</pre>";

$bloque4 = <<<EOF
        
    <table style="font-size: 9.5px; padding: 5px 10px;">
        <tr>
            <td style="border: 0.5px solid #666;">$nombreEstatus</td>
            <td style="border: 0.5px solid #666;">$diferenciaObtenida</td>
        </tr>
    </table>
        
EOF;
    
# Escribe el HTML en PDF
$pdf->writeHTML($bloque4, false, false, false, false, '');


}
       
# Salida del archivo
$pdf->Output('reporte_logistica.pdf');

}


}

$reporteLogistica = new imprimirReporteLogisticaPorFechas();
$reporteLogistica->fechaInicio = $_GET["fechaInicio"];
$reporteLogistica->fechaFin = $_GET["fechaFin"];
$reporteLogistica->traerReporteLogisticaPorFechas();