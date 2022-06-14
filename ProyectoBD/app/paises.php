<?php
    

    include "conexionPDO.php";

    $sql="SELECT pais_id, pais_nombre FROM proyecto2.pais;";
    $result=$conexion->query($sql);
    $arr = $result->fetchAll(PDO::FETCH_OBJ);
     foreach($arr as $response){
     ?>
        <option value="<?php echo $response->pais_id ?>"><?php echo $response->pais_nombre?></option> 
     <?php
     }
    
?>