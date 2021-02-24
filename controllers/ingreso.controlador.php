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
        } else if (isset($_COOKIE["user_ck"]) && $_COOKIE["user_ck"] != "") {

            $tabla = "usuario";
            $item = "Correo";
            $item2 = "Apodo";
            $correoUser = $_COOKIE["user_ck"];
            $passEncrypt = $_COOKIE["pass_ck"];

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

                    echo

                    '<script>
                    
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    
                        window.location = "levantarPedido";
                    </script>';
                } else {
                    echo '<script> window.location = "salir"; </script>';
                }
            } else {
                echo '<script> window.location = "salir"; </script>';
            }
        }
    }

    static public function establecerSesiones( $usuario, $password )
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
            
            } else {
                echo '<script> window.location = "salir"; </script>';
            }

        } else {
            echo '<script> window.location = "salir"; </script>';
        }
    }
}
