$("#ingAnticipoPedido").prop("readonly", true);
$("#ingPagoCompleto").prop("checked", true);

$(document).on("change", "#ingPagoCompleto", function () {
    if ($(this).is(":checked")) {
        $("#ingAnticipoPedido").prop("readonly", true);
        $("#ingAnticipoPedido").val("");
    } else {
        $("#ingAnticipoPedido").prop("readonly", false);
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
});

$(document).on("keyup", "#ingTelfCliente", function () {
    var expresion = /^55+[0-9]{0,8}$/;

    if ($(this).val().match(expresion)) {
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
            if ($(this).val().length >= 2 && $(this).val().substring(0, 2) != "55")
                $("#errorIngTelfCliente1").show();
            else
                $("#errorIngTelfCliente1").show();
                
            if ($(this).val().length < 10)
                $("#errorIngTelfCliente2").show();

            $(this).removeClass("is-info is-valid");
            $(this).addClass("is-invalid");
        }else{
            $("#errorIngTelfCliente1").hide();
            $("#errorIngTelfCliente2").hide();
        }

    }
});