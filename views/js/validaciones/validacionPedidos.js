$("#ingAnticipoPedido").prop("readonly", true);
$("#ingPagoCompleto").prop("checked", true);

// var serverDate = document.getElementById('serverDate').value; 

// var target_date = new Date(serverDate).getTime();

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
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
    } else {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
    }
});

$(document).on("keyup", "#ingTelfCliente", function () {
    var expresion = /^55+[0-9]{0,8}$/;

    if ($(this).val().match(expresion)) {
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
        $("#errorIngTelfCliente").hide();
    } else {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $("#errorIngTelfCliente").show();
    }
});