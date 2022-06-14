<?php

include '../conexion.php';
require '../validarSesion.php';

$action = $_GET['action'];

switch ($action) {
    case 'agregar-item':

        echo agregarItem();

        break;

    case 'consultar-carrito':

        echo consultarCarrito();

        break;

    case 'eliminar-item':

        echo eliminarItem();

        break;

    case 'actualizar-cantidad':

        echo actualizarCantidad();

        break;

    case 'generar-factura':

        echo generarFactura();

        break;
}

function agregarItem()
{

    global $conexion;

    $id_producto = $_POST['id_producto'];
    $id_empleado = $_SESSION['id_empleado'];
    $cantidad = $_POST['cantidad'];

    $sql = "insert into proyecto2.carrito values(default, $id_producto, $id_empleado, $cantidad)";

    $result = pg_query($conexion, $sql);
    if (!$result) {
        return 'false';
    }
    return 'true';
}

function consultarCarrito()
{

    global $conexion;

    $sql = "select c.id_carrito, c.cantidad, p.nombre, p.precio from proyecto2.carrito c inner join proyecto2.producto p on c.id_producto=p.id_producto where c.id_empleado=" . $_SESSION['id_empleado'];

    $result = pg_query($conexion, $sql);
    if (!$result) {
        return '<tr>
                    <td colspan="5">Error: consultando en base de datos</td>
                </tr>';
    }
    if (pg_num_rows($result)) {
        $data = '';

        $cont=1;
        $total=0;

        while ($row = pg_fetch_object($result)) {
            
            $data .= '
            <tr>
                <th scope="row">'.$cont.'</th>
                <td>'.$row->nombre.'</td>
                <td>'.$row->precio.'</td>
                <td><input value="'.$row->cantidad.'" type="number" min="1" style="width: 50px;" onchange="actualizarCantidad('.$row->id_carrito.',this)"></td>
                <td>'.($row->cantidad*$row->precio).'</td>
                <td><button type="button" class="btn btn-dark" onclick="eliminarItem('.$row->id_carrito.')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                </td>
            </tr>
            ';
            $cont++;
            $total+=($row->cantidad*$row->precio);
        }
            $data .='
            <tr>
                <th colspan="4">Total: </th>
                <th>'.$total.'</th>
            </tr>
            ';
        return $data;
    }else{
        return '<tr>
                    <td colspan="5">No se ha agregado ningun producto</td>
                </tr>';
    }
}

function eliminarItem(){

    global $conexion;

    $id_carrito=$_POST['id_carrito'];

    $sql = "delete from proyecto2.carrito where id_carrito=".$id_carrito;

    $result=pg_query($conexion, $sql);
    if(!$result){
        return 'false';
    }
    return 'true';

}

function actualizarCantidad(){

    global $conexion;

    $id_carrito=$_POST['id_carrito'];
    $cant=$_POST['cant'];

    $sql="update proyecto2.carrito set cantidad=".$cant." where id_carrito=".$id_carrito;

    $result = pg_query($conexion,$sql);
    if(!$result){
        return 'false';
    }
    return 'true';


}

function generarFactura(){

    global $conexion;

    $id_empleado=$_SESSION['id_empleado'];

    $carrito = "select id_carrito, id_producto, cantidad from proyecto2.carrito where id_empleado=".$id_empleado;

    $resultc = pg_query($conexion,$carrito);

    if(pg_numrows($resultc)){
        
        $sql="insert into proyecto2.factura values(DEFAULT,'".$_POST['cod']."','".date('Y-m-d')."','".$id_empleado."','') RETURNING id_factura";

        $result = pg_query($conexion,$sql);



        $id_factura = pg_fetch_object($result);

        while($data=pg_fetch_object($resultc)){
                
            $sql="insert into proyecto2.detalle_pedido values(DEFAULT,'".$id_factura->id_factura."','".$data->id_producto."','".$data->cantidad."')";
            $result=pg_query($conexion,$sql);

            $sql = "update proyecto2.producto set stock = (stock - ".$data->cantidad.") where id_producto = '".$data->id_producto."'";
            $result= pg_query($conexion,$sql);
        }

        $sql="delete from proyecto2.carrito where id_empleado=".$id_empleado;
        $result=pg_query($conexion,$sql);

        return 'true';
        
    }
    return 'false';

    
}