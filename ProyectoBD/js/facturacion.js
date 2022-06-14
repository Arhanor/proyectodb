$(document).ready(function(){
    consultarCarrito();
});

function agregarItem(id_producto){

    $.ajax({
        method: "POST",
        url:"/ProyectoBD/app/api/api_facturacion.php?action=agregar-item",
        data: {
            id_producto, 
            cantidad: 1
        }
    }).done(function( msg ) {

        if(msg=='false'){
            alert('Error agregando al carrito');
        }
        consultarCarrito();
      });

}

function consultarCarrito(){

    $.ajax({
        method: "GET",
        url:"/ProyectoBD/app/api/api_facturacion.php?action=consultar-carrito",
    }).done(function( msg ) {
        $("#resultado_carrito").html(msg);
      });

}

function eliminarItem(id_carrito){

    $.ajax({
        method: "POST",
        url:"/ProyectoBD/app/api/api_facturacion.php?action=eliminar-item",
        data:{
            id_carrito
        }
    }).done(function( msg ){
        if(msg=='false'){
            alert('Error eliminando item');
        }
        consultarCarrito();
    })

}

function actualizarCantidad(id_carrito, input){


    $.ajax({
        method: "POST",
        url:"/ProyectoBD/app/api/api_facturacion.php?action=actualizar-cantidad",
        data:{
            id_carrito, 
            cant:$(input).val()
        }
    }).done(function(msg){
        if(msg=='false'){
            alert ('No se pudo modificar la cantidad')
        }
        consultarCarrito();
    })

}

function generarFactura(){

    let cod = document.getElementById('cod').value;

    $.ajax({
        method: "POST",
        url:"/ProyectoBD/app/api/api_facturacion.php?action=generar-factura",
        data:{
            cod
        }
    }).done(function(msg){
        if(msg=='false'){
            alert ('No se genero factura')
        }else{
            alert('Factura generada')
        }
        consultarCarrito();
    })

}