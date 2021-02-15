<table class="table table-hover table-striped text-md-center tablas dt-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 3px; max-width: 8px;">#</th>
            <th scope="col">Imagen</th>
            <th scope="col">Acabado</th>
            <th scope="col">Abreviación</th>
            <?php if (intval($permisosAdministrarAcabados["U"]) == 1 || intval($permisosAdministrarAcabados["D"]) == 1) : ?>
                <th scope="col">Acciones</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $tabla = "acabado";
        $item = "Acabado";
        $acabados = ControladorAcabado::ctrTraerAcabado($tabla, $item, null);
        foreach ($acabados as $key => $value) :
        ?>
            <tr>
                <td scope="row" style="width: 3px; max-width: 8px;"><?php echo $key + 1; ?></td>
                <td>
                    <?php if ($value["Foto_Acabado"] != "") : ?>
                        <a href="<?php echo $value["Foto_Acabado"]; ?>" data-toggle="lightbox" data-max-width="600" data-title="<?php echo $value["Acabado"]; ?>">
                            <img src="<?php echo $value["Foto_Acabado"]; ?>" alt="" class="img-thumbnail p-0" style="width: 50px;">
                        </a>
                    <?php else : ?>
                        <a href="views/img/Acabados/defaultAcabado.png" data-toggle="lightbox" data-max-width="600" data-title="<?php echo $value["Acabado"]; ?>" data-footer="Sin imagen disponible">
                            <img src="views/img/Acabados/defaultAcabado.png" alt="" class="img-thumbnail p-0" style="width: 50px;">
                        </a>
                    <?php endif ?>
                </td>
                <td><?php echo $value["Acabado"]; ?></td>
                <td><?php echo $value["Abreviacion_Acabado"]; ?></td>
                <?php if (intval($permisosAdministrarAcabados["U"]) == 1 || intval($permisosAdministrarAcabados["D"]) == 1) : ?>
                    <td>
                        <div class="btn-group">
                            <?php if (intval($permisosAdministrarAcabados["U"]) == 1) : ?>
                                <button class="btn btn-warning btnEditarAcabado" idAcabado="<?php echo $value["Id_Acabado"]; ?>" data-toggle="modal" data-target="#modalEditAcabado"><i class="fas fa-edit text-white"></i></button>
                            <?php endif; ?>
                            <?php if (intval($permisosAdministrarAcabados["D"]) == 1) : ?>
                                <button class="btn btn-danger btnEliminarAcabado" idAcabado="<?php echo $value["Id_Acabado"]; ?>" fotoAcabado="<?php echo $value["Foto_Acabado"]; ?>" nomAcabado="<?php echo $value["Acabado"]; ?>"><i class="fas fa-trash-alt text-white"></i></button>
                            <?php endif; ?>
                        </div>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>