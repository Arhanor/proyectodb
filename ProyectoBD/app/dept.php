<?php
     include "conexionPDO.php";
    $id=$_POST['pais_id'];

    

    $sql="SELECT dept_id, dept_nombre FROM proyecto2.departamento WHERE pais_pais_id=$id;";
    $result=$conexion->query($sql);;
    $arr = $result->fetchAll(PDO::FETCH_OBJ);;
    foreach($arr as $response){
        ?>
           <option value="<?php echo $response->dept_id ?>"><?php echo $response->dept_nombre?></option> 
        <?php
    }
    
?>