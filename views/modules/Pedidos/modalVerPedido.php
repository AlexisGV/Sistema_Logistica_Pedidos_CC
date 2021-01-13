<!--=============================================
MODAL - VER DETALLE PEDIDO
=============================================-->
<div class="modal fade" id="modalVerDetallePedido" data-backdrop="static">
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
                <div class="mb-3">
                    <h5 class="font-weight-bold text-center">Fechas</h5>
                    <div class="d-flex flex-xl-row flex-column justify-content-between" id="fechasPedido">
                        <div class="text-center text-xl-left">Inicio: martes, 12 de enero del 2021</div>
                        <div class="text-center">Compromiso: martes, 12 de enero del 2021</div>
                        <div class="text-center text-xl-right">Entrega: martes, 12 de enero del 2021</div>
                    </div>
                </div>

                <div class="mb-3">
                    <h5 class="font-weight-bold text-center">Datos del cliente</h5>
                    <div class="d-flex flex-xl-row flex-column justify-content-between" id="fechasPedido">
                        <div class="text-center text-xl-left">Nombre: Francisco Alexis García Villanueva</div>
                        <div class="text-center">Correo: alexisfvgarcia@gmail.com</div>
                        <div class="text-center text-xl-right">Teléfono: 5542189135</div>
                    </div>
                </div>
            </div>
            <!-- FIN CUERPO DEL MODAL
                -------------------------------------------------- -->

            <!-- PIE DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-footer" style="border-top: #28a745 1px solid;">
                <button type="button" class="btn btn-danger closeModalVerDetallePedido" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
            <!-- FIN PIE DEL MODAL
                -------------------------------------------------- -->

        </div>
    </div>
    <!--============  FIN FORMULARIO - AGREGAR ACABADO =============-->
</div>

<!--============  FIN MODAL - AGREGAR ACABADO =============-->