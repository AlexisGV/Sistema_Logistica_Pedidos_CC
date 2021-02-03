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
                    <h1 class="d-inline-block mr-2">Pedidos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="levantarPedido">Inicio</a></li>
                        <li class="breadcrumb-item active">Pedidos</li>
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
            OBTENER PERMISOS PARA REPORTES DE LOGISTICA
            =============================================-->
            <?php
            $modulo = "Logística y reportes";
            $permisosLogistica = ControladorPermisos::ctrObtenerPermisos($modulo);

            /* PERMISO PARA CREAR REPORTES
            -------------------------------------------------- */
            if (intval($permisosLogistica["C"]) == 1) :
            ?>
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn bg-navy mb-3" data-toggle="modal" data-target="#modalReportesLogistica">Obtener reporte de logistica</button>
                    </div>
                </div>
            <?php endif; ?>

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
                        <div class="card-header mb-1">
                            <h1 class="card-title">Todos los pedidos</h1>
                        </div>
                        <div class="card-body p-1">
                            <?php

                                if ( intval($permisosPedidos["C"]) == 1 || intval($permisosPedidos["R"]) == 1 || intval($permisosPedidos["U"]) == 1 || intval($permisosPedidos["D"]) == 1 || intval($permisosLogistica["R"]) == 1 ) :
                            
                                    include "views/modules/Pedidos/tablaPedidos.php";

                                else :

                                    include "views/pages/permisosDenegados.php";
                                    
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            include "views/modules/Pedidos/modalVerPedido.php";
            include "views/modules/Pedidos/modalVerLogisticaPedido.php";
            include "views/modules/Pedidos/modalOpcionesReportes.php";
            include "views/modules/Pedidos/editPedido/modalEditPedido.php";
            include "views/modules/Pedidos/editPedido/modalAddProducto.php";
            ?>
        </div>
    </section>
    <!-- FIN DE CONTENEDOR PRINCIPAL
    -------------------------------------------------- -->

</div>
<!--============  FIN DE CONTENEDOR  =============-->

<?php

/*=============================================
ELIMINAR PEDIDO
=============================================*/
$eliminarPedido = new ControladorPedidos();
$eliminarPedido->ctrEliminarPedido();

?>