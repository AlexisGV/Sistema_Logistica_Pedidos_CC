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

                if ( ($ingreso["Correo"] == $_POST["ingresoCorreo"] || $ingreso["Apodo"] == $_POST["ingresoCorreo"]) && $ingreso["Password"] == $encriptarContraseña) {

                    // echo "<pre>"; print_r($ingreso); echo "</pre>";
                    $_SESSION["sesionActiva"] = "ok";
                    $_SESSION["idUsuario"] = $ingreso["Id_Usuario"];
                    $_SESSION["nombreUsuario"] = $ingreso["Nombre_Usuario"];
                    $_SESSION["tipoUsuario"] = $ingreso["Id_Tipo_User1"];
                    $_SESSION["imagenUsuario"] = $ingreso["Foto_User"];

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
                    
                    <div class="alert alert-danger">Error al ingresar, la contraseña es incorrecta.</div>';
                }
            } else {
                echo
                        '<script>
                    
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    
                    </script>
                    
                    <div class="alert alert-danger">Error al ingresar, el usuario es incorrecto.</div>';
            }
        }
    }
}
