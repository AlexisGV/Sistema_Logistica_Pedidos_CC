<!--=============================================
MODAL - EDITAR ACABADO
=============================================-->
<div class="modal fade" id="modalEditCorte" data-backdrop="static">
    <!--=============================================
    FORMULARIO - EDITAR ACABADO
    =============================================-->
    <form role="form" class="modal-dialog modal-dialog-centered modal-lg" id="formEditarCorte" method="post" enctype="multipart/form-data">
        <div class="modal-content">

            <!-- HEADER
                -------------------------------------------------- -->
            <div class="modal-header" style="border-top: #3C8DBC 12px solid;">
                <h1 class="modal-title">Editar corte o proceso</h1>
                <button type="button" class="close btn text-black closeModalEditCorte" data-dismiss="modal">×</button>
            </div>
            <!-- FIN HEADER
                -------------------------------------------------- -->

            <!-- CUERPO DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-body" style="border-top: #3C8DBC 1px solid;">
                <?php
                include "editCorte.php";
                // Llamar metodo para ingresar categoria a la BD
                $respuesta = ControladorCorte::ctrActualizarCorte();                    

                if ($respuesta == "ok") {
                    echo '<script>
                            swal({
                                title: "Actualización exitosa!",
                                text: "El corte se editó exitosamente.",
                                icon: "success",
                            }).then( (result) => {
                                window.location = "mainCorte";
                            });
                         </script>';
                } else if ($respuesta == "error") {
                    echo '<script>
                            swal({
                                title: "Error!",
                                text: "Ha ocurrido un error con la conexión a la base de datos.",
                                icon: "error",
                            }).then( (result) => {
                                window.location = "mainCorte";
                            });
                          </script>';
                } else if ($respuesta == "duplicado") {
                    echo '<script>
                                swal({
                                    title: "Error al actualizar!",
                                    text: "Parece que tienes un registro duplicado o bien la abreviación que se esta intentando ingresar coincide con la de otros registros.",
                                    icon: "info",
                                }).then( (result) => {
                                    window.location = "mainCorte";
                                });
                              </script>';
                }
                ?>
            </div>
            <!-- FIN CUERPO DEL MODAL
                -------------------------------------------------- -->

            <!-- PIE DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-footer" style="border-top: #3C8DBC 1px solid;">
                <button type="button" class="btn btn-danger closeModalEditCorte" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
            <!-- FIN PIE DEL MODAL
                -------------------------------------------------- -->

        </div>
    </form>
    <!--============  FIN FORMULARIO - AGREGAR ACABADO =============-->
</div>

<!--============  FIN MODAL - AGREGAR ACABADO =============-->