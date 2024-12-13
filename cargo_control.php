<?php
require_once './config/database.php';
session_start();

$sql = "SELECT sp_cargo(".$_REQUEST['accion'].","
        .$_REQUEST['vcod_car'].",'".$_REQUEST['vcar_descrip']."') as cargo;";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['cargo']== null) {
    $_SESSION['mensaje'] = 'Error de proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['cargo']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>