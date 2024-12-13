<?php
session_start();
require 'config/database.php';
$facturas = consultas::get_datos("select * from v_factura_cab "
        . " where cod_factura = " . $_REQUEST['vfactu']);
?>
<select class="form-control" name="vcli"
        id="cli"
        required="">
            <?php
            if (!empty($facturas)){
                foreach ($facturas as $factura){
                  ?>
    <option value="<?php echo $factura['id_cliente_2'];?>">
    <?php echo $factura['cliente']?></option>
    <?php 
                }
            }else{
                ?>
    <option>
        Debe insertar al menos un cliente </option>
           <?php };?>
            
</select>