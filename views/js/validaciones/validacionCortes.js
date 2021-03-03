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
VALIDACIONES PARA INGRESAR CORTES (FORM)
=============================================*/
$(document).on("keyup", "#ingNomCorte", function () {
    var expresion = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;


    if ( validarExpresion($(this), expresion) ) {
        $("#errorIngNomCorte").hide();
    } else {
        $("#errorIngNomCorte").show();
    }
});

$(document).on("submit", "#formAgregarCorte", function (e) {
    var expresion1 = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;

    if ( !validarExpresion($("#ingNomCorte"), expresion1) && $("#ingNomCorte").val() != "" ){ 
        e.preventDefault();
        $("#errorIngNomCorte").show();
    }

    if ( !validarExpresion($("#ingNomCorte"), expresion1)){ e.preventDefault(); }
});

/*=============================================
VALIDACIONES PARA EDITAR CORTES (FORM)
=============================================*/
$(document).on("keyup", "#editNomCorte", function () {
    var expresion = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;


    if ( validarExpresion($(this), expresion) ) {
        $("#errorEditNomCorte").hide();
    } else {
        $("#errorEditNomCorte").show();
    }
});

$(document).on("submit", "#formEditarCorte", function (e) {
    var expresion1 = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;

    if ( !validarExpresion($("#editNomCorte"), expresion1) && $("#editNomCorte").val() != "" ){ 
        e.preventDefault();
        $("#errorEditNomCorte").show();
    }
    
    if ( !validarExpresion($("#editNomCorte"), expresion1) ){ e.preventDefault(); }
});