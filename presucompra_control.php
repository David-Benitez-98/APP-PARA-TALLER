<?php
require './config/database.php';
session_start();
$cod = "select coalesce(max(cod_presu_com),0)+1 as vdetpresu from presupuesto_compra ";
$res = consultas::get_datos($cod);
$sql = "SELECT sp_presucompra(".$_REQUEST['accion'].","
        .$_REQUEST['vpresu'].",".
        $_REQUEST['vusuario'].",".$_REQUEST['vped'].",".
        $_REQUEST['vprov'].",'".$_REQUEST['vfecha']."','".$_REQUEST['vvigen']."','".
        $_REQUEST['vestado']."',".$_REQUEST['vtotal'].") as presupuesto";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['presupuesto']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['presupuesto']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vdetpresu='.$res[0]['vdetpresu'].'&vped='.$_REQUEST['vped']);
}
?>