/*=============================================
SUBIENDO LA FOTO DE LA MARCA - AGREAR
=============================================*/
$(".fotoMarca").on('change', function () {
    var imagen = this.files[0];
    // console.log("imagen", imagen);

    /*=============================================
    VALIDAR FORMATO DE LA IMAGEN
    =============================================*/
    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        $(this).val("");
        $(this).siblings(".custom-file-label").addClass("selected").html("Subir una imagen");
        
        swal({
            title: "Error al subir la imagen!",
            text: "La imagen debe estar en formato JPG o PNG.",
            icon: "error",
            button: "Cerrar",
        });
    } else if (imagen["size"] > 3000000) {
        $(this).val("");
        $(this).siblings(".custom-file-label").addClass("selected").html("Subir una imagen");

        swal({
            title: "Error al subir la imagen!",
            text: "La imagen no debe pesar mas de 3MB.",
            icon: "error",
            button: "Cerrar",
        });
    } else {
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on('load', function (event) {
            var rutaImagen = event.target.result;
            $(".previsualizarMarca").attr('src', rutaImagen);
        });
    }

});

/*=============================================
ENVIANDO DATOS DEL ACABADO A FORMULARIO PARA EDITAR
=============================================*/
$(document).on("click", ".btnEditarMarca", function(){

    var idMarca = $(this).attr("idMarca");

    var datos = new FormData();
    datos.append('idMarca', idMarca);

    $.ajax({

        url: "ajax/marcas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log(respuesta);
            // Valores actuales
            $("#editNomActualMarca").val(respuesta["Marca"]);
            $("#editFotoActualMarca").val(respuesta["Foto_Marca"]);

            // Nuevos valores
            $("#editIdMarca").val(respuesta["Id_Marca"]);
            $("#editNomMarca").val(respuesta["Marca"]);

            if (respuesta["Foto_Marca"] != "" && respuesta["Foto_Marca"] != null) {
                $(".previsualizarMarca").attr("src", respuesta["Foto_Marca"]);
            }
        }

    });

});

/*=============================================
BORRAR FORMA CON AJAX
=============================================*/
$(document).on('click', '.btnEliminarMarca', function () {

    var idMarca = $(this).attr('idMarca'),
        fotoMarca = $(this).attr('fotoMarca'),
        nombreMarca = $(this).attr('nomMarca');

    swal({
        title: "Eliminar marca",
        text: "¿Estas seguro de que quieres eliminar esta marca?",
        icon: "warning",
        buttons: {
            cancel: {
                text: "Cancelar",
                value: null,
                visible: true,
                className: "bg-danger",
            },
            confirm: {
                text: "Confirmar",
                value: true,
                visible: true,
                className: "bg-primary",
            }
        },
    }).then((result) => {
        if (result) {
            window.location = "index.php?pagina=mainMarca&idMarca=" + idMarca + "&fotoMarca=" + fotoMarca + "&nombreMarca=" + nombreMarca;
        }
    });

});

/*=============================================
LIMPIAR CAMPOS - FORMULARIO AGREGAR
=============================================*/
$(document).on("click", ".closeModalMarca", function(){
    $("#ingNomMarca").val("");
    $("#ingNomMarca").removeClass("is-invalid is-valid");
    $(".fotoMarca").val("");
    $(".fotoMarca").siblings(".custom-file-label").addClass("selected").html("Subir una imagen");
    $(".previsualizarMarca").attr("src", "views/img/Marcas/defaultMarca.png");

    // Esconder errores
    $("#errorIngNomMarca").hide();
});

/*=============================================
LIMPIAR CAMPOS - FORMULARIO EDITAR
=============================================*/
$(document).on("click", ".closeModalEditMarca", function(){
    $("#editNomMarca").val("");
    $("#editNomMarca").removeClass("is-invalid is-valid");
    $(".fotoMarca").val("");
    $(".fotoMarca").siblings(".custom-file-label").addClass("selected").html("Subir una imagen");
    $(".previsualizarMarca").attr("src", "views/img/Marcas/defaultMarca.png");

    // Esconder errores
    $("#errorEditNomMarca").hide();
});