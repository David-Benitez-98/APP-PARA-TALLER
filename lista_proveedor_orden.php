<?php
session_start();

require './config/database.php';

$proveedors= consultas::get_datos("select * from v_presucompra where cod_presu_com = " . $_REQUEST['vpresu']."order by cod_presu_com ");
?>

<select class="form-control"  required="" id="presupuesto" >
    <?php
    if (!empty($proveedors)) {
        foreach ($proveedors as $proveedor) {
            ?>
            <option value="<?php echo $proveedor['cod_provee'];?>">
                <?php echo $proveedor['cod_provee']."-".$proveedor['provee_nomb'];?></option>
            <?php
        }
    } else {
        ?>
      <option value="">seleccione un proveedor</option>
<?php }; ?>
</select>
