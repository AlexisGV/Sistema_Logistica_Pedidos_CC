<!-- The Modal -->
<div class="modal fade" id="modalAgregarUsuario" data-backdrop="static">
    <form role="form" class="modal-dialog modal-dialog-centered modal-lg" id="formAgregarUsuario" method="post" enctype="multipart/form-data">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header" style="border-top: #6610F2 12px solid;">
                <h1 class="modal-title">Agregar nuevo usuario</h1>
                <button type="button" class="close btn text-black closeModalUser" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" style="border-top: #6610F2 1px solid;">
                <?php
                include "addUser.php";
                // Llamar metodo para ingresar categoria a la BD
                $respuesta = ControladorUsuarios::ctrCrearUsuario();

                if ($respuesta == "ok") {
                    echo '<script>
                                swal({
                                    title: "Registro exitoso!",
                                    text: "El usuario se creo exitosamente.",
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
                } else if ($respuesta == "duplicado") {
                    echo '<script>
                                swal({
                                    title: "Registro duplicado!",
                                    text: "El usuario que quieres ingresar ya esta registrado.",
                                    icon: "info",
                                }).then( (result) => {
                                    window.location = "mainUsuarios";
                                });
                              </script>';
                }
                ?>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer" style="border-top: #6610F2 1px solid;">
                <button type="button" class="btn btn-danger closeModalUser" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</div>