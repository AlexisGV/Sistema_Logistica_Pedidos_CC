<?php

class imprimirReporteLogisticaPorFechas{

    public $fechaInicio;
    public $fechaFin;

    public function traerReporteLogisticaPorFechas(){

    }

}

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

# Indica que el PDF puede tener varias páginas
$pdf->startPageGroup();

# Agrega una nueva página
$pdf->AddPage();

$bloque1 = <<<EOF

    <table>
        <tr>
            <td style="width:135px; text-align:center;">
                <div style="display:flex; flex-direction:row; justify-content: center; align-content: center;">
                    <img style="width:60px;" src="images/Logo-CC-Largo.png">
                </div>
            </td>
            <td style="width:270px; text-align:center;">
                    
                <div style="display:flex; flex-direction:row; justify-content: center; align-content: center;">
                    <span style="font-size:14px; font-style:bold;">Reporte de Logística</span><br>
                    <span style="font-size:9px; font-style:bold;">Del Jueves 4 de Enero del 2021 al Jueves 4 de Febrero del 2021</span>
                </div>

            </td>
            <td style="width:135px; text-align:center;">
                <div style="display:flex; flex-direction:row; justify-content: center; align-content: center;">
                    <img style="width:60px;" src="images/Logo-CC-Largo.png">
                </div>
            </td>
        </tr>
    </table>

EOF;

# Escribe el HTML en PDF
$pdf->writeHTML($bloque1, false, false, false, false, '');

# Salida del archivo
$pdf->Output('reporte_logistica.pdf');

$reporteLogistica = new imprimirReporteLogisticaPorFechas();
$reporteLogistica->fechaInicio = $_GET["fechaInicio"];
$reporteLogistica->fechaFin = $_GET["fechaFin"];
$reporteLogistica->traerReporteLogisticaPorFechas();