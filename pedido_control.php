<?php
require './config/database.php';
session_start();
$cod = "select coalesce(max(cod_pedido_com),0)+1 as vdetped from pedido_compra ";
$res = consultas::get_datos($cod);
$sql = "SELECT sp_pedido(".$_REQUEST['accion'].","
        .$_REQUEST['vpedido'].",'".$_REQUEST['vfecha']."','".
        $_REQUEST['vestado']."',".
        $_REQUEST['vusuario'].") as pedido";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['pedido']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['pedido']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vdetped='.$res[0]['vdetped']);
}
?>