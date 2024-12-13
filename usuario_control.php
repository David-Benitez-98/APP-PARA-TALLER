<?php

require './config/database.php';
session_start();


$sql = "SELECT sp_usuario(" . $_REQUEST['accion'] . ","
        . $_REQUEST['vcod'] . ",'" . $_REQUEST['vnick'] . "','" .
        $_REQUEST['vclave']. "'," . $_REQUEST['vgrup'] . ",'" . $_REQUEST['vestado'] ") as usuarios;";



$resultado = consultas::get_datos($sql);

if ($resultado[0]['usuarios'] == null) {
    $_SESSION['mensaje'] = 'Error de prceso ' + $sql;
    header('location:./' . $_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['usuarios'] . "_" . $_REQUEST['accion'];

    header('location:./' . $_REQUEST['pagina']);
}
?>
        
