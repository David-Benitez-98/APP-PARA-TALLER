<?php
session_start();

require './config/database.php';

$costos = consultas::get_datos("select * from compra where cod_compra =" . $_REQUEST['vcompr']);
?>
<!--<select class="form-control"  required="" id="total" >
    <?php
    if (!empty($costos)) {
        foreach ($costos as $costo) {
            ?>
            <option value="<?php echo $costo['total_comp'];?>">
                <?php echo $costo['total_comp'];?></option>
            <?php
        }
    } else {
        ?>
            <option >CARGUE UNA COMPRA</option>
<?php }; ?>
</select>-->
                <span class="col-md-3"></span>
<div class="col-md-8" >
    <label class="col-md-6 control-label"><h3>TOTAL</h3></label>
    <input type="number" required="" readonly=""
           class="form-control"  id="total" value="<?= $costos[0]['total_comp'] ?>">
</di