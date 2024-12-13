<?php
require './config/database.php';
session_start();
$cod = "select coalesce(max(cod_nota_comp),0)+1 as vdetcred from nota_credi_comp ";
$res = consultas::get_datos($cod);
$desc = ($_REQUEST['vdesc'])? $_REQUEST['vdesc'] : 0 ;

//If ($_REQUEST['vdesc'] == 0){
//    $subt = !empty($_REQUEST['vtotal']) ? $_REQUEST['vtotal'] : 0 ;
//    
//}  else {
//   $subt = !empty($_REQUEST['subtotal_nota']) ? $_REQUEST['subtotal_nota'] :0 ; 
//}

$sql = "SELECT sp_notacredcompra(".
    intval($_REQUEST['accion']).",".
    floatval($_REQUEST['vcred']).",".
    "'".$_REQUEST['vfecha']."',".
    "'".pg_escape_string($_REQUEST['vmotiv'])."',".
    "'".pg_escape_string($_REQUEST['vdescrip'])."',".
    floatval($desc).",".
    "'".pg_escape_string($_REQUEST['vestado'])."',".
    floatval($_REQUEST['vtotal']).",".
    "'".$_REQUEST['vfechasis']."',".
    floatval($_REQUEST['vtimb']).",".
    "'".$_REQUEST['vvigen']."',".
    "'".$_REQUEST['vnrocredi']."',".
    floatval($_REQUEST['vtip']).",".
    floatval($_REQUEST['vprov']).",".
    floatval($_REQUEST['vcompr']).",".
    floatval($_REQUEST['vusu']).") as credito;";



    

$resultado = consultas::get_datos($sql);

//if ($_REQUEST['accion'] == 1){
//$sql_esta_comp = "update compras set compra_estado='CONFRIMADO/NOTA' where id_compra = ".$_REQUEST['vcompr'];
//$reul_estado = consultas::ejecutar_sql($sql_esta_comp);
//    
//}

if ($resultado[0]['credito']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['credito']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vdetcred='.$res[0]['vdetcred'].'&vcompr='.$_REQUEST['vcompr']);
            
}
?>
        

