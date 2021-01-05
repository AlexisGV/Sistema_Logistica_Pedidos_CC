<?php

class ControladorCorte
{

    /*=============================================
    OBTENER LOS ACABADOS
    =============================================*/
    static public function ctrTraerCorte($tabla, $item, $valor)
    {

        $consulta = ModeloCorte::mdlTraerCorte($tabla, $item, $valor);
        return $consulta;
    }

    /*=============================================
    CREAR UN NUEVO TIPO DE ACABADO
    =============================================*/
    static public function ctrCrearCorte()
    {

        if (isset($_POST["ingNomCorte"])) {

            $tabla = "corte";
            $datos = array(
                "nombre" => $_POST["ingNomCorte"],
                "abreviacion" => $_POST["ingAbvCorte"]
            );
            $ruta = "";

            $verificarDuplicado = ModeloCorte::mdlVerificarCorte($tabla, $datos, true);

            if ($verificarDuplicado) {
                return "duplicado";
            } else {

                if (isset($_FILES["ingfotoCorte"]["tmp_name"])) {

                    list($ancho, $alto) = getimagesize($_FILES["ingfotoCorte"]["tmp_name"]);
                    $nuevoAncho = 512;
                    $nuevoAlto = 512;

                    #Crear directorio donde se guardaran las imagenes
                    $directorio = "views/img/Cortes/" . $_POST["ingNomCorte"];
                    mkdir($directorio, 0755);

                    #Vincular foto de acuerdo al tipo de foto
                    if ($_FILES["ingfotoCorte"]["type"] == "image/jpeg") {
                        #Guardar la imagen JPG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Cortes/" . $_POST["ingNomCorte"] . "/" . $aleatario . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["ingfotoCorte"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["ingfotoCorte"]["type"] == "image/png") {
                        #Guardar la imagen PNG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Cortes/" . $_POST["ingNomCorte"] . "/" . $aleatario . ".png";

                        $origen = imagecreatefrompng($_FILES["ingfotoCorte"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $datos += ["foto" => $ruta];

                $ingresar = ModeloCorte::mdlCrearCorte($tabla, $datos);
                return $ingresar;
            }
        }
    }

    /*=============================================
    ACTUALIZAR ACABADO
    =============================================*/
    static public function ctrActualizarCorte()
    {

        if (isset($_POST["editNomCorte"])) {

            $tabla = "corte";
            $datos = array(
                "idCorte" => $_POST["editIdCorte"],
                "nombre" => $_POST["editNomCorte"],
                "abreviacion" => $_POST["editAbvCorte"]
            );

            $verificarDuplicado = ModeloCorte::mdlVerificarCorte($tabla, $datos, false);

            if ($verificarDuplicado) {
                return "duplicado";
            } else {
                /*=============================================
                VALIDAR LA EXISTENCIA DE LA IMAGEN
                =============================================*/
                if (isset($_FILES["editfotoCorte"]["tmp_name"]) && $_FILES["editfotoCorte"]["tmp_name"] != "") {
                    list($ancho, $alto) = getimagesize($_FILES["editfotoCorte"]["tmp_name"]);
                    $nuevoAncho = 512;
                    $nuevoAlto = 512;

                    #Preguntar si existe una Imagen en la BD
                    if (!empty($_POST["editFotoActualCorte"])) {
                        unlink($_POST["editFotoActualCorte"]);
                    }

                    #Ruta Actual
                    $directorioActual = "views/img/Cortes/" . $_POST["editNomActualCorte"];

                    #Valida si existe el directorio y con la imagen actual
                    if (file_exists($directorioActual)) {
                        #Ruta Nueva
                        $directorioNuevo = "views/img/Cortes/" . $_POST["editNomCorte"];
                        rename($directorioActual, $directorioNuevo);
                    } else {
                        mkdir("views/img/Cortes/" . $_POST["editNomCorte"], 0755);
                    }

                    #Vincular foto de acuerdo al tipo de foto
                    if ($_FILES["editfotoCorte"]["type"] == "image/jpeg") {
                        #Guardar la imagen JPG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Cortes/" . $_POST["editNomCorte"] . "/" . $aleatario . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editfotoCorte"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["editfotoCorte"]["type"] == "image/png") {
                        #Guardar la imagen PNG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Cortes/" . $_POST["editNomCorte"] . "/" . $aleatario . ".png";

                        $origen = imagecreatefrompng($_FILES["editfotoCorte"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                } else { #En caso de no venir una imagen nueva
                    #Asigna la ruta actual que tiene el producto
                    $ruta = $_POST["editFotoActualCorte"];
                    if ($ruta) { #Evaluar si el producto tiene un imagen o no en la ruta actual
                        #Separa la ruta
                        $valoresRuta = explode("/", $ruta);
                        #Obtiene el nombre de la imagen
                        $nombreImagen = $valoresRuta[4];
                        #Asinga un nueva ruta cambiando el nombre de la carpeta por el nuevo nombre del producto
                        $ruta = "views/img/Cortes/" . $_POST["editNomCorte"] . "/" . $nombreImagen;
                    } else {
                        #Deja la ruta vacía en caso de que el producto no tenga una imagen asignada
                        $ruta = "";
                    }

                    #Ruta Actual
                    $directorioActual = "views/img/Cortes/" . $_POST["editNomActualCorte"];
                    #Ruta Nueva
                    $directorioNuevo = "views/img/Cortes/" . $_POST["editNomCorte"];
                    rename($directorioActual, $directorioNuevo);
                }

                $datos += ["foto" => $ruta];

                $actualizar = ModeloCorte::mdlActualizarCorte($tabla, $datos);

                return $actualizar;
            }
        }
    }

    /*=============================================
    BORRAR ACABADO
    =============================================*/
    static public function ctrEliminarCorte()
    {

        if (isset($_GET["idCorte"])) {

            $tabla = "corte";
            $item = "Id_Corte";
            $dato = $_GET["idCorte"];

            #Pregunta si existe una imagen en la BD
            if ($_GET["fotoCorte"] != "") {
                unlink($_GET["fotoCorte"]);
            }

            #Borrar el directorio del usuario
            rmdir("views/img/Cortes/" . $_GET["nombreCorte"]);

            $borrar = ModeloCorte::mdlEliminarCorte($tabla, $item, $dato);

            if ($borrar == "ok") {
                echo '<script>
                        swal({
                            title: "Eliminación exitosa!",
                            text: "El tipo de corte se eliminó correctamente.",
                            icon: "success",
                        }).then( (result) => {
                            window.location = "mainCorte";
                        });
                      </script>';
            } else {
                echo '<script>
                        swal({
                            title: "Error!",
                            text: "Ha ocurrido un error con la conexión a la base de datos.",
                            icon: "error",
                        }).then( (result) => {
                            window.location = "mainCorte";
                        });
                      </script>';
            }
        }
    }
}
