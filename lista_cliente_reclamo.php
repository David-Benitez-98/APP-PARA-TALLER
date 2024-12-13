<?php
session_start();

require './config/database.php';

$cliente= consultas::get_datos("select * from v_servicios where cod_servicios = " . $_REQUEST['vfactura']."order by cod_servicios ");
?>

<select class="form-control"  required="" >
   
    <?php
    if (!empty($cliente)) {
        foreach ($cliente as $clientes) {
            ?>
            <option value="<?php echo $clientes['cod_cliente'];?>">
                <?php echo $clientes['persona'];?></option>
               

            <?php
        }
    } else {
        ?>
          
<?php }; ?>
</select>
