<?php $fechaActual = date('d-m-Y'); ?>

<!--=============================================
INFORMACION DEL PEDIDO
=============================================-->
<div class="row d-flex flex-row flex-wrap justify-content-between">

    <div class="col-12 col-lg-3">

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">N° Pedido</i></div>
                </div>
                <input type="text" class="form-control" name="ingFolioPedido" id="ingFolioPedido" placeholder="Número de pedido" autocomplete="off" readonly value="0000001">
            </div>
        </div>

    </div>

    <div class="col-12 col-lg-3">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Fecha inc.</div>
                </div>
                <input type="text" class="form-control" name="ingFechaInicio" id="ingFechaInicio" placeholder="Fecha pedido" autocomplete="off" readonly value="<?php echo $fechaActual; ?>">
            </div>
        </div>
    </div>

</div>

<!--=============================================
DATOS DEL CLIENTE
=============================================-->
<div class="row d-flex flex-row flex-wrap justify-content-between">

    <div class="col-12 col-lg-6">

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Cliente</i></div>
                </div>
                <input type="text" class="form-control" name="ingNombreCliente" id="ingNombreCliente" placeholder="Nombre completo del cliente" autocomplete="off">
            </div>
        </div>

    </div>

    <div class="col-12 col-lg-3">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Teléfono</div>
                </div>
                <input type="text" class="form-control" name="ingTelfCliente" id="ingTelfCliente" placeholder="Número teléfonico" autocomplete="off">
                <div class="invalid-feedback" id="errorIngTelfCliente">
                    <ul>
                        <li>El teléfono debe tener 10 dígitos</li>
                        <li>El teléfono debe empezar con 55</li>
                        <li>Ejemplo (5588193595)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-3">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Fecha est.</div>
                </div>
                <input type="text" class="form-control" name="ingFechaEstimada" id="ingFechaEstimada" placeholder="Fecha entrega estimada" autocomplete="off" readonly value="<?php echo date('d-m-Y', strtotime($fechaActual . "+ 3 week")); ?>">
            </div>
        </div>
    </div>

</div>