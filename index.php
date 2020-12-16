<?php
    #Plantilla
    require_once "controllers/plantilla.controlador.php";
    #Inicio de sesion
    // require_once "controllers/ingreso.controlador.php";
    // require_once "models/ingreso.modelo.php";
    // #Usuarios
    // require_once "controllers/usuarios.controlador.php";
    // require_once "models/usuarios.modelo.php";

    $plantilla = new ControladorPlantilla();
    $plantilla->TraerPlantilla();

?>