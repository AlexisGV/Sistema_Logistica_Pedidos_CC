<?php

class ControladorForma
{

    /*=============================================
    OBTENER LAS FORMAS
    =============================================*/
    static public function ctrTraerForma($tabla, $item, $valor)
    {
        $consulta = ModeloForma::mdlTraerForma($tabla, $item, $valor);
        return $consulta;
    }

    /*=============================================
    CREAR UNA NUEVA FORMA
    =============================================*/
    static public function ctrCrearForma()
    {

        if (isset($_POST["ingNomForma"])) {

            $tabla = "forma";
            $datos = array(
                "nombre" => $_POST["ingNomForma"]
            );
            $ruta = "";

            $verificarDuplicado = ModeloForma::mdlVerificarForma($tabla, $datos, true);

            if ($verificarDuplicado) {
                return "duplicado";
            } else {

                if (isset($_FILES["ingfotoForma"]["tmp_name"]) && $_FILES["ingfotoForma"]["tmp_name"] != "" ) {

                    list($ancho, $alto) = getimagesize($_FILES["ingfotoForma"]["tmp_name"]);
                    $nuevoAncho = 512;
                    $nuevoAlto = 512;

                    #Crear directorio donde se guardaran las imagenes
                    $directorio = "views/img/Formas/" . $_POST["ingNomForma"];
                    mkdir($directorio, 0755);

                    #Vincular foto de acuerdo al tipo de foto
                    if ($_FILES["ingfotoForma"]["type"] == "image/jpeg") {
                        #Guardar la imagen JPG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Formas/" . $_POST["ingNomForma"] . "/" . $aleatario . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["ingfotoForma"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["ingfotoForma"]["type"] == "image/png") {
                        #Guardar la imagen PNG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Formas/" . $_POST["ingNomForma"] . "/" . $aleatario . ".png";

                        $origen = imagecreatefrompng($_FILES["ingfotoForma"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $datos += ["foto" => $ruta];

                $ingresar = ModeloForma::mdlCrearForma($tabla, $datos);
                return $ingresar;
            }
        }
    }

    /*=============================================
    ACTUALIZAR FORMA
    =============================================*/
    static public function ctrActualizarForma()
    {

        if (isset($_POST["editNomForma"])) {

            $tabla = "forma";
            $datos = array(
                "idForma" => $_POST["editIdForma"],
                "nombre" => $_POST["editNomForma"]
            );

            $verificarDuplicado = ModeloForma::mdlVerificarForma($tabla, $datos, false);

            if ($verificarDuplicado) {
                return "duplicado";
            } else {
                /*=============================================
                VALIDAR LA EXISTENCIA DE LA IMAGEN
                =============================================*/
                if (isset($_FILES["editfotoForma"]["tmp_name"]) && $_FILES["editfotoForma"]["tmp_name"] != "") {
                    list($ancho, $alto) = getimagesize($_FILES["editfotoForma"]["tmp_name"]);
                    $nuevoAncho = 512;
                    $nuevoAlto = 512;

                    #Preguntar si existe una Imagen en la BD
                    if (!empty($_POST["editFotoActualForma"])) {
                        unlink($_POST["editFotoActualForma"]);
                    }

                    #Ruta Actual
                    $directorioActual = "views/img/Formas/" . $_POST["editNomActualForma"];

                    #Valida si existe el directorio y con la imagen actual
                    if (file_exists($directorioActual)) {
                        #Ruta Nueva
                        $directorioNuevo = "views/img/Formas/" . $_POST["editNomForma"];
                        rename($directorioActual, $directorioNuevo);
                    } else {
                        mkdir("views/img/Formas/" . $_POST["editNomForma"], 0755);
                    }

                    #Vincular foto de acuerdo al tipo de foto
                    if ($_FILES["editfotoForma"]["type"] == "image/jpeg") {
                        #Guardar la imagen JPG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Formas/" . $_POST["editNomForma"] . "/" . $aleatario . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editfotoForma"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["editfotoForma"]["type"] == "image/png") {
                        #Guardar la imagen PNG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Formas/" . $_POST["editNomForma"] . "/" . $aleatario . ".png";

                        $origen = imagecreatefrompng($_FILES["editfotoForma"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                } else { #En caso de no venir una imagen nueva
                    #Asigna la ruta actual que tiene el producto
                    $ruta = $_POST["editFotoActualForma"];
                    if ($ruta) { #Evaluar si el producto tiene un imagen o no en la ruta actual
                        #Separa la ruta
                        $valoresRuta = explode("/", $ruta);
                        #Obtiene el nombre de la imagen
                        $nombreImagen = $valoresRuta[4];
                        #Asinga un nueva ruta cambiando el nombre de la carpeta por el nuevo nombre del producto
                        $ruta = "views/img/Formas/" . $_POST["editNomForma"] . "/" . $nombreImagen;
                    } else {
                        #Deja la ruta vacía en caso de que el producto no tenga una imagen asignada
                        $ruta = "";
                    }

                    #Ruta Actual
                    $directorioActual = "views/img/Formas/" . $_POST["editNomActualForma"];
                    #Ruta Nueva
                    $directorioNuevo = "views/img/Formas/" . $_POST["editNomForma"];
                    rename($directorioActual, $directorioNuevo);
                }

                $datos += ["foto" => $ruta];

                $actualizar = ModeloForma::mdlActualizarForma($tabla, $datos);

                return $actualizar;
            }
        }
    }

    /*=============================================
    BORRAR FORMA
    =============================================*/
    static public function ctrEliminarForma()
    {

        if (isset($_GET["idForma"])) {

            $tabla = "forma";
            $item = "Id_Forma";
            $dato = $_GET["idForma"];

            
            $borrar = ModeloForma::mdlEliminarForma($tabla, $item, $dato);
            
            if ($borrar == "ok") {
                #Pregunta si existe una imagen en la BD
                if ($_GET["fotoForma"] != "") {
                    unlink($_GET["fotoForma"]);
                }
    
                #Borrar el directorio del usuario
                rmdir("views/img/Formas/" . $_GET["nombreForma"]);

                echo '<script>
                        swal({
                            title: "Eliminación exitosa!",
                            text: "La forma se eliminó correctamente.",
                            icon: "success",
                            closeOnClickOutside: false,
                        }).then( (result) => {
                            window.location = "mainForma";
                        });
                      </script>';
            } else if($borrar == "errorPadres"){
                echo '<script>
                        swal({
                            title: "Error al intentar eliminar!",
                            text: "No puedes borrar esta forma, ya que tienes productos registrados con esta.",
                            icon: "warning",
                            closeOnClickOutside: false,
                        }).then( (result) => {
                            window.location = "mainForma";
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
                            window.location = "mainForma";
                        });
                      </script>';
            }
        }
    }
}
