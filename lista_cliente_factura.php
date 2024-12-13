<?php
session_start();

require_once './config/database.php';

$clientes = consultas::get_datos("select * from v_presupuesto_servi where cod_presu_servi = " . $_REQUEST['vpresu'] . "order by cod_presu_servi ");
?>
<?php $clientes1 = consultas::get_datos("select * from v_presupuesto_servi"); ?>


<select class="form-control"  required="" id="detalles" name="vclie">
    <?php
    if (!empty($clientes)) {
        foreach ($clientes as $cliente) {
            ?>
            <option value="<?php echo $cliente['id_cliente_2']; ?>">
                <?php echo $cliente['id_cliente_2'] . " - " . $cliente['cliente']; ?></option>
            <?php
        }
    } else {
        ?>
        <option  value="">Seleccione un Cliente</option>
        <?php $clientes = consultas::get_datos("select * from v_clientes_2 "); ?> 
        <?php foreach ($clientes as $cliente) { ?>
            <option value="<?php echo $cliente['id_cliente_2']; ?>"><?php echo $cliente['cliente']; ?></option>
           
        <?php }; ?>
        <?php }; ?>
</select>