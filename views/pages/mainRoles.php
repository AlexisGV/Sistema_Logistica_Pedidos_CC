<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="d-inline-block mr-2">Roles de usuario</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="mainProduct">Inicio</a></li>
                        <li class="breadcrumb-item active">Roles de usuario</li>
                    </ol>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">

            <!--=============================================
            OBTENER PERMISOS PARA ADMINISTRAR ROLES
            =============================================-->
            <?php
            $modulo = "Administración de roles";
            $permisosAdministrarRoles = ControladorPermisos::ctrObtenerPermisos($modulo);
            ?>

            <!-- VALIDAR PERMISO PARA CREAR ROLES
            -------------------------------------------------- -->
            <?php if (intval($permisosAdministrarRoles["C"])) : ?>
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-info d-block mb-3" data-toggle="modal" data-target="#modalAddRol">
                            <i class="fas fa-plus mr-1"></i> Crear nuevo rol de usuario
                        </button>
                    </div>
                </div>
            <?php
                include "views/modules/Roles-Usuario/modalAddRol.php";
            endif;
            ?>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header mb-1">
                            <h1 class="card-title">Roles de usuario registrados</h1>
                        </div>
                        <div class="card-body p-1">
                            <?php

                                if (intval($permisosAdministrarRoles["R"]) == 1 || intval($permisosAdministrarRoles["U"]) == 1 || intval($permisosAdministrarRoles["D"]) == 1 || $_SESSION["tipoUsuarioPorNombre"] == "Administrador") {

                                    include "views/modules/Roles-Usuario/tablaRoles.php";

                                    if (intval($permisosAdministrarRoles["U"]) == 1) {
                                        include "views/modules/Roles-Usuario/modalEditRol.php";
                                    }

                                    if (intval($permisosAdministrarRoles["D"]) == 1) {
                                        /*=============================================
                                        INSTANCIA PARA ELIMINAR ROLES
                                        =============================================*/
                                        $elimiarRol = new ControladorRoles();
                                        $elimiarRol->ctrEliminarRol();
                                    }

                                    if ( $_SESSION["tipoUsuarioPorNombre"] == "Administrador" ) {
                                        include "views/modules/Roles-Usuario/modalPermisos.php";
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
    <!-- /.content -->

</div>