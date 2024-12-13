<?php

require './config/database.php';
session_start();

$sub = $_REQUEST['vprecio'] * $_REQUEST['vcant'];

if ($_REQUEST['vped']) {
    $arti = !empty($_REQUEST['articulooculto']) ? $_REQUEST['articulooculto'] : $_REQUEST['varti'];
} else if ($_REQUEST['vorden']) {
    $arti = !empty($_REQUEST['articuloocultoo']) ? $_REQUEST['articuloocultoo'] : $_REQUEST['varti'];
} else {
    $arti = $_REQUEST['varti'];
}

// Evitar problemas de sintaxis si $arti está vacío
// $arti = empty($arti) ? "NULL" : $arti;

$sql = "SELECT sp_det_comp(" . $_REQUEST['accion'] . "," . $_REQUEST['vdetcompra'] . "," . $arti . "," . $_REQUEST['vcant'] . "," . $_REQUEST['vprecio'] . "," . $sub . ",'" . $_REQUEST['vestado'] . "') as detcomp";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['detcomp'] == null) {
    $_SESSION['mensaje'] = 'Error de proceso ' . $sql;
    header('location:./' . $_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['detcomp'] . "_" . $_REQUEST['accion'];

    header('location:./' . $_REQUEST['pagina'] . "?vdetcompra=" .
            $_REQUEST['vdetcompra'] .
            "&vorden=" . $_REQUEST['vorden'] .
            "&vped=" . $_REQUEST['vped']);
}
?>
