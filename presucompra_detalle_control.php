<?php
require './config/database.php';
session_start();
$sub = $_REQUEST['vprecio']*$_REQUEST['vcant'] ;
$sql = "SELECT sp_detpresu_comp(".$_REQUEST['accion'].","
        .$_REQUEST['vdetpresu'].",".$_REQUEST['varti'].","
        .$_REQUEST['vprecio'].",".$_REQUEST['vcant'].",".
        $sub.",'".$_REQUEST['vestado']."') as detpresucompr";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['detpresucompr']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['detpresucompr']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']."?vdetpresu=".
            $_REQUEST['vdetpresu'].
            "&vped=".$_REQUEST['vped']);
}
?>
        
    