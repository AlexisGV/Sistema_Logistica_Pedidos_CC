function validarExpresion(campo, expresion){

    if (campo.val().match(expresion)) {
        campo.removeClass("is-invalid");
        campo.addClass("is-valid");

        return true;
    } else {
        campo.removeClass("is-valid");
        campo.addClass("is-invalid");

        return false;
    }

}

/*=============================================
VALIDACIONES PARA INGRESAR MARCAS (FORM)
=============================================*/
$(document).on("keyup", "#ingNomMarca", function () {
    var expresion = /^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s]+$/;

    if ( validarExpresion($(this), expresion) ) {
        $("#errorIngNomMarca").hide();
    } else {
        $("#errorIngNomMarca").show();
    }
});

$(document).on("submit", "#formAgregarMarca", function (e) {
    var expresion1 = /^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s]+$/;

    if ( !validarExpresion($("#ingNomMarca"), expresion1) && $("#ingNomMarca").val() != "" ){ 
        e.preventDefault();
        $("#errorIngNomMarca").show();
    }

    if ( !validarExpresion($("#ingNomMarca"), expresion1)){ e.preventDefault(); }
});

/*=============================================
VALIDACIONES PARA EDITAR MARCAS (FORM)
=============================================*/
$(document).on("keyup", "#editNomMarca", function () {
    var expresion = /^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s]+$/;

    if ( validarExpresion($(this), expresion) ) {
        $("#errorEditNomMarca").hide();
    } else {
        $("#errorEditNomMarca").show();
    }
});

$(document).on("submit", "#formEditarMarca", function (e) {
    var expresion1 = /^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s]+$/;

    if ( !validarExpresion($("#editNomMarca"), expresion1) && $("#editNomMarca").val() != "" ){ 
        e.preventDefault();
        $("#errorEditNomMarca").show();
    }

    if ( !validarExpresion($("#editNomMarca"), expresion1) ){ e.preventDefault(); }
});