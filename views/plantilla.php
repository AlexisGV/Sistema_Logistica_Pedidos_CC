<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>Gestión y Logistica de Pedidos</title>
  <link rel="shortcut icon" href="views/dist/img/Logo-CC-Corto.png" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="views/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="views/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="views/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/adminlte.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- SweetAlert2 -->
  <script src="views/plugins/sweetalert2/sweetalert.min.js"></script>
</head>


<?php if (isset($_SESSION["sesionActiva"]) && isset($_SESSION["sesionActiva"]) == "ok") : ?>

  <body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">

    <div class="wrapper">
      <?php

      include "sections/cabezote.php";
      include "sections/lateral.php";

      if (isset($_GET["pagina"])) {

        if (
          $_GET["pagina"] == "mainUsuarios" ||
          $_GET["pagina"] == "mainRoles" ||
          $_GET["pagina"] == "levantarPedido" ||
          $_GET["pagina"] == "salir"
        ) {

          include "pages/" . $_GET["pagina"] . ".php";
        } else {
          include "pages/error404.php";
        }
      } else {
        include "pages/mainUsuarios.php";
      }

      include "sections/pie.php";

      ?>
    </div>

  <?php
    else :

      if (isset($_GET["pagina"])) {

        if ($_GET["pagina"] == "ingreso") {
          include "pages/" . $_GET["pagina"] . ".php";
        } else {
          include "pages/error404.php";
        }
      } else {
        include "pages/ingreso.php";
      }

    endif
  ?>

  <!--=============================================
  LIBRERIAS DE JAVASCRIPT
  =============================================-->
  <!-- jQuery -->
  <script src="views/plugins/jquery/jquery.min.js"></script>
  <script src="views/plugins/jquery-3.5.1/jquery-3.5.1.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="views/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- jQuery Number -->
  <script src="views/plugins/jquery-number/jquery.number.min.js"></script>
  <!-- Select2 -->
  <script src="views/plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables -->
  <script src="views/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!--=============================================
  SCRIPTS PARA PLANTILLA / MODULOS
  =============================================-->
  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.js"></script>
  <!-- Plantilla -->
  <script src="views/js/plantilla.js"></script>
  <!-- Usuarios / Roles -->
  <script src="views/js/usuarios.js"></script>
  <script src="views/js/roles.js"></script>
  <script src="views/js/validaciones/validacionUsers.js"></script>
  <script src="views/js/validaciones/validacionPedidos.js"></script>

  </body>

</html>