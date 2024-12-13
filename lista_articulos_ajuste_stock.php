<?php
session_start();
require './config/database.php';
$stocks = consultas::get_datos("SELECT * FROM v_stock ");
?>
<select class="form-control" name="varti"
        id="artic" onchange="obtenercantidad()"
        onkeyup="obtenercantidad()"
        required="">
            <?php
            if (!empty($stocks)){
                foreach ($stocks as $stock){
                  ?>
    <option value="<?php echo $stock['cod_arti'];?>">
    <?php echo $stock['arti_descrip'];?>
   </option>
    <?php 
                }
            }else{
                ?>
    <option>
        Debe insertar al menos un articulo </option>
           <?php };?>
     
</select>




