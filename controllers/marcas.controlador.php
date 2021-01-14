<?php

class ControladorMarca
{

    /*=============================================
    OBTENER LAS MARCAS
    =============================================*/
    static public function ctrTraerMarca($tabla, $item, $valor)
    {
        $consulta = ModeloMarca::mdlTraerMarca($tabla, $item, $valor);
        return $consulta;
    }

    /*=============================================
    CREAR UNA NUEVA MARCA
    =============================================*/
    static public function ctrCrearMarca()
    {

        if (isset($_POST["ingNomMarca"])) {

            $tabla = "marca";
            $datos = array( "nombre" => $_POST["ingNomMarca"] );
            $ruta = "";

            $verificarDuplicado = ModeloMarca::mdlVerificarMarca($tabla, $datos);

            if ($verificarDuplicado) {
                return "duplicado";
            } else {

                if (isset($_FILES["ingfotoMarca"]["tmp_name"])) {

                    list($ancho, $alto) = getimagesize($_FILES["ingfotoMarca"]["tmp_name"]);
                    $nuevoAncho = 512;
                    $nuevoAlto = 512;

                    #Crear directorio donde se guardaran las imagenes
                    $directorio = "views/img/Marcas/" . $_POST["ingNomMarca"];
                    mkdir($directorio, 0755);

                    #Vincular foto de acuerdo al tipo de foto
                    if ($_FILES["ingfotoMarca"]["type"] == "image/jpeg") {
                        #Guardar la imagen JPG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Marcas/" . $_POST["ingNomMarca"] . "/" . $aleatario . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["ingfotoMarca"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["ingfotoMarca"]["type"] == "image/png") {
                        #Guardar la imagen PNG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Marcas/" . $_POST["ingNomMarca"] . "/" . $aleatario . ".png";

                        $origen = imagecreatefrompng($_FILES["ingfotoMarca"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $datos += ["foto" => $ruta];

                $ingresar = ModeloMarca::mdlCrearMarca($tabla, $datos);
                return $ingresar;
            }
        }
    }

    /*=============================================
    ACTUALIZAR MARCA
    =============================================*/
    static public function ctrActualizarMarca()
    {

        if (isset($_POST["editNomMarca"])) {

            $tabla = "marca";
            $datos = array( 
                "nombre" => $_POST["editNomMarca"],
                "idMarca" => $_POST["editIdMarca"]
            );

            $verificarDuplicado = ModeloMarca::mdlVerificarMarca($tabla, $datos);

            if ($verificarDuplicado) {
                return "duplicado";
            } else {
                /*=============================================
                VALIDAR LA EXISTENCIA DE LA IMAGEN
                =============================================*/
                if (isset($_FILES["editfotoMarca"]["tmp_name"]) && $_FILES["editfotoMarca"]["tmp_name"] != "") {
                    list($ancho, $alto) = getimagesize($_FILES["editfotoMarca"]["tmp_name"]);
                    $nuevoAncho = 512;
                    $nuevoAlto = 512;

                    #Preguntar si existe una Imagen en la BD
                    if (!empty($_POST["editFotoActualMarca"])) {
                        unlink($_POST["editFotoActualMarca"]);
                    }

                    #Ruta Actual
                    $directorioActual = "views/img/Marcas/" . $_POST["editNomActualMarca"];

                    #Valida si existe el directorio y con la imagen actual
                    if (file_exists($directorioActual)) {
                        #Ruta Nueva
                        $directorioNuevo = "views/img/Marcas/" . $_POST["editNomMarca"];
                        rename($directorioActual, $directorioNuevo);
                    } else {
                        mkdir("views/img/Marcas/" . $_POST["editNomMarca"], 0755);
                    }

                    #Vincular foto de acuerdo al tipo de foto
                    if ($_FILES["editfotoMarca"]["type"] == "image/jpeg") {
                        #Guardar la imagen JPG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Marcas/" . $_POST["editNomMarca"] . "/" . $aleatario . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editfotoMarca"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["editfotoMarca"]["type"] == "image/png") {
                        #Guardar la imagen PNG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Marcas/" . $_POST["editNomMarca"] . "/" . $aleatario . ".png";

                        $origen = imagecreatefrompng($_FILES["editfotoMarca"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                } else { #En caso de no venir una imagen nueva
                    #Asigna la ruta actual que tiene el producto
                    $ruta = $_POST["editFotoActualMarca"];
                    if ($ruta) { #Evaluar si el producto tiene un imagen o no en la ruta actual
                        #Separa la ruta
                        $valoresRuta = explode("/", $ruta);
                        #Obtiene el nombre de la imagen
                        $nombreImagen = $valoresRuta[4];
                        #Asinga un nueva ruta cambiando el nombre de la carpeta por el nuevo nombre del producto
                        $ruta = "views/img/Marcas/" . $_POST["editNomMarca"] . "/" . $nombreImagen;
                    } else {
                        #Deja la ruta vacía en caso de que el producto no tenga una imagen asignada
                        $ruta = "";
                    }

                    #Ruta Actual
                    $directorioActual = "views/img/Marcas/" . $_POST["editNomActualMarca"];
                    #Ruta Nueva
                    $directorioNuevo = "views/img/Marcas/" . $_POST["editNomMarca"];
                    rename($directorioActual, $directorioNuevo);
                }

                $datos += ["foto" => $ruta];

                $actualizar = ModeloMarca::mdlActualizarMarca($tabla, $datos);

                return $actualizar;
            }
        }
    }

    /*=============================================
    BORRAR MARCA
    =============================================*/
    static public function ctrEliminarMarca()
    {

        if (isset($_GET["idMarca"])) {

            $tabla = "marca";
            $item = "Id_Marca";
            $dato = $_GET["idMarca"];

            #Pregunta si existe una imagen en la BD
            if ($_GET["fotoMarca"] != "") {
                unlink($_GET["fotoMarca"]);
            }

            #Borrar el directorio del usuario
            rmdir("views/img/Marcas/" . $_GET["nombreMarca"]);

            $borrar = ModeloMarca::mdlEliminarMarca($tabla, $item, $dato);

            if ($borrar == "ok") {
                echo '<script>
                        swal({
                            title: "Eliminación exitosa!",
                            text: "La marca se eliminó correctamente.",
                            icon: "success",
                            closeOnClickOutside: false,
                        }).then( (result) => {
                            window.location = "mainMarca";
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
                            window.location = "mainMarca";
                        });
                      </script>';
            }
        }
    }
}
