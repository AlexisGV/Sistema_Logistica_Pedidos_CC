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
$(document).on("change", "#ingAbreviacionEspecialCorte", function () {
    if ($(this).is(":checked")) {
        $("#ingAbvCorte").prop("readonly", false);
    } else {
        $("#ingAbvCorte").prop("readonly", true);
    }
});

$(document).on("keyup", "#ingNomCorte", function () {
    var expresion = /^[A-Z]+[a-zñÑáÁéÉíÍóÓúÚ]+$/,
        expresion2 = /^[A-ZÑÁÉÍÓÚ]+$/;


    if ( validarExpresion($(this), expresion) ) {
        $("#errorIngNomCorte").hide();
        let abreviacion = "C"+$(this).val().substr(0,1);
        $("#ingAbvCorte").val(abreviacion.toUpperCase());
        validarExpresion($("#ingAbvCorte"), expresion2);
    } else {
        $("#errorIngNomCorte").show();
        $("#errorIngAbvCorte").hide();
        $("#ingAbvCorte").val(null);
        validarExpresion($("#ingAbvCorte"), expresion2);
    }
});

$(document).on("keyup", "#ingAbvCorte", function () {
    var expresion = /^[A-ZÑÁÉÍÓÚ]+$/;

    if ( validarExpresion($(this), expresion) ){
        $("#errorIngAbvCorte").hide();
    } else {
        $("#errorIngAbvCorte").show();
    }
});

$(document).on("change", "#ingPrecioCorte", function () {
    var expresion = /^[0-9]+([.][0-9]{0,2})?$/;

    validarExpresion($(this), expresion)
});

$(document).on("submit", "#formAgregarCorte", function (e) {
    var expresion1 = /^[A-Z]+[a-zñÑáÁéÉíÍóÓúÚ]+$/,
        expresion2 = /^[A-ZÑÁÉÍÓÚ]+$/,
        expresion3 = /^[0-9]+([.][0-9]{0,2})?$/;

    if ( !validarExpresion($("#ingNomCorte"), expresion1) && $("#ingNomCorte").val() != "" ){ 
        e.preventDefault();
        $("#errorIngNomCorte").show();
    }

    if ( !validarExpresion($("#ingAbvCorte"), expresion2) && $("#ingAbvCorte").val() != "" ) { 
        e.preventDefault();
        $("#errorIngAbvCorte").show();
    }

    if ( !validarExpresion($("#ingNomCorte"), expresion1)){ e.preventDefault(); }
    if ( !validarExpresion($("#ingAbvCorte"), expresion2) ){ e.preventDefault(); }
    if ( !validarExpresion($("#ingPrecioCorte"), expresion3) ){ e.preventDefault(); }
});

/*=============================================
VALIDACIONES PARA EDITAR CORTES (FORM)
=============================================*/
$(document).on("change", "#editAbreviacionEspecialCorte", function () {
    if ($(this).is(":checked")) {
        $("#editAbvCorte").prop("readonly", false);
    } else {
        $("#editAbvCorte").prop("readonly", true);
    }
});

$(document).on("keyup", "#editNomCorte", function () {
    var expresion = /^[A-Z]+[a-zñÑáÁéÉíÍóÓúÚ]+$/,
        expresion2 = /^[A-ZÑÁÉÍÓÚ]+$/;


    if ( validarExpresion($(this), expresion) ) {
        $("#errorEditNomCorte").hide();
        let abreviacion = "C"+$(this).val().substr(0,1);
        $("#editAbvCorte").val(abreviacion.toUpperCase());
        validarExpresion($("#editAbvCorte"), expresion2);
    } else {
        $("#errorEditNomCorte").show();
        $("#errorEditAbvCorte").hide();
        $("#editAbvCorte").val(null);
        validarExpresion($("#editAbvCorte"), expresion2);
    }
});

$(document).on("keyup", "#editAbvCorte", function () {
    var expresion = /^[A-ZÑÁÉÍÓÚ]+$/;

    if ( validarExpresion($(this), expresion) ){
        $("#errorEditAbvCorte").hide();
    } else {
        $("#errorEditAbvCorte").show();
    }
});

$(document).on("change", "#editPrecioCorte", function () {
    var expresion = /^[0-9]+([.][0-9]{0,2})?$/;

    validarExpresion($(this), expresion)
});

$(document).on("submit", "#formEditarCorte", function (e) {
    var expresion1 = /^[A-Z]+[a-zñÑáÁéÉíÍóÓúÚ]+$/,
        expresion2 = /^[A-ZÑÁÉÍÓÚ]+$/,
        expresion3 = /^[0-9]+([.][0-9]{0,2})?$/;

    if ( !validarExpresion($("#editNomCorte"), expresion1) && $("#editNomCorte").val() != "" ){ 
        e.preventDefault();
        $("#errorEditNomCorte").show();
    }
    
    if ( !validarExpresion($("#editAbvCorte"), expresion2) && $("#editAbvCorte").val() != "" ) { 
        e.preventDefault();
        $("#errorEditAbvCorte").show();
    }

    if ( !validarExpresion($("#editNomCorte"), expresion1) ){ e.preventDefault(); }
    if ( !validarExpresion($("#editAbvCorte"), expresion2) ){ e.preventDefault(); }
    if ( !validarExpresion($("#editPrecioCorte"), expresion3) ){ e.preventDefault(); }
});