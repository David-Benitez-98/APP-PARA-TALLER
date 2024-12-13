<?php
session_start();

require './config/database.php';

$cliente= consultas::get_datos("select * from v_diagnostico where cod_diag = " . $_REQUEST['vdiagnostico']."order by cod_diag ");
?>

<select class="form-control"  required="" >
   
    <?php
    if (!empty($cliente)) {
        foreach ($cliente as $clientes) {
            ?>
            <option value="<?php echo $clientes['cod_vehi'];?>">
                <?php echo $clientes['vehiculo'];?></option>
               

            <?php
        }
    } else {
        ?>
          
<?php }; ?>
</select>
