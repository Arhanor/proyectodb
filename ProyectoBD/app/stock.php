<?php 
require './validarSesion.php';
?>
<html lang="ES">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Stock</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vista.css">
</head>
<body class="modulos">
    <?php

    include 'conexion.php';

    if(empty(!$_POST)){
        $sql="update proyecto2.producto set stock = ".$_POST['cantidad']." where id_producto = '".$_POST['id_producto']."'";
        $result=pg_query($conexion,$sql);

        if(!$result){
            echo 'error';
        }
    }

    include 'head.php';
    include 'stock.html';
    include 'foot.html';
    ?>
</body>

</html>