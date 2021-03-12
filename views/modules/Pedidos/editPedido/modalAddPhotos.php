<!--=============================================
MODAL - AGREGAR FOTO
=============================================-->
<div class="modal fade" id="modalAddFoto" data-backdrop="static">
    <!--=============================================
    FORMULARIO - AGREGAR FOTO
    =============================================-->
    <form role="form" class="modal-dialog modal-dialog-centered modal-xl" id="formAgregarFoto" method="post" enctype="multipart/form-data">
        <div class="modal-content">

            <!-- HEADER
            -------------------------------------------------- -->
            <div class="modal-header" style="border-top: #17A2B8 12px solid;">
                <h1 class="modal-title">Agregar Fotos</h1>
                <button type="button" class="close btn text-black closeModalFoto" data-dismiss="modal">×</button>
            </div>
            <!-- FIN HEADER
            -------------------------------------------------- -->

            <!-- CUERPO DEL MODAL
            -------------------------------------------------- -->
            <div class="modal-body" style="border-top: #17A2B8 1px solid;">
                <div class="alert alert-light"><i class="fas fa-info-circle"></i> Puedes subir 1, 2 o 3 imágenes como máximo. No es obligatorio subir todas, inclusive puedes no subir ninguna.</div>
                <div class="row">
                    <div class="col-12 col-xl-4 mb-3">
                        <div class="mb-3 text-center border p-0 mx-auto w-100 position-relative imagenPedido">
                            <img class="previewDetalle img-thumbnail border-0" src="views/img/Pedidos/defaultPedido2.png" alt="" style="width:100%;">
                            <!-- <button type="button" class="btn btn-danger rounded-circle btnEliminarFotoDetalle" style="position: absolute; right: -8px; top: -8px;"><i class="fas fa-times"></i></button> -->
                        </div>
                        <div class="custom-file">
                            <input type="file" class="fotoDetalle custom-file-input" name="ingfotoDetalle" id="ingfotoDetalle">
                            <label class="custom-file-label text-truncate" for="ingfotoDetalle" data-browse="Elegir">Escoger imagen</label>
                        </div>
                        <!-- <div class="text-center">
                            <button type="button" class="btn btn-info mt-3"><i class="fas fa-upload mr-1"></i>Confirmar y subir imagen</button>
                        </div> -->
                    </div>
                    <div class="col-12 col-xl-4 mb-3">
                        <div class="mb-3 text-center border p-0 mx-auto w-100 position-relative imagenPedido">
                            <img class="previewDetalle img-thumbnail border-0" src="views/img/Pedidos/defaultPedido2.png" alt="" style="width:100%;">
                            <!-- <button type="button" class="btn btn-danger rounded-circle btnEliminarFotoDetalle" style="position: absolute; right: -8px; top: -8px;"><i class="fas fa-times"></i></button> -->
                        </div>
                        <div class="custom-file">
                            <input type="file" class="fotoDetalle custom-file-input" name="ingfotoDetalle" id="ingfotoDetalle">
                            <label class="custom-file-label text-truncate" for="ingfotoDetalle" data-browse="Elegir">Escoger imagen</label>
                        </div>
                        <!-- <div class="text-center botonEnviar">
                            <button type="button" class="btn btn-info mt-3"><i class="fas fa-upload mr-1"></i>Confirmar y subir imagen</button>
                        </div> -->
                    </div>
                    <div class="col-12 col-xl-4 mb-3">
                        <div class="mb-3 text-center border p-0 mx-auto w-100 position-relative imagenPedido">
                            <img class="previewDetalle img-thumbnail border-0" src="views/img/Pedidos/defaultPedido2.png" alt="" style="width:100%;">
                            <!-- <button type="button" class="btn btn-danger rounded-circle btnEliminarFotoDetalle" style="position: absolute; right: -8px; top: -8px;"><i class="fas fa-times"></i></button> -->
                        </div>
                        <div class="custom-file">
                            <input type="file" class="fotoDetalle custom-file-input" name="ingfotoDetalle" id="ingfotoDetalle">
                            <label class="custom-file-label text-truncate" for="ingfotoDetalle" data-browse="Elegir">Escoger imagen</label>
                        </div>
                        <!-- <div class="text-center">
                            <button type="button" class="btn btn-info mt-3"><i class="fas fa-upload mr-1"></i>Confirmar y subir imagen</button>
                        </div> -->
                    </div>
                </div>
                <?php
                // include "addFoto.php";
                // // Llamar metodo para ingresar categoria a la BD
                // $respuesta = ControladorFoto::ctrCrearFoto();

                // if ($respuesta == "ok") {
                //     echo '<script>
                //                 swal({
                //                     title: "Registro exitoso!",
                //                     text: "La Foto se creo exitosamente.",
                //                     icon: "success",
                //                 }).then( (result) => {
                //                     window.location = "mainFoto";
                //                 });
                //              </script>';
                // } else if ($respuesta == "error") {
                //     echo '<script>
                //                 swal({
                //                     title: "Error!",
                //                     text: "Ha ocurrido un error con la conexión a la base de datos.",
                //                     icon: "error",
                //                 }).then( (result) => {
                //                     window.location = "mainFoto";
                //                 });
                //               </script>';
                // } else if ($respuesta == "duplicado") {
                //     echo '<script>
                //                 swal({
                //                     title: "Registro duplicado!",
                //                     text: "Parece que el registro está duplicado o bien la abreviación que se esta intentando ingresar coincide con la de otros registros.",
                //                     icon: "info",
                //                 }).then( (result) => {
                //                     window.location = "mainFoto";
                //                 });
                //               </script>';
                // }
                ?>
            </div>
            <!-- FIN CUERPO DEL MODAL
            -------------------------------------------------- -->

            <!-- PIE DEL MODAL
            -------------------------------------------------- -->
            <!-- <div class="modal-footer" style="border-top: #17A2B8 1px solid;">
                <button type="button" class="btn btn-danger closeModalFoto" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div> -->
            <!-- FIN PIE DEL MODAL
            -------------------------------------------------- -->

        </div>
    </form>
    <!--============  FIN FORMULARIO - AGREGAR FOTO =============-->
</div>
<!--============  FIN MODAL - AGREGAR FOTO =============-->