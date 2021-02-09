$("#ingAnticipoPedido").prop("readonly", true);
$("#ingPagoCompleto").prop("checked", true);
$("#ingFechaCompromisoPersonalizada").prop("checked", true);

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

$(document).on("change", "#ingPagoCompleto", function () {
    if ($(this).is(":checked")) {
        $("#ingAnticipoPedido").removeClass("is-valid is-invalid");
        $("#ingAnticipoPedido").prop("readonly", true);
        $("#ingAnticipoPedido").val("");
    } else {
        $("#ingAnticipoPedido").prop("readonly", false);
    }

    listarProductos();
});

$(document).on("change", "#ingFechaCompromisoPersonalizada", function () {
    if ($(this).is(":checked")) {
        $("#ingFechaEstimada").removeClass("is-valid is-invalid");
        $("#ingFechaEstimada").prop("readonly", true);
        $("#ingFechaEstimada").val($("#ingFechaEstimadaHidden").val());
    } else {
        $("#ingFechaEstimada").prop("readonly", false);
        $("#ingFechaEstimada").val("");
    }
});

$(document).on("change keyup blur", "#ingFechaEstimada", function () {
    var expresion = /^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{4,4}$/;
    if (!$("#ingFechaCompromisoPersonalizada").is(":checked")) {
        if(validarExpresion($(this), expresion)){
            let fechaHOY = moment();
            let fechaPersonalizada = moment($(this).val(), "DD/MM/YYYY");

            if ( fechaPersonalizada < fechaHOY ) {
                $(this).removeClass("is-valid");
                $(this).addClass("is-invalid");
                $("#ingFechaEstimadaFormateada").val("");
            } else {
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");

                let fechaFormateada = fechaPersonalizada.format("YYYY-MM-DD 20:00:00");
                $("#ingFechaEstimadaFormateada").val(fechaFormateada);
                console.log($("#ingFechaEstimadaFormateada").val());
            }
        } else {
            $("#ingFechaEstimadaFormateada").val("");
        }
    } else {
        $("#ingFechaEstimadaFormateada").val("");
    }
});

$(document).on("keyup change", "#ingAnticipoPedido", function () {
    var expresion = /^[0-9]+$/,
        expresion3 = /^[0-9]+\.[0-9]{1,2}$/;

    if ( $("#ingTotalPedido").val() != "" && $("#ingTotalPedido").val() != null ) {

        if ($(this).val().match(expresion)) {
            if (Number($("#ingTotalPedido").val()) >= Number($(this).val())){
                $(this).removeClass("is-invalid");
                $("#erroringAnticipoMenorPedido").hide();
                validarExpresion($(this), expresion);
                listarProductos();
            }else{
                $(this).addClass("is-invalid");
                $("#erroringAnticipoMenorPedido").show();
            }
        } else {
    
            if (Number($("#ingTotalPedido").val()) >= Number($(this).val())){
                $(this).removeClass("is-invalid");
                $("#erroringAnticipoMenorPedido").hide();
                if (validarExpresion($(this), expresion3)) {
                    $("#erroringAnticipoPedido").hide();
                } else {
                    if ($(this).val() != "") $("#erroringAnticipoPedido").show();
                    else $("#erroringAnticipoPedido").hide();
                }
                listarProductos();
            }else{
                $(this).addClass("is-invalid");
                $("#erroringAnticipoMenorPedido").show();
            }
    
        }
        
    }


});

$(document).on("keyup", "#ingNombreCliente", function () {
    var expresion = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/;

    if ($(this).val().match(expresion)) {
        $("#erroringNombreCliente").hide();
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
    } else {
        if ($(this).val() != "") $("#erroringNombreCliente").show();
        else $("#erroringNombreCliente").hide();
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
    }
});

$(document).on("keyup", "#ingEmailCliente", function () {
    var expresion = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}$/;

    if ($(this).val() != null && $(this).val() != "") {
        if ($(this).val().match(expresion)) {
            $("#erroringEmailCliente").hide();
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        } else {
            if ($(this).val() != "") $("#erroringEmailCliente").show();
            else $("#erroringEmailCliente").hide();
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        }
    }else{
        $(this).removeClass("is-valid is-invalid");
        $("#erroringEmailCliente").hide();
    }

});

