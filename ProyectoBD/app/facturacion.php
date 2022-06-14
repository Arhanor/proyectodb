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

    $sql="select id_producto, nombre, detalles, stock, precio from proyecto2.producto";

    $result = pg_query($conexion, $sql);
    if(!$result){
        echo 'Error';
        exit;
    }

    $productos ='';

    
    while($data = pg_fetch_object($result)){
       $productos .= '
       <div class="card tarjetas" style="width: 18rem; margin:10px;">
            <div class="card-body">
                <h5 class="card-title">'.$data->nombre.'</h5>
                <p class="card-text">'.$data->detalles.'</p>
                
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item" style="background-color: unset;">Stock: '.$data->stock.' <br> Precio: '.$data->precio.'</li>
                
            </ul>';
        $productos .= ($data->stock) ? '
            <a href="#" class="btn btn-dark" onclick="agregarItem('.$data->id_producto.')" style="background-color:#4d4975;">Agregar al carrito</a>
        ' : '';
        $productos .= '
        </div>
       ';

    }

    include 'head.php';
    $html = file_get_contents('facturacion.html');

    echo str_replace([
        '%producto%',
        '%titulo%'
    ],[
        $productos, 
        'Hola'
    ],$html);
    include 'foot.html';

    ?>

    
</body>

</html>