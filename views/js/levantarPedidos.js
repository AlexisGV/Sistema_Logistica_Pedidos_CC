/*=============================================
ELIMINAR PRODUCTO DEL PEDIDO
=============================================*/
$(document).on("click", ".btnQuitarProductoPedido", function(){

    swal({
        title: "Quitar producto",
        text: "¿Estas seguro de que quieres remover este producto?",
        icon: "warning",
        buttons: {
            cancel: {
                text: "Cancelar",
                value: null,
                visible: true,
                className: "bg-danger",
            },
            confirm: {
                text: "Confirmar",
                value: true,
                visible: true,
                className: "bg-primary",
            }
        },
    }).then((result) => {
        if (result) {
            $(this).parent().parent().parent().parent().parent().parent().remove();
            contadorProductos--;

            if ( $("#contenedorProductosKit").html() != "" && $("#contenedorProductosKit").html() != null ){
                sumaTotalCostos();
                listarProductos();
            } else {
                $("#ingSubtotalPedido").val("");
                $("#ingIVAPedido").val("");
                $("#ingTotalPedido").val("");
            }

        }
    });
});

/*=============================================
MODIFICAR CANTIDAD DEL PRODUCTO
=============================================*/
$(document).on("change", ".nuevaCantidadProducto", function (){
    var precio = $(this).parent().parent().parent().children(".ingresoPrecioProducto").children().children().children(".nuevoPrecioProducto");

    var precioFinal = $(this).val() * precio.attr("precioUnitario");

    precio.val(precioFinal);
    $(".nuevoPrecioProducto").number(true, 2);
    sumaTotalCostos();
    listarProductos();
});

/*=============================================
SUMAR TOTALES PARA OBTENER VALOR DEL PEDIDO
=============================================*/
function sumaTotalCostos() {

    var precioItem = $(".nuevoPrecioProducto"),
        arraySumaCostos = [];

    for (var i = 0; i < precioItem.length; i++) {

        arraySumaCostos.push(Number($(precioItem[i]).val()));

    }

    function sumarArrayCostos(total, numero) {
        return total + numero;
    }

    var sumaTotalCostos = arraySumaCostos.reduce(sumarArrayCostos),
        IVA = 0,
        total = 0;

    if ( $("#ingIVAPedido").val() != null && $("#ingIVAPedido").val() != "" )
        IVA = $("#ingIVAPedido").val();
    
    total = sumaTotalCostos + ( (sumaTotalCostos * IVA) / 100);

    $("#ingSubtotalPedido").val(sumaTotalCostos).number(true, 2);
    $("#ingTotalPedido").val(total).number(true, 2);
    // console.log("sumaTotalCostos", sumaTotalCostos);

}

/*=============================================
CALCULAR IVA
=============================================*/
$(document).on("change", "#ingIVAPedido", function () {
    if ( $("#ingSubtotalPedido").val() != "" && $("#ingSubtotalPedido").val() != null ) {
        sumaTotalCostos();
        listarProductos();
    }
});

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/
function listarProductos() {
    
    var listaProductos = [];
    var informacionPedido = [];

    // Número de pedido
    var idPedido = $("#ingFolioPedido").val();

    // Datos del cliente
    var nomCliente = $("#ingNombreCliente").val();
    var correoCliente = $("#ingEmailCliente").val();
    var telefonoCliente = $("#ingTelfCliente").val();

    // Detalles del producto
    var descripcion = $(".nuevaDescripcionProducto");
    var cantidad = $(".nuevaCantidadProducto");
    var importe = $(".nuevoPrecioProducto");

    // Totales
    var subtotal = $("#ingSubtotalPedido").val();
    var iva = $("#ingIVAPedido").val();
    var total = $("#ingTotalPedido").val();

    // Anticipo
    if ($("#ingPagoCompleto").is(":checked")) {
        var anticipo = $("#ingTotalPedido").val();
    } else {
        var anticipo = $("#ingAnticipoPedido").val();
    }

    // ALMACENANDO DATOS DEL PRODUCTO CON JSON
    for ( var i = 0; i < descripcion.length; i++){
        
        listaProductos.push({
            "idPedido": idPedido,
            "descripcion": $(descripcion[i]).val(),
            "precio": $(importe[i]).attr("precioUnitario"),
            "cantidad": $(cantidad[i]).val(),
            "descuento": $(importe[i]).attr("descuento"),
            "importe": $(importe[i]).val()
        });
    
    }

    // ALMACENANDO INFORMACION DEL PEDIDO CON JSON
    informacionPedido.push({
        "idPedido": idPedido,
        "nomCliente": nomCliente,
        "correoCliente": correoCliente,
        "telefonoCliente": telefonoCliente,
        "subtotal": subtotal,
        "iva": iva,
        "total": total,
        "anticipo": anticipo
    });
    
    console.log("listaProductos", listaProductos);
    console.log("informacionPedido", informacionPedido);

}