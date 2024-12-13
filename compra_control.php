<?php
require './config/database.php';
session_start();
$cod = "select coalesce(max(cod_compra),0)+1 as vdetcompra from compra ";
$res = consultas::get_datos($cod);
$orden = ($_REQUEST['vorden'])? $_REQUEST['vorden'] : 0 ;
$pedido = ($_REQUEST['vped'])? $_REQUEST['vped'] : 0 ;
$intervalo = ($_REQUEST['vinter'])? $_REQUEST['vinter'] : 1 ;


$sql = "SELECT sp_compra(".$_REQUEST['accion'].","
        .$_REQUEST['vcompra'].","
        .$_REQUEST['vusuario'].","
        .$_REQUEST['vprov'].","
        .$orden.","
        .$_REQUEST['vtipo'].",'"
        .$_REQUEST['vfechasis']."','"
        .$_REQUEST['vfechafact']."','"
        .$_REQUEST['vfact']."',"
        .$_REQUEST['vtim'].",'"
        .$_REQUEST['vfin']."','"
        .$_REQUEST['vcondicion']."',"
        .$_REQUEST['vcuota'].","
        .$intervalo.","
        .$pedido.","
        .$_REQUEST['vtotal'].",'"
        .$_REQUEST['vestad']."') as compra";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['compra']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['compra']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vdetcompra='.$res[0]['vdetcompra'].'&vorden='.$_REQUEST['vorden'].'&vped='.$_REQUEST['vped']);
}
?>
        

