<?php
session_start();

require './config/database.php';

    $tiposervis = consultas::get_datos("select * from v_tipo_servicios_descuentopromos where ESTADODESCU <> 'INACTIVO' and cod_ser = " . $_REQUEST['vservi'] . "");
?>
<span class="col-md-1"></span>
<div class="form-group">
<div class="col-md-12" >
    <label class="col-md-0 control-label"><h3>TOTAL</h3></label>
    <input type="number" required="" readonly="" name="vprec"
           id="total"
     
  placeholder="Ingrese Precio"
           class="form-control"  value="<?= $tiposervis[0]['sumaretadescuentopromo'] ?>">
</div>
</div>

     <div class="form-group">
<div class="col-md-12" >
    <label class="col-md-0 control-label"><h3>DESCUENTO</h3></label>
    <input type="number" required="" readonly="" 

           placeholder="Ingrese Precio"
           class="form-control" name="vmonto"  value="<?= $tiposervis[0]['total_descuento'] ?>">
</div>
          
</div>
<!--<div class="form-group">
<div class="col-md-12" >
    <label class="col-md-0 control-label"><h3>TOTAL/PROMOCION</h3></label>
    <input type="number" required="" readonly="" name="vprec"

           placeholder="Ingrese Precio"
           class="form-control"  value="<?= $tiposervis[0]['total_descuento_calculado'] ?>">
</div>
</div>-->

<div class="form-group">
<div class="col-md-12" >
    
    <input type="hidden" required="" readonly="" 
           id="totaloculto"
           placeholder="Ingrese Precio"
           class="form-control"  value="<?= $tiposervis[0]['sumaretadescuentopromo'] ?>">
</div>
</div>
