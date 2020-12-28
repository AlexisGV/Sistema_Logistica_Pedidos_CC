<!--=============================================
MODAL - AGREGAR MARCA
=============================================-->
<div class="modal fade" id="modalAddMarca" data-backdrop="static">
    <!--=============================================
    FORMULARIO - AGREGAR MARCA
    =============================================-->
    <form role="form" class="modal-dialog modal-dialog-centered modal-lg" id="formAgregarMarca" method="post" enctype="multipart/form-data">
        <div class="modal-content">

            <!-- HEADER
            -------------------------------------------------- -->
            <div class="modal-header" style="border-top: #ff851b 12px solid;">
                <h1 class="modal-title">Crear nueva marca</h1>
                <button type="button" class="close btn text-black closeModalMarca" data-dismiss="modal">×</button>
            </div>
            <!-- FIN HEADER
            -------------------------------------------------- -->

            <!-- CUERPO DEL MODAL
            -------------------------------------------------- -->
            <div class="modal-body" style="border-top: #ff851b 1px solid;">
                <?php
                include "addMarca.php";
                // Llamar metodo para ingresar categoria a la BD
                $respuesta = ControladorMarca::ctrCrearMarca();

                if ($respuesta == "ok") {
                    echo '<script>
                                swal({
                                    title: "Registro exitoso!",
                                    text: "La marca se creo exitosamente.",
                                    icon: "success",
                                }).then( (result) => {
                                    window.location = "mainMarca";
                                });
                             </script>';
                } else if ($respuesta == "error") {
                    echo '<script>
                                swal({
                                    title: "Error!",
                                    text: "Ha ocurrido un error con la conexión a la base de datos.",
                                    icon: "error",
                                }).then( (result) => {
                                    window.location = "mainMarca";
                                });
                              </script>';
                } else if ($respuesta == "duplicado") {
                    echo '<script>
                                swal({
                                    title: "Registro duplicado!",
                                    text: "Parece que el registro está duplicado o bien la abreviación que se esta intentando ingresar coincide con la de otros registros.",
                                    icon: "info",
                                }).then( (result) => {
                                    window.location = "mainMarca";
                                });
                              </script>';
                }
                ?>
            </div>
            <!-- FIN CUERPO DEL MODAL
            -------------------------------------------------- -->

            <!-- PIE DEL MODAL
            -------------------------------------------------- -->
            <div class="modal-footer" style="border-top: #ff851b 1px solid;">
                <button type="button" class="btn btn-danger closeModalMarca" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            <!-- FIN PIE DEL MODAL
            -------------------------------------------------- -->

        </div>
    </form>
    <!--============  FIN FORMULARIO - AGREGAR MARCA =============-->
</div>

<!--============  FIN MODAL - AGREGAR MARCA =============-->