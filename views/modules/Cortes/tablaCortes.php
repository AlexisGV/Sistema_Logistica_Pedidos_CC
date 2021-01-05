<table class="table table-hover table-striped text-md-center tablas dt-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 3px; max-width: 8px;">#</th>
            <th scope="col">Imagen</th>
            <th scope="col">Corte</th>
            <th scope="col">Abreviación</th>
            <th scope="col">Acciones</th>
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
                        <img src="<?php echo $value["Foto_Corte"]; ?>" alt="" class="img-thumbnail p-0" style="width: 50px;">
                    <?php else : ?>
                        <img src="views/img/Cortes/defaultCorte.png" alt="" class="img-thumbnail p-0" style="width: 50px;">
                    <?php endif ?>
                </td>
                <td><?php echo $value["Corte"]; ?></td>
                <td><?php echo $value["Abreviacion_Corte"]; ?></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-warning btnEditarCorte" idCorte="<?php echo $value["Id_Corte"]; ?>" data-toggle="modal" data-target="#modalEditCorte"><i class="fas fa-edit text-white"></i></button>
                        <button class="btn btn-danger btnEliminarCorte" idCorte="<?php echo $value["Id_Corte"]; ?>" fotoCorte="<?php echo $value["Foto_Corte"]; ?>" nomCorte="<?php echo $value["Corte"]; ?>"><i class="fas fa-trash-alt text-white"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>