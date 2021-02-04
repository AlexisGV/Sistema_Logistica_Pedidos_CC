<table class="table table-hover table-striped text-md-center tablas dt-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 3px; max-width: 10px;">#</th>
            <th scope="col">Rol</th>
            <th scope="col" style="max-width: 45%;">Descripción</th>
            <?php if ($_SESSION["tipoUsuarioPorNombre"] == "Administrador" || intval($permisosAdministrarRoles["U"]) == 1 || intval($permisosAdministrarRoles["D"]) == 1) : ?>
                <th scope="col">Acciones</th>
            <?php endif; ?>
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
                <td><?php echo $value["Descripcion_Tipo_User"]; ?></td>
                <?php if ($_SESSION["tipoUsuarioPorNombre"] == "Administrador" || intval($permisosAdministrarRoles["U"]) == 1 || intval($permisosAdministrarRoles["D"]) == 1) : ?>
                    <td>
                        <div class="btn-group">
                            <?php if ($_SESSION["tipoUsuarioPorNombre"] == "Administrador") : ?>
                                <button class="btn bg-navy btnEditarPermisos" idRol="<?php echo $value["Id_Tipo_User"]; ?>" data-toggle="modal" data-target="#modalEditarPermisos"><i class="fas fa-key"></i></button>
                            <?php endif; ?>

                            <?php if (intval($permisosAdministrarRoles["U"]) == 1) : ?>
                                <button class="btn btn-warning btnEditarRol" idRol="<?php echo $value["Id_Tipo_User"]; ?>" data-toggle="modal" data-target="#modalEditRol"><i class="fas fa-edit text-white"></i></button>
                            <?php endif; ?>

                            <?php if (intval($permisosAdministrarRoles["D"]) == 1) : ?>
                                <button class="btn btn-danger btnEliminarRol" idRol="<?php echo $value["Id_Tipo_User"]; ?>"><i class="fas fa-trash-alt text-white"></i></button>
                            <?php endif; ?>
                        </div>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>