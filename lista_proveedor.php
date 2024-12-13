<?php
session_start();

require './config/database.php';

$proveedors= consultas::get_datos("select * from v_ordencompra where cod_ord_compra = " . $_REQUEST['vorden']."order by cod_ord_compra ");
?>
<!--id="orden"-->
<select class="form-control"  required=""  >
     
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
            <option value="">Seleccione un proveedor</option>
<?php }; ?>
</select>
