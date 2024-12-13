<?php
require './config/database.php';
session_start();
$cod = "select coalesce(max(cod_nota_deb),0)+1 as vdetdebi from nota_debi_compra ";
$res = consultas::get_datos($cod);
$inte = ($_REQUEST['vinter'])? $_REQUEST['vinter'] : 0 ;
$tras = ($_REQUEST['vtras'])? $_REQUEST['vtras'] : 0 ;

//If ($_REQUEST['vdesc'] == 0){
//    $subt = !empty($_REQUEST['vtotal']) ? $_REQUEST['vtotal'] : 0 ;
//    
//}  else {
//   $subt = !empty($_REQUEST['subtotal_nota']) ? $_REQUEST['subtotal_nota'] :0 ; 
//}

$sql = "SELECT sp_notadebitocompra(".$_REQUEST['accion'].","
        .$_REQUEST['vdebi'].",".
        $_REQUEST['vusu'].",".
        $_REQUEST['vcompr'].",".
        $_REQUEST['vprov'].",".
        $_REQUEST['vtip'].",'".
        $_REQUEST['vfecha']."','".
        $_REQUEST['vfechasis']."','".
        $_REQUEST['vvigen']."',".
        $_REQUEST['vtimb'].",'".
        $_REQUEST['vmotiv']."','".
        $_REQUEST['vdescrip']."',".
        $inte.",".
        $tras.",'".
        $_REQUEST['vestado']."',".
        $_REQUEST['vtotal'].",'".
         $_REQUEST['vdebinro']."') as debito;";
        
        

$resultado = consultas::get_datos($sql);

//if ($_REQUEST['accion'] == 1){
//$sql_esta_comp = "update compras set compra_estado='CONFRIMADO/NOTA' where id_compra = ".$_REQUEST['vcompr'];
//$reul_estado = consultas::ejecutar_sql($sql_esta_comp);
//    
//}

if ($resultado[0]['debito']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['debito']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vdetdebi='.$res[0]['vdetdebi'].'&vcompr='.$_REQUEST['vcompr']);
            
}
?>
        

