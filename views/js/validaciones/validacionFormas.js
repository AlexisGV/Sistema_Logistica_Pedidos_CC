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
$(document).on("change", "#ingAbreviacionEspecialForma", function () {
    if ($(this).is(":checked")) {
        $("#ingAbvForma").prop("readonly", false);
    } else {
        $("#ingAbvForma").prop("readonly", true);
    }
});

$(document).on("keyup", "#ingNomForma", function () {
    var expresion = /^[A-Z]+[a-zñÑáÁéÉíÍóÓúÚ]+$/,
        expresion2 = /^[A-ZÑÁÉÍÓÚ]+$/;


    if ( validarExpresion($(this), expresion) ) {
        $("#errorIngNomForma").hide();
        let abreviacion = "F"+$(this).val().substr(0,1);
        $("#ingAbvForma").val(abreviacion.toUpperCase());
        validarExpresion($("#ingAbvForma"), expresion2);
    } else {
        $("#errorIngNomForma").show();
        $("#errorIngAbvForma").hide();
        $("#ingAbvCorte").val(null);
        validarExpresion($("#ingAbvForma"), expresion2);
    }
});

$(document).on("keyup", "#ingAbvForma", function () {
    var expresion = /^[A-ZÑÁÉÍÓÚ]+$/;

    if ( validarExpresion($(this), expresion) ){
        $("#errorIngAbvForma").hide();
    } else {
        $("#errorIngAbvForma").show();
    }
});

$(document).on("submit", "#formAgregarForma", function (e) {
    var expresion1 = /^[A-Z]+[a-zñÑáÁéÉíÍóÓúÚ]+$/,
        expresion2 = /^[A-ZÑÁÉÍÓÚ]+$/;

    if ( !validarExpresion($("#ingNomForma"), expresion1) && $("#ingNomForma").val() != "" ){ 
        e.preventDefault();
        $("#errorIngNomForma").show();
    }

    if ( !validarExpresion($("#ingAbvForma"), expresion2) && $("#ingAbvForma").val() != "" ) { 
        e.preventDefault();
        $("#errorIngAbvForma").show();
    }

    if ( !validarExpresion($("#ingNomForma"), expresion1)){ e.preventDefault(); }
    if ( !validarExpresion($("#ingAbvForma"), expresion2) ){ e.preventDefault(); }
});

/*=============================================
VALIDACIONES PARA EDITAR FORMAS (FORM)
=============================================*/
$(document).on("change", "#editAbreviacionEspecialForma", function () {
    if ($(this).is(":checked")) {
        $("#editAbvForma").prop("readonly", false);
    } else {
        $("#editAbvForma").prop("readonly", true);
    }
});

$(document).on("keyup", "#editNomForma", function () {
    var expresion = /^[A-Z]+[a-zñÑáÁéÉíÍóÓúÚ]+$/,
        expresion2 = /^[A-ZÑÁÉÍÓÚ]+$/;


    if ( validarExpresion($(this), expresion) ) {
        $("#errorEditNomForma").hide();
        let abreviacion = "F"+$(this).val().substr(0,1);
        $("#editAbvForma").val(abreviacion.toUpperCase());
        validarExpresion($("#editAbvForma"), expresion2);
    } else {
        $("#errorEditNomForma").show();
        $("#errorEditAbvForma").hide();
        $("#editAbvForma").val(null);
        validarExpresion($("#editAbvForma"), expresion2);
    }
});

$(document).on("keyup", "#editAbvForma", function () {
    var expresion = /^[A-ZÑÁÉÍÓÚ]+$/;

    if ( validarExpresion($(this), expresion) ){
        $("#errorEditAbvForma").hide();
    } else {
        $("#errorEditAbvForma").show();
    }
});

$(document).on("submit", "#formEditarForma", function (e) {
    var expresion1 = /^[A-Z]+[a-zñÑáÁéÉíÍóÓúÚ]+$/,
        expresion2 = /^[A-ZÑÁÉÍÓÚ]+$/;

    if ( !validarExpresion($("#editNomForma"), expresion1) && $("#editNomForma").val() != "" ){ 
        e.preventDefault();
        $("#errorEditNomForma").show();
    }
    
    if ( !validarExpresion($("#editAbvForma"), expresion2) && $("#editAbvForma").val() != "" ) { 
        e.preventDefault();
        $("#errorEditAbvForma").show();
    }

    if ( !validarExpresion($("#editNomForma"), expresion1) ){ e.preventDefault(); }
    if ( !validarExpresion($("#editAbvForma"), expresion2) ){ e.preventDefault(); }
});