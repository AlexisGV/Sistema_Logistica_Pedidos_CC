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
                    <h1 class="d-inline-block mr-2">Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="levantarPedido">Inicio</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
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
            OBTENER PERMISOS PARA ADMINISTRAR USUARIOS
            =============================================-->
            <?php
            $modulo = "Administración de usuarios";
            $permisosAdministrarUsuarios = ControladorPermisos::ctrObtenerPermisos($modulo);
            ?>

            <!-- VALIDAR PERMISO PARA CREAR USUARIOS
            -------------------------------------------------- -->
            <?php if (intval($permisosAdministrarUsuarios["C"])) : ?>

                <div class="row">
                    <div class="col">
                        <button type="button" class="btn bg-indigo d-block mb-3" data-toggle="modal" data-target="#modalAgregarUsuario">
                            <i class="fas fa-plus mr-1"></i> Crear nuevo usuario
                        </button>
                    </div>
                </div>

            <?php

                include "views/modules/Usuarios/addUser/modalAddUser.php";

            endif;

            ?>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header mb-1">
                            <h1 class="card-title">Usuarios registrados</h1>
                        </div>
                        <div class="card-body p-1">
                            <?php

                                if ( intval($permisosAdministrarUsuarios["R"]) == 1 || intval($permisosAdministrarUsuarios["U"]) == 1 || intval($permisosAdministrarUsuarios["D"]) == 1 ) {

                                    include "views/modules/Usuarios/listaUsuarios.php";

                                    if ( intval($permisosAdministrarUsuarios["U"]) == 1 ) {
                                        include "views/modules/Usuarios/editUser/modalEditUser.php";
                                    }

                                    if ( intval($permisosAdministrarUsuarios["D"]) == 1 ) {
                                        /*=============================================
                                        INSTANCIA PARA ELIMINAR USUARIO
                                        =============================================*/
                                        $borrarUsuario = new ControladorUsuarios();
                                        $borrarUsuario->ctrEliminarUsuario();
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