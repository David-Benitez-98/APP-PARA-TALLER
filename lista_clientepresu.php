<?php
session_start();

require './config/database.php';

$clientes= consultas::get_datos("select * from v_presuservicio where cod_presu_ser = " . $_REQUEST['vpresu']."order by cod_presu_ser ");
?>

<select class="form-control"  required="" >
   
    <?php
    if (!empty($clientes)) {
        foreach ($clientes as $cliente) {
            ?>
            <option value="<?php echo $cliente['cod_cliente'];?>">
                <?php echo $cliente['persona'];?></option>
               

            <?php
        }
    } else {
        ?>
          
<?php }; ?>
</select>
