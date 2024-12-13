<?php
require './config/database.php';
session_start();

$sql = "SELECT sp_detpedido(".$_REQUEST['accion'].","
        .$_REQUEST['vdetped'].",".$_REQUEST['varti'].",".
        $_REQUEST['vcant'].",'".$_REQUEST['vestado']."') as detpedido";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['detpedido']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['detpedido']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']."?vdetped=".
            $_REQUEST['vdetped']);
}
?>