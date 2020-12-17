<!-- INICIO DE LA BARRA LATERAL -->
<aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <!-- LOGO DE LA ASOCIACION -->
    <a href="mainInventario" class="brand-link">
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

                        <?php if ($_GET["pagina"] == "levantarPedido" || $_GET["pagina"] == "administrarPedidos") : ?>
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
                        </ul>
                    </li>

                    <!-- LOGISTICA DE PEDIDOS -->
                    <li class="nav-item has-treeview">

                        <?php if ($_GET["pagina"] == "cambiarEstatus" || $_GET["pagina"] == "consultarPedidos") : ?>
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

                                <?php if ($_GET["pagina"] == "cambiarEstatus") : ?>
                                    <a href="cambiarEstatus" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Cambiar estados</p>
                                    </a>
                                <?php else : ?>
                                    <a href="cambiarEstatus" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Cambiar estados</p>
                                    </a>
                                <?php endif ?>

                            </li>
                            <li class="nav-item">

                                <?php if ($_GET["pagina"] == "consultarPedidos") : ?>
                                    <a href="consultarPedidos" class="nav-link active">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Consultar pedidos</p>
                                    </a>
                                <?php else : ?>
                                    <a href="consultarPedidos" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Consultar pedidos</p>
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
                                <a href="cambiarEstatus" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Cambiar estados</p>
                                </a>
                                <a href="consultarPedidos" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Consultar pedidos</p>
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

                <?php endif ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>