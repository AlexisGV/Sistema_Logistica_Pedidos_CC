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
                    <h1 class="d-inline-block mr-2">Cortes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="levantarPedido">Inicio</a></li>
                        <li class="breadcrumb-item active">Cortes</li>
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
            OBTENER PERMISOS PARA ADMINISTRAR ACABADOS
            =============================================-->
            <?php
            $modulo = "Administración de cortes";
            $permisosAdministrarCortes = ControladorPermisos::ctrObtenerPermisos($modulo);
            ?>

            <!-- VALIDAR PERMISO PARA CREAR CORTES
            -------------------------------------------------- -->
            <?php if (intval($permisosAdministrarCortes["C"])) : ?>

                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-info d-block mb-3" data-toggle="modal" data-target="#modalAddCorte">
                            <i class="fas fa-plus mr-1"></i> Crear nuevo corte
                        </button>
                    </div>
                </div>

            <?php

                include "views/modules/Cortes/addCorte/modalAddCorte.php";

            endif;

            ?>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header mb-1">
                            <h1 class="card-title">Tipos de cortes</h1>
                        </div>
                        <div class="card-body p-1">
                            <?php

                                if (intval($permisosAdministrarCortes["R"]) == 1 || intval($permisosAdministrarCortes["U"]) == 1 || intval($permisosAdministrarCortes["D"]) == 1) {

                                    include "views/modules/Cortes/tablaCortes.php";

                                    if (intval($permisosAdministrarCortes["U"]) == 1) {
                                        include "views/modules/Cortes/editCorte/modalEditCorte.php";
                                    }

                                    if (intval($permisosAdministrarCortes["D"]) == 1) {
                                        /*=============================================
                                        INSTANCIA PARA ELIMINAR CORTE
                                        =============================================*/
                                        $elimiarCorte = new ControladorCorte();
                                        $elimiarCorte->ctrEliminarCorte();
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