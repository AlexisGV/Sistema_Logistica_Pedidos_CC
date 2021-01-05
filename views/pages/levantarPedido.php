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
                                <?php include "views/modules/Pedidos/addPedido/addPedido.php"; ?>

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
                                                        <textarea class="form-control" name="ingProductoNuevo" id="ingProductoNuevo" rows="1" placeholder="Descripción del producto" autocomplete="off" readonly required></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- CANTIDAD DEL PRODUCTO -->
                                            <div class="col-5 col-lg-1">
                                                <div class="form-group">
                                                    <input class="form-control" type="number" min="1" name="ingCantidadProductoNuevo" placeholder="Cantidad" autocomplete="off" value="1" required>
                                                </div>
                                            </div>

                                            <!-- PRECIO -->
                                            <div class="col-7 col-lg-2">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" name="ingPrecioProductoNuevo" placeholder="0.00" autocomplete="off" readonly required>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- SEPARADOR PARA DISPOSITIVOS MOVILES -->
                                            <hr class="d-block d-lg-none">

                                            <!--============  FIN DE PRODUCTO NUEVO  =============-->
                                        </div>

                                    <!--============  FIN DE CONTENEDOR DE PRODUCTOS QUE CONFORMAN EL PEDIDO  =============-->
                                    </div>

                                    <!-- BOTON PARA AGREGAR NUEVOS PRODUCTOS -->
                                    <div class="col-12 text-center mb-3">
                                        <button type="button" class="btn btn-outline-success btnAgregarProducto" data-toggle="modal" data-target="#modalAddProducto"><i class="fas fa-plus-circle mr-1"></i> Agregar producto</button>
                                    </div>
                                </div>

                                <?php include "views/modules/Pedidos/addPedido/addTotalesPedido.php"; ?>

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

    <!--=============================================
    LLAMAMIENTO DEL MODAL PARA AGREGAR PRODUCTO
    =============================================-->
    <?php include "views/modules/Pedidos/addPedido/addProducto/modalAddProducto.php"; ?>

</div>
<!--============  FIN DE CONTENEDOR  =============-->

<?php

// $elimiarRol = new ControladorRoles();
// $elimiarRol->ctrEliminarRol();

?>