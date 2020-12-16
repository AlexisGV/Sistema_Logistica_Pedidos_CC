<table class="table table-hover table-striped text-md-center tablas dt-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 3px; max-width: 10px;">#</th>
            <th scope="col">Rol</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $item = "Tipo_User";
        $roles = ControladorRoles::ctrObtenerRoles($item, null);
        foreach ($roles as $key => $value) :
        ?>
            <tr>
                <td scope="row" style="width: 3px; max-width: 10px;"><?php echo $key + 1; ?></td>
                <td><?php echo $value["Tipo_User"]; ?></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-secondary btnEditarPermisos" idRol="<?php echo $value["Id_Tipo_User"]; ?>" data-toggle="modal" data-target="#modalEditarPermisos"><i class="fas fa-key"></i></button>
                        <button class="btn btn-warning btnEditarRol" idRol="<?php echo $value["Id_Tipo_User"]; ?>" data-toggle="modal" data-target="#modalEditRol"><i class="fas fa-edit text-white"></i></button>
                        <button class="btn btn-danger btnEliminarRol" idRol="<?php echo $value["Id_Tipo_User"]; ?>"><i class="fas fa-trash-alt text-white"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>