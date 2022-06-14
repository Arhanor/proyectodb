<html lang="ES">

<head>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vista.css">
</head>
<body>
    <?php
        $html = file_get_contents('head.html');

        $html= str_replace ('%user%',$_SESSION['nombre'],$html);
        $html= str_replace ('%permiso%',$_SESSION['permisos'],$html);
        
         echo $html;
    ?>

    
</body>

</html>