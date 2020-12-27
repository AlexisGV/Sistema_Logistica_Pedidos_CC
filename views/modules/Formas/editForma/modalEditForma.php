<!--=============================================
MODAL - EDITAR FORMA
=============================================-->
<div class="modal fade" id="modalEditForma" data-backdrop="static">
    <!--=============================================
    FORMULARIO - EDITAR FORMA
    =============================================-->
    <form role="form" class="modal-dialog modal-dialog-centered modal-lg" id="formEditarForma" method="post" enctype="multipart/form-data">
        <div class="modal-content">

            <!-- HEADER
                -------------------------------------------------- -->
            <div class="modal-header" style="border-top: #6610F2 12px solid;">
                <h1 class="modal-title">Editar forma</h1>
                <button type="button" class="close btn text-black closeModalEditForma" data-dismiss="modal">×</button>
            </div>
            <!-- FIN HEADER
                -------------------------------------------------- -->

            <!-- CUERPO DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-body" style="border-top: #6610F2 1px solid;">
                <?php
                include "editForma.php";
                // Llamar metodo para ingresar categoria a la BD
                $respuesta = ControladorForma::ctrActualizarForma();                    

                if ($respuesta == "ok") {
                    echo '<script>
                            swal({
                                title: "Actualización exitosa!",
                                text: "La forma se editó exitosamente.",
                                icon: "success",
                            }).then( (result) => {
                                window.location = "mainForma";
                            });
                         </script>';
                } else if ($respuesta == "error") {
                    echo '<script>
                            swal({
                                title: "Error!",
                                text: "Ha ocurrido un error con la conexión a la base de datos.",
                                icon: "error",
                            }).then( (result) => {
                                window.location = "mainForma";
                            });
                          </script>';
                } else if ($respuesta == "duplicado") {
                    echo '<script>
                                swal({
                                    title: "Error al actualizar!",
                                    text: "Parece que tienes un registro duplicado o bien la abreviación que se esta intentando ingresar coincide con la de otros registros.",
                                    icon: "info",
                                }).then( (result) => {
                                    window.location = "mainForma";
                                });
                              </script>';
                }
                ?>
            </div>
            <!-- FIN CUERPO DEL MODAL
                -------------------------------------------------- -->

            <!-- PIE DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-footer" style="border-top: #6610F2 1px solid;">
                <button type="button" class="btn btn-danger closeModalEditForma" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
            <!-- FIN PIE DEL MODAL
                -------------------------------------------------- -->

        </div>
    </form>
    <!--============  FIN FORMULARIO - AGREGAR FORMA =============-->
</div>

<!--============  FIN MODAL - AGREGAR FORMA =============-->