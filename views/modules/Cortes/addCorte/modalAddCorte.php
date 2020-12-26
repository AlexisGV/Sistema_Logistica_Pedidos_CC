<!--=============================================
MODAL - AGREGAR ACABADO
=============================================-->
<div class="modal fade" id="modalAddCorte" data-backdrop="static">
    <!--=============================================
    FORMULARIO - AGREGAR ACABADO
    =============================================-->
    <form role="form" class="modal-dialog modal-dialog-centered modal-lg" id="formAgregarCorte" method="post" enctype="multipart/form-data">
        <div class="modal-content">

            <!-- HEADER
            -------------------------------------------------- -->
            <div class="modal-header" style="border-top: #3C8DBC 12px solid;">
                <h1 class="modal-title">Crear nuevo corte</h1>
                <button type="button" class="close btn text-black closeModalCorte" data-dismiss="modal">×</button>
            </div>
            <!-- FIN HEADER
            -------------------------------------------------- -->

            <!-- CUERPO DEL MODAL
            -------------------------------------------------- -->
            <div class="modal-body" style="border-top: #3C8DBC 1px solid;">
                <?php
                include "addCorte.php";
                // Llamar metodo para ingresar categoria a la BD
                $respuesta = ControladorCorte::ctrCrearCorte();

                if ($respuesta == "ok") {
                    echo '<script>
                                swal({
                                    title: "Registro exitoso!",
                                    text: "El corte se creo exitosamente.",
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
                                    title: "Registro duplicado!",
                                    text: "Parece que el registro está duplicado o bien la abreviación que se esta intentando ingresar coincide con la de otros registros.",
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
                <button type="button" class="btn btn-danger closeModalCorte" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            <!-- FIN PIE DEL MODAL
            -------------------------------------------------- -->

        </div>
    </form>
    <!--============  FIN FORMULARIO - AGREGAR ACABADO =============-->
</div>

<!--============  FIN MODAL - AGREGAR ACABADO =============-->