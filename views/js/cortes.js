/*=============================================
SUBIENDO LA FOTO DEL USUARIO - AGREAR
=============================================*/
$(".fotoCorte").on('change', function () {
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
            $(".previsualizarCorte").attr('src', rutaImagen);
        });
    }

});

/*=============================================
ENVIANDO DATOS DEL ACABADO A FORMULARIO PARA EDITAR
=============================================*/
$(document).on("click", ".btnEditarCorte", function(){

    var idCorte = $(this).attr("idCorte");

    var datos = new FormData();
    datos.append('idCorte', idCorte);

    $.ajax({

        url: "ajax/cortes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log(respuesta);
            // Valores actuales
            $("#editNomActualCorte").val(respuesta["Corte"]);
            $("#editFotoActualCorte").val(respuesta["Foto_Corte"]);

            // Nuevos valores
            $("#editIdCorte").val(respuesta["Id_Corte"]);
            $("#editNomCorte").val(respuesta["Corte"]);
            $("#editAbvCorte").val(respuesta["Abreviacion_Corte"]);
            $("#editPrecioCorte").val(respuesta["Precio_Corte"]);

            if (respuesta["Foto_Corte"] != "" && respuesta["Foto_Corte"] != null) {
                $(".previsualizarCorte").attr("src", respuesta["Foto_Corte"]);
            }
        }

    });

});

/*=============================================
BORRAR ACABADO CON AJAX
=============================================*/
$(document).on('click', '.btnEliminarCorte', function () {

    var idCorte = $(this).attr('idCorte'),
        fotoCorte = $(this).attr('fotoCorte'),
        nombreCorte = $(this).attr('nomCorte');

    swal({
        title: "Eliminar corte",
        text: "¿Estas seguro de que quieres eliminar este tipo de corte?",
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
            window.location = "index.php?pagina=mainCorte&idCorte=" + idCorte + "&fotoCorte=" + fotoCorte + "&nombreCorte=" + nombreCorte;
        }
    });

});

/*=============================================
LIMPIAR CAMPOS - FORMULARIO AGREGAR
=============================================*/
$(document).on("click", ".closeModalCorte", function(){
    $("#ingNomCorte").val("");
    $("#ingNomCorte").removeClass("is-invalid is-valid");
    $("#ingAbvCorte").val("");
    $("#ingAbvCorte").removeClass("is-invalid is-valid");
    $("#ingAbvCorte").prop("readonly", true);
    $("#ingAbreviacionEspecialCorte").prop("checked", false);
    $("#ingPrecioCorte").val("");
    $("#ingPrecioCorte").removeClass("is-invalid is-valid");
    $(".fotoCorte").val("");
    $(".fotoCorte").siblings(".custom-file-label").addClass("selected").html("Subir una imagen");
    $(".previsualizarCorte").attr("src", "views/img/Cortes/defaultCorte.png");

    // Esconder errores
    $("#errorIngNomCorte").hide();
    $("#errorIngAbvCorte").hide();
});

/*=============================================
LIMPIAR CAMPOS - FORMULARIO EDITAR
=============================================*/
$(document).on("click", ".closeModalEditCorte", function(){
    $("#editNomCorte").val("");
    $("#editNomCorte").removeClass("is-invalid is-valid");
    $("#editAbvCorte").val("");
    $("#editAbvCorte").removeClass("is-invalid is-valid");
    $("#editAbvCorte").prop("readonly", true);
    $("#editAbreviacionEspecialCorte").prop("checked", false);
    $("#editPrecioCorte").val("");
    $("#editPrecioCorte").removeClass("is-invalid is-valid");
    $(".fotoCorte").val("");
    $(".fotoCorte").siblings(".custom-file-label").addClass("selected").html("Subir una imagen");
    $(".previsualizarCorte").attr("src", "views/img/Cortes/defaultCorte.png");

    // Esconder errores
    $("#errorEditNomCorte").hide();
    $("#errorEditAbvCorte").hide();
});