<?php

class ControladorAcabado
{

    /*=============================================
    OBTENER LOS ACABADOS
    =============================================*/
    static public function ctrTraerAcabado($tabla, $item, $valor)
    {

        $consulta = ModeloAcabado::mdlTraerAcabado($tabla, $item, $valor);
        return $consulta;

    }

    /*=============================================
    CREAR UN NUEVO TIPO DE ACABADO
    =============================================*/
    static public function ctrCrearAcabado()
    {

        if (isset($_POST["ingNomAcabado"])) {

            $tabla = "acabado";
            $datos = array(
                "nombre" => $_POST["ingNomAcabado"],
                "abreviacion" => $_POST["ingAbvAcabado"]
            );
            $ruta = "";

            $verificarDuplicado = ModeloAcabado::mdlVerificarAcabado($tabla, $datos, true);

            if ($verificarDuplicado) {
                return "duplicado";
            } else {

                if (isset($_FILES["ingfotoAcabado"]["tmp_name"])) {

                    list($ancho, $alto) = getimagesize($_FILES["ingfotoAcabado"]["tmp_name"]);
                    $nuevoAncho = 512;
                    $nuevoAlto = 512;

                    #Crear directorio donde se guardaran las imagenes
                    $directorio = "views/img/Acabados/" . $_POST["ingNomAcabado"];
                    mkdir($directorio, 0755);

                    #Vincular foto de acuerdo al tipo de foto
                    if ($_FILES["ingfotoAcabado"]["type"] == "image/jpeg") {
                        #Guardar la imagen JPG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Acabados/" . $_POST["ingNomAcabado"] . "/" . $aleatario . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["ingfotoAcabado"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["ingfotoAcabado"]["type"] == "image/png") {
                        #Guardar la imagen PNG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Acabados/" . $_POST["ingNomAcabado"] . "/" . $aleatario . ".png";

                        $origen = imagecreatefrompng($_FILES["ingfotoAcabado"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $datos += ["foto" => $ruta];

                $ingresar = ModeloAcabado::mdlCrearAcabado($tabla, $datos);
                return $ingresar;
            }
        }
    }

    /*=============================================
    ACTUALIZAR ACABADO
    =============================================*/
    static public function ctrActualizarAcabado(){
        
        if ( isset($_POST["editNomAcabado"]) ){

            $tabla = "acabado";
            $datos = array(
                "idAcabado" => $_POST["editIdAcabado"],
                "nombre" => $_POST["editNomAcabado"],
                "abreviacion" => $_POST["editAbvAcabado"]
            );

            $verificarDuplicado = ModeloAcabado::mdlVerificarAcabado($tabla, $datos, false);

            if ($verificarDuplicado) {
                return "duplicado";
            } else {
                /*=============================================
                VALIDAR LA EXISTENCIA DE LA IMAGEN
                =============================================*/
                if (isset($_FILES["editfotoAcabado"]["tmp_name"]) && $_FILES["editfotoAcabado"]["tmp_name"] != "") {
                    list($ancho, $alto) = getimagesize($_FILES["editfotoAcabado"]["tmp_name"]);
                    $nuevoAncho = 512;
                    $nuevoAlto = 512;
    
                    #Preguntar si existe una Imagen en la BD
                    if (!empty($_POST["editFotoActualAcabado"])) {
                        unlink($_POST["editFotoActualAcabado"]);
                    }
    
                    #Ruta Actual
                    $directorioActual = "views/img/Acabados/" . $_POST["editNomActualAcabado"];
    
                    #Valida si existe el directorio y con la imagen actual
                    if (file_exists($directorioActual)) {
                        #Ruta Nueva
                        $directorioNuevo = "views/img/Acabados/" . $_POST["editNomAcabado"];
                        rename($directorioActual, $directorioNuevo);
                    } else {
                        mkdir("views/img/Acabados/" . $_POST["editNomAcabado"], 0755);
                    }
    
                    #Vincular foto de acuerdo al tipo de foto
                    if ($_FILES["editfotoAcabado"]["type"] == "image/jpeg") {
                        #Guardar la imagen JPG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Acabados/" . $_POST["editNomAcabado"] . "/" . $aleatario . ".jpg";
    
                        $origen = imagecreatefromjpeg($_FILES["editfotoAcabado"]["tmp_name"]);
    
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
    
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
    
                        imagejpeg($destino, $ruta);
                    }
    
                    if ($_FILES["editfotoAcabado"]["type"] == "image/png") {
                        #Guardar la imagen PNG en el directorio
                        $aleatario = mt_rand(100, 999);
                        $ruta = "views/img/Acabados/" . $_POST["editNomAcabado"] . "/" . $aleatario . ".png";
    
                        $origen = imagecreatefrompng($_FILES["editfotoAcabado"]["tmp_name"]);
    
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
    
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
    
                        imagepng($destino, $ruta);
                    }
                } else { #En caso de no venir una imagen nueva
                    #Asigna la ruta actual que tiene el producto
                    $ruta = $_POST["editFotoActualAcabado"];
                    if ($ruta) { #Evaluar si el producto tiene un imagen o no en la ruta actual
                        #Separa la ruta
                        $valoresRuta = explode("/", $ruta);
                        #Obtiene el nombre de la imagen
                        $nombreImagen = $valoresRuta[4];
                        #Asinga un nueva ruta cambiando el nombre de la carpeta por el nuevo nombre del producto
                        $ruta = "views/img/Acabados/" . $_POST["editNomAcabado"] . "/" . $nombreImagen;
                    } else {
                        #Deja la ruta vacía en caso de que el producto no tenga una imagen asignada
                        $ruta = "";
                    }
    
                    #Ruta Actual
                    $directorioActual = "views/img/Acabados/" . $_POST["editNomActualAcabado"];
                    #Ruta Nueva
                    $directorioNuevo = "views/img/Acabados/" . $_POST["editNomAcabado"];
                    rename($directorioActual, $directorioNuevo);
                }
    
                $datos += ["foto" => $ruta];
    
                $actualizar = ModeloAcabado::mdlActualizarAcabado($tabla, $datos);
    
                return $actualizar;
            }


        }

    }

    /*=============================================
    BORRAR ACABADO
    =============================================*/
    static public function ctrEliminarAcabado(){

        if( isset($_GET["idAcabado"]) ){

            $tabla = "acabado";
            $item = "Id_Acabado";
            $dato = $_GET["idAcabado"];

            #Pregunta si existe una imagen en la BD
            if ( $_GET["fotoAcabado"] != "" ){
                unlink($_GET["fotoAcabado"]);
            }

            #Borrar el directorio del usuario
            rmdir("views/img/Acabados/" . $_GET["nombreAcabado"]);

            $borrar = ModeloAcabado::mdlEliminarAcabado($tabla, $item, $dato);

            if ($borrar == "ok") {
                echo '<script>
                        swal({
                            title: "Eliminación exitosa!",
                            text: "El tipo de acabado se eliminó correctamente.",
                            icon: "success",
                            closeOnClickOutside: false,
                        }).then( (result) => {
                            window.location = "mainAcabado";
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
                            window.location = "mainAcabado";
                        });
                      </script>';
            }

        }

    }
}
