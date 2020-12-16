<div class="row">

    <!-- DATOS DEL USUARIO -->
    <div class="col-12 col-lg-8">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-address-card"></i></i></div>
                </div>
                <input type="text" class="form-control" name="nomUser" id="nomUser" placeholder="Nombre completo del usuario" required autocomplete="off">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                </div>
                <input type="email" class="form-control" name="correoUser" id="correoUser" placeholder="Correo del usuario" required autocomplete="off">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                </div>
                <input type="text" class="form-control" name="apodoUser" id="apodoUser" placeholder="Apodo o nickname" required autocomplete="off">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                </div>
                <input type="password" class="form-control" name="passUser" id="passUser" placeholder="Contraseña" required autocomplete="off">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-key"></i></div>
                </div>
                <input type="password" class="form-control" name="passUser" id="passUser2" placeholder="Confirmar contraseña" required autocomplete="off">
            </div>
            <div class="invalid-feedback" id="errorContraseñas">
                Las contraseñas no coinciden
            </div>
        </div>

        <div class="form-group">
            <select name="tipoUsuario" id="tipoUsuario" class="form-control select2" style="width:100%;" data-placeholder="Seleccione el tipo de usuario" required>
                <option></option>
                <?php
                $tipoUsuario = ControladorUsuarios::ctrObtenerTiposUsuario();
                foreach ($tipoUsuario as $key => $value) :
                ?>
                    <option value="<?php echo $value["Tipo_User"]; ?>"><?php echo $value["Tipo_User"]; ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>

    <!-- FOTO DEL USUARIO -->
    <div class="col-12 col-lg-4">
        <div class="mb-3 text-center border p-0 mx-auto" style="max-width:200px; max-height: 200px;">
            <img class="previsualizarUsuario img-thumbnail border-0" src="views/img/Usuarios/defaultUser.png" alt="" style="width:100%;">
        </div>
        <div class="custom-file">
            <input type="file" class="fotoUsuario custom-file-input" name="fotoUsuario" id="fotoUsuario">
            <label class="custom-file-label text-truncate" for="fotoUsuario" data-browse="Elegir">Subir foto</label>
        </div>
    </div>

</div>