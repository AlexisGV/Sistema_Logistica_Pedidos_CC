<?php
setlocale(LC_ALL,"spanish.utf8");
date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");
?>

<table class="table table-hover table-striped text-md-center tablas dt-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 3px; max-width: 8px;">#</th>
            <th scope="col">N° de Pedido</th>
            <th scope="col">Fecha Inicio</th>
            <th scope="col">Fecha Entrega</th>
            <th scope="col">Días restantes</th>
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
                        $date1 = new DateTime($value["Fecha_Inicio"]);
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
                    <div class="btn-group">
                        <button class="btn btn-warning btnEditarPedido" idPedido="<?php echo $value["Id_Pedido"]; ?>" data-toggle="modal" data-target="#modalEditPedido"><i class="fas fa-edit text-white"></i></button>
                        <button class="btn btn-danger btnEliminarPedido" idPedido="<?php echo $value["Id_Pedido"]; ?>"><i class="fas fa-trash-alt text-white"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>