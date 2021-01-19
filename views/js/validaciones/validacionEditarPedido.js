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
    let expresion = /^[0-9]+$/,
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

    if ( !validarExpresion($("#editCliente"), expNombre) ) {e.preventDefault();}
    if ( !validarExpresion($("#editTelefono"), expTelf) ) {e.preventDefault();}

    if ( $("#editCorreo").val() != "" && $("#editCorreo").val() != null ) {
        if ( !validarExpresion($("#editCorreo"), expEmail) ) {e.preventDefault();}
    }

});

/*=============================================
AGREGAR UN PRODUCTO A PEDIDO EXISTENTE
=============================================*/
$(document).on("click", "#addProductoToPedido", function(){
    var idPedido = $("#editIdPedido").val();

    $("#viewNumberPedido").html(idPedido);
    $("#idNumberPedidoAddProd").val(idPedido);
});

$(document).on("click", ".btnAñadirProductoPedido", function (e) {
    let expTit = /^[A-Za-z0-9ñÑáÁéÉíÍóÓúÚ,.\s]+$/,
        expOMOCObv = /^[A-Za-z0-9ñÑáÁéÉíÍóÓúÚ,.\s]+$/,
        expOFOA = /^[A-Za-zñÑáÁéÉíÍóÓúÚ,.\s]+$/,
        expInt = /^[0-9]+$/,
        expDec = /^[0-9]+\.[0-9]{2,2}$/;

    if (!validarExpresion($("#ingNomProducto"), expTit)) return false;

    // VALIDAR PRECIO INICIAL
    if ($("#ingPrecioInicial").val().match(expInt)) {
        validarExpresion($("#ingPrecioInicial"), expInt);
    } else {

        if (isNaN($("#ingPrecioInicial").val())) {
            $("#errorIngPrecioInicial").html("Ingrese un valor númerico");
            validarExpresion($("#ingPrecioInicial"), expDec);
            $("#errorIngPrecioInicial").show();
            return false;
        } else {
            $("#errorIngPrecioInicial").html("El valor debe tener 2 decimales.");
            if (validarExpresion($("#ingPrecioInicial"), expDec)) {
                $("#errorIngPrecioInicial").hide();
            } else {
                if ($("#ingPrecioInicial").val() != "") $("#errorIngPrecioInicial").show();
                else $("#errorIngPrecioInicial").hide();
                return false;
            }
        }
    }

    // VALIDAR CANTIDAD Y DESCUENTO
    if (!validarExpresion($("#ingCantidad"), expInt)) return false;
    if (!validarExpresion($("#ingDescuento"), expInt)) return false;

    // VALIDAR PRECIO FINAL
    if ($("#ingPrecioFinal").val().match(expInt)) {
        validarExpresion($("#ingPrecioFinal"), expInt);
    } else {

        if (isNaN($("#ingPrecioFinal").val())) {
            $("#errorIngPrecioFinal").html("Ingrese un valor númerico");
            validarExpresion($("#ingPrecioFinal"), expDec);
            $("#errorIngPrecioFinal").show();
            return false;
        } else {
            $("#errorIngPrecioInicial").html("El valor debe tener 2 decimales.");
            if (validarExpresion($("#ingPrecioFinal"), expDec)) {
                $("#errorIngPrecioFinal").hide();
            } else {
                if ($("#ingPrecioFinal").val() != "") $("#errorIngPrecioFinal").show();
                else $("#errorIngPrecioFinal").hide();
                return false;
            }
        }
    }

    /* VALIDACION PARA LA MARCA
    -------------------------------------------------- */
    if ($("#ingCheckOtraMarcaProd").is(":checked")) {
        if (!validarExpresion($("#ingOtraMarcaProd"), expOMOCObv)) return false;
    } else{
        if( $("#ingMarcaProducto").val() == null || $("#ingMarcaProducto").val() == "" ) {
            $("#errorIngMarcaProducto").show();
            return false;
        } else {
            $("#errorIngMarcaProducto").hide();
        }
    }

    /* VALIDACION PARA LA FORMA
    -------------------------------------------------- */
    if ($("#ingCheckOtraFormaProd").is(":checked")) {
        if (!validarExpresion($("#ingOtraFormaProd"), expOFOA)) return false;
    } else{
        if( $("#ingFormaProducto").val() == null || $("#ingFormaProducto").val() == "" ) {
            $("#errorIngFormaProducto").show();
            return false;   
        } else {
            $("#errorIngFormaProducto").hide();
        }
    }

    if ($("#ingCheckOtroCorteProd").is(":checked")) {
        if (!validarExpresion($("#ingOtroCorteProd"), expOMOCObv))
            return false;
    }

    if ($("#ingCheckOtroAcabadoProd").is(":checked")) {
        if (!validarExpresion($("#ingOtroAcabadoProd"), expOFOA))
            return false;
    }

    if ( ($("#ingCorteProducto").val() == null || $("#ingCorteProducto").val() == "") && $("#ingCheckOtroCorteProd").prop("checked") == false ){
        $("#errorNingunCorte").show();
        return false;
    }

    if ( ($("#ingAcabadoProducto").val() == null || $("#ingAcabadoProducto").val() == "") && $("#ingCheckOtroAcabadoProd").prop("checked") == false ){
        $("#errorNingunAcabado").show();
        return false;
    }

    // VALIDAR OBSERVACION
    if ($("#ingObvProducto").val() != "") {
        if (!validarExpresion($("#ingObvProducto"), expOMOCObv))
            return false;
    }
    
    $.ajax({
        url: "ajax/pedidos.ajax.php",
        type: "POST",
        data: $("#formAgregarProductoPedido").serialize(),
        dataType: "json",
        success: function (respuesta) {

            console.log(respuesta);

            // agregarProducto($("#contenedorProductosKit"), respuesta["descripcion"], respuesta["cantidad"], respuesta["precioInicial"], respuesta["descuento"], respuesta["precioFinal"]);
            // sumaTotalCostos();
            // listarProductos();
            // $(".closeModalProducto").trigger("click");

            // swal({
            //     title: "Producto añadido con éxito!",
            //     text: "El producto se agrego de forma correcta a la lista del pedido.",
            //     icon: "success",
            // });
        }
    });

    return false;

});