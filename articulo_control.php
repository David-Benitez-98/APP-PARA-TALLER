<?php

require 'config/database.php';
session_start();
$sql = "SELECT sp_articulo(" . (int)$_REQUEST['accion'] . ",
        " . (int)$_REQUEST['vcodarti'] . ",
        '" . pg_escape_string($_REQUEST['descrip']) . "',
        '" . (int)$_REQUEST['precio'] . "',
        " . (int)$_REQUEST['vimpues'] . ") as articulo;";




$resultado = consultas::get_datos($sql);

if ($resultado[0]['articulo'] == null) {
    $_SESSION['mensaje'] = 'Error de prceso ' + $sql;
    header('location:./' . $_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['articulo'] . "_" . $_REQUEST['accion'];

    header('location:./' . $_REQUEST['pagina']);
}
?>