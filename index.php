<?php
    #Plantilla
    require_once "controllers/plantilla.controlador.php";
    #Inicio de sesion
    require_once "controllers/ingreso.controlador.php";
    require_once "models/ingreso.modelo.php";
    #Usuarios
    require_once "controllers/usuarios.controlador.php";
    require_once "models/usuarios.modelo.php";
    #Roles
    require_once "controllers/roles.controlador.php";
    require_once "models/roles.modelo.php";
    #Acabados
    require_once "controllers/acabados.controlador.php";
    require_once "models/acabados.modelo.php";
    #Cortes
    require_once "controllers/cortes.controlador.php";
    require_once "models/cortes.modelo.php";
    #Formas
    require_once "controllers/formas.controlador.php";
    require_once "models/formas.modelo.php";
    #Marcas
    require_once "controllers/marcas.controlador.php";
    require_once "models/marcas.modelo.php";
    #Pedidos
    require_once "controllers/pedidos.controlador.php";
    require_once "models/pedidos.modelo.php";
    #Logistica
    require_once "controllers/logistica.controlador.php";
    require_once "models/logistica.modelo.php";

    $plantilla = new ControladorPlantilla();
    $plantilla->TraerPlantilla();

?>