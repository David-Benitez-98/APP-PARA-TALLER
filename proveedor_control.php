<?php

require 'config/database.php';
session_start();
$sql = "SELECT sp_proveedor(" . $_REQUEST['accion'] . ","
        . $_REQUEST['vcodprov'] . ",'" .
        $_REQUEST['vruc'] . "','" .
        $_REQUEST['vprovnombre'] . "'," .
        $_REQUEST['vtelef'] . "," .
        $_REQUEST['vciu'] . "," .
        $_REQUEST['vdepar'] . ") as proveedor;";



$resultado = consultas::get_datos($sql);

if ($resultado[0]['proveedor'] == null) {
    $_SESSION['mensaje'] = 'Error de prceso ' + $sql;
    header('location:./' . $_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['proveedor'] . "_" . $_REQUEST['accion'];

    header('location:./' . $_REQUEST['pagina']);
}
?>