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
                    <h1 class="d-inline-block mr-2">Asignar responsables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="levantarPedido">Inicio</a></li>
                        <li class="breadcrumb-item active">Asignar responsables</li>
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
                        En esta sección se muestran todos los pedidos que han llegado a taller y a los cuales se les debe asignar un responsable.
                    </div>
                </div>
            </div>

            <!--=============================================
            OBTENER PERMISOS PARA ASIGNAR RESPONSABLES
            =============================================-->
            <?php
            $modulo = "Asignación de pedidos";
            $permisosAsignacion = ControladorPermisos::ctrObtenerPermisos($modulo);
            ?>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header mb-1">
                            <h1 class="card-title">Pedidos sin responsables asignados</h1>
                        </div>
                        <div class="card-body p-1">
                            <?php

                                if (intval($permisosAsignacion["R"]) == 1 || intval($permisosAsignacion["U"]) == 1) {

                                    include "views/modules/Logistica/tablaAsignacion.php";

                                    if (intval($permisosAsignacion["R"]) == 1) {
                                        include "views/modules/Pedidos/modalVerPedido.php";
                                    }

                                    if (intval($permisosAsignacion["U"]) == 1) {
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