<?php
session_start();
require './config/database.php';

$stocks = consultas::get_datos("SELECT * FROM v_stock WHERE cod_arti = " . $_REQUEST['varti']);
?>

<?php if (!empty($stocks)){ ?>

<input type="number"  id="cantstock" 
       class="form-control" name="vsto"readonly=""
       placeholder="Cantidad del Articulo" 
       value="<?php echo $stocks[0]['cantidad'] ?>"
       >

<input type="hidden"  id="cantstock_prueba"
       value="<?php echo $stocks[0]['cantidad'] ?>"
       >
    <?php }else { ?>
<?php } ?>
