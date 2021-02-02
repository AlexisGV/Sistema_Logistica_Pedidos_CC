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
    CONSULTA DE MODULOS Y PERMISOS
    =============================================*/
    static public function ctrObtenerPermisos($idRol)
    {
        $tabla = "modulo";
        $item = "Id_Tipo_User";
        $valor = $idRol;
        $orderItem = "Id_Modulo";

        $consulta = ModeloRoles::mdlObtenerPermisos($tabla, $item, $valor, $orderItem);

        return $consulta;
    }

    /*=============================================
    AGREGAR ROL DE USUARIO
    =============================================*/
    static public function ctrCrearRol()
    {

        if (isset($_POST["nomRol"])) {

            /* OBTENER SIGUIENTE ID
            -------------------------------------------------- */
            $tabla = "tipo_usuario";
            $item = "Id_Tipo_User";

            $idRol = ModeloPedidos::mdlObtenerSiguienteId($tabla, $item);

            if ($idRol) {
                $idRolNuevo = intval($idRol["Id_Tipo_User"]) + 1;
            } else {
                $idRolNuevo = 1;
            }

            /* INSERTAR ROL
            -------------------------------------------------- */
            $tabla = "tipo_usuario";
            $datos = array(
                "id" => $idRolNuevo,
                "nombre" => $_POST["nomRol"],
                "descripcion" => $_POST["ingDescripcionRol"]
            );

            $ingreso = ModeloRoles::mdlCrearRol($tabla, $datos);

            if ($ingreso == "ok") :

                /* INSERTAR PERMISOS DEL ROL
            -------------------------------------------------- */
                $modulos = ModeloRoles::mdlObtenerModulos();

                $tabla = "permisos";
                $errores = 0;

                foreach ($modulos as $key => $value) {

                    $idModulo = $value["Id_Modulo"];
                    $registrarPermisos = ModeloRoles::mdlRegistrarPermisos($tabla, $idModulo, $idRolNuevo);

                    if ($registrarPermisos == "error") {
                        $errores++;
                    }
                }

                if ($errores == 0) {
                    return $ingreso;
                } else {

                    $tabla = "tipo_usuario";
                    $item = "Id_Tipo_User";
                    $eliminarRol = ModeloRoles::mdlEliminarRol($tabla, $item, $idRolNuevo);

                    return "erroresModulos";
                }

            else :

                return $ingreso;

            endif;
        }
    }

    /*=============================================
    ACTUALIZAR ROL DE USUARIO
    =============================================*/
    static public function ctrAztualizarRol()
    {

        if (isset($_POST["nomEditRol"])) {

            $tabla = "tipo_usuario";
            $item = "Id_Tipo_User";
            $datos = array(
                "idRol" => $_POST["idEditRol"],
                "nombre" => $_POST["nomEditRol"],
                "descripcion" => $_POST["editDescripcionRol"]
            );

            $actualizar = ModeloRoles::mdlActualizarRol($tabla, $item, $datos);

            return $actualizar;
        }
    }

    /*=============================================
    ACTULIZAR PERMISO DEL ROL DE USUARIO
    =============================================*/
    static public function ctrActualizarPermiso($datos)
    {
        $tabla = "permisos";
        $permiso = $datos;

        $actualizar = ModeloRoles::mdlActualizarPermiso($tabla, $permiso);

        return $actualizar;
    }

    /*=============================================
    ELIMINAR ROL DE USUARIO
    =============================================*/
    static public function ctrEliminarRol()
    {

        if (isset($_GET["idRol"])) {

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
                            closeOnClickOutside: false,
                        }).then( (result) => {
                            window.location = "mainRoles";
                        });
                      </script>';
            } else if ($eliminar == "errorPadres") {
                echo '<script>
                        swal({
                            title: "Error al intentar eliminar!",
                            text: "No se ha podido eliminar, ya que tienes usuarios registrados con este tipo de rol.",
                            icon: "warning",
                            closeOnClickOutside: false,
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
                            closeOnClickOutside: false,
                        }).then( (result) => {
                            window.location = "mainRoles";
                        });
                      </script>';
            }
        }
    }
}
