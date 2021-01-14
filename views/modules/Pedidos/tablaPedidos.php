<?php
setlocale(LC_ALL,"spanish.utf8");
date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");
$fechaActual = date('Y-m-d');
?>

<table class="table table-hover table-striped text-md-center tablas dt-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 3px; max-width: 8px;">#</th>
            <th scope="col">N° de Pedido</th>
            <th scope="col">Fecha Inicio</th>
            <th scope="col">Fecha Compromiso</th>
            <th scope="col">Días restantes</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $tabla = "pedido";
        $item = "Fecha_Compromiso";
        $marcas = ControladorPedidos::ctrTraerRegistrosDescendentes($tabla, $item);
        foreach ($marcas as $key => $value) :
        ?>
            <tr>
                <td scope="row" style="width: 3px; max-width: 8px;"><?php echo $key + 1; ?></td>
                <td><?php echo $value["Id_Pedido"]; ?></td>
                <td><?php echo strftime("%A, %d de %B del %Y a las %r", strtotime($value["Fecha_Inicio"])); ?></td>
                <td><?php echo strftime("%A, %d de %B del %Y a las %r", strtotime($value["Fecha_Compromiso"])); ?></td>
                <td>
                    <?php
                        $date1 = new DateTime($fechaActual);
                        $date2 = new DateTime($value["Fecha_Compromiso"]);
                        $diff = $date1->diff($date2);
                        $dias = $diff->days;

                        if ( $dias > 14 ) {
                            echo '<span class="badge bg-success" style="font-size:1rem;">'. $dias . ' días</span>';
                        }else if ( $dias <= 14 && $dias > 7 ) {
                            echo '<span class="badge bg-info" style="font-size:1rem;">'. $dias . ' días</span>';
                        }else if ( $dias <= 7 && $dias > 3 ) {
                            echo '<span class="badge bg-warning" style="font-size:1rem;">'. $dias . ' días</span>';
                        }else{
                            echo '<span class="badge bg-danger" style="font-size:1rem;">'. $dias . ' días</span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        $tabla = "actualizaciones_pedido";
                        $idPedido = $value["Id_Pedido"];
                        $item = "Orden";
                        $estados = ControladorPedidos::ctrTraerEstadoPedido($tabla, $idPedido, $item);
                        foreach ($estados as $key => $value) :

                            $orden = $value["Orden"];
                            $estado = $value["Nombre_Estatus"];

                            if ( $orden == 1 ) :
                                echo '<span class="badge bg-primary" style="font-size:1rem;">'. $estado . '</span>';
                            elseif ( $orden == 2 ):
                                echo '<span class="badge bg-success" style="font-size:1rem;">'. $estado . '</span>';
                            elseif ( $orden == 3 ):
                                echo '<span class="badge bg-danger" style="font-size:1rem;">'. $estado . '</span>';
                            elseif ( $orden == 4 ):
                                echo '<span class="badge bg-indigo" style="font-size:1rem;">'. $estado . '</span>';
                            elseif ( $orden == 5 ):
                                echo '<span class="badge bg-navy" style="font-size:1rem;">'. $estado . '</span>';
                            elseif ( $orden == 6 ):
                                echo '<span class="badge bg-danger" style="font-size:1rem;">'. $estado . '</span>';
                            elseif ( $orden == 7 ):
                                echo '<span class="badge bg-success" style="font-size:1rem;">'. $estado . '</span>';
                            elseif ( $orden == 8 ):
                                echo '<span class="badge bg-primary" style="font-size:1rem;">'. $estado . '</span>';
                            elseif ( $orden == 9 ):
                                echo '<span class="badge bg-maroon" style="font-size:1rem;">'. $estado . '</span>';
                            endif;

                        endforeach;
                    ?>
                </td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-success btnVerDetallePedido" idPedido="<?php echo $idPedido; ?>" data-toggle="modal" data-target="#modalVerDetallePedido"><i class="fas fa-eye text-white"></i></button>
                        <button class="btn btn-warning btnEditarPedido" idPedido="<?php echo $idPedido; ?>" data-toggle="modal" data-target="#modalEditPedido"><i class="fas fa-edit text-white"></i></button>
                        <button class="btn btn-danger btnEliminarPedido" idPedido="<?php echo $idPedido; ?>"><i class="fas fa-trash-alt text-white"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>