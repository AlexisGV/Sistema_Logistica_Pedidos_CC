<table class="table table-hover table-striped text-md-center tablas dt-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 3px; max-width: 8px;">#</th>
            <th scope="col">Imagen</th>
            <th scope="col">Marca</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $tabla = "marca";
        $item = "Marca";
        $marcas = ControladorMarca::ctrTraerMarca($tabla, $item, null);
        foreach ($marcas as $key => $value) :
        ?>
            <tr>
                <td scope="row" style="width: 3px; max-width: 8px;"><?php echo $key + 1; ?></td>
                <td>
                    <?php if ($value["Foto_Marca"] != "") : ?>
                        <img src="<?php echo $value["Foto_Marca"]; ?>" alt="" class="img-thumbnail p-0" style="width: 50px;">
                    <?php else : ?>
                        <img src="views/img/Marcas/defaultMarca.png" alt="" class="img-thumbnail p-0" style="width: 50px;">
                    <?php endif ?>
                </td>
                <td><?php echo $value["Marca"]; ?></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-warning btnEditarMarca" idMarca="<?php echo $value["Id_Marca"]; ?>" data-toggle="modal" data-target="#modalEditMarca"><i class="fas fa-edit text-white"></i></button>
                        <button class="btn btn-danger btnEliminarMarca" idMarca="<?php echo $value["Id_Marca"]; ?>" fotoMarca="<?php echo $value["Foto_Marca"]; ?>" nomMarca="<?php echo $value["Marca"]; ?>"><i class="fas fa-trash-alt text-white"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>