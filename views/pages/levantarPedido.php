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

            <!--=============================================
            OBTENER PERMISOS PARA ADMINISTRAR PEDIDOS
            =============================================-->
            <?php
            $modulo = "Administración de pedidos";
            $permisosPedidos = ControladorPermisos::ctrObtenerPermisos($modulo);
            ?>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header" style="border-top: 10px solid #1A6890; border-bottom: 1px solid #1A6890;">
                            <h3 class="card-title">Orden de pedido</h3>
                        </div>

                        <?php

                        if (intval($permisosPedidos["C"]) == 1) :

                        ?>

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
                                        <div id="contenedorProductosKit" class="pt-3 px-2"></div>
                                        <!--============  FIN DE CONTENEDOR DE PRODUCTOS QUE CONFORMAN EL PEDIDO  =============-->

                                        <!-- BOTON PARA AGREGAR NUEVOS PRODUCTOS -->
                                        <div class="col-12 text-center mb-3">
                                            <input type="hidden" name="informacionPedido" id="informacionPedido">
                                            <input type="hidden" name="listaProductos" id="listaProductos">
                                            <button type="button" class="btn btn-outline-success btnAgregarProducto" data-toggle="modal" data-target="#modalAddProducto"><i class="fas fa-plus-circle mr-1"></i> Agregar producto</button>
                                        </div>
                                    </div>

                                    <?php include "views/modules/Pedidos/addPedido/addTotalesPedido.php"; ?>

                                </div>

                                <div class="card-footer bg-transparent" style="border-top: 1px solid #1A6890;">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary">Levantar pedido</button>
                                    </div>
                                </div>
                            </form>

                        <?php
                            /*=============================================
                            LLAMAMIENTO DEL MODAL PARA AGREGAR PRODUCTO
                            =============================================*/
                            include "views/modules/Pedidos/addPedido/addProducto/modalAddProducto.php";

                            /*=============================================
                            CONTROLADOR PARA LEVANTAR EL PEDIDO
                            =============================================*/
                            $levantarPedido = new ControladorPedidos();
                            $levantarPedido->ctrLevantarPedido();

                        else :

                            include "views/pages/permisosDenegados.php";

                        endif;
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- FIN DE CONTENEDOR PRINCIPAL
    -------------------------------------------------- -->

</div>
<!--============  FIN DE CONTENEDOR  =============-->