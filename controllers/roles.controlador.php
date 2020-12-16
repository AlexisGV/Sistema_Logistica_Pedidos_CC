<?php

class ControladorRoles
{

    /*=============================================
    CONSULTA Y BUSQUEDA DE ROLES
    =============================================*/
    static public function ctrObtenerRoles($item, $valor)
    {

        $tabla = "tipo_usuario";

        $consulta = ModeloRoles::mdlObtenerRoles($tabla, $item, $valor);

        return $consulta;

    }

    /*=============================================
    AGREGAR ROL DE USUARIO
    =============================================*/
    static public function ctrCrearRol(){

        if ( isset($_POST["nomRol"]) ){

            $tabla = "tipo_usuario";
            $valor = $_POST["nomRol"];

            $ingreso = ModeloRoles::mdlCrearRol($tabla, $valor);

            return $ingreso;

        }

    }

    /*=============================================
    ACTUALIZAR ROL DE USUARIO
    =============================================*/
    static public function ctrAztualizarRol(){

        if ( isset($_POST["nomEditRol"]) ){

            $tabla = "tipo_usuario";
            $item = "Id_Tipo_User";
            $datos = array(
                "idRol" => $_POST["idEditRol"],
                "rol" => $_POST["nomEditRol"]
            );

            $actualizar = ModeloRoles::mdlActualizarRol($tabla, $item, $datos);

            return $actualizar;

        }

    }

    /*=============================================
    ELIMINAR ROL DE USUARIO
    =============================================*/
    static public function ctrEliminarRol(){

        if ( isset($_GET["idRol"]) ){

            $tabla = "tipo_usuario";
            $item = "Id_Tipo_User";
            $valor = $_GET["idRol"];

            $eliminar = ModeloRoles::mdlEliminarRol($tabla, $item, $valor);

            if ($eliminar == "ok") {
                echo '<script>
                        swal({
                            title: "Eliminación exitosa!",
                            text: "El rol se eliminó correctamente.",
                            icon: "success",
                        }).then( (result) => {
                            window.location = "mainRoles";
                        });
                      </script>';
            } else if( $eliminar == "errorPadres" ){
                echo '<script>
                        swal({
                            title: "Error al intentar eliminar!",
                            text: "No se ha podido eliminar, ya que tienes usuarios registrados con este tipo de rol.",
                            icon: "warning",
                        }).then( (result) => {
                            window.location = "mainRoles";
                        });
                      </script>';
            } else {
                echo '<script>
                        swal({
                            title: "Error!",
                            text: "Ha ocurrido un error con la conexión a la base de datos.",
                            icon: "error",
                        }).then( (result) => {
                            window.location = "mainRoles";
                        });
                      </script>';
            }

        }

    }

}

?>