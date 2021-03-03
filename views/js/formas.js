/*=============================================
SUBIENDO LA FOTO DEL USUARIO - AGREAR
=============================================*/
$(".fotoForma").on('change', function () {
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
            $(".previsualizarForma").attr('src', rutaImagen);
        });
    }

});

/*=============================================
ENVIANDO DATOS DEL ACABADO A FORMULARIO PARA EDITAR
=============================================*/
$(document).on("click", ".btnEditarForma", function(){

    var idForma = $(this).attr("idForma");

    var datos = new FormData();
    datos.append('idForma', idForma);

    $.ajax({

        url: "ajax/formas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log(respuesta);
            // Valores actuales
            $("#editNomActualForma").val(respuesta["Forma"]);
            $("#editFotoActualForma").val(respuesta["Foto_Forma"]);

            // Nuevos valores
            $("#editIdForma").val(respuesta["Id_Forma"]);
            $("#editNomForma").val(respuesta["Forma"]);

            if (respuesta["Foto_Forma"] != "" && respuesta["Foto_Forma"] != null) {
                $(".previsualizarForma").attr("src", respuesta["Foto_Forma"]);
            }
        }

    });

});

/*=============================================
BORRAR FORMA CON AJAX
=============================================*/
$(document).on('click', '.btnEliminarForma', function () {

    var idForma = $(this).attr('idForma'),
        fotoForma = $(this).attr('fotoForma'),
        nombreForma = $(this).attr('nomForma');

    swal({
        title: "Eliminar forma",
        text: "¿Estas seguro de que quieres eliminar esta forma?",
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
            window.location = "index.php?pagina=mainForma&idForma=" + idForma + "&fotoForma=" + fotoForma + "&nombreForma=" + nombreForma;
        }
    });

});

/*=============================================
LIMPIAR CAMPOS - FORMULARIO AGREGAR
=============================================*/
$(document).on("click", ".closeModalForma", function(){
    $("#ingNomForma").val("");
    $("#ingNomForma").removeClass("is-invalid is-valid");
    $(".fotoForma").val("");
    $(".fotoForma").siblings(".custom-file-label").addClass("selected").html("Subir una imagen");
    $(".previsualizarForma").attr("src", "views/img/Formas/defaultForma.png");

    // Esconder errores
    $("#errorIngNomForma").hide();
});

/*=============================================
LIMPIAR CAMPOS - FORMULARIO EDITAR
=============================================*/
$(document).on("click", ".closeModalEditForma", function(){
    $("#editNomForma").val("");
    $("#editNomForma").removeClass("is-invalid is-valid");
    $(".fotoForma").val("");
    $(".fotoForma").siblings(".custom-file-label").addClass("selected").html("Subir una imagen");
    $(".previsualizarForma").attr("src", "views/img/Formas/defaultForma.png");

    // Esconder errores
    $("#errorEditNomForma").hide();
});