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
                <!-- <form method="post">
                    <input type="hidden" name="idPedido" id="idPedidoForPhoto">
                </form> -->
                <!-- AQUI SE MOSTRARAN LAS FOTOS DEL PRODUCTO -->
                <div class="row" id="contenedorFotos"></div>
            </div>
            <!-- FIN CUERPO DEL MODAL
            -------------------------------------------------- -->

        </div>
    </form>
    <!--============  FIN FORMULARIO - AGREGAR FOTO =============-->
</div>
<!--============  FIN MODAL - AGREGAR FOTO =============-->