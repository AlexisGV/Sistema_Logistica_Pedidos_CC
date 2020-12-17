<!--=============================================
CONTENEDOR
=============================================-->
<div class="content-wrapper">

    <!-- HEADER
    -------------------------------------------------- -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="d-inline-block mr-2">Levantar pedido</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="levantarPedido">Inicio</a></li>
                        <li class="breadcrumb-item active">Levantar pedido</li>
                    </ol>
                </div>
            </div>

        </div>
    </section>
    <!-- FIN DE HEADER
    -------------------------------------------------- -->

    <!-- CONTENEDOR PRINCIPAL
    -------------------------------------------------- -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header" style="border-top: 10px solid #1A6890; border-bottom: 1px solid #1A6890;">
                            <h3 class="card-title">Orden de pedido</h3>
                        </div>

                        <form method="POST" id="formAddPedido">
                            <div class="card-body">
                                <?php include "views/modules/Pedidos/addPedido.php"; ?>

                                <!--=============================================
                                TITULO DETALLES DEL PEDIDO
                                =============================================-->
                                <h5 class="card-subtitle mt-lg-1 mb-3">Detalles del pedido</h5>

                                <!--=============================================
                                BORDE DE LOS DETALLES DEL PRODUCTO
                                =============================================-->
                                <div class="border">
                                    <!--=============================================
                                    CONTENEDOR DE PRODUCTOS QUE CONFORMAN EL PEDIDO
                                    =============================================-->
                                    <div id="contenedorProductosKit" class="pt-3 px-2">

                                        <div class="row nuevoProducto">
                                            <!--=============================================
                                            NUEVO PRODUCTO
                                            =============================================-->

                                            <!-- DESCRIPCION DEL PRODUCTO -->
                                            <div class="col-12 col-lg-9">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-transparent border-0 p-0 mr-2"><button type="button" class="btn btn-danger"><i class="fas fa-times"></i></button></div>
                                                        </div>
                                                        <textarea class="form-control" name="ingProductoNuevo" rows="1" placeholder="Descripción del producto" autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- CANTIDAD DEL PRODUCTO -->
                                            <div class="col-5 col-lg-1">
                                                <div class="form-group">
                                                    <input class="form-control" type="number" min="1" name="ingCantidadProductoNuevo" placeholder="Cantidad" autocomplete="off" value="1">
                                                </div>
                                            </div>

                                            <!-- PRECIO -->
                                            <div class="col-7 col-lg-2">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" name="ingPrecioProductoNuevo" placeholder="0.00" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- SEPARADOR PARA DISPOSITIVOS MOVILES -->
                                            <hr class="d-block d-lg-none">

                                            <!--============  FIN DE PRODUCTO NUEVO  =============-->
                                        </div>

                                        <div class="row nuevoProducto">
                                            <!--=============================================
                                            NUEVO PRODUCTO
                                            =============================================-->

                                            <!-- DESCRIPCION DEL PRODUCTO -->
                                            <div class="col-12 col-lg-9">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-transparent border-0 p-0 mr-2"><button type="button" class="btn btn-danger"><i class="fas fa-times"></i></button></div>
                                                        </div>
                                                        <textarea class="form-control" name="ingProductoNuevo" rows="1" placeholder="Descripción del producto" autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- CANTIDAD DEL PRODUCTO -->
                                            <div class="col-5 col-lg-1">
                                                <div class="form-group">
                                                    <input class="form-control" type="number" min="1" name="ingCantidadProductoNuevo" placeholder="Cantidad" autocomplete="off" value="1">
                                                </div>
                                            </div>

                                            <!-- PRECIO -->
                                            <div class="col-7 col-lg-2">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" name="ingPrecioProductoNuevo" placeholder="0.00" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- SEPARADOR PARA DISPOSITIVOS MOVILES -->
                                            <hr class="d-block d-lg-none">

                                            <!--============  FIN DE PRODUCTO NUEVO  =============-->
                                        </div>

                                    </div>

                                    <!-- BOTON PARA AGREGAR NUEVOS PRODUCTOS -->
                                    <div class="col-12 text-center mb-3">
                                        <button type="button" class="btn btn-outline-success btnAgregarProducto"><i class="fas fa-plus-circle mr-1"></i> Agregar producto</button>
                                    </div>
                                </div>

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
                                                <input type="text" class="form-control" name="ingSubtotalPedido" placeholder="0.00" autocomplete="off" readonly>
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
                                                <input type="number" min="0" value="0" class="form-control" name="ingIVAPedido" placeholder="0" autocomplete="off">
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
                                                <input type="text" class="form-control" name="ingTotalPedido" placeholder="0.00" autocomplete="off" readonly>
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
                                                <input type="text" class="form-control" name="ingAnticipoPedido" placeholder="0.00" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- PAGADO -->
                                    <div class="col-5 col-lg-2 py-2">
                                        <div class="icheck-warning d-inline">
                                            <input type="checkbox" name="PagoCompleto" id="PagoCompleto">
                                            <label for="PagoCompleto">
                                                Pago completo
                                            </label>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="card-footer bg-transparent" style="border-top: 1px solid #1A6890;">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary">Enviar pedido</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- FIN DE CONTENEDOR PRINCIPAL
    -------------------------------------------------- -->

</div>
<!--============  FIN DE CONTENEDOR  =============-->

<?php

// $elimiarRol = new ControladorRoles();
// $elimiarRol->ctrEliminarRol();

?>