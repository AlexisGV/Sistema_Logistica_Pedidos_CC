/*=============================================
EDICION DE ROLES
=============================================*/
$(document).on('click', '.btnEditarRol', function () {

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

            if ( respuesta["Tipo_User"] == "Administrador" || respuesta["Tipo_User"] == "Ventas") {
                $("#nomEditRol").prop("readonly", true);
            } else {
                $("#nomEditRol").prop("readonly", false);
            }

            $("#editDescripcionRol").val(respuesta["Descripcion_Tipo_User"]);
        }

    });

    autosize($('#editDescripcionRol'));

});

/*=============================================
EDICION DE PERMISOS - MOSTRAR TODOS LOS PERMISOS
=============================================*/
$(document).on('click', '.btnEditarPermisos', function () {

    var idRol = $(this).attr('idRol');

    var dato = new FormData();
    dato.append('idRolForModules', idRol);

    $.ajax({
        url: "ajax/roles.ajax.php",
        method: "POST",
        data: dato,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log(respuesta);

            for (let i = 0; i < respuesta.length; i++) {

                $("#nomRolUsuario").html("\"" + respuesta[0]["Tipo_User"] + "\"");

                if ( respuesta[0]["Tipo_User"] == "Administrador" ) {
                    
                    $("#modulos").append(
                        '<div class="jumbotron bg-info m-2">'+
                        '   <h1 class="display-4"><i class="fas fa-info-circle d-block d-md-inline-block text-center text-md-left"></i> Privilegios sin restricciones</h1>'+
                        '   <p class="lead">Este es el rol de administrador, puede realizar la acción que desee en el sistema sin ningún tipo de restricción. Sin embargo, debe procura ser cuidadoso con estas acciones para evitar cualquier perdida de información o alteración de la misma.</p>'+
                        '</div>'
                    );

                    break;

                } else {

                    // BOTON PARA CREAR
                    var botonCreate = "";
                    if (Number(respuesta[i]["C_A"]) == 0) {
                        botonCreate = '<div class="btn border border-dark w-100">N/A</div>';
                    } else {
    
                        if (Number(respuesta[i]["C"]) == 0) {
                            botonCreate = '<button type="button" class="btn btn-secondary w-100 btnChangePermiso" idRol="' + respuesta[i]["Id_Tipo_User"] + '" idModulo="' + respuesta[i]["Id_Modulo"] + '" tipoPermiso="C" permiso="' + respuesta[i]["C"] + '">OFF</button>';
                        } else {
                            botonCreate = '<button type="button" class="btn btn-success w-100 btnChangePermiso" idRol="' + respuesta[i]["Id_Tipo_User"] + '" idModulo="' + respuesta[i]["Id_Modulo"] + '" tipoPermiso="C" permiso="' + respuesta[i]["C"] + '">ON</button>';
                        }
    
                    }
    
                    // BOTON PARA LEER DATOS
                    var botonRead = "";
                    if (Number(respuesta[i]["R_A"]) == 0) {
                        botonRead = '<div class="btn border border-dark w-100">N/A</div>';
                    } else {
    
                        if (Number(respuesta[i]["R"]) == 0) {
                            botonRead = '<button type="button" class="btn btn-secondary w-100 btnChangePermiso" idRol="' + respuesta[i]["Id_Tipo_User"] + '" idModulo="' + respuesta[i]["Id_Modulo"] + '" tipoPermiso="R" permiso="' + respuesta[i]["R"] + '">OFF</button>';
                        } else {
                            botonRead = '<button type="button" class="btn btn-success w-100 btnChangePermiso" idRol="' + respuesta[i]["Id_Tipo_User"] + '" idModulo="' + respuesta[i]["Id_Modulo"] + '" tipoPermiso="R" permiso="' + respuesta[i]["R"] + '">ON</button>';
                        }
    
                    }
    
                    // BOTON PARA ACTUALIZAR DATOS
                    var botonUpdate = "";
                    if (Number(respuesta[i]["U_A"]) == 0) {
                        botonUpdate = '<div class="btn border border-dark w-100">N/A</div>';
                    } else {
    
                        if (Number(respuesta[i]["U"]) == 0) {
                            botonUpdate = '<button type="button" class="btn btn-secondary w-100 btnChangePermiso" idRol="' + respuesta[i]["Id_Tipo_User"] + '" idModulo="' + respuesta[i]["Id_Modulo"] + '" tipoPermiso="U" permiso="' + respuesta[i]["U"] + '">OFF</button>';
                        } else {
                            botonUpdate = '<button type="button" class="btn btn-success w-100 btnChangePermiso" idRol="' + respuesta[i]["Id_Tipo_User"] + '" idModulo="' + respuesta[i]["Id_Modulo"] + '" tipoPermiso="U" permiso="' + respuesta[i]["U"] + '">ON</button>';
                        }
    
                    }
    
                    // BOTON PARA ELIMINAR DATOS
                    var botonDelete = "";
                    if (Number(respuesta[i]["D_A"]) == 0) {
                        botonDelete = '<div class="btn border border-dark w-100">N/A</div>';
                    } else {
    
                        if (Number(respuesta[i]["D"]) == 0) {
                            botonDelete = '<button type="button" class="btn btn-secondary w-100 btnChangePermiso" idRol="' + respuesta[i]["Id_Tipo_User"] + '" idModulo="' + respuesta[i]["Id_Modulo"] + '" tipoPermiso="D" permiso="' + respuesta[i]["D"] + '">OFF</button>';
                        } else {
                            botonDelete = '<button type="button" class="btn btn-success w-100 btnChangePermiso" idRol="' + respuesta[i]["Id_Tipo_User"] + '" idModulo="' + respuesta[i]["Id_Modulo"] + '" tipoPermiso="D" permiso="' + respuesta[i]["D"] + '">ON</button>';
                        }
    
                    }
    
                    if (i == 0) {
    
                        $("#modulos").append(
                            '<div class="row">' +
                            '   <div class="col-12 col-md-4">' +
                            '       <h5 class="font-weight-bold">Modulo</h5>' +
                            '       <p>' + respuesta[i]["Nombre_Modulo"] + '</p>' +
                            '   </div>' +
                            '   <div class="col-3 col-md-2 text-center">' +
                            '       <h5 class="font-weight-bold text-truncate">Crear</h5>' +
                            botonCreate +
                            '   </div>' +
                            '<div class="col-3 col-md-2 text-center">' +
                            '       <h5 class="font-weight-bold text-truncate">Lectura</h5>' +
                            botonRead +
                            '   </div>' +
                            '   <div class="col-3 col-md-2 text-center">' +
                            '       <h5 class="font-weight-bold text-truncate">Actualizar</h5>' +
                            botonUpdate +
                            '   </div>' +
                            '   <div class="col-3 col-md-2 text-center">' +
                            '       <h5 class="font-weight-bold text-truncate">Eliminar</h5>' +
                            botonDelete +
                            '   </div>' +
                            '</div>'
                        );
    
                    } else {
                        $("#modulos").append(
                            '<div class="row mt-3">' +
                            '   <div class="col-12 col-md-4">' +
                            '       <h5 class="font-weight-bold d-block d-md-none">Modulo</h5>' +
                            '       <p>' + respuesta[i]["Nombre_Modulo"] + '</p>' +
                            '   </div>' +
                            '   <div class="col-3 col-md-2 text-center">' +
                            '       <h5 class="font-weight-bold d-block d-md-none text-truncate">Crear</h5>' +
                            botonCreate +
                            '   </div>' +
                            '   <div class="col-3 col-md-2 text-center">' +
                            '       <h5 class="font-weight-bold d-block d-md-none text-truncate">Lectura</h5>' +
                            botonRead +
                            '   </div>' +
                            '   <div class="col-3 col-md-2 text-center">' +
                            '       <h5 class="font-weight-bold d-block d-md-none text-truncate">Actualizar</h5>' +
                            botonUpdate +
                            '   </div>' +
                            '   <div class="col-3 col-md-2 text-center">' +
                            '       <h5 class="font-weight-bold d-block d-md-none text-truncate">Eliminar</h5>' +
                            botonDelete +
                            '   </div>' +
                            '</div>'
                        );
                    }

                }

            }
        }

    });

});

