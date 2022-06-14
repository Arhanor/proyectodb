<?php

    $conexion = pg_connect("host=localhost dbname=pizzeria user=postgres password=123456789");
    if(!$conexion){
        echo 'Error: No se pudo conectar a la base de datos';
        exit();
    }
    
?>