<?php
session_start();

require './config/database.php';

$tiposervi = consultas::get_datos("select * from v_tipo_servicios_promo where ESTADO <> 'INACTIVO' and   cod_ser = " . $_REQUEST['vservi'] . " ");
?>


<span class="col-md-1"></span>
<div class="form-group">
    <div class="col-md-12" >
        <label class="col-md-0 control-label"><h3>PRECIO/SERVI</h3></label>
        <input type="number" required="" readonly="" 
               placeholder="Ingrese Precio"
               class="form-control"  value="<?= $tiposervi[0]['precio_servi'] ?>">
    </div>

</div>
<div class="form-group">
    <div class="col-md-12" >
        <label class="col-md-0 control-label"><h3>PROMOCION</h3></label>
        <input type="number" required="" readonly="" 
               placeholder="Ingrese Precio"
               class="form-control"   value="<?= $tiposervi[0]['total_promo_descactualizado'] ?>">
    </div>

</div>
<!--<div class="form-group">
<div class="col-md-12" >
    <label class="col-md-0 control-label"><h3>TOTAL/DESCUENTO</h3></label>
    <input type="number" required="" readonly="" name="vprec"

           placeholder="Ingrese Precio"
           class="form-control"  value="<?= $tiposervi[0]['promocion_desc'] ?>">
</div>
</div>-->



