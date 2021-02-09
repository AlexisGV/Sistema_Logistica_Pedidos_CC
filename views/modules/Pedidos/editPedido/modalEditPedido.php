<!--=============================================
MODAL - EDITAR PEDIDO
=============================================-->
<div class="modal fade" id="modalEditPedido" data-backdrop="static" style="overflow-y: scroll;">
    <!--=============================================
    FORMULARIO - EDITAR PEDIDO
    =============================================-->
    <form class="modal-dialog modal-dialog-centered modal-xl" method="POST" id="formEditPedido">
        <div class="modal-content">

            <!-- HEADER
                -------------------------------------------------- -->
            <div class="modal-header" style="border-top: #FFC107 12px solid;">
                <h1 class="modal-title">Editar Pedido "<span id="viewEditNumeroPedido">10001</span>"</h1>
                <input type="hidden" name="editIdPedido" id="editIdPedido">
                <button type="button" class="close btn text-black closeModalEditPedido" data-dismiss="modal">×</button>
            </div>
            <!-- FIN HEADER
                -------------------------------------------------- -->

            <!-- CUERPO DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-body" style="border-top: #FFC107 1px solid;">
                <!-- FECHAS
                -------------------------------------------------- -->
                <h5 class="font-weight-bold text-center">Fechas</h5>
                <div class="row" id="editFechasPedido">
                    <div class="form-group col-12 col-xl-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Inc.</div>
                            </div>
                            <input type="text" class="form-control" name="editFechaInicioPedido" id="editFechaInicioPedido" placeholder="Fecha de inicio" readonly>
                        </div>
                    </div>
                    <div class="form-group col-12 col-xl-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Com.</div>
                            </div>
                            <input type="hidden" class="form-control" id="editFechaCompromisoPedidoHidden" placeholder="Fecha compromiso" readonly>
                            <input type="hidden" class="form-control" name="editFechaCompromisoActual" id="editFechaCompromisoActual" placeholder="Fecha compromiso" readonly>

                            <input type="text" class="form-control" name="editFechaCompromisoPedido" id="editFechaCompromisoPedido" placeholder="Fecha compromiso" readonly autocomplete="off">
                            <div class="icheck-primary d-inline ml-1">
                                <input type="checkbox" name="editFechaCompromisoPersonalizada" id="editFechaCompromisoPersonalizada">
                                <label for="editFechaCompromisoPersonalizada"></label>
                            </div>
                            <div class="invalid-feedback">El formato de la fecha debe ser similar a este dd/mm/aaaa y debe de ser mayor o igual a la de hoy</div>

                            <input type="hidden" class="form-control" name="editFechaCompromisoPedidoFormateada" id="editFechaCompromisoPedidoFormateada" placeholder="Fecha compromiso" readonly>
                        </div>
                    </div>
                    <div class="form-group col-12 col-xl-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Ent.</div>
                            </div>
                            <input type="text" class="form-control" name="editFechaEntregaPedido" id="editFechaEntregaPedido" placeholder="Fecha de entrega" readonly>
                        </div>
                    </div>
                </div>

                <!-- DATOS DEL CLIENTE
                -------------------------------------------------- -->
                <h5 class="font-weight-bold text-center">Datos del cliente</h5>
                <div class="row" id="editDatosCliente">
                    <div class="form-group col-12 col-xl-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Cliente</div>
                            </div>
                            <input type="text" class="form-control" name="editCliente" id="editCliente" placeholder="Nombre completo del cliente" autocomplete="off" required>
                            <div class="invalid-feedback">
                                El nombre debe contener solo letras.
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12 col-xl-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Correo</div>
                            </div>
                            <input type="text" class="form-control" name="editCorreo" id="editCorreo" placeholder="Correo del cliente" autocomplete="off">
                            <div class="invalid-feedback">
                                El formato del correo electrónico no es el adecuado. Ejemplo: usuario@example.com
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12 col-xl-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Teléfono</div>
                            </div>
                            <input type="text" class="form-control" name="editTelefono" id="editTelefono" placeholder="Número teléfonico" autocomplete="off" required>
                            <div class="invalid-feedback">
                                El teléfono debe empezar con 55 o 56 y debe tener 10 digitos.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <h5 class="font-weight-bold text-center">Detalles del pedido</h5>
                    <div class="bg-light border-bottom border-secondary" id="editContenedorProductos"></div>
                    <div class="text-center mt-3"><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalAddProductoPedido" id="addProductoToPedido">Agregar producto</button></div>
                </div>

                <div class="mb-3">
                    <div id="editTotalesPedido">
                        <div class="row d-flex flex-row justify-content-end">
                            <div class="form-group col-12 col-xl-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Subtotal<i class="fas fa-dollar-sign ml-1"></i></div>
                                    </div>
                                    <input type="text" class="form-control" name="editSubtotal" id="editSubtotal" placeholder="Subtotal" autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="form-group col-12 col-xl-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">IVA<i class="fas fa-percentage ml-1"></i></div>
                                    </div>
                                    <input type="number" min="0" max="16" step="16" class="form-control" name="editIVA" id="editIVA" placeholder="0" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group col-12 col-xl-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Total<i class="fas fa-dollar-sign ml-1"></i></div>
                                    </div>
                                    <input type="text" class="form-control" name="editTotal" id="editTotal" placeholder="Total" autocomplete="off" required readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex flex-row justify-content-end mt-3 mt-xl-0">
                            <div class="form-group col-12 col-xl-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Anticipo<i class="fas fa-dollar-sign ml-1"></i></div>
                                    </div>
                                    <input type="text" class="form-control" name="editAnticipo" id="editAnticipo" placeholder="Anticipo" autocomplete="off" readonly>
                                    <div class="invalid-feedback" id="errorEditAnticipoPedido">
                                        El valor debe tener 2 decimales.
                                    </div>
                                    <div class="invalid-feedback" id="errorEditAnticipoMenorPedido">
                                        El anticipo debe ser menor o igual al total.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-xl-2 py-2 text-center">
                                <div class="icheck-warning d-inline">
                                    <input type="checkbox" name="editPagoCompleto" id="editPagoCompleto">
                                    <label for="editPagoCompleto">
                                        Pago completo
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN CUERPO DEL MODAL
                -------------------------------------------------- -->

            <!-- PIE DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-footer" style="border-top: #FFC107 1px solid;">
                <button type="button" class="btn btn-danger closeModalEditPedido" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-warning">Guardar cambios</button>
            </div>
            <!-- FIN PIE DEL MODAL
                -------------------------------------------------- -->

        </div>
    </form>
    <!--============  FIN FORMULARIO - AGREGAR ACABADO =============-->
</div>

<!--============  FIN MODAL - AGREGAR ACABADO =============-->

<?php

/*=============================================
    ACTUALIZAR PEDIDO
    =============================================*/
$actualizarPedido = new ControladorPedidos();
$actualizarPedido->ctrActualizarPedido();

?>