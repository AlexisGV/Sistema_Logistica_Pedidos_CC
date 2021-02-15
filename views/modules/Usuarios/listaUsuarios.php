<table class="table table-hover table-striped text-md-center tablas dt-responsive">
    <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 3px; max-width: 8px;">#</th>
            <th scope="col">Foto</th>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Apodo</th>
            <th scope="col">Tipo</th>
            <?php if (intval($permisosAdministrarUsuarios["U"]) == 1 || intval($permisosAdministrarUsuarios["D"]) == 1) : ?>
                <th scope="col">Acciones</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $usuarios = ControladorUsuarios::ctrTraerUsuarios();
        foreach ($usuarios as $key => $value) :
        ?>
            <tr>
                <td scope="row" style="width: 3px; max-width: 8px;"><?php echo $key + 1; ?></td>
                <td>
                    <?php if ($value["Foto_User"] != "") : ?>
                        <a href="<?php echo $value["Foto_User"]; ?>" data-toggle="lightbox" data-max-width="600" data-title="<?php echo $value["Nombre_Usuario"]; ?>">
                            <img src="<?php echo $value["Foto_User"]; ?>" alt="" class="img-thumbnail p-0" style="width: 50px;">
                        </a>
                    <?php else : ?>
                        <a href="views/img/Usuarios/defaultUser.png" data-toggle="lightbox" data-max-width="600" data-title="<?php echo $value["Nombre_Usuario"]; ?>" data-footer="Sin imagen disponible">
                            <img src="views/img/Usuarios/defaultUser.png" alt="" class="img-thumbnail p-0" style="width: 50px;">
                        </a>
                    <?php endif ?>
                </td>
                <td><?php echo $value["Nombre_Usuario"]; ?></td>
                <td><?php echo $value["Correo"]; ?></td>
                <td><?php echo $value["Apodo"]; ?></td>
                <td><?php echo $value["Tipo_User"]; ?></td>
                <?php if (intval($permisosAdministrarUsuarios["U"]) == 1 || intval($permisosAdministrarUsuarios["D"]) == 1) : ?>
                    <td>
                        <div class="btn-group">
                            <?php if (intval($permisosAdministrarUsuarios["U"]) == 1) : ?>
                                <button class="btn btn-warning btnEditarUsuario" idUsuario="<?php echo $value["Id_Usuario"]; ?>" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fas fa-edit text-white"></i></button>
                            <?php endif; ?>
                            <?php if (intval($permisosAdministrarUsuarios["D"]) == 1) : ?>
                                <button class="btn btn-danger btnEliminarUsuario" idUsuario="<?php echo $value["Id_Usuario"]; ?>" fotoUsuario="<?php echo $value["Foto_User"]; ?>" apodoUsuario="<?php echo $value["Apodo"]; ?>"><i class="fas fa-trash-alt text-white"></i></button>
                            <?php endif; ?>
                        </div>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>