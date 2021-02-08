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

$pdf->SetTitle('Reporte de Logistica ('.substr($fechaInicial,0,10). ' a ' . substr($fechaTermino,0,10).')');
        
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
            <td style="width:120px; text-align:center;">
                <div style="display:flex; flex-direction:row; justify-content: center; align-content: center;">
                    <img style="width:60px;" src="images/Logo-CC-Largo.png">
                </div>
            </td>
            <td style="width:300px; text-align:center;">
                            
                <div style="display:flex; flex-direction:row; justify-content: center; align-content: center;">
                    <span style="font-size:13px; font-weight:bold;">Reporte de Logística</span><br>
                    <span style="font-size:9px; font-style:italic;">Del $fchInicialHumanice al $fchTerminoHumanice</span>
                </div>
        
            </td>
            <td style="width:120px; text-align:center;">
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
$totalPedidosEntregados = 0;
$pedidosEntregados = ControladorLogistica::ctrTraerPedidosEntregados($fechaInicial, $fechaTermino);
$totalPedidosEntregados = count($pedidosEntregados);

/* ACUMULAR ID DE PEDIDOS ENTREGADOS
-------------------------------------------------- */
$idsPedidos = "Pedidos entregados: ";
foreach($pedidosEntregados as $key => $value){
    $idsPedidos .= $value["Id_Pedido"] . ", " ;

    # VALIDACION PARA IMPIRMIR SOLO 10 PEDIDOS
    if ( $key+1 == 10 && count($pedidosEntregados) > 10 ) {
        $idsPedidos .= "...";
        break;
    }
}

/* ACUMULAR PEDIDOS ENTREGADOS CON RETRASO
-------------------------------------------------- */
$totalPedidosRetardados = 0;
$totalPedidosEnTimepo = 0;
$pedidosRetardados = "";
$pedidosEnTiempo = "";
foreach($pedidosEntregados as $key => $value){
    $fechaCompromiso = new DateTime($value["Fecha_Compromiso"]);
    $fechaEntrega = new DateTime($value["Fecha_Entrega"]);

    if ($fechaEntrega > $fechaCompromiso) {
        $totalPedidosRetardados++;
        if ($key <= 10) {
            $pedidosRetardados .= $value["Id_Pedido"] . ", ";
        }
    } else if ( $fechaEntrega <= $fechaCompromiso ) {
        $totalPedidosEnTimepo++;
        if ($key <= 10) {
            $pedidosEnTiempo .= $value["Id_Pedido"] . ", ";
        }
    }
}

if ( $pedidosRetardados == "" ) {
    $pedidosRetardados = "No hay información disponible";
}

if ( $pedidosEnTiempo == "" ) {
    $pedidosEnTiempo = "No hay información disponible.";
}

