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
                    <h1 class="d-inline-block mr-2">Marcas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="levantarPedido">Inicio</a></li>
                        <li class="breadcrumb-item active">Marcas</li>
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
                    <button type="button" class="btn bg-orange d-block mb-3" data-toggle="modal" data-target="#modalAddMarca">
                        <i class="fas fa-plus mr-1"></i> Crear nueva marca
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header mb-1">
                            <h1 class="card-title">Marcas registradas</h1>
                        </div>
                        <div class="card-body p-1">
                            <?php include "views/modules/Marcas/tablaMarcas.php"; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            include "views/modules/Marcas/addMarca/modalAddMarca.php";
            include "views/modules/Marcas/editMarca/modalEditMarca.php";
            ?>
        </div>
    </section>
    <!-- FIN DE CONTENEDOR PRINCIPAL
    -------------------------------------------------- -->

</div>
<!--============  FIN DE CONTENEDOR  =============-->

<?php

$elimiarMarca = new ControladorMarca();
$elimiarMarca->ctrEliminarMarca();

?>