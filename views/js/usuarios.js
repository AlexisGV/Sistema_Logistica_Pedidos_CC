/*=============================================
SUBIENDO LA FOTO DEL USUARIO - AGREAR
=============================================*/
$(".fotoUsuario").on('change', function () {
    var imagen = this.files[0];
    // console.log("imagen", imagen);

    /*=============================================
    VALIDAR FORMATO DE LA IMAGEN
    =============================================*/
    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        $(this).val("");
        $(this).siblings(".custom-file-label").addClass("selected").html("Subir una foto");

        swal({
            title: "Error al subir la imagen!",
            text: "La imagen debe estar en formato JPG o PNG.",
            icon: "error",
            button: "Cerrar",
        });
    } else if (imagen["size"] > 3000000) {
        $(this).val("");
        $(this).siblings(".custom-file-label").addClass("selected").html("Subir una foto");

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
            $(".previsualizarUsuario").attr('src', rutaImagen);
        });
    }

});

/*=============================================
SUBIENDO LA FOTO DEL USUARIO - EDIT
=============================================*/
$(".fotoEditUsuario").on('change', function () {
    var imagen = this.files[0];
    // console.log("imagen", imagen);

    /*=============================================
    VALIDAR FORMATO DE LA IMAGEN
    =============================================*/
    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        $(this).val("");
        $(this).siblings(".custom-file-label").addClass("selected").html("Subir una foto");

        swal({
            title: "Error al subir la imagen!",
            text: "La imagen debe estar en formato JPG o PNG.",
            icon: "error",
            button: "Cerrar",
        });
    } else if (imagen["size"] > 3000000) {
        $(this).val("");
        $(this).siblings(".custom-file-label").addClass("selected").html("Subir una foto");

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
            $(".previsualizarEditUsuario").attr('src', rutaImagen);
        });
    }

});

/*=============================================
EDITAR USUARIO CON AJAX
=============================================*/
$(document).on('click', '.btnEditarUsuario', function () {

    var idUsuario = $(this).attr('idUsuario');

    var datos = new FormData();
    datos.append('idUsuario', idUsuario);

    $.ajax({

        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // VALORES OCULTOS
            $("#idEditUser").val(respuesta["Id_Usuario"]);
            $("#apodoUserActual").val(respuesta["Apodo"]);
            $("#fotoUserActual").val(respuesta["Foto_User"]);
            $("#passActual").val(respuesta["Password"]);

            // VALORES EDITABLES
            $("#nomEditUser").val(respuesta["Nombre_Usuario"]);
            $("#correoEditUser").val(respuesta["Correo"]);
            $("#apodoEditUser").val(respuesta["Apodo"]);
            $("#tipoEditUsuario").val(respuesta["Tipo_User"]).trigger("change");

            if (respuesta["Foto_User"] != "" && respuesta["Foto_User"] != null) {
                $(".previsualizarEditUsuario").attr("src", respuesta["Foto_User"]);
            }
        }

    });

});

/*=============================================
BORRAR USUARIO CON AJAX
=============================================*/
$(document).on('click', '.btnEliminarUsuario', function () {

    var idUsuario = $(this).attr('idUsuario'),
        fotoUsuario = $(this).attr('fotoUsuario'),
        apodoUsuario = $(this).attr('apodoUsuario');

    swal({
        title: "Eliminar usuario",
        text: "¿Estas seguro de que quieres eliminar este usuario?",
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
            window.location = "index.php?pagina=mainUsuarios&idUser=" + idUsuario + "&fotoUser=" + fotoUsuario + "&apodoUser=" + apodoUsuario;
        }
    });

});

/*=============================================
LIMPIAR MODAL PARA AGREGAR USUARIO
=============================================*/
$(document).on('click', '.closeModalUser', function () {
    $("#nomUser").val("");
    $("#correoUser").val("");
    $("#apodoUser").val("");
    $("#passUser").val("");
    $("#passUser2").val("");
    $('#tipoUsuario').val(null).trigger("change");

    // LIMPIAR IMAGEN
    $(".fotoUsuario").val("");
    $(".fotoUsuario").siblings(".custom-file-label").addClass("selected").html("Subir una foto");
    $(".previsualizarUsuario").attr('src', "views/img/Usuarios/defaultUser.png");
});

/*=============================================
LIMPIAR MODAL PARA EDITAR USUARIO
=============================================*/
$(document).on('click', '.closeModalEditUser', function () {
    $("#nomEditUser").val("");
    $("#idEditUser").val("");
    $("#correoEditUser").val("");
    $("#apodoEditUser").val("");
    $("#apodoUserActual").val("");
    $("#passEditUser").val("");
    $("#passEditUser2").val("");
    $("#passActual").val("");
    $('#tipoEditUsuario').val(null).trigger("change");

    // LIMPIAR IMAGEN
    $("#fotoUserActual").val("");
    $(".fotoEditUsuario").val("");
    $(".fotoEditUsuario").siblings(".custom-file-label").addClass("selected").html("Subir una foto");
    $(".previsualizarEditUsuario").attr('src', "views/img/Usuarios/defaultUser.png");
});