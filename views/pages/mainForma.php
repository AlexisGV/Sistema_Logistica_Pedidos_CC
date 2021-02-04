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
                    <h1 class="d-inline-block mr-2">Formas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="levantarPedido">Inicio</a></li>
                        <li class="breadcrumb-item active">Formas</li>
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
            OBTENER PERMISOS PARA ADMINISTRAR FORMAS
            =============================================-->
            <?php
            $modulo = "Administración de formas";
            $permisosAdministrarFormas = ControladorPermisos::ctrObtenerPermisos($modulo);
            ?>

            <!-- VALIDAR PERMISO PARA CREAR FORMAS
            -------------------------------------------------- -->
            <?php if (intval($permisosAdministrarFormas["C"])) : ?>
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn bg-indigo d-block mb-3" data-toggle="modal" data-target="#modalAddForma">
                            <i class="fas fa-plus mr-1"></i> Crear nueva forma
                        </button>
                    </div>
                </div>
            <?php

                include "views/modules/Formas/addForma/modalAddForma.php";

            endif;

            ?>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header mb-1">
                            <h1 class="card-title">Tipos de formas</h1>
                        </div>
                        <div class="card-body p-1">
                            <?php

                                if (intval($permisosAdministrarFormas["R"]) == 1 || intval($permisosAdministrarFormas["U"]) == 1 || intval($permisosAdministrarFormas["D"]) == 1) {

                                    include "views/modules/Formas/tablaFormas.php";

                                    if (intval($permisosAdministrarFormas["U"]) == 1) {
                                        include "views/modules/Formas/editForma/modalEditForma.php";
                                    }

                                    if (intval($permisosAdministrarFormas["D"]) == 1) {
                                        /*=============================================
                                        INSTANCIA PARA ELIMINAR CORTE
                                        =============================================*/
                                        $elimiarForma = new ControladorForma();
                                        $elimiarForma->ctrEliminarForma();
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