<?php if (isset($_SESSION["sesionActiva"])) : ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->



        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Página de error 404</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="mainProduct">Inicio</a></li>
                            <li class="breadcrumb-item active">Página de error 404</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

    <?php endif ?>

    <!-- Main content -->
    <section class="content">

        <?php if (isset($_SESSION["sesionActiva"])) : ?>
            <div class="error-page">
                <h2 class="headline text-warning"> 404</h2>

                <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Página no encontrada.</h3>
                <?php else : ?>
                    <div class="error-page bg-light py-5 px-4" style="margin-top: 18vh;">
                        <h2 class="headline text-danger"> 404</h2>

                        <div class="error-content">
                            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Página no encontrada.</h3>
                        <?php endif ?>

                        <p>
                            No hemos podido encontrar la página que esta solicitando.
                            Sin embargo, puedes intentar
                            <?php if (isset($_SESSION["sesionActiva"])) : ?>
                                <a href="mainProduct">volver al inicio</a>
                            <?php else : ?>
                                <a href="ingreso">volver al inicio</a>
                            <?php endif ?>
                            .
                        </p>

                        </div>
                        <!-- /.error-content -->
                    </div>
                    <!-- /.error-page -->
    </section>
    <!-- /.content -->
    <?php if (isset($_SESSION["sesionActiva"])) : ?>
    </div>
    <!-- /.content-wrapper -->
<?php endif ?>