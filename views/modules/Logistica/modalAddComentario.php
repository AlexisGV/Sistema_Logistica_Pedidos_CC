<!--=============================================
MODAL - AGREGAR ACABADO
=============================================-->
<div class="modal fade" id="modalAddComentario" data-backdrop="static">
    <!--=============================================
    FORMULARIO - AGREGAR ACABADO
    =============================================-->
    <form role="form" class="modal-dialog modal-dialog-centered modal-lg" id="formAgregarComentario" method="post">
        <div class="modal-content">

            <!-- HEADER
            -------------------------------------------------- -->
            <div class="modal-header" style="border-top: #28a745 12px solid;">
                <h5 class="modal-title">Agregar comentario - Pedido "<span id="viewComIdPedido">10001</span>"</h5>
                <button type="button" class="close btn text-black closeModalComentario" data-dismiss="modal">×</button>
            </div>
            <!-- FIN HEADER
            -------------------------------------------------- -->

            <!-- CUERPO DEL MODAL
            -------------------------------------------------- -->
            <div class="modal-body" style="border-top: #28a745 1px solid;">
                <input type="hidden" name="ingCompedidoID" id="ingCompedidoID">
                <input type="hidden" name="numEstado" id="numEstado">
                <label for="ingComentarioPedido">Comentario:</label>
                <div class="form-group">
                    <textarea name="ingComentarioPedido" id="ingComentarioPedido" class="form-control" rows="1" placeholder="Escriba un comentario para el pedido seleccionado" autocomplete="off" required></textarea>
                    <div class="invalid-feedback">
                        El comentario no puede tener caracteres especiales.
                    </div>
                </div>
            </div>
            <!-- FIN CUERPO DEL MODAL
            -------------------------------------------------- -->

            <!-- PIE DEL MODAL
            -------------------------------------------------- -->
            <div class="modal-footer" style="border-top: #28a745 1px solid;">
                <button type="button" class="btn btn-danger closeModalComentario" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btnAgregarComentario">Guardar</button>
            </div>
            <!-- FIN PIE DEL MODAL
            -------------------------------------------------- -->

        </div>
    </form>
    <!--============  FIN FORMULARIO - AGREGAR ACABADO =============-->
</div>

<!--============  FIN MODAL - AGREGAR ACABADO =============-->