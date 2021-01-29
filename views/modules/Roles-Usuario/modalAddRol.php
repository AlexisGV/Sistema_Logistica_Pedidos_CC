<!-- The Modal -->
<div class="modal fade" id="modalAddRol" tabindex="-1" data-backdrop="static">
    <form class="modal-dialog modal-dialog-centered" role="form" id="formAgregarRol" method="post">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header" style="border-top: #17A2B8 12px solid;">
                <h1 class="modal-title">Agregar rol de usuario</h1>
                <button type="button" class="close btn text-black closeModalRol" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" style="border-top: #17A2B8 1px solid;">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="nomRol">Rol de Usuario ( <i class="fas fa-user-tag"></i> )</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                                </div>
                                <input type="text" class="form-control" name="nomRol" id="nomRol" placeholder="Nombre del rol de usuario" required autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ingDescripcionRol">Descripcion del rol de usuario</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-info-circle"></i></div>
                                </div>
                                <textarea class="form-control" name="ingDescripcionRol" id="ingDescripcionRol" placeholder="Ingresa una descripción acerca de las funciones que realizará este tipo de usuario" autocomplete="off" rows="2" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                // Llamar metodo para ingresar categoria a la BD
                $respuesta = ControladorRoles::ctrCrearRol();

                if ($respuesta == "ok") {
                    echo '<script>
                                    swal({
                                        title: "Registro exitoso!",
                                        text: "El rol se registró exitosamente.",
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
                } else if ($respuesta == "duplicado") {
                    echo '<script>
                                    swal({
                                        title: "Registro duplicado!",
                                        text: "El rol que quieres ingresar ya esta registrado.",
                                        icon: "info",
                                    }).then( (result) => {
                                        window.location = "mainRoles";
                                    });
                                  </script>';
                } else if ($respuesta == "erroresModulos") {
                    echo '<script>
                                    swal({
                                        title: "Opps, al parecer hubo errores!",
                                        text: "Hubieron algunos errores al intentar registrar el rol, intenta de nuevo.",
                                        icon: "warning",
                                    }).then( (result) => {
                                        window.location = "mainRoles";
                                    });
                                  </script>';
                }
                ?>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger closeModalRol" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</div>