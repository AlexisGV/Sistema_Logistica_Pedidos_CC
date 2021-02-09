<!--=============================================
MODAL - VISUALIZAR COMENTARIO
=============================================-->
<div class="modal fade" id="modalViewComentario" data-backdrop="static">
    <!--=============================================
    FORMULARIO - VISUALIZAR COMENTARIO
    =============================================-->
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <!-- HEADER
            -------------------------------------------------- -->
            <div class="modal-header" style="border-top: #001f3f 12px solid;">
                <h5 class="modal-title">Comentario sobre pedido "<span id="viewIdPedidoForMC">10001</span>"</h5>
                <button type="button" class="close btn text-black closeModalViewComentario" data-dismiss="modal">×</button>
            </div>
            <!-- FIN HEADER
            -------------------------------------------------- -->

            <!-- CUERPO DEL MODAL
            -------------------------------------------------- -->
            <div class="modal-body" style="border-top: #001f3f 1px solid;">
                <blockquote class="blockquote m-0">
                    <p id="comentarioPedido">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer class="blockquote-footer" id="autorComentario"></footer>
                </blockquote>
            </div>
            <!-- FIN CUERPO DEL MODAL
            -------------------------------------------------- -->

            <!-- PIE DEL MODAL
            -------------------------------------------------- -->
            <div class="modal-footer" style="border-top: #001f3f 1px solid;">
                <button type="button" class="btn btn-danger closeModalViewComentario" data-dismiss="modal">Cancelar</button>
            </div>
            <!-- FIN PIE DEL MODAL
            -------------------------------------------------- -->

        </div>
    </div>
    <!--============  FORMULARIO - VISUALIZAR COMENTARIO =============-->
</div>

<!--============  FIN MODAL - VISUALIZAR COMENTARIO =============-->