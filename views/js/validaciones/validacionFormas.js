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
VALIDACIONES PARA INGRESAR FORMAS (FORM)
=============================================*/
$(document).on("keyup", "#ingNomForma", function () {
    var expresion = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;

    if ( validarExpresion($(this), expresion) ) {
        $("#errorIngNomForma").hide();
    } else {
        $("#errorIngNomForma").show();
    }
});

$(document).on("submit", "#formAgregarForma", function (e) {
    var expresion1 = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;

    if ( !validarExpresion($("#ingNomForma"), expresion1) && $("#ingNomForma").val() != "" ){ 
        e.preventDefault();
        $("#errorIngNomForma").show();
    }

    if ( !validarExpresion($("#ingNomForma"), expresion1)){ e.preventDefault(); }
});

/*=============================================
VALIDACIONES PARA EDITAR FORMAS (FORM)
=============================================*/
$(document).on("keyup", "#editNomForma", function () {
    var expresion = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;


    if ( validarExpresion($(this), expresion) ) {
        $("#errorEditNomForma").hide();
    } else {
        $("#errorEditNomForma").show();
    }
});

$(document).on("submit", "#formEditarForma", function (e) {
    var expresion1 = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;

    if ( !validarExpresion($("#editNomForma"), expresion1) && $("#editNomForma").val() != "" ){ 
        e.preventDefault();
        $("#errorEditNomForma").show();
    }

    if ( !validarExpresion($("#editNomForma"), expresion1) ){ e.preventDefault(); }
});