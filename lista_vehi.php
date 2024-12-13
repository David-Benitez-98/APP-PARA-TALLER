<?php
session_start();

require './config/database.php';

$clientes= consultas::get_datos("select * from v_recepcion where cod_recep = " . $_REQUEST['vdig']."order by cod_recep ");
?>

<select class="form-control"  required="" >
   
    <?php
    if (!empty($clientes)) {
        foreach ($clientes as $cliente) {
            ?>
            <option value="<?php echo $cliente['cod_vehi'];?>">
                <?php echo $cliente['vehiculo'];?></option>
               

            <?php
        }
    } else {
        ?>
          
<?php }; ?>
</select>
