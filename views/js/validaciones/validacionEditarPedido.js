function validarExpresion(campo, expresion) {

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

$(document).on("change keyup blur", "#editCliente", function(){
    let expresion = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;
    validarExpresion($(this), expresion);
});

$(document).on("change keyup blur", "#editCorreo", function(){
    let expresion = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}$/;
    if ( $(this).val() != "" && $(this).val() != null ) {
        validarExpresion($(this), expresion);
    }
});

$(document).on("change keyup blur", "#editTelefono", function(){
    let expresion = /^5+[5-6]+[0-9]{8,8}$/;
    validarExpresion($(this), expresion);
});

$(document).on("keyup change", "#editAnticipo", function () {
    var expresion = /^[0-9]+$/,
        expresion3 = /^[0-9]+\.[0-9]{1,2}$/;

    if ( $("#editTotal").val() != "" && $("#editTotal").val() != null ) {

        if ($(this).val().match(expresion)) {
            if (Number($("#editTotal").val()) >= Number($(this).val())){
                $(this).removeClass("is-invalid");
                $("#errorEditAnticipoMenorPedido").hide();
                validarExpresion($(this), expresion);
                listarProductos();
            }else{
                $(this).addClass("is-invalid");
                $("#errorEditAnticipoMenorPedido").show();
            }
        } else {
    
            if (Number($("#editTotal").val()) >= Number($(this).val())){
                $(this).removeClass("is-invalid");
                $("#errorEditAnticipoMenorPedido").hide();
                if (validarExpresion($(this), expresion3)) {
                    $("#errorEditAnticipoPedido").hide();
                } else {
                    if ($(this).val() != "") $("#errorEditAnticipoPedido").show();
                    else $("#errorEditAnticipoPedido").hide();
                }
                listarProductos();
            }else{
                $(this).addClass("is-invalid");
                $("#errorEditAnticipoMenorPedido").show();
            }
    
        }
        
    }

});

$(document).on("submit", "#formEditPedido", function(e){
    let expNombre = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/,
        expEmail = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}$/,
        expTelf = /^5+[5-6]+[0-9]{8,8}$/;

    if ( !validarExpresion($("editCliente"), expNombre) ) {e.preventDefault();}
    if ( !validarExpresion($("#editTelefono"), expTelf) ) {e.preventDefault();}

    if ( $("#editCorreo").val() != "" && $("#editCorreo").val() != null ) {
        if ( !validarExpresion($("#editCorreo"), expEmail) ) {e.preventDefault();}
    }

});