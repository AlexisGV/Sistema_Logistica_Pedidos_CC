<table class="table table-hover table-striped text-md-center tablas dt-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 3px; max-width: 8px;">#</th>
            <th scope="col">Imagen</th>
            <th scope="col">Corte</th>
            <th scope="col">Abreviación</th>
            <?php if (intval($permisosAdministrarCortes["U"]) == 1 || intval($permisosAdministrarCortes["D"]) == 1) : ?>
                <th scope="col">Acciones</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $tabla = "corte";
        $item = "Corte";
        $acabados = ControladorCorte::ctrTraerCorte($tabla, $item, null);
        foreach ($acabados as $key => $value) :
        ?>
            <tr>
                <td scope="row" style="width: 3px; max-width: 8px;"><?php echo $key + 1; ?></td>
                <td>
                    <?php if ($value["Foto_Corte"] != "") : ?>
                        <a href="<?php echo $value["Foto_Corte"]; ?>" data-toggle="lightbox" data-max-width="600" data-title="<?php echo $value["Corte"]; ?>">
                            <img src="<?php echo $value["Foto_Corte"]; ?>" alt="" class="img-thumbnail p-0" style="width: 50px;">
                        </a>
                    <?php else : ?>
                        <a href="views/img/Cortes/defaultCorte.png" data-toggle="lightbox" data-max-width="600" data-title="<?php echo $value["Corte"]; ?>" data-footer="Sin imagen disponible">
                            <img src="views/img/Cortes/defaultCorte.png" alt="" class="img-thumbnail p-0" style="width: 50px;">
                        </a>
                    <?php endif ?>
                </td>
                <td><?php echo $value["Corte"]; ?></td>
                <td><?php echo $value["Abreviacion_Corte"]; ?></td>
                <?php if (intval($permisosAdministrarCortes["U"]) == 1 || intval($permisosAdministrarCortes["D"]) == 1) : ?>
                    <td>
                        <div class="btn-group">
                            <?php if (intval($permisosAdministrarCortes["U"]) == 1) : ?>
                                <button class="btn btn-warning btnEditarCorte" idCorte="<?php echo $value["Id_Corte"]; ?>" data-toggle="modal" data-target="#modalEditCorte"><i class="fas fa-edit text-white"></i></button>
                            <?php endif; ?>
                            <?php if (intval($permisosAdministrarCortes["D"]) == 1) : ?>
                                <button class="btn btn-danger btnEliminarCorte" idCorte="<?php echo $value["Id_Corte"]; ?>" fotoCorte="<?php echo $value["Foto_Corte"]; ?>" nomCorte="<?php echo $value["Corte"]; ?>"><i class="fas fa-trash-alt text-white"></i></button>
                            <?php endif; ?>
                        </div>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>