<!-- INICIO DE LA BARRA LATERAL -->
<aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <!-- LOGO DE LA ASOCIACION -->
    <a href="levantarPedido" class="brand-link">
        <img src="views/dist/img/Logo-CC-Corto.png" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-normal">Cerrando el Ciclo A.C</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="
                <?php
                # Colocar la imagen desde la base de datos
                if (isset($_SESSION["sesionActiva"]) && isset($_SESSION["sesionActiva"]) == "ok") {
                    if ($_SESSION["imagenUsuario"] != "") :
                        echo $_SESSION["imagenUsuario"];
                    else :
                        echo "views/img/Usuarios/defaultUser.png";
                    endif;
                }
                ?>
                " class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <span href="#" class="d-block text-truncate text-white">
                    <?php
                    # Colocar el nombre de usuario desde la Base de Datos
                    if (isset($_SESSION["sesionActiva"]) && isset($_SESSION["sesionActiva"]) == "ok") {
                        echo $_SESSION["nombreUsuario"];
                    }
                    ?>
                </span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <?php if (isset($_GET["pagina"])) : ?>

                    <!-- PEDIDOS -->
                    <li class="nav-item has-treeview">

                        <?php if ($_GET["pagina"] == "levantarPedido" || $_GET["pagina"] == "administrarPedidos" || $_GET["pagina"] == "entregarPedidos") : ?>
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-folder-open"></i>
                                <p>
                                    Pedidos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                        <?php else : ?>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-folder-open"></i>
                                <p>
                                    Pedidos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                        <?php endif ?>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "levantarPedido") : ?>
                                    <a href="levantarPedido" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Levantar pedido</p>
                                    </a>
                                <?php else : ?>
                                    <a href="levantarPedido" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Levantar pedido</p>
                                    </a>
                                <?php endif ?>

                            </li>
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "administrarPedidos") : ?>
                                    <a href="administrarPedidos" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Administrar pedidos</p>
                                    </a>
                                <?php else : ?>
                                    <a href="administrarPedidos" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Administrar pedidos</p>
                                    </a>
                                <?php endif ?>

                            </li>
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "entregarPedidos") : ?>
                                    <a href="entregarPedidos" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Entrega final</p>
                                    </a>
                                <?php else : ?>
                                    <a href="entregarPedidos" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Entrega final</p>
                                    </a>
                                <?php endif ?>

                            </li>
                        </ul>
                    </li>

                    <!-- LOGISTICA DE PEDIDOS -->
                    <li class="nav-item has-treeview">

                        <?php if ($_GET["pagina"] == "verPedidosEnProduccion" || $_GET["pagina"] == "recolectarPedidos" || $_GET["pagina"] == "descargaTaller" || $_GET["pagina"] == "asignarPedidos" || $_GET["pagina"] == "pedidosEnCola" || $_GET["pagina"] == "produccionPedidos" || $_GET["pagina"] == "transportarPedidos" || $_GET["pagina"] == "descargaTienda") : ?>
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-shipping-fast"></i>
                                <p>
                                    Logística de pedidos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                        <?php else : ?>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-shipping-fast"></i>
                                <p>
                                    Logística de pedidos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                        <?php endif ?>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "verPedidosEnProduccion") : ?>
                                    <a href="verPedidosEnProduccion" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Ver todos los pedidos</p>
                                    </a>
                                <?php else : ?>
                                    <a href="verPedidosEnProduccion" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Ver todos los pedidos</p>
                                    </a>
                                <?php endif ?>

                            </li>
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "recolectarPedidos") : ?>
                                    <a href="recolectarPedidos" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Recolección de pedidos</p>
                                    </a>
                                <?php else : ?>
                                    <a href="recolectarPedidos" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Recolección de pedidos</p>
                                    </a>
                                <?php endif ?>

                            </li>
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "descargaTaller") : ?>
                                    <a href="descargaTaller" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Descarga en taller</p>
                                    </a>
                                <?php else : ?>
                                    <a href="descargaTaller" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Descarga en taller</p>
                                    </a>
                                <?php endif ?>

                            </li>
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "asignarPedidos") : ?>
                                    <a href="asignarPedidos" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Asignación de pedidos</p>
                                    </a>
                                <?php else : ?>
                                    <a href="asignarPedidos" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Asignación de pedidos</p>
                                    </a>
                                <?php endif ?>

                            </li>
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "pedidosEnCola") : ?>
                                    <a href="pedidosEnCola" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Pedidos en espera</p>
                                    </a>
                                <?php else : ?>
                                    <a href="pedidosEnCola" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Pedidos en espera</p>
                                    </a>
                                <?php endif ?>

                            </li>
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "produccionPedidos") : ?>
                                    <a href="produccionPedidos" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Producción de pedidos</p>
                                    </a>
                                <?php else : ?>
                                    <a href="produccionPedidos" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Producción de pedidos</p>
                                    </a>
                                <?php endif ?>

                            </li>
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "transportarPedidos") : ?>
                                    <a href="transportarPedidos" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Recolección en taller</p>
                                    </a>
                                <?php else : ?>
                                    <a href="transportarPedidos" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Recolección en taller</p>
                                    </a>
                                <?php endif ?>

                            </li>
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "descargaTienda") : ?>
                                    <a href="descargaTienda" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Descarga en tienda</p>
                                    </a>
                                <?php else : ?>
                                    <a href="descargaTienda" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Descarga en tienda</p>
                                    </a>
                                <?php endif ?>

                            </li>
                        </ul>
                    </li>

                    <!-- USUARIOS Y PERMISOS -->
                    <li class="nav-item has-treeview">

                        <?php if ($_GET["pagina"] == "mainUsuarios" || $_GET["pagina"] == "mainRoles") : ?>
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                        <?php else : ?>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                        <?php endif ?>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "mainUsuarios") : ?>
                                    <a href="mainUsuarios" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Usuarios</p>
                                    </a>
                                <?php else : ?>
                                    <a href="mainUsuarios" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Usuarios</p>
                                    </a>
                                <?php endif ?>

                            </li>
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "mainRoles") : ?>
                                    <a href="mainRoles" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Roles de usuario</p>
                                    </a>
                                <?php else : ?>
                                    <a href="mainRoles" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Roles de usuario</p>
                                    </a>
                                <?php endif ?>

                            </li>
                        </ul>
                    </li>

                    <!-- DETALLES DEL PRODUCTO -->
                    <li class="nav-item has-treeview">

                        <?php if ($_GET["pagina"] == "mainAcabado" || $_GET["pagina"] == "mainCorte"  || $_GET["pagina"] == "mainForma" || $_GET["pagina"] == "mainMarca") : ?>
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-wine-bottle"></i>
                                <p>
                                    Detalles del producto
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                        <?php else : ?>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-wine-bottle"></i>
                                <p>
                                    Detalles del producto
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                        <?php endif ?>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "mainAcabado") : ?>
                                    <a href="mainAcabado" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Abacados</p>
                                    </a>
                                <?php else : ?>
                                    <a href="mainAcabado" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Abacados</p>
                                    </a>
                                <?php endif ?>

                            </li>
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "mainCorte") : ?>
                                    <a href="mainCorte" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Cortes</p>
                                    </a>
                                <?php else : ?>
                                    <a href="mainCorte" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Cortes</p>
                                    </a>
                                <?php endif ?>

                            </li>
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "mainForma") : ?>
                                    <a href="mainForma" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Formas</p>
                                    </a>
                                <?php else : ?>
                                    <a href="mainForma" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Formas</p>
                                    </a>
                                <?php endif ?>

                            </li>
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "mainMarca") : ?>
                                    <a href="mainMarca" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Marcas</p>
                                    </a>
                                <?php else : ?>
                                    <a href="mainMarca" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Marcas</p>
                                    </a>
                                <?php endif ?>

                            </li>
                        </ul>
                    </li>

                <?php else :  ?>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-folder-open"></i>
                            <p>
                                Pedidos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="levantarPedido" class="nav-link active">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Levantar pedido</p>
                                </a>
                                <a href="administrarPedidos" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Administrar pedidos</p>
                                </a>
                                <a href="entregarPedidos" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Entrega final</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-shipping-fast"></i>
                            <p>
                                Logística de pedidos
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="verPedidosEnProduccion" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Ver todos los pedidos</p>
                                </a>
                                <a href="recolectarPedidos" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Recolección de pedidos</p>
                                </a>
                                <a href="descargaTaller" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Descarga en taller</p>
                                </a>
                                <a href="asignarPedidos" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Asignación de pedidos</p>
                                </a>
                                <a href="pedidosEnCola" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Pedidos en espera</p>
                                </a>
                                <a href="produccionPedidos" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Producción de pedidos</p>
                                </a>
                                <a href="transportarPedidos" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Recolección en taller</p>
                                </a>
                                <a href="descargaTienda" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Descarga en tienda</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Usuarios
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="mainUsuarios" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Usuarios</p>
                                </a>
                                <a href="mainRoles" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Roles de Usuario</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-wine-bottle"></i>
                            <p>
                                Detalles del producto
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="mainAcabado" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Acabados</p>
                                </a>
                                <a href="mainCorte" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Cortes</p>
                                </a>
                                <a href="mainForma" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Formas</p>
                                </a>
                                <a href="mainMarca" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Marcas</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php endif ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>