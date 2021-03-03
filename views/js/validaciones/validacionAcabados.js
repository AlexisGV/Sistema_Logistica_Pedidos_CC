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
VALIDACIONES PARA INGRESAR ACABADOS (FORM)
=============================================*/
$(document).on("keyup", "#ingNomAcabado", function () {
    var expresion = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;


    if ( validarExpresion($(this), expresion) ) {
        $("#errorIngNomAcabado").hide();
    } else {
        $("#errorIngNomAcabado").show();
    }
});

$(document).on("submit", "#formAgregarAcabado", function (e) {
    var expresion1 = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;

    if ( !validarExpresion($("#ingNomAcabado"), expresion1) && $("#ingNomAcabado").val() != "" ){ 
        e.preventDefault();
        $("#errorIngNomAcabado").show();
    }

    if ( !validarExpresion($("#ingNomAcabado"), expresion1)){ e.preventDefault(); }
});

/*=============================================
VALIDACIONES PARA EDITAR ACABADOS (FORM)
=============================================*/
$(document).on("keyup", "#editNomAcabado", function () {
    var expresion = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;

    if ( validarExpresion($(this), expresion) ) {
        $("#errorEditNomAcabado").hide();
    } else {
        $("#errorEditNomAcabado").show();
    }
});

$(document).on("submit", "#formEditarAcabado", function (e) {
    var expresion1 = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;

    if ( !validarExpresion($("#editNomAcabado"), expresion1) && $("#editNomAcabado").val() != "" ){ 
        e.preventDefault();
        $("#errorEditNomAcabado").show();
    }

    if ( !validarExpresion($("#editNomAcabado"), expresion1) ){ e.preventDefault(); }
});