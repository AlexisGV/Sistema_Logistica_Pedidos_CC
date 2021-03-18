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
                    <form method="post">
                        <input type="hidden" name="idPedido" id="idPedidoForPhoto">
                    </form>
                    <div class="col-12 col-xl-4 mb-3 contenedorFoto1">
                        <div class="mb-3 text-center border p-0 mx-auto w-100 position-relative imagenPedido">
                            <img class="previewDetalle img-thumbnail border-0" src="views/img/Pedidos/defaultPedido.png" alt="" style="width:100%;">
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="idProducto" class="idProducto" id="idProductoFoto1">
                            <div class="custom-file">
                                <input type="file" class="fotoDetalle custom-file-input" name="ingfotoDetalle" id="ingfotoDetalle1">
                                <label class="custom-file-label text-truncate" for="ingfotoDetalle1" data-browse="Elegir">Escoger imagen</label>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-xl-4 mb-3 contenedorFoto2">
                        <div class="mb-3 text-center border p-0 mx-auto w-100 position-relative imagenPedido">
                            <img class="previewDetalle img-thumbnail border-0" src="views/img/Pedidos/defaultPedido.png" alt="" style="width:100%;">
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="idProducto" class="idProducto" id="idProductoFoto2" value=10002>
                            <div class="custom-file">
                                <input type="file" class="fotoDetalle custom-file-input" name="ingfotoDetalle" id="ingfotoDetalle2" idPedido>
                                <label class="custom-file-label text-truncate" for="ingfotoDetalle2" data-browse="Elegir">Escoger imagen</label>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-xl-4 mb-3 contenedorFoto3">
                        <div class="mb-3 text-center border p-0 mx-auto w-100 position-relative imagenPedido">
                            <img class="previewDetalle img-thumbnail border-0" src="views/img/Pedidos/defaultPedido.png" alt="" style="width:100%;">
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="idProducto" class="idProducto" id="idProductoFoto3">
                            <div class="custom-file">
                                <input type="file" class="fotoDetalle custom-file-input" name="ingfotoDetalle" id="ingfotoDetalle3" idPedido>
                                <label class="custom-file-label text-truncate" for="ingfotoDetalle3" data-browse="Elegir">Escoger imagen</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- FIN CUERPO DEL MODAL
            -------------------------------------------------- -->

        </div>
    </form>
    <!--============  FIN FORMULARIO - AGREGAR FOTO =============-->
</div>
<!--============  FIN MODAL - AGREGAR FOTO =============-->