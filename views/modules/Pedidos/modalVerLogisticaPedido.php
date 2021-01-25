<!--=============================================
MODAL - VER DETALLE PEDIDO
=============================================-->
<div class="modal fade" id="modalVerLogisticaPedido" data-backdrop="static">
    <!--=============================================
    FORMULARIO - VER DETALLE PEDIDO
    =============================================-->
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

            <!-- HEADER
                -------------------------------------------------- -->
            <div class="modal-header" style="border-top: #001f3f 12px solid;">
                <h1 class="modal-title">Número de Pedido "<span id="viewNumPedido">10001</span>"</h1>
                <button type="button" class="close btn text-black closeModalVerLogisticaPedido" data-dismiss="modal">×</button>
            </div>
            <!-- FIN HEADER
                -------------------------------------------------- -->

            <!-- CUERPO DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-body" style="border-top: #001f3f 1px solid;">

                <div class="mb-3">
                    <h5 class="font-weight-bold text-center">Logística del pedido</h5>
                    <!-- LINEA DEL TIEMPO
                    -------------------------------------------------- -->
                    <div class="timeline" id="contenedorEstadosPedido"></div>
                    <!-- FIN - LINEA DEL TIEMPO
                    -------------------------------------------------- -->
                </div>
            </div>
            <!-- FIN CUERPO DEL MODAL
                -------------------------------------------------- -->

            <!-- PIE DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-footer" style="border-top: #001f3f 1px solid;">
                <button type="button" class="btn btn-danger closeModalVerLogisticaPedido" data-dismiss="modal">Cerrar ventana</button>
            </div>
            <!-- FIN PIE DEL MODAL
                -------------------------------------------------- -->

        </div>
    </div>
    <!--============  FIN FORMULARIO - AGREGAR ACABADO =============-->
</div>

<!--============  FIN MODAL - AGREGAR ACABADO =============-->