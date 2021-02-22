<?php
setlocale(LC_ALL, "es_MX.UTF-8");
date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");
$fechaActual = date('Y-m-d');
?>

<table id="tablaActualizarPedidos" class="table table-hover table-striped text-center tablas dt-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 3px; max-width: 8px;">#</th>
            <th scope="col">N° Pedido</th>
            <?php if (intval($permisosAsignacion["U"]) == 1) : ?>
                <th scope="col">Responsable</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $tabla = "pedido";
        $item = "Orden";
        $ordenEstado = 3;
        $avance = 30;

        $pedidos = ControladorLogistica::ctrTraerPedidosPorEstado($tabla, $item, $ordenEstado, $avance);
        foreach ($pedidos as $key => $value) :

            $idPedido = $value["Id_Pedido"];
            $avanceActual = $value["Avance_Estado"];
        ?>
            <tr id="filaPedido<?php echo $idPedido ?>">
                <td scope="row" style="width: 3px; max-width: 8px;"><?php echo $key+1 ?></td>
                <td>
                    <span><?php echo $value["Id_Pedido"] ?></span><br>
                    <?php if (intval($permisosAsignacion["R"]) == 1) : ?>
                        <button class="btn btn-sm bg-indigo my-1 btnVerDetallePedidoParaLogistica" idPedido="<?php echo $idPedido; ?>" data-toggle="modal" data-target="#modalVerDetallePedido">Ver detalles</button><br>
                    <?php endif; ?>

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
                <?php if (intval($permisosAsignacion["U"]) == 1) : ?>
                    <td>
                        <div class="form-group optionResponsable">
                            <select name="ingResponsable" class="form-control select2 responsable" data-placeholder="Responsable ...">
                                <option></option>
                                <?php
                                $usuarios = ControladorUsuarios::ctrTraerUsuariosParaAsignar();
                                foreach ($usuarios as $key => $value2) :
                                ?>
                                    <option value="<?php echo $value2["Id_Usuario"]; ?>"><?php echo $value2["Nombre_Usuario"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php echo '<script> 
                                        $( document ).ready(function() {
                                            if ( screen.width <= 758 ) {
                                                $(".responsable:last").select2();
                                            }
                                        });
                                    </script>' ?>
                        <button type="button" class="btn btn-sm btn-primary btnAsignarUsuario" idPedido="<?php echo $idPedido; ?>" ordenEstado="<?php echo $ordenEstado ?>" avanceEstado="<?php echo intval($avanceActual) + 10; ?>">Asignar responsable</button>
                        <?php
                        $comentarioPedido = ControladorLogistica::ctrTraerComentario($value["Id_Pedido"], $ordenEstado);

                        if ($comentarioPedido) :
                        ?>
                            <button type="button" class="btn btn-sm btn-info btnViewComentario mt-1" idPedido="<?php echo $value["Id_Pedido"]; ?>" orden="<?php echo $ordenEstado; ?>" data-toggle="modal" data-target="#modalViewComentario">Ver comentario</button>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>