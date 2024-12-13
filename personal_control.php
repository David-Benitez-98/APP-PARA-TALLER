<?php
require 'config/database.php';
session_start();

$sql = "SELECT sp_personal(".$_REQUEST['accion'].","
        .$_REQUEST['vcodper'].",".$_REQUEST['vpercargo'].",".
        $_REQUEST['vperperso'].") as personal;";
        
        

$resultado = consultas::get_datos($sql);

if ($resultado[0]['personal']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['personal']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
