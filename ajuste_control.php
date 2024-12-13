<?php

require './config/database.php';
session_start();
$cod = "select coalesce(max(cod_ajuste_stock),0)+1 as vdetcod from ajuste_stock ";
$res = consultas::get_datos($cod);

$sql = "SELECT sp_ajuste(" . $_REQUEST['accion'] .
        "," . $_REQUEST['vcod'] .
        "," . $_REQUEST['vusu'] .
        ",'" . $_REQUEST['vfecha'] .
        "','" . $_REQUEST['vestado'] . "') as ajuste;";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['ajuste'] == null) {
    $_SESSION['mensaje'] = 'Error de prceso ' + $sql;
    header('location:./' . $_REQUEST['pagina']);
} else {
    $_SESSION['mensaje'] = $resultado[0]['ajuste'] . "_" . $_REQUEST['accion'];

    header('location:./' . $_REQUEST['pagina'].'?vdetcod='.$res[0]['vdetcod']);
}
?>
        

