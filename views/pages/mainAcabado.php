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
                    <h1 class="d-inline-block mr-2">Acabados</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="levantarPedido">Inicio</a></li>
                        <li class="breadcrumb-item active">Acabados</li>
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
            $modulo = "Administración de acabados";
            $permisosAdministrarAcabados = ControladorPermisos::ctrObtenerPermisos($modulo);
            ?>

            <!-- VALIDAR PERMISO PARA CREAR ACABADOS
            -------------------------------------------------- -->
            <?php if (intval($permisosAdministrarAcabados["C"])) : ?>

                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-success d-block mb-3" data-toggle="modal" data-target="#modalAddAcabado">
                            <i class="fas fa-plus mr-1"></i> Crear nuevo acabado
                        </button>
                    </div>
                </div>

            <?php

                include "views/modules/Acabados/addAcabado/modalAddAcabado.php";

            endif;

            ?>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header mb-1">
                            <h1 class="card-title">Tipos de acabados</h1>
                        </div>
                        <div class="card-body p-1">
                            <?php

                                if (intval($permisosAdministrarAcabados["R"]) == 1 || intval($permisosAdministrarAcabados["U"]) == 1 || intval($permisosAdministrarAcabados["D"]) == 1) {

                                    include "views/modules/Acabados/tablaAcabados.php";

                                    if (intval($permisosAdministrarAcabados["U"]) == 1) {
                                        include "views/modules/Acabados/editAcabado/modalEditAcabado.php";
                                    }

                                    if (intval($permisosAdministrarAcabados["D"]) == 1) {
                                        /*=============================================
                                            INSTANCIA PARA ELIMINAR ACABADO
                                            =============================================*/
                                        $elimiarAcabado = new ControladorAcabado();
                                        $elimiarAcabado->ctrEliminarAcabado();
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