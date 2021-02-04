<table class="table table-hover table-striped text-md-center tablas dt-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 3px; max-width: 8px;">#</th>
            <th scope="col">Imagen</th>
            <th scope="col">Forma</th>
            <th scope="col">Abreviación</th>
            <?php if (intval($permisosAdministrarFormas["U"]) == 1 || intval($permisosAdministrarFormas["D"]) == 1) : ?>
                <th scope="col">Acciones</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $tabla = "forma";
        $item = "Forma";
        $formas = ControladorForma::ctrTraerForma($tabla, $item, null);
        foreach ($formas as $key => $value) :
        ?>
            <tr>
                <td scope="row" style="width: 3px; max-width: 8px;"><?php echo $key + 1; ?></td>
                <td>
                    <?php if ($value["Foto_Forma"] != "") : ?>
                        <img src="<?php echo $value["Foto_Forma"]; ?>" alt="" class="img-thumbnail p-0" style="width: 50px;">
                    <?php else : ?>
                        <img src="views/img/Formas/defaultForma.png" alt="" class="img-thumbnail p-0" style="width: 50px;">
                    <?php endif ?>
                </td>
                <td><?php echo $value["Forma"]; ?></td>
                <td><?php echo $value["Abreviacion_Forma"]; ?></td>
                <?php if (intval($permisosAdministrarFormas["U"]) == 1 || intval($permisosAdministrarFormas["D"]) == 1) : ?>
                    <td>
                        <div class="btn-group">
                            <?php if (intval($permisosAdministrarFormas["U"]) == 1) : ?>
                                <button class="btn btn-warning btnEditarForma" idForma="<?php echo $value["Id_Forma"]; ?>" data-toggle="modal" data-target="#modalEditForma"><i class="fas fa-edit text-white"></i></button>
                            <?php endif; ?>
                            <?php if (intval($permisosAdministrarFormas["D"]) == 1) : ?>
                                <button class="btn btn-danger btnEliminarForma" idForma="<?php echo $value["Id_Forma"]; ?>" fotoForma="<?php echo $value["Foto_Forma"]; ?>" nomForma="<?php echo $value["Forma"]; ?>"><i class="fas fa-trash-alt text-white"></i></button>
                            <?php endif; ?>
                        </div>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>