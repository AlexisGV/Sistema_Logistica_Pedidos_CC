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

                <div class="mb-3">
                    <h5 class="font-weight-bold text-center">Detalles del pedido</h5>
                    <div class="contenedorProductosModal bg-light border-bottom border-secondary">
                        <div class="productoNuevo row py-3 border-top border-secondary">
                            <div class="col-12 col-xl-10 pb-2 pb-xl-0"><span class="d-block font-weight-bold text-center d-xl-none">Descripción del producto:</span>Prueba 1 | Marca: Bacardi | Forma: Cilindrica | Corte(s): Horizontal; Vertical | Otro corte: No | Acabado(s): Pulido | Otro acabado: No | Observación: Sin observaciones</div>
                            <div class="col-4 col-xl-1 text-left text-xl-center"><span class="d-inline-block d-xl-none font-weight-bold mr-1">Cantidad:</span>1</div>
                            <div class="col-6 col-xl-1 text-right text-xl-center"><span class="d-inline-block d-xl-none font-weight-bold mr-1">Precio:</span>$ 1,474.00</div>
                        </div>
                        <div class="productoNuevo row py-3 border-top border-secondary">
                            <div class="col-12 col-xl-10 pb-2 pb-xl-0"><span class="d-block font-weight-bold text-center d-xl-none">Descripción del producto:</span>Prueba 2 | Marca: Bacardi | Forma: Cilindrica | Corte(s): Horizontal; Vertical | Otro corte: No | Acabado(s): Pulido | Otro acabado: No | Observación: Sin observaciones</div>
                            <div class="col-4 col-xl-1 text-left text-xl-center"><span class="d-inline-block d-xl-none font-weight-bold mr-1">Cantidad:</span>1</div>
                            <div class="col-6 col-xl-1 text-right text-xl-center"><span class="d-inline-block d-xl-none font-weight-bold mr-1">Precio:</span>$ 1,474.00</div>
                        </div>
                        <div class="productoNuevo row py-3 border-top border-secondary">
                            <div class="col-12 col-xl-10 pb-2 pb-xl-0"><span class="d-block font-weight-bold text-center d-xl-none">Descripción del producto:</span>Prueba 3 | Marca: Bacardi | Forma: Cilindrica | Corte(s): Horizontal; Vertical | Otro corte: No | Acabado(s): Pulido | Otro acabado: No | Observación: Sin observaciones</div>
                            <div class="col-4 col-xl-1 text-left text-xl-center"><span class="d-inline-block d-xl-none font-weight-bold mr-1">Cantidad:</span>1</div>
                            <div class="col-6 col-xl-1 text-right text-xl-center"><span class="d-inline-block d-xl-none font-weight-bold mr-1">Precio:</span>$ 1,474.00</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex flex-column flex-xl-row justify-content-between">
                        <div id="viewSubtotal" class="text-right"><span class="font-weight-bold mr-1">Subtotal:</span>$ 1,450.00</div>
                        <div id="viewIVA" class="text-right"><span class="font-weight-bold mr-1">IVA Aplicado:</span>16 %</div>
                        <div id="viewTotal" class="text-right"><span class="font-weight-bold mr-1">Total:</span>$ 1,450.00</div>
                        <div id="viewAnticipo" class="text-right mt-2 mt-xl-0"><span class="font-weight-bold mr-1">Anticipo:</span>$ 1,400.00</div>
                        <div id="viewDeuda" class="text-right"><span class="font-weight-bold mr-1">Debe:</span>$ 40.00</div>
                    </div>
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