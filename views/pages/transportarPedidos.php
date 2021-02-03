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
                    <h1 class="d-inline-block mr-2">Recolección de pedidos para enviar a tienda</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="levantarPedido">Inicio</a></li>
                        <li class="breadcrumb-item active">Recolección de pedidos para enviar a tienda</li>
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
                        En esta sección se muestran todos los pedidos ya han sido terminados y que pueden ser recolectados por la camioneta para ser enviados de regreso a tienda.
                    </div>
                </div>
            </div>

            <!--=============================================
            OBTENER PERMISOS PARA RECOLECCIÓN DE PEDIDOS
            =============================================-->
            <?php
            $modulo = "Recolección y descarga de pedidos";
            $permisosRecoleccion = ControladorPermisos::ctrObtenerPermisos($modulo);
            ?>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header mb-1">
                            <h1 class="card-title">Pedidos terminados</h1>
                        </div>
                        <div class="card-body p-1">
                            <?php

                                if (intval($permisosRecoleccion["R"]) == 1 || intval($permisosRecoleccion["U"]) == 1) {

                                    include "views/modules/Logistica/tablaTransporte.php";

                                    if (intval($permisosRecoleccion["R"]) == 1) {
                                        include "views/modules/Pedidos/modalVerPedido.php";
                                    }

                                    if (intval($permisosRecoleccion["U"]) == 1) {
                                        include "views/modules/Logistica/modalAddComentario.php";
                                    }
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