<?php
setlocale(LC_ALL, "es_MX.UTF-8");
date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");
$fechaActual = date('d-m-Y');
$fechaFutura = date('d-m-Y', strtotime($fechaActual . "+ 3 week"));
?>

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

                <?php

                $numeroPedido = ControladorPedidos::ctrObtenerNumeroPedido();
                echo '<input type="text" class="form-control" name="ingFolioPedido" id="ingFolioPedido" placeholder="Número de pedido" autocomplete="off" readonly value="' . $numeroPedido . '">';

                ?>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Fecha est.</div>
                </div>
                <input type="hidden" class="form-control text-center" id="ingFechaEstimadaHidden" placeholder="Fecha entrega estimada" autocomplete="off" readonly value="<?php echo strftime("%A, %d de %B del %Y", strtotime($fechaFutura)); ?>">

                <input type="text" class="form-control text-center" id="ingFechaEstimada" placeholder="Fecha entrega estimada personalizada" autocomplete="off" readonly value="<?php echo strftime("%A, %d de %B del %Y", strtotime($fechaFutura)); ?>">
                <div class="icheck-primary d-inline ml-1">
                    <input type="checkbox" name="ingFechaCompromisoPersonalizada" id="ingFechaCompromisoPersonalizada">
                    <label for="ingFechaCompromisoPersonalizada"></label>
                </div>
                <div class="invalid-feedback">El formato de la fecha debe ser similar a este dd/mm/aaaa y debe de ser mayor o igual a la de hoy</div>

                <input type="hidden" name="ingFechaEstimadaFormateada" id="ingFechaEstimadaFormateada">
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Fecha inc.</div>
                </div>
                <input type="text" class="form-control text-center" name="ingFechaInicio" id="ingFechaInicio" placeholder="Fecha pedido" autocomplete="off" readonly value="<?php echo strftime("%A, %d de %B del %Y", strtotime($fechaActual)); ?>">
            </div>
        </div>
    </div>

</div>

<!--=============================================
DATOS DEL CLIENTE
=============================================-->
<div class="row d-flex flex-row flex-wrap justify-content-between">

    <div class="col-12 col-lg-5">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Cliente</i></div>
                </div>
                <input type="text" class="form-control" name="ingNombreCliente" id="ingNombreCliente" placeholder="Nombre completo del cliente" autocomplete="off">
                <div class="invalid-feedback" id="erroringNombreCliente">
                    El nombre no puede contener números o carácteres especiales.
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Correo</i></div>
                </div>
                <input type="email" class="form-control" name="ingEmailCliente" id="ingEmailCliente" placeholder="Correo del cliente" autocomplete="off">
                <div class="invalid-feedback" id="erroringEmailCliente">
                    El formato del correo electrónico no es el adecuado. Ejemplo: usuario@example.com
                </div>
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
                <div class="invalid-feedback" id="errorIngTelfCliente1">
                    El teléfono debe empezar con 55 o 56
                </div>
                <div class="warning-feedback text-info" id="errorIngTelfCliente2">
                    El teléfono debe tener 10 dígitos. Ejemplo (5588193595)
                </div>
            </div>
        </div>
    </div>

</div>