<?php
require './config/database.php';
session_start();

$sql = "SELECT sp_cliente(".$_REQUEST['accion'].","
        .$_REQUEST['vcod'].",'".$_REQUEST['vpers']."') as cliente;";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['cliente']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['cliente']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        

