/*=============================================
EDICION DE SUBCATEGORIA
=============================================*/
$(document).on('click', '.btnEditarRol', function(){

    var idRol = $(this).attr('idRol');

    var dato = new FormData();
    dato.append('idRol', idRol);

    $.ajax({
        url: "ajax/roles.ajax.php",
        method: "POST",
        data: dato,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $("#idEditRol").val(respuesta["Id_Tipo_User"]);
            $("#nomEditRol").val(respuesta["Tipo_User"]);
        }

    });

});

/*=============================================
ELIMINAR ROL
=============================================*/
$(document).on('click', '.btnEliminarRol', function(){

    var idRol = $(this).attr('idRol');

    swal({
        title: "Eliminar rol de usuario",
        text: "¿Estas seguro de que quieres eliminar este rol?",
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
            window.location = "index.php?pagina=mainRoles&idRol=" + idRol;
        }
    });

});

/*=============================================
Limpiar Modals
=============================================*/
$(document).on('click', '.closeModalRol', function(){
    $("#nomRol").val("");
});