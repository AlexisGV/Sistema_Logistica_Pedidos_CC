<!--=============================================
TITULO TOTALES DEL PEDIDO
=============================================-->
<h5 class="card-subtitle mt-3 mb-3 text-left text-lg-right">Totales</h5>

<div class="row d-flex flex-wrap flex-row justify-content-end">
    <!-- SUBTOTAL -->
    <div class="col-12 col-lg-2">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Subtotal<i class="fas fa-dollar-sign ml-2"></i></div>
                </div>
                <input type="text" class="form-control" name="ingSubtotalPedido" id="ingSubtotalPedido" placeholder="0.00" autocomplete="off" readonly>
            </div>
        </div>
    </div>

    <!-- IVA -->
    <div class="col-5 col-lg-2">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">IVA<i class="fas fa-percentage ml-2 d-none d-sm-block"></i></div>
                </div>
                <input type="number" min="0" value="0" class="form-control" name="ingIVAPedido" id="ingIVAPedido" placeholder="0" autocomplete="off" required>
            </div>
        </div>
    </div>

    <!-- TOTAL -->
    <div class="col-7 col-lg-2">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Total<i class="fas fa-dollar-sign ml-2"></i></div>
                </div>
                <input type="text" class="form-control" name="ingTotalPedido" id="ingTotalPedido" placeholder="0.00" autocomplete="off" readonly>
            </div>
        </div>
    </div>

</div>

<div class="row d-flex flex-wrap flex-row justify-content-end">

    <!-- ANTICIPO -->
    <div class="col-7 col-lg-2">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Anticipo<i class="fas fa-dollar-sign ml-2"></i></div>
                </div>
                <input type="text" class="form-control" name="ingAnticipoPedido" id="ingAnticipoPedido" placeholder="0.00" autocomplete="off">
                <div class="invalid-feedback" id="erroringAnticipoPedido">
                    El valor debe tener 2 decimales.
                </div>
                <div class="invalid-feedback" id="erroringAnticipoMenorPedido">
                    El anticipo debe ser menor o igual al total.
                </div>
            </div>
        </div>
    </div>

    <!-- PAGADO -->
    <div class="col-5 col-lg-2 py-2">
        <div class="icheck-warning d-inline">
            <input type="checkbox" name="ingPagoCompleto" id="ingPagoCompleto">
            <label for="ingPagoCompleto">
                Pago completo
            </label>
        </div>
    </div>

</div>