/*=============================================
EDICION DE PERMISOS - MOSTRAR TODOS LOS PERMISOS
=============================================*/
$(document).on('click', '.btnChangePermiso', function () {

    var campo = $(this);
    var idRol = $(this).attr('idRol');
    var idModulo = $(this).attr('idModulo');
    var tipoPermiso = $(this).attr('tipoPermiso');
    var permiso = $(this).attr('permiso');
    // console.log(idRol + " - " + idModulo + " - " + tipoPermiso + " - " + permiso);

    var datos = new FormData();
    datos.append('idRol', idRol);
    datos.append('idModulo', idModulo);
    datos.append('tipoPermiso', tipoPermiso);
    datos.append('permiso', permiso);

    $.ajax({
        url: "ajax/roles.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);

            // if ( respuesta == "ok" ) {

            //     if ( Number(permiso) == 1 ) {
            //         campo.removeClass("btn-succes");
            //         campo.addClass("btn-secondary");
            //         campo.attr("permiso", 0);
            //         campo.text("OFF");
            //     } else {
            //         campo.removeClass("btn-secondary");
            //         campo.addClass("btn-succes");
            //         campo.attr("permiso", 1);
            //         campo.text("ON");
            //     }

            // } else {
            //     swal({
            //         title: "Error al actualizar permiso",
            //         text: "Ha ocurrido un error inesperado al intentar actualziar el permiso",
            //         icon: "error",
            //     });
            // }
        }
    });

    if (Number(permiso) == 1) {
        campo.removeClass("btn-success");
        campo.addClass("btn-secondary");
        campo.attr("permiso", 0);
        campo.text("OFF");
    } else {
        campo.removeClass("btn-secondary");
        campo.addClass("btn-success");
        campo.attr("permiso", 1);
        campo.text("ON");
    }

});

/*=============================================
ELIMINAR ROL
=============================================*/
$(document).on('click', '.btnEliminarRol', function () {

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
$(document).on('click', '.closeModalRol', function () {
    $("#nomRol").val("");
    $("#ingDescripcionRol").val("");
    $("#ingDescripcionRol").attr("style", "overflow: hidden; overflow-wrap: break-word; resize: none;");
    $("#ingDescripcionRol").attr("rows", 2);
});

$(document).on('click', '.closeModalEditRol', function () {
    $("#idEditRol").val("");
    $("#nomEditRol").val("");
    $("#editDescripcionRol").val("");
    $("#editDescripcionRol").attr("style", "overflow: hidden; overflow-wrap: break-word; resize: none;");
    $("#editDescripcionRol").attr("rows", 3);
});

$(document).on('click', '.closeModalEditPermisos', function () {
    $("#nomRolUsuario").html("");
    $("#modulos").html("");
});