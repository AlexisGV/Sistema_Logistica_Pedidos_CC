/*=============================================
SUBIENDO LA FOTO DEL USUARIO - AGREAR
=============================================*/
$(".fotoAcabado").on('change', function () {
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
            $(".previsualizarAcabado").attr('src', rutaImagen);
        });
    }

});

/*=============================================
ENVIANDO DATOS DEL ACABADO A FORMULARIO PARA EDITAR
=============================================*/
$(document).on("click", ".btnEditarAcabado", function(){

    var idAcabado = $(this).attr("idAcabado");

    var datos = new FormData();
    datos.append('idAcabado', idAcabado);

    $.ajax({

        url: "ajax/acabados.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log(respuesta);
            // Valores actuales
            $("#editNomActualAcabado").val(respuesta["Acabado"]);
            $("#editFotoActualAcabado").val(respuesta["Foto_Acabado"]);

            // Nuevos valores
            $("#editIdAcabado").val(respuesta["Id_Acabado"]);
            $("#editNomAcabado").val(respuesta["Acabado"]);

            if (respuesta["Foto_Acabado"] != "" && respuesta["Foto_Acabado"] != null) {
                $(".previsualizarAcabado").attr("src", respuesta["Foto_Acabado"]);
            }
        }

    });

});

/*=============================================
BORRAR ACABADO CON AJAX
=============================================*/
$(document).on('click', '.btnEliminarAcabado', function () {

    var idAcabado = $(this).attr('idAcabado'),
        fotoAcabado = $(this).attr('fotoAcabado'),
        nombreAcabado = $(this).attr('nomAcabado');

    swal({
        title: "Eliminar acabado",
        text: "¿Estas seguro de que quieres eliminar este tipo de acabado?",
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
            window.location = "index.php?pagina=mainAcabado&idAcabado=" + idAcabado + "&fotoAcabado=" + fotoAcabado + "&nombreAcabado=" + nombreAcabado;
        }
    });

});

/*=============================================
LIMPIAR CAMPOS - FORMULARIO AGREGAR
=============================================*/
$(document).on("click", ".closeModalAcabado", function(){
    $("#ingNomAcabado").val("");
    $("#ingNomAcabado").removeClass("is-invalid is-valid");
    $(".fotoAcabado").val("");
    $(".fotoAcabado").siblings(".custom-file-label").addClass("selected").html("Subir una imagen");
    $(".previsualizarAcabado").attr("src", "views/img/Acabados/defaultAcabado.png");

    // Esconder errores
    $("#errorIngNomAcabado").hide();
});

/*=============================================
LIMPIAR CAMPOS - FORMULARIO EDITAR
=============================================*/
$(document).on("click", ".closeModalEditAcabado", function(){
    $("#editNomAcabado").val("");
    $("#editNomAcabado").removeClass("is-invalid is-valid");
    $(".fotoAcabado").val("");
    $(".fotoAcabado").siblings(".custom-file-label").addClass("selected").html("Subir una imagen");
    $(".previsualizarAcabado").attr("src", "views/img/Acabados/defaultAcabado.png");

    // Esconder errores
    $("#errorEditNomAcabado").hide();
});