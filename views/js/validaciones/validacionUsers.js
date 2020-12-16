/*=============================================
VALIDACION DE LAS CONTRASEÑAS AL AGREGAR USUARIO
=============================================*/
$(document).on("submit", "#formAgregarUsuario", function(e){

    var pass1 = $("#passUser").val(),
        pass2 = $("#passUser2").val();

    if ( pass1 != pass2 ){
        $("#errorContraseñas").show();
        e.preventDefault();
    }

});

/*=============================================
VALIDACION DE LAS CONTRASEÑAS AL AGREGAR USUARIO
=============================================*/
$(document).on("submit", "#formEditarUsuario", function(e){

    var pass1 = $("#passEditUser").val(),
        pass2 = $("#passEditUser2").val();

    if ( pass1 != pass2 ){
        $("#errorEditContraseñas").show();
        e.preventDefault();
    }

});