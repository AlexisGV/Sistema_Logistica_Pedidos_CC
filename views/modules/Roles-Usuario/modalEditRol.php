<!-- The Modal -->
<div class="modal fade" id="modalEditRol" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <form role="form" id="formEditarRol" method="post">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header" style="border-top: #17A2B8 12px solid;">
                    <h1 class="modal-title">Editar rol de usuario</h1>
                    <button type="button" class="close btn text-black closeModalEditRol" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="border-top: #17A2B8 1px solid;">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nomEditRol">Rol de Usuario ( <i class="fas fa-user-tag"></i> )</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                    </div>
                                    <input type="text" class="form-control" name="nomEditRol" id="nomEditRol" placeholder="Nombre del rol de usuario" required autocomplete="off">
                                    <input type="hidden" name="idEditRol" id="idEditRol">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    // Llamar metodo para ingresar categoria a la BD
                    $respuesta = ControladorRoles::ctrAztualizarRol();

                    if ($respuesta == "ok") {
                        echo '<script>
                                    swal({
                                        title: "Actualización exitosa!",
                                        text: "El rol se actualizó correctaamente.",
                                        icon: "success",
                                    }).then( (result) => {
                                        window.location = "mainRoles";
                                    });
                                  </script>';
                    } else if ($respuesta == "error") {
                        echo '<script>
                                    swal({
                                        title: "Error!",
                                        text: "Ha ocurrido un error con la conexión a la base de datos.",
                                        icon: "error",
                                    }).then( (result) => {
                                        window.location = "mainRoles";
                                    });
                                  </script>';
                    }
                    ?>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger closeModalEditRol" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>