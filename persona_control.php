<?php
require './config/database.php';
session_start();
$telef = ($_REQUEST['vpertelef2'])? $_REQUEST['vpertelef2'] : 0 ;
$sql = "SELECT sp_persona(".$_REQUEST['accion'].","
        .$_REQUEST['vcodper'].",'".$_REQUEST['vpernomb']."','".
        $_REQUEST['vperapelli']."',".$_REQUEST['vperci'].",'".
        $_REQUEST['vpersexo']."','".$_REQUEST['vperfn']."','".
        $_REQUEST['vperdirec']."',".$_REQUEST['vpertelef'].",".
        $telef.",'".$_REQUEST['vperemail']."',".
        $_REQUEST['vperdepart'].",".$_REQUEST['vperciu'].") as persona;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['persona']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['persona']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
