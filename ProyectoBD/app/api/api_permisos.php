<?php

include '../conexion.php';
require '../validarSesion.php';

$action = $_GET['action'];

switch ($action) {
    case 'eliminar-permisos':
        
        echo eliminarPermisos();
        break;
}

function eliminarPermisos(){

    global $conexion;

    if(!empty($_POST['id_empleado'])){
        $id_empleado = $_POST['id_empleado'];
        $sql="select id_empleado from proyecto2.empleado where id_empleado = ".$id_empleado;
    }
    if(!empty($_POST['documento'])){
        $id_empleado = $_POST['documento'];
        $sql="select id_empleado from proyecto2.empleado where documento = '$id_empleado'";
    }
    
    

    $result=pg_query($conexion,$sql);
    $data = pg_fetch_object($result);


    if(empty($data->id_empleado)){
         var_dump('Usuario no existe');
         return false;
    }

    $id_empleado=$data->id_empleado;
    
    $sql = "delete from proyecto2.permiso where id_empleado=$id_empleado";

    $result=pg_query($conexion, $sql);
    if(!$result){
        return 'false';
    }
    return 'true';
}

?>