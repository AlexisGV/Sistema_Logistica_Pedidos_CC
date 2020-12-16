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

            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-info d-block mb-3" data-toggle="modal" data-target="#modalAddRol">
                        <i class="fas fa-plus mr-1"></i> Crear nuevo rol de usuario
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header mb-1">
                            <h1 class="card-title">Usuarios registrados</h1>
                        </div>
                        <div class="card-body p-1">
                            <?php include "views/modules/Roles-Usuario/tablaRoles.php"; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            include "views/modules/Roles-Usuario/modalAddRol.php";
            include "views/modules/Roles-Usuario/modalEditRol.php";
            ?>
        </div>
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<?php

    $elimiarRol = new ControladorRoles();
    $elimiarRol->ctrEliminarRol();

?>