<?php
session_start();

require './config/database.php';

$proveedors= consultas::get_datos("select * from v_compras where cod_compra = " . $_REQUEST['vcompr']."order by cod_compra ");
?>

<select class="form-control"  required="" id="compra" name="vprov">
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
            <option value="">Seleccione un Proveedor </option>
<?php }; ?>
</select>
