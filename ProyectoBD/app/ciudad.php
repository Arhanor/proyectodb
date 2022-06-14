<?php
    
    include "conexionPDO.php";

    $id=$_POST['dept_id'];

    

    $sql="SELECT ciudad_id, ciudad_nombre FROM proyecto2.ciudad WHERE departamento_dept_id=$id;";
    $result=$conexion->query($sql);
    $arr = $result->fetchAll(PDO::FETCH_OBJ);
    foreach($arr as $response){
        ?>
           <option value="<?php echo $response->ciudad_id ?>"><?php echo $response->ciudad_nombre?></option> 
        <?php
    }
    
?>