$bloque2 = <<<EOF

    <br><br>
    <table style="background-color: #D1ECF1; opacity: 0.5; font-size: 9.5px; color: #35747E; padding: 5px 10x; text-align:justify;">
        <tr>
            <td><span style="font-weight: bold;">Nota:</span> Este reporte únicamente muestra un resumen de todos los pedidos que ya han sido entregados. Por lo tanto, todo pedido que se encuentre en producción o cualquier otro estado de pedido diferente a entregado en estos momentos, no se tomará en cuenta para las estadísticas mostradas en este reporte.</td>
        </tr>
    </table>

    <h4 style="text-align:center;">Estadísticas generales sobre los pedidos entregados en este periodo</h4>

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

    <table style="font-size: 8.5px; padding: 5px 0x; text-align:justify;">
        <tr>
            <td><span style="font-weight: bold;">Nota:</span> Esta tabla muestra únicamente los primeros 10 Números de los pedidos que fueron entregados en este periodo, independientemente si fueron entregados a tiempo o no. Si deseas observar todos los números de pedidos y sus detalles, así como el recorrido de logística que se llevó en cada uno, puedes hacerlo desde el sistema en el apartado de "administrar pedidos".</td>
        </tr>
    </table>

    <br><br>
    <table style="font-size: 9.5px; padding: 5px 10px;">
        <tr>
            <td style="border: 0.5px solid #666; width: 150px; font-weight: bold;">Entregados a tiempo</td>
            <td style="border: 0.5px solid #666; width: 380px; text-align: center;">$totalPedidosEnTimepo pedidos entregados en tiempo y forma.</td>
        </tr>
        <tr>
            <td style="border: 0.5px solid #666;" colspan="2">Pedidos en tiempo y forma: $pedidosEnTiempo</td>
        </tr>
    </table>

    <table style="font-size: 8.5px; padding: 5px 0x; text-align:justify;">
        <tr>
            <td><span style="font-weight: bold;">Nota:</span> Esta tabla únicamente muestra 10 números de pedidos que fueron entregados en tiempo y forma, pero eso no afecta las estadisticas si el valor mostrado en la fila "Entregados a tiempo" es mayor a 10.</td>
        </tr>
    </table>

    <br><br>
    <table style="font-size: 9.5px; padding: 5px 10px;">
        <tr>
            <td style="border: 0.5px solid #666; width: 150px; font-weight: bold;">Entregados con retraso</td>
            <td style="border: 0.5px solid #666; width: 380px; text-align: center;">$totalPedidosRetardados pedidos entregados en con retraso.</td>
        </tr>
        <tr>
            <td style="border: 0.5px solid #666;" colspan="2">Pedidos con retraso: $pedidosRetardados</td>
        </tr>
    </table>

    <table style="font-size: 8.5px; padding: 5px 0x; text-align:justify;">
        <tr>
            <td><span style="font-weight: bold;">Nota:</span> Esta tabla únicamente muestra 10 números de pedidos que fueron entregados con retraso, pero eso no afecta las estadisticas si el valor mostrado en la fila "Entregados con retraso" es mayor a 10.</td>
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

    <h4 style="text-align:center;">Estimación de los tiempos transcurridos de un estado de pedido a otro</h4>
    <div style="font-size: 9.5px; padding: 5px 10px; text-align:justify;">La siguiente tabla muestra del lado izquierdo todos los estados de pedido existentes, es decir, la logística que debe de llevar cada pedido. Y en la parte derecha, muestra un promedio del tiempo que está pasando de un estado de pedido a otro, con el objetivo de ver cuanto está tardando la producción de los mismos.<div><br>
    
    <table style="font-size: 9.5px; padding: 5px 10px;">
        <tr>
            <td style="border: 0.5px solid #666; font-weight: bold; text-align: center;">Estados de pedido</td>
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

// $sumaDiff = new DateTime("0001-01-01 00:00:00");
$sumaDiff = 0;

foreach ( $pedidosEntregados as $key2 => $value2 ) {

$idPedido = $value2["Id_Pedido"];

$pedidoEstadoActual = ControladorLogistica::ctrTraerEstadosPedido($tabla, $item1, $idPedido, $item2, $idEstatus);
$pedidoEstadoSiguiente = ControladorLogistica::ctrTraerEstadosPedido($tabla, $item1, $idPedido, $item2, $idEstatusSiguiente);

#Evalua que se haga esto hasta el ultimo estado del pedido
if ( $idEstatusSiguiente < 10 ) {

    $fechaActualizacion1 = new DateTime($pedidoEstadoActual["Fecha_Actualizacion"]);
    $fechaActualizacion2 = new DateTime($pedidoEstadoSiguiente["Fecha_Actualizacion"]);

    $interval = $fechaActualizacion1->diff($fechaActualizacion2);
    $sumaDiff += ($interval->days*86400 + $interval->h*3600 + $interval->i*60 + $interval->s);

}

}

$promedioSegundos = $sumaDiff / $totalPedidosEntregados;
$horas = floor($promedioSegundos / 3600);
$minutos = floor(($promedioSegundos - ($horas * 3600)) / 60);
$segundos = $promedioSegundos - ($horas * 3600) - ($minutos * 60);

if  ($idEstatus != 9) :
$diferenciaObtenida = $horas . " horas " . $minutos . " minutos " . number_format($segundos, 2) . " segundos.";
else :
$diferenciaObtenida = "Este es el último estado de pedido";
endif;

$bloque4 = <<<EOF
        
    <table style="font-size: 9.5px; padding: 5px 10px;">
        <tr>
            <td style="border: 0.5px solid #666;">$nombreEstatus</td>
            <td style="border: 0.5px solid #666; text-align:center;">$diferenciaObtenida</td>
        </tr>
    </table>
        
EOF;
    
# Escribe el HTML en PDF
$pdf->writeHTML($bloque4, false, false, false, false, '');


}
       
# Salida del archivo
$pdf->Output('replog_'.substr(str_replace("-","",$fechaInicial),0,8). '_to_' . substr(str_replace("-","",$fechaTermino),0,8));

}


}

$reporteLogistica = new imprimirReporteLogisticaPorFechas();
$reporteLogistica->fechaInicio = $_GET["fechaInicio"];
$reporteLogistica->fechaFin = $_GET["fechaFin"];
$reporteLogistica->traerReporteLogisticaPorFechas();