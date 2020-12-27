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

    $plantilla = new ControladorPlantilla();
    $plantilla->TraerPlantilla();

?>