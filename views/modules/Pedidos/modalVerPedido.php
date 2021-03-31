<!--=============================================
MODAL - VER DETALLE PEDIDO
=============================================-->
<div class="modal fade" id="modalVerDetallePedido" data-backdrop="static" style="overflow-y: scroll;">
    <!--=============================================
    FORMULARIO - VER DETALLE PEDIDO
    =============================================-->
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

            <!-- HEADER
                -------------------------------------------------- -->
            <div class="modal-header" style="border-top: #28a745 12px solid;">
                <h1 class="modal-title">Número de Pedido "<span id="viewNumeroPedido">10001</span>"</h1>
                <button type="button" class="close btn text-black closeModalVerDetallePedido" data-dismiss="modal">×</button>
            </div>
            <!-- FIN HEADER
                -------------------------------------------------- -->

            <!-- CUERPO DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-body" style="border-top: #28a745 1px solid;">
                <!-- FECHAS
                -------------------------------------------------- -->                
                <div class="mb-3">
                    <h5 class="font-weight-bold text-center">Fechas</h5>
                    <div class="d-flex flex-xl-row flex-column justify-content-between" id="fechasPedido"></div>
                </div>

                <!-- DATOS DEL CLIENTE
                -------------------------------------------------- -->
                <div class="mb-3">
                    <h5 class="font-weight-bold text-center">Datos del cliente</h5>
                    <div class="d-flex flex-xl-row flex-column justify-content-between" id="datosCliente"></div>
                </div>

                <div class="mb-3">
                    <h5 class="font-weight-bold text-center">Detalles del pedido</h5>
                    <div class="bg-light border-bottom border-secondary" id="contenedorProductosModal"></div>
                </div>

                <div class="mb-3">
                    <div class="d-flex flex-column flex-xl-row justify-content-between" id="totalesPedido"></div>
                </div>

                <div class="mb-1">
                    <div class="text-center" id="obtenerFactura"></div>
                </div>
            </div>
            <!-- FIN CUERPO DEL MODAL
                -------------------------------------------------- -->

            <!-- PIE DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-footer" style="border-top: #28a745 1px solid;">
                <button type="button" class="btn btn-danger closeModalVerDetallePedido" data-dismiss="modal">Cerrar ventana</button>
            </div>
            <!-- FIN PIE DEL MODAL
                -------------------------------------------------- -->

        </div>
    </div>
    <!--============  FIN FORMULARIO - AGREGAR ACABADO =============-->
</div>

<!--============  FIN MODAL - AGREGAR ACABADO =============-->