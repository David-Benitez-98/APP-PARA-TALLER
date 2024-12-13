<?php
require_once './config/database.php';
session_start();

$sql = "SELECT sp_departamento(".$_REQUEST['accion'].","
        .$_REQUEST['vdep_cod'].",'".$_REQUEST['vdep_nom']."') as departamento;";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['departamento']== null) {
    $_SESSION['mensaje'] = 'Error de proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['departamento']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>