<?php
session_start();

include_once 'config/database.php';

$stocks = consultas::get_datos("select * from v_stock_2 where cod_art = " . $_REQUEST['varti']." and cod_dep = " . $_REQUEST['vdepo']);
?>
    <?php if (!empty($stocks)) { ?>
<span class="col-md-3"></span>
<label class="col-md-2 control-label">Descripcion|Garantia:</label>
<input type="text" required="" placeholder="Descripcion Garantia"
           class="form-control" name="vdescri_garan" id="descri_g"
           value="<?php echo $stocks[0]['garantia_descri'] ?>"
           readonly="" >

    
    <?php }else {?>
     <option value="">El articulo no posee descripcion garantia</option>
    <?php } ?> 