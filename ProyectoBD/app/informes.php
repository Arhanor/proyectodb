<?php
require './validarSesion.php';
?>
<html lang="ES">

<head>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vista.css">
</head>

<body class="modulos">
    <?php

    include 'conexion.php';

    $sql = "
          select f.id_factura, f.cod_pedido, f.fecha, d.id_producto, d.cantidad, p.nombre, p.precio
          from proyecto2.factura as f inner join proyecto2.detalle_pedido as d on  f.id_factura = d.id_factura
          inner join proyecto2.producto as p on p.id_producto = d.id_producto
        ";

    $result = pg_query($conexion, $sql);

    if (!$result) {
        echo 'Error';
        exit;
    }

    $cont = 1;
    $facturas = '';

    while ($data = pg_fetch_object($result)) {
        $facturas .= '
                        <tr>
                            <th scope="row">' . $cont . '</th>
                            <td>' . $data->id_factura . '</td>
                            <td>' . $data->cod_pedido . '</td>
                            <td>' . $data->nombre . '</td>
                            <td>' . $data->cantidad . '</td>
                            <td>' . ($data->precio * $data->cantidad) . '</td>
                        </tr>
        ';
        $cont++;
    }

    if (!empty($_POST)) {

        $fcha_fin = $_POST['fcha_fin'];
        $fcha_inicio = $_POST['fcha_inicio'];
        $cod = $_POST['cod'];


        if (!empty($fcha_inicio and $fcha_fin)) {
            $sql = "
          select f.id_factura, f.cod_pedido, f.fecha, d.id_producto, d.cantidad, p.nombre, p.precio
          from proyecto2.factura as f inner join proyecto2.detalle_pedido as d on  f.id_factura = d.id_factura
          inner join proyecto2.producto as p on p.id_producto = d.id_producto
          where f.fecha between '" . $fcha_inicio . "' and '" . $fcha_fin . "'";

            $result = pg_query($conexion, $sql);

            if (!$result) {
                echo 'Error';
                exit;
            }

            $cont = 1;
            $facturas = '';

            while ($data = pg_fetch_object($result)) {
                $facturas .= '
                        <tr>
                            <th scope="row">' . $cont . '</th>
                            <td>' . $data->id_factura . '</td>
                            <td>' . $data->cod_pedido . '</td>
                            <td>' . $data->nombre . '</td>
                            <td>' . $data->cantidad . '</td>
                            <td>' . ($data->precio * $data->cantidad) . '</td>
                        </tr>
        ';
                $cont++;
            }
        }else if (!empty($fcha_inicio)) {
            $sql = "
          select f.id_factura, f.cod_pedido, f.fecha, d.id_producto, d.cantidad, p.nombre, p.precio
          from proyecto2.factura as f inner join proyecto2.detalle_pedido as d on  f.id_factura = d.id_factura
          inner join proyecto2.producto as p on p.id_producto = d.id_producto
          where f.fecha = '" . $fcha_inicio . "'";

            $result = pg_query($conexion, $sql);

            if (!$result) {
                echo 'Error';
                exit;
            }

            $cont = 1;
            $facturas = '';

            while ($data = pg_fetch_object($result)) {
                $facturas .= '
                        <tr>
                            <th scope="row">' . $cont . '</th>
                            <td>' . $data->id_factura . '</td>
                            <td>' . $data->cod_pedido . '</td>
                            <td>' . $data->nombre . '</td>
                            <td>' . $data->cantidad . '</td>
                            <td>' . ($data->precio * $data->cantidad) . '</td>
                        </tr>
        ';
                $cont++;
            }
        }else if (!empty($cod)) {
            $sql = "
          select f.id_factura, f.cod_pedido, f.fecha, d.id_producto, d.cantidad, p.nombre, p.precio
          from proyecto2.factura as f inner join proyecto2.detalle_pedido as d on  f.id_factura = d.id_factura
          inner join proyecto2.producto as p on p.id_producto = d.id_producto
          where f.cod_pedido = '" .$cod. "'";

            $result = pg_query($conexion, $sql);

            if (!$result) {
                echo 'Error';
                exit;
            }

            $cont = 1;
            $facturas = '';

            while ($data = pg_fetch_object($result)) {
                $facturas .= '
                        <tr>
                            <th scope="row">' . $cont . '</th>
                            <td>' . $data->id_factura . '</td>
                            <td>' . $data->cod_pedido . '</td>
                            <td>' . $data->nombre . '</td>
                            <td>' . $data->cantidad . '</td>
                            <td>' . ($data->precio * $data->cantidad) . '</td>
                        </tr>
        ';
                $cont++;
            }
        }
    }
    include 'head.php';


    $html = file_get_contents('informes.html');

    echo str_replace([
        '%facturas%'
    ], [
        $facturas
    ], $html);

    include 'foot.html';
    ?>
</body>

</html>