$(document).on("keyup", "#ingTelfCliente", function () {
    var expresion = /^55+[0-9]{0,8}$/;
    var expresion2 = /^56+[0-9]{0,8}$/;

    if ($(this).val().match(expresion) || $(this).val().match(expresion2)) {
        $(this).removeClass("is-invalid is-valid is-warning");

        if ($(this).val().length < 10) {
            $(this).addClass("is-info");
            $("#errorIngTelfCliente2").show();
        } else {
            $("#errorIngTelfCliente2").hide();
            $(this).addClass("is-valid");
        }

        $("#errorIngTelfCliente1").hide();
    } else {

        if ($(this).val() != "") {
            if ($(this).val().length >= 2 && ($(this).val().substring(0, 2) != "55" && $(this).val().substring(0, 2) != "56"))
                $("#errorIngTelfCliente1").show();
            else
                $("#errorIngTelfCliente1").show();

            if ($(this).val().length < 10)
                $("#errorIngTelfCliente2").show();

            $(this).removeClass("is-info is-valid");
            $(this).addClass("is-invalid");
        } else {
            $("#errorIngTelfCliente1").hide();
            $("#errorIngTelfCliente2").hide();
        }

    }
});

$(document).on("submit", "#formAddPedido", function (e) {

    var expNombre = /^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/,
        expCorreo = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}$/,
        expTelefono = /^55+[0-9]{8,8}$/,
        expTelefono2 = /^56+[0-9]{8,8}$/,
        expFecha = /^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{4,4}$/;

    if ($("#ingFechaCompromisoPersonalizada").is(":checked") == false) {
        if ( !validarExpresion($("#ingFechaEstimada"), expFecha) ) e.preventDefault();
    }

    if (!validarExpresion($("#ingNombreCliente"), expNombre)) e.preventDefault();

    if ( $("#ingEmailCliente").val() != "" && $("#ingEmailCliente").val() != null){
        if (!validarExpresion($("#ingEmailCliente"), expCorreo)) e.preventDefault();
    }
    
    if (!validarExpresion($("#ingTelfCliente"), expTelefono) && !validarExpresion($("#ingTelfCliente"), expTelefono2)) e.preventDefault();

    if ($("#ingPagoCompleto").is(":checked") == false) {
        var expresion = /^[0-9]+$/,
            expresion3 = /^[0-9]+\.[0-9]{1,2}$/;

        if ( $("#ingAnticipoPedido").val() != "" && $("#ingAnticipoPedido").val() != null){

            if ( $("#ingTotalPedido").val() != "" && $("#ingTotalPedido").val() != null ) {
                
                if ($("#ingAnticipoPedido").val().match(expresion)) {
                    if (Number($("#ingTotalPedido").val()) >= Number($("#ingAnticipoPedido").val())){
                        $("#ingAnticipoPedido").removeClass("is-invalid");
                        $("#erroringAnticipoMenorPedido").hide();
                        validarExpresion($("#ingAnticipoPedido"), expresion);
                    }else{
                        $("#ingAnticipoPedido").addClass("is-invalid");
                        $("#erroringAnticipoMenorPedido").show();
                        e.preventDefault();
                    }
                    
                } else {
        
                    if (Number($("#ingTotalPedido").val()) >= Number($("#ingAnticipoPedido").val())){
                        $("#ingAnticipoPedido").removeClass("is-invalid");
                        $("#erroringAnticipoMenorPedido").hide();
                        if (validarExpresion($("#ingAnticipoPedido"), expresion3)) {
                            $("#erroringAnticipoPedido").hide();
                        } else {
                            if ($("#ingAnticipoPedido").val() != "") {
                                $("#erroringAnticipoPedido").show();
                                e.preventDefault();
                            }
                            else $("#erroringAnticipoPedido").hide();
                        }
                    }else{
                        $("#ingAnticipoPedido").addClass("is-invalid");
                        $("#erroringAnticipoMenorPedido").show();
                        e.preventDefault();
                    }

        
                }

            }else{
                e.preventDefault();
            }

        }else{
            $("#ingAnticipoPedido").addClass("is-invalid");
            e.preventDefault();
        }

    }

    if ( $("#contenedorProductosKit").html() == "" || $("#contenedorProductosKit").html() == null ){
        swal({
            title: "Ningún producto en la lista",
            text: "Para poder levantar un pedido, debes agregar al menos un producto a la lista.",
            icon: "error",
        });
        e.preventDefault();
    }

});