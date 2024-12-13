

<?php
require './config/database.php';
session_start();

$sql = "SELECT sp_tipo_comprobante(".$_REQUEST['accion'].","
        .$_REQUEST['vtipocod'].",'".$_REQUEST['vdescrip']."') as tipocomprobante;";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['tipocomprobante']== null) {
    $_SESSION['mensaje'] = 'Error de proceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['tipocomprobante']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']);
}
?>
        