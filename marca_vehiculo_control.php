<?php
require './config/database.php';
session_start();

$sql = "SELECT sp_marcavehiculo(".$_REQUEST['accion'].","
        .$_REQUEST['vmar_cod'].",'".$_REQUEST['vmar_nom']."') as marcavehiculo;";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['marcavehiculo']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['marcavehiculo']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        

