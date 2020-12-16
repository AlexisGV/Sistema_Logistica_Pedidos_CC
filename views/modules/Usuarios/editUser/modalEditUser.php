<!-- The Modal -->
<div class="modal fade" id="modalEditarUsuario" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form role="form" id="formEditarUsuario" method="post" enctype="multipart/form-data"
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header" style="border-top: #6610F2 12px solid;">
                    <h1 class="modal-title">Editar datos del usuario</h1>
                    <button type="button" class="close btn text-black closeModalEditUser" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="border-top: #6610F2 1px solid;">
                    <?php
                    include "editUser.php";
                    // Llamar metodo para ingresar categoria a la BD
                    $respuesta = ControladorUsuarios::ctrActualizarUsuario();                    

                    if ($respuesta == "ok") {
                        echo '<script>
                                swal({
                                    title: "Actualización exitosa!",
                                    text: "El usuario se actualizó correctamente.",
                                    icon: "success",
                                }).then( (result) => {
                                    window.location = "mainUsuarios";
                                });
                             </script>';
                    } else if ($respuesta == "error") {
                        echo '<script>
                                swal({
                                    title: "Error!",
                                    text: "Ha ocurrido un error con la conexión a la base de datos.",
                                    icon: "error",
                                }).then( (result) => {
                                    window.location = "mainUsuarios";
                                });
                              </script>';
                    }
                    ?>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer" style="border-top: #6610F2 1px solid;">
                    <button type="button" class="btn btn-danger closeModalEditUser" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>