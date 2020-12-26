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
$(document).on("change", "#ingAbreviacionEspecial", function () {
    if ($(this).is(":checked")) {
        $("#ingAbvAcabado").prop("readonly", false);
    } else {
        $("#ingAbvAcabado").prop("readonly", true);
    }
});

$(document).on("keyup", "#ingNomAcabado", function () {
    var expresion = /^[A-Z]+[a-zñÑáÁéÉíÍóÓúÚ]+$/,
        expresion2 = /^[A-ZÑÁÉÍÓÚ]+$/;


    if ( validarExpresion($(this), expresion) ) {
        $("#errorIngNomAcabado").hide();
        let abreviacion = "A"+$(this).val().substr(0,1);
        $("#ingAbvAcabado").val(abreviacion.toUpperCase());
        validarExpresion($("#ingAbvAcabado"), expresion2);
    } else {
        $("#errorIngNomAcabado").show();
        $("#errorIngAbvAcabado").hide();
        $("#ingAbvAcabado").val(null);
        validarExpresion($("#ingAbvAcabado"), expresion2);
    }
});

$(document).on("keyup", "#ingAbvAcabado", function () {
    var expresion = /^[A-ZÑÁÉÍÓÚ]+$/;

    if ( validarExpresion($(this), expresion) ){
        $("#errorIngAbvAcabado").hide();
    } else {
        $("#errorIngAbvAcabado").show();
    }
});

$(document).on("change", "#ingPrecioAcabado", function () {
    var expresion = /^[0-9]+([.][0-9]{0,2})?$/;

    validarExpresion($(this), expresion)
});

$(document).on("submit", "#formAgregarAcabado", function (e) {
    var expresion1 = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/,
        expresion2 = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ]+$/,
        expresion3 = /^[0-9]+([.][0-9]{0,2})?$/;

    if ( !validarExpresion($("#ingNomAcabado"), expresion1) && $("#ingNomAcabado").val() != "" ){ 
        e.preventDefault();
        $("#errorIngNomAcabado").show();
    }

    if ( !validarExpresion($("#ingAbvAcabado"), expresion2) && $("#ingAbvAcabado").val() != "" ) { 
        $("#errorIngAbvAcabado").show();
    }

    if ( !validarExpresion($("#ingNomAcabado"), expresion1)){ e.preventDefault(); }
    if ( !validarExpresion($("#ingAbvAcabado"), expresion2) ){ e.preventDefault(); }
    if ( !validarExpresion($("#ingPrecioAcabado"), expresion3) ){ e.preventDefault(); }
});

/*=============================================
VALIDACIONES PARA EDITAR ACABADOS (FORM)
=============================================*/
$(document).on("change", "#editAbreviacionEspecial", function () {
    if ($(this).is(":checked")) {
        $("#editAbvAcabado").prop("readonly", false);
    } else {
        $("#editAbvAcabado").prop("readonly", true);
    }
});

$(document).on("keyup", "#editNomAcabado", function () {
    var expresion = /^[A-Z]+[a-zñÑáÁéÉíÍóÓúÚ]+$/,
        expresion2 = /^[A-ZÑÁÉÍÓÚ]+$/;


    if ( validarExpresion($(this), expresion) ) {
        $("#errorEditNomAcabado").hide();
        let abreviacion = "A"+$(this).val().substr(0,1);
        $("#editAbvAcabado").val(abreviacion.toUpperCase());
        validarExpresion($("#editAbvAcabado"), expresion2);
    } else {
        $("#errorEditNomAcabado").show();
        $("#errorEditAbvAcabado").hide();
        $("#editAbvAcabado").val(null);
        validarExpresion($("#editAbvAcabado"), expresion2);
    }
});

$(document).on("keyup", "#editAbvAcabado", function () {
    var expresion = /^[A-ZÑÁÉÍÓÚ]+$/;

    if ( validarExpresion($(this), expresion) ){
        $("#errorEditAbvAcabado").hide();
    } else {
        $("#errorEditAbvAcabado").show();
    }
});

$(document).on("change", "#editPrecioAcabado", function () {
    var expresion = /^[0-9]+([.][0-9]{0,2})?$/;

    validarExpresion($(this), expresion)
});

$(document).on("submit", "#formEditarAcabado", function (e) {
    var expresion1 = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/,
        expresion2 = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ]+$/,
        expresion3 = /^[0-9]+([.][0-9]{0,2})?$/;

    if ( !validarExpresion($("#editNomAcabado"), expresion1) && $("#editNomAcabado").val() != "" ){ 
        e.preventDefault();
        $("#errorEditNomAcabado").show();
    }
    
    if ( !validarExpresion($("#editAbvAcabado"), expresion2) && $("#editAbvAcabado").val() != "" ) { 
        $("#errorEditAbvAcabado").show();
    }

    if ( !validarExpresion($("#editNomAcabado"), expresion1) ){ e.preventDefault(); }
    if ( !validarExpresion($("#editAbvAcabado"), expresion2) ){ e.preventDefault(); }
    if ( !validarExpresion($("#editPrecioAcabado"), expresion3) ){ e.preventDefault(); }
});