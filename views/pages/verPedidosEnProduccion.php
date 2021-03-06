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
                    <h1 class="d-inline-block mr-2">Todos los pedidos en producción</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="levantarPedido">Inicio</a></li>
                        <li class="breadcrumb-item active">Ver todos los pedidos</li>
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
                    <div class="alert alert-info">
                        En esta sección se muestran todos los pedidos que ya están en producción y los responsables de verificar que se estén realizando los mismos.
                    </div>
                </div>
            </div>

            <!--=============================================
            OBTENER PERMISOS PARA VER PEDIDOS EN PRODUCCION - GEN
            =============================================-->
            <?php
            $modulo = "Vista general de pedidos";
            $permisosGeneralesVistaPedidos = ControladorPermisos::ctrObtenerPermisos($modulo);
            ?>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header mb-1">
                            <h1 class="card-title">Pedidos en producción</h1>
                        </div>
                        <div class="card-body p-1">
                            <?php
                                if (intval($permisosGeneralesVistaPedidos["R"])) {

                                    include "views/modules/Logistica/tablaGenPedidosEnProduccion.php";
                                    include "views/modules/Pedidos/modalVerPedido.php";
                                } else {

                                    include "views/pages/permisosDenegados.php";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- FIN DE CONTENEDOR PRINCIPAL
    -------------------------------------------------- -->

</div>
<!--============  FIN DE CONTENEDOR  =============-->