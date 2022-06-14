<?php

    if(!empty($_POST)){
        $sql = "INSERT INTO usuarios (usuario, contrasenia) VALUES ('".$_POST['nombres']."', '".$_POST['contrasena']."')";
        echo $sql;
        var_dump($_FILES);
        $ruta = rand(0, 1000).'-'.$_FILES['imagen']['name'];
        copy($_FILES['imagen']['tmp_name'], $ruta);
        
        $sql = "INSERT INTO archivos (ruta, nombre, tamanio) VALUES ('$ruta', '".$_FILES['imagen']['name']."')";
        echo $sql;

    }
?>

<html lang="ES">

<head>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vista.css">

</head>
<body class="formularios-i-r">
    <img src="<?php echo $ruta ?>" />
    <?php
    
    include 'registro.html';

    ?>
</body>

</html>