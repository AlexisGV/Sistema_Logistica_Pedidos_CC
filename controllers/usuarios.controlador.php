<?php

class ControladorUsuarios
{

    /*=============================================
    OBTENER TIPOS DE USUARIO PARA EL FORMULARIO DE AGREGAR
    =============================================*/
    static public function ctrObtenerTiposUsuario()
    {

        $tabla = "tipo_usuario";

        $respuesta = ModeloUsuarios::mdlObtenerTiposUsuario($tabla);

        return $respuesta;
    }

    /*=============================================
    SELECCIONAR TODOS LOS USUARIOS
    =============================================*/
    static public function ctrTraerUsuarios()
    {

        $consulta = ModeloUsuarios::mdlTraerUsuarios();

        return $consulta;
    }

    /*=============================================
    SELECCIONAR TODOS LOS USUARIOS - ASIGNAR PEDIDOS
    =============================================*/
    static public function ctrTraerUsuariosParaAsignar()
    {

        $consulta = ModeloUsuarios::mdlTraerUsuariosParaAsignar();

        return $consulta;
    }

    /*=============================================
    BUSCAR UN USUARIO EN ESPECIFICO
    =============================================*/
    static public function ctrBuscarUsuario($tabla, $item, $valor)
    {

        $busqueda = ModeloUsuarios::mdlBuscarUsuario($tabla, $item, $valor);

        return $busqueda;
    }

