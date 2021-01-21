<?php
setlocale(LC_ALL, "spanish.utf8");
date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");
$fechaActual = date('Y-m-d');
?>

<table class="table table-hover table-striped text-center tablas dt-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 3px; max-width: 8px;">#</th>
            <th scope="col">N° Pedido</th>
            <th scope="col">Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $tabla = "pedido";
        $item = "Orden";
        $ordenEstado = 1;

        $pedidos = ControladorLogistica::ctrTraerPedidosPorEstado($tabla, $item, $ordenEstado);
        foreach ($pedidos as $key => $value) :
        ?>
            <tr>
                <td scope="row" style="width: 3px; max-width: 8px;">1</td>
                <td>
                    <span><?php echo $value["Id_Pedido"] ?></span><br>
                    <button class="btn btn-sm bg-indigo my-1 btnVerDetallePedidoParaLogistica" idPedido="<?php echo $value["Id_Pedido"] ?>"  data-toggle="modal" data-target="#modalVerDetallePedido">Ver detalles</button><br>

                    <?php

                    $date1 = new DateTime($fechaActual);
                    $date2 = new DateTime($value["Fecha_Compromiso"]);
                    $diff = $date1->diff($date2);
                    $dias = $diff->days;

                    if ($dias == 0) {
                        echo '<span class="badge bg-navy" style="font-size:1rem;">Hoy se entrega</span>';
                    } else {
                        if (($diff->invert == 1)) :

                            echo '<span class="badge bg-danger" style="font-size:1rem;">' . $dias . ' días de retraso</span>';

                        else :

                            if ($dias > 14) {
                                echo '<span class="badge bg-success" style="font-size:1rem;">' . $dias . ' días</span>';
                            } else if ($dias <= 14 && $dias > 7) {
                                echo '<span class="badge bg-info" style="font-size:1rem;">' . $dias . ' días</span>';
                            } else if ($dias <= 7 && $dias > 3) {
                                echo '<span class="badge bg-warning" style="font-size:1rem;">' . $dias . ' días</span>';
                            } else {
                                echo '<span class="badge bg-danger" style="font-size:1rem;">' . $dias . ' días</span>';
                            }

                        endif;
                    }

                    ?>
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-md btn-primary btnActualizarEstado" idPedido="<?php echo $value["Id_Pedido"] ?>" ordenEstado="<?php echo $ordenEstado?>">En tienda</button>
                    </div>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>