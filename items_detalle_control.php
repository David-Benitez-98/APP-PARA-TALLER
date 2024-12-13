<?php
require './config/database.php';
session_start();

$sql = "SELECT sp_detalle_items(".
        $_REQUEST['accion'].",".
        $_REQUEST['vdetrecep'].",".
        $_REQUEST['varti'].",".
        $_REQUEST['vcant'].") as detajuste";


$resultado = consultas::get_datos($sql);

if ($resultado[0]['detajuste']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['detajuste']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']."?vdetrecep=".
            $_REQUEST['vdetrecep']);
}
?>