    /*=============================================
    INSERTAR UN NUEVO USAURIO EN LA BASE DE DATOS
    =============================================*/
    static public function ctrCrearUsuario()
    {

        if (isset($_POST["nomUser"])) {

            $tabla = "usuario";
            $datosVerificaciones = array(
                "nombre" => $_POST["nomUser"],
                "correo" => $_POST["correoUser"]
            );

            $verificarDuplicado = ModeloUsuarios::mdlVerificarUsuario($tabla, $datosVerificaciones);

            if ($verificarDuplicado) {
                return "duplicado";
            } else {

                $ruta = "";

                if (isset($_FILES["fotoUsuario"]["tmp_name"])) {

                    echo "<pre>";
                    print_r($_FILES["fotoUsuario"]["tmp_name"]);
                    echo "</pre>";

                    list($ancho, $alto) = getimagesize($_FILES["fotoUsuario"]["tmp_name"]);
                    $nuevoAncho = 512;
                    $nuevoAlto = 512;

                    #Crear directorio donde se guardaran las imagenes
                    $directorio = "views/img/Usuarios/" . $_POST["apodoUser"];
                    mkdir($directorio, 0755);

                    #Vincular foto de acuerdo al tipo de foto
                    if ($_FILES["fotoUsuario"]["type"] == "image/jpeg") {
                        #Guardar la imagen JPG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Usuarios/" . $_POST["apodoUser"] . "/" . $aleatario . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["fotoUsuario"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["fotoUsuario"]["type"] == "image/png") {
                        #Guardar la imagen PNG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Usuarios/" . $_POST["apodoUser"] . "/" . $aleatario . ".png";

                        $origen = imagecreatefrompng($_FILES["fotoUsuario"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $encriptarContraseña = crypt($_POST["passUser"], '$2a$07$cialOgCcrAolNofVEsmcrdDeA$');

                $datos = array(
                    "foto" => $ruta,
                    "nombre" => $_POST["nomUser"],
                    "correo" => $_POST["correoUser"],
                    "apodo" => $_POST["apodoUser"],
                    "contrasenia" => $encriptarContraseña,
                    "tipoUsuario" => $_POST["tipoUsuario"]
                );

                $ingresar = ModeloUsuarios::mdlCrearUsuario($tabla, $datos);

                return $ingresar;
            }
        }
    }

    /*=============================================
    ACTUALIZAR USAURIO
    =============================================*/
    static public function ctrActualizarUsuario()
    {

        if (isset($_POST["nomEditUser"])) {

            $tabla = "usuario";

            /*=============================================
            VALIDAR LA EXISTENCIA DE LA IMAGEN
            =============================================*/
            if (isset($_FILES["fotoEditUsuario"]["tmp_name"]) && $_FILES["fotoEditUsuario"]["tmp_name"] != "") {
                list($ancho, $alto) = getimagesize($_FILES["fotoEditUsuario"]["tmp_name"]);
                $nuevoAncho = 512;
                $nuevoAlto = 512;

                #Preguntar si existe una Imagen en la BD
                if (!empty($_POST["fotoUserActual"])) {
                    unlink($_POST["fotoUserActual"]);
                }

                #Ruta Actual
                $directorioActual = "views/img/Usuarios/" . $_POST["apodoUserActual"];

                #Valida si existe el directorio y con la imagen actual
                if (file_exists($directorioActual)) {
                    #Ruta Nueva
                    $directorioNuevo = "views/img/Usuarios/" . $_POST["apodoEditUser"];
                    rename($directorioActual, $directorioNuevo);
                } else {
                    mkdir("views/img/Usuarios/" . $_POST["apodoEditUser"], 0755);
                }

                #Vincular foto de acuerdo al tipo de foto
                if ($_FILES["fotoEditUsuario"]["type"] == "image/jpeg") {
                    #Guardar la imagen JPG en el directorio
                    $aleatario = mt_rand(100, 999);
                    $ruta = "views/img/Usuarios/" . $_POST["apodoEditUser"] . "/" . $aleatario . ".jpg";

                    $origen = imagecreatefromjpeg($_FILES["fotoEditUsuario"]["tmp_name"]);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagejpeg($destino, $ruta);
                }

                if ($_FILES["fotoEditUsuario"]["type"] == "image/png") {
                    #Guardar la imagen PNG en el directorio
                    $aleatario = mt_rand(100, 999);
                    $ruta = "views/img/Usuarios/" . $_POST["apodoEditUser"] . "/" . $aleatario . ".png";

                    $origen = imagecreatefrompng($_FILES["fotoEditUsuario"]["tmp_name"]);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagepng($destino, $ruta);
                }
            } else { #En caso de no venir una imagen nueva
                #Asigna la ruta actual que tiene el producto
                $ruta = $_POST["fotoUserActual"];
                if ($ruta) { #Evaluar si el producto tiene un imagen o no en la ruta actual
                    #Separa la ruta
                    $valoresRuta = explode("/", $ruta);
                    #Obtiene el nombre de la imagen
                    $nombreImagen = $valoresRuta[4];
                    #Asinga un nueva ruta cambiando el nombre de la carpeta por el nuevo nombre del producto
                    $ruta = "views/img/Usuarios/" . $_POST["apodoEditUser"] . "/" . $nombreImagen;
                } else {
                    #Deja la ruta vacía en caso de que el producto no tenga una imagen asignada
                    $ruta = "";
                }

                #Ruta Actual
                $directorioActual = "views/img/Usuarios/" . $_POST["apodoUserActual"];
                #Ruta Nueva
                $directorioNuevo = "views/img/Usuarios/" . $_POST["apodoEditUser"];
                rename($directorioActual, $directorioNuevo);
            }

            /*=============================================
            VALIDAR LA EXISTENCIA DE NUEVA CONTRASEÑA
            =============================================*/
            if ( $_POST["passEditUser"] != "" && $_POST["passEditUser"] != null ){

                $encriptarContraseña = crypt($_POST["passEditUser"], '$2a$07$cialOgCcrAolNofVEsmcrdDeA$');

            } else {

                $encriptarContraseña = $_POST["passActual"];

            }

            $datos = array(
                "idUsuario" => $_POST["idEditUser"],
                "foto" => $ruta,
                "nombre" => $_POST["nomEditUser"],
                "correo" => $_POST["correoEditUser"],
                "apodo" => $_POST["apodoEditUser"],
                "contrasenia" => $encriptarContraseña,
                "tipoUsuario" => $_POST["tipoEditUsuario"]
            );

            $actualizar = ModeloUsuarios::mdlActualizarUsuario($tabla, $datos);

            if ($_POST["idEditUser"] == $_SESSION["idUsuario"] && $actualizar == "ok") {
                $_SESSION["nombreUsuario"] = $_POST["nomEditUser"];
                $_SESSION["imagenUsuario"] = $ruta;
                $_SESSION["tipoUsuarioPorNombre"] = $_POST["tipoEditUsuario"];

                #Obtener ID del nuevo tipo de usuario para actualizar SESSION
                $tabla = "usuario";
                $item = "Tipo_User";
                $valor = $_POST["tipoEditUsuario"];
                $usuarioActualizado = ModeloUsuarios::mdlBuscarUsuario($tabla, $item, $valor);
                $_SESSION["tipoUsuario"] = $usuarioActualizado["Id_Tipo_User"];
            }

            return $actualizar;
        }
    }

    /*=============================================
    BORRAR USUARIO
    =============================================*/
    static public function ctrEliminarUsuario(){

        if( isset($_GET["idUser"]) ){

            $tabla = "usuario";
            $item = "Id_Usuario";
            $dato = $_GET["idUser"];

            $borrar = ModeloUsuarios::mdlEliminarUsuario($tabla, $item, $dato);
            
            if ($borrar == "ok") {

                #Pregunta si existe una imagen en la BD
                if ( $_GET["fotoUser"] != "" ){
                    unlink($_GET["fotoUser"]);
                }
    
                #Borrar el directorio del usuario
                rmdir("views/img/Usuarios/" . $_GET["apodoUser"]);

                #Obtener ID de Usuario Eliminado
                $tabla = "usuario";
                $item = "Tipo_User";
                $valor = "Usuario eliminado";
                $usuarioEliminado = ModeloUsuarios::mdlBuscarUsuario($tabla, $item, $valor);
                $idUserEliminated = $usuarioEliminado["Id_Usuario"];

                #Actualizar usuario eliminado en pedidos
                $tabla = "actualizaciones_pedido";
                $item = "Id_Usuario1";
                $actualizarUsuarioEliminado = ModeloUsuarios::mdlActualizarUsuarioEliminado($tabla, $item, $idUserEliminated);

                if ( $actualizarUsuarioEliminado == "ok" ) {
                    echo '<script>
                            swal({
                                title: "Eliminación exitosa!",
                                text: "El producto se eliminó correctamente.",
                                icon: "success",
                                closeOnClickOutside: false,
                            }).then( (result) => {
                                window.location = "mainUsuarios";
                            });
                          </script>';
                } else {
                    echo '<script>
                            swal({
                                title: "Eliminación exitosa!",
                                text: "El producto se eliminó correctamente, pero no se actualizaron los campos vacíos.",
                                icon: "info",
                                closeOnClickOutside: false,
                            }).then( (result) => {
                                window.location = "mainUsuarios";
                            });
                          </script>';
                }
                
            } else {
                echo '<script>
                        swal({
                            title: "Error!",
                            text: "Ha ocurrido un error con la conexión a la base de datos.",
                            icon: "error",
                            closeOnClickOutside: false,
                        }).then( (result) => {
                            window.location = "mainUsuarios";
                        });
                      </script>';
            }

        }

    }
}
