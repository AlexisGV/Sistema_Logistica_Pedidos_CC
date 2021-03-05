<?php

session_start();

class FormularioIngreso
{

    static public function ctlIngreso()
    {

        if (isset($_POST["ingresoCorreo"])) {

            $tabla = "usuario";
            $item = "Correo";
            $item2 = "Apodo";
            $correoUser = $_POST["ingresoCorreo"];

            $ingreso = ModeloIngreso::mdlIngreso($tabla, $item, $item2, $correoUser);

            $encriptarContraseña = crypt($_POST["ingresoPassword"], '$2a$07$cialOgCcrAolNofVEsmcrdDeA$');

            if ($ingreso) {

                if (($ingreso["Correo"] == $_POST["ingresoCorreo"] || $ingreso["Apodo"] == $_POST["ingresoCorreo"]) && $ingreso["Password"] == $encriptarContraseña) {

                    // echo "<pre>"; print_r($ingreso); echo "</pre>";
                    $_SESSION["sesionActiva"] = "ok";
                    $_SESSION["idUsuario"] = $ingreso["Id_Usuario"];
                    $_SESSION["nombreUsuario"] = $ingreso["Nombre_Usuario"];
                    $_SESSION["tipoUsuario"] = $ingreso["Id_Tipo_User1"];
                    $_SESSION["tipoUsuarioPorNombre"] = $ingreso["Tipo_User"];
                    $_SESSION["imagenUsuario"] = $ingreso["Foto_User"];

                    if (isset($_POST["remember"])) {
                        setcookie("user_ck", $_POST["ingresoCorreo"], time() + 183 * 24 * 60 * 60);
                        setcookie("pass_ck", $encriptarContraseña, time() + 183 * 24 * 60 * 60);
                    }

                    echo

                    '<script>
                    
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    
                        window.location = "levantarPedido";
                    </script>';
                } else {

                    echo

                    '<script>
                    
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    
                    </script>
                    
                    <div class="alert alert-danger mt-3">Error al ingresar, la contraseña es incorrecta.</div>';
                }
            } else {
                echo
                '<script>
                    
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    
                    </script>
                    
                    <div class="alert alert-danger mt-3">Error al ingresar, el usuario es incorrecto.</div>';
            }
        }
    }

    /*=============================================
    ESTABLECER SESIONES CUANDO HAY COOKIES
    =============================================*/
    static public function establecerSesiones($usuario, $password)
    {
        $tabla = "usuario";
        $item = "Correo";
        $item2 = "Apodo";
        $correoUser = $usuario;
        $passEncrypt = $password;

        $ingreso = ModeloIngreso::mdlIngreso($tabla, $item, $item2, $correoUser);

        if ($ingreso) {

            if (($ingreso["Correo"] == $correoUser || $ingreso["Apodo"] == $correoUser) && $ingreso["Password"] == $passEncrypt) {

                // echo "<pre>"; print_r($ingreso); echo "</pre>";
                $_SESSION["sesionActiva"] = "ok";
                $_SESSION["idUsuario"] = $ingreso["Id_Usuario"];
                $_SESSION["nombreUsuario"] = $ingreso["Nombre_Usuario"];
                $_SESSION["tipoUsuario"] = $ingreso["Id_Tipo_User1"];
                $_SESSION["tipoUsuarioPorNombre"] = $ingreso["Tipo_User"];
                $_SESSION["imagenUsuario"] = $ingreso["Foto_User"];

                return true;
            }
        } else {
            # Usuario no encontrado
            echo '<script>
                    swal({
                        title: "¡Error al validar datos de ingreso al sistema!",
                        text: "Parace ser que tu correo, usuario o contraseña han cambiado. Debes iniciar sesión nuevamente.",
                        icon: "info",
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                    }).then( (result) => {
                        window.location = "salir";
                    });
                  </script>';

            return false;
            
        }
    }

    /*=============================================
    ACTUALIZA SESIONES Y COOKIES PARA EVITAR 
    PROBLEMAS AL ACTUALIZAR ROL, APODO, NOMBRE, ETC
    =============================================*/
    static public function ctrActualizarSesionesCookies()
    {

        if ((isset($_SESSION["sesionActiva"]) && $_SESSION["sesionActiva"] == "ok") && (isset($_SESSION["idUsuario"]) && $_SESSION["idUsuario"] != "")) {

            $tabla = "usuario";
            $item = "Id_Usuario";
            $valor = $_SESSION["idUsuario"];

            $usuarioLoggeado = ModeloIngreso::mdlSeleccionarUsuario($tabla, $item, $valor);

            if ( $usuarioLoggeado ) {

                $_SESSION["nombreUsuario"] = $usuarioLoggeado["Nombre_Usuario"];
                $_SESSION["tipoUsuario"] = $usuarioLoggeado["Id_Tipo_User1"];
                $_SESSION["tipoUsuarioPorNombre"] = $usuarioLoggeado["Tipo_User"];
                $_SESSION["imagenUsuario"] = $usuarioLoggeado["Foto_User"];

                if (isset($_COOKIE["user_ck"]) && $_COOKIE["user_ck"] != "") {

                    if ( strpos($_COOKIE["user_ck"], "@") ) :
                        $campo = $usuarioLoggeado["Correo"];
                    else: 
                        $campo = $usuarioLoggeado["Apodo"];
                    endif;

                    if ( $_COOKIE["user_ck"] !=  $campo || $_COOKIE["pass_ck"] != $usuarioLoggeado["Password"] ) {

                        echo '<script>
                                swal({
                                    title: "¡Error al validar datos de ingreso al sistema!",
                                    text: "Parace ser que tu correo, usuario o contraseña han cambiado. Debes iniciar sesión nuevamente.",
                                    icon: "info",
                                    closeOnClickOutside: false,
                                    closeOnEsc: false,
                                }).then( (result) => {
                                    window.location = "salir";
                                });
                              </script>';

                        return false;

                    }
                    
                }

                return true;
            } else {

                # Usuario no existe en la base de datos
                echo '<script>
                        swal({
                            title: "¡Usuario eliminado!",
                            text: "Parace ser que tu registro ya no existe en la base de datos. Si se trata de un error verificalo con el administrador del sistema.",
                            icon: "error",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        }).then( (result) => {
                            window.location = "salir";
                        });
                      </script>';

                return false;
            }
        }
    }
}
