<?php
session_start();
require_once './config/database.php';
$recepciones = consultas::get_datos("select * from v_recepcion_2 "
        . " where cod_recep = " . $_REQUEST['vrecep']);
?>
<select class="form-control" name="vcli"
        id="cli"
        required="">
            <?php
            if (!empty($recepciones)){
                foreach ($recepciones as $recepcion){
                  ?>
    <option value="<?php echo $recepcion['id_cliente_2'];?>">
    <?php echo $recepcion['cliente']?></option>
    <?php 
                }
            }else{
                ?>
    <option>
        Debe insertar al menos un cliente </option>
           <?php };?>
            
</select>