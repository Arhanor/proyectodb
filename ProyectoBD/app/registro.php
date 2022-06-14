<?php 
session_start();

if(!empty($_SESSION)){
    header("location:menu.php");
}
?>

<?php


    if(!empty($_POST)){

        if($_POST['contrasena']==$_POST['conContrasena']){
            
            include 'conexion.php';
            
            $sql="INSERT INTO proyecto2.empleado(id_empleado, nombres, apellidos, clave, email, direccion, fcha_ncto,sexo, documento,pais, departamento, ciudad)
            VALUES(DEFAULT,'".$_POST['nombres']."','".$_POST['apellidos']."','".$_POST['contrasena']."','".$_POST['email']."','".$_POST['direccion']."','".$_POST['fecha']."','".$_POST['sexo']."','".$_POST['documento']."','".$_POST['pais']."','".$_POST['dept']."','".$_POST['city']."')";


            $result = pg_query($conexion, $sql);
        }else{

        }

    }

?>

<html lang="ES">

<head>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vista.css">

</head>
<body class="formularios-i-r">

    <?php
    
    include 'registro.html';

    ?>
</body>

</html>