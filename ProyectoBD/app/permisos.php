<?php 
require './validarSesion.php'
?>
<html lang="ES">

<head>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vista.css">
</head>
<body class="modulos">

    <?php

    $id_empleado = '0';

    if(!empty($_POST)){

        include 'conexion.php';

        if(!empty($_POST['id_empleado'])){
            $id_empleado = $_POST['id_empleado'];
        }

        
        $sql="select id_empleado from proyecto2.empleado where id_empleado = ".$id_empleado." or documento = '".$_POST['documento']."'";
        
        $result=pg_query($conexion,$sql);
        $data = pg_fetch_object($result);


        if(empty($data->id_empleado)){
             var_dump('Usuario no existe');
             exit;
        }

        if(!empty($data->id_empleado)){

            $empleado = $data->id_empleado;


            if(!empty($_POST['menu'])){
                $sql="insert into proyecto2.permiso values (default, ".$empleado.",'MENU')";
                $result=pg_query($conexion,$sql);
            }if(!empty($_POST['productos'])){
                $sql="insert into proyecto2.permiso values (default, ".$empleado.",'PRODUCTOS')";
                $result=pg_query($conexion,$sql);
            }if(!empty($_POST['stock'])){
                $sql="insert into proyecto2.permiso values (default, ".$empleado.",'STOCK')";
                $result=pg_query($conexion,$sql);
            }if(!empty($_POST['facturacion'])){
                $sql="insert into proyecto2.permiso values (default, ".$empleado.",'FACTURACION')";
                                                           
                $result=pg_query($conexion,$sql);
            }if(!empty($_POST['informes'])){
                $sql="insert into proyecto2.permiso values (default, ".$empleado.",'INFORMES')";
                $result=pg_query($conexion,$sql);
            }if(!empty($_POST['permisos'])){
                $sql="insert into proyecto2.permiso values (default, ".$empleado.",'PERMISOS')";
                $result=pg_query($conexion,$sql);
            }
        }

 
    }

    include 'head.php';
    include 'permisos.html';
    include 'foot.html';
    ?>
</body>

</html>