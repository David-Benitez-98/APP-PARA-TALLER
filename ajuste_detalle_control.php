<?php
require './config/database.php';
session_start();

$sql = "SELECT sp_detalle_ajuste(".
        $_REQUEST['accion'].",".
        $_REQUEST['vdetcod'].",".
        $_REQUEST['varti'].",'".
        $_REQUEST['vajuste']."','".
        $_REQUEST['vajusdescrip']."',".
        $_REQUEST['vcant'].",".
        $_REQUEST['vsto'].") as detajuste";


$resultado = consultas::get_datos($sql);

if ($resultado[0]['detajuste']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['detajuste']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']."?vdetcod=".
            $_REQUEST['vdetcod']);
}
?>