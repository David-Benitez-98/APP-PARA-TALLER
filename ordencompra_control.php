<?php
require './config/database.php';
session_start();
$cod = "select coalesce(max(cod_ord_compra),0)+1 as vdetorden from orden_compra ";
$res = consultas::get_datos($cod);
$pedido = ($_REQUEST['vped'])? $_REQUEST['vped'] : 0 ;
$presu = ($_REQUEST['vpresu'])? $_REQUEST['vpresu'] : 0 ;

$sql = "SELECT sp_ordencompra(".$_REQUEST['accion'].","
        .$_REQUEST['vorden'].","
        .$_REQUEST['vusuario'].","
        .$pedido.","
        .$presu.","
        .$_REQUEST['vprov'].",'"
        .$_REQUEST['vfecha']."','"
        .$_REQUEST['vestad']."',"
        .$_REQUEST['vtotal'].") as ordencompra";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['ordencompra']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['ordencompra']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vdetorden='.$res[0]['vdetorden'].'&vped='.$_REQUEST['vped'].'&vpresu='.$_REQUEST['vpresu']);
}
?>
        

