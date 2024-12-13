<?php
session_start();

require './config/database.php';
//
?>
<?php $proveedors = consultas::get_datos("select * from v_proveedor "); ?> 
<select class="form-control"  required=""  >
    <option value="">Seleccione un proveedor</option>
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
        <option value="">Debe insertar al menos un proveedor</option>
<?php }; ?>
</select>
