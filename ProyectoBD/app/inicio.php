
<?php 
session_start();

if(!empty($_SESSION)){
    header("location:menu.php");
}
?>

<html lang="ES">

<head>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vista.css">
    
</head>
<body class="formularios-i-r">

    <?php
    
    include 'inicio.html';

    ?>
</body>

</html>

<?php

    if(!empty($_POST)){

        
        
        $usuario=$_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        include 'conexion.php';

        $sql = "select id_empleado, email, nombres from proyecto2.empleado where email='$usuario' and clave='$contrasena'";

        
        $result = pg_query($conexion, $sql);
        
        $filas = pg_num_rows($result);
        
        
        
        if($filas){
            $dato = pg_fetch_object($result);
            include 'conexionPDO.php';
            $sql = "select * from proyecto2.permiso as p INNER JOIN proyecto2.modulo as m on p.nombre = m.nombre where p.id_empleado =$dato->id_empleado ";
            $resultp=$conexion->query($sql);
            $resultPermiso = $resultp->fetchAll(PDO::FETCH_OBJ);
            
            //die(print_r(($resultPermiso)));
            ob_start();
            foreach($resultPermiso as $permiso)
            {
                ?>
                <a class="dropdown-item" href="<?php echo $permiso->url?>"><?php echo $permiso->nombre?></a>
                <?php
            }
            $html=ob_get_clean();
            $_SESSION['permisos']=$html;

            $_SESSION['nombre']=$dato->nombres;
            $_SESSION['user']=$usuario;
            $_SESSION['id_empleado']=$dato->id_empleado;

            header("location:menu.php");
            die();
        }else{
            
            echo "<script language='javascript'>alert('Las contraseñas no coinciden'); </script>";
            session_destroy();
        }

        pg_close($conexion);
    }
?>