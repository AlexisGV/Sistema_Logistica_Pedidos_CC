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
                    <h1 class="d-inline-block mr-2">Producción</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="levantarPedido">Inicio</a></li>
                        <li class="breadcrumb-item active">Producción</li>
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
                        En esta sección se muestran todos los pedidos que han sido recibidos por el personal de producción y están por ser empezados a producir.
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header mb-1">
                            <h1 class="card-title">Pedidos en cola</h1>
                        </div>
                        <div class="card-body p-1">
                            <?php include "views/modules/Logistica/tablaCola.php"; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            include "views/modules/Pedidos/modalVerPedido.php";
            include "views/modules/Logistica/modalAddComentario.php";
            ?>

        </div>
    </section>
    <!-- FIN DE CONTENEDOR PRINCIPAL
    -------------------------------------------------- -->

</div>
<!--============  FIN DE CONTENEDOR  =============-->