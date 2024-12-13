<?php
require './config/database.php';
session_start();
$cod = "select coalesce(max(cod_nota_remision),0)+1 as vdetremi from nota_remi_compra ";
$res = consultas::get_datos($cod);
$ci = ($_REQUEST['vci'])? $_REQUEST['vci'] : 0 ;
$tel = ($_REQUEST['vtel'])? $_REQUEST['vtel'] : 0 ;

If ($_REQUEST['vmotiv'] == 0){
$mot = !empty($_REQUEST['vmotiv'])? $_REQUEST['vmotiv'] :$_REQUEST['vmotivo'];
    
}  else {
   
}

$sql = "SELECT sp_notaremisioncompra(".$_REQUEST['accion'].","
        .$_REQUEST['vremi'].",".
        $_REQUEST['vcompr'].",".
        $_REQUEST['vusu'].",".
        $_REQUEST['vtip'].",'".
        $_REQUEST['vref']."','".
        $_REQUEST['vfecharemi']."','".
        $mot."','".
        $_REQUEST['vcond']."',".
        $ci.",".
        $tel.",'".
        $_REQUEST['vsali']."','".
        $_REQUEST['vllega']."','".
        $_REQUEST['vestado']."',".
        $_REQUEST['vmarc'].",".
        $_REQUEST['vprov'].",".
        $_REQUEST['vtimb'].",'".
        $_REQUEST['vvigen']."','".
        $_REQUEST['vfechasis']."','".
        $_REQUEST['vchap']."') as remision;";
        
        

$resultado = consultas::get_datos($sql);

//if ($_REQUEST['accion'] == 1){
//$sql_esta_comp = "update compras set compra_estado='CONFRIMADO/NOTA' where id_compra = ".$_REQUEST['vcompr'];
//$reul_estado = consultas::ejecutar_sql($sql_esta_comp);
//    
//}

if ($resultado[0]['remision']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['remision']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina'].'?vdetremi='.$res[0]['vdetremi'].'&vcompr='.$_REQUEST['vcompr']);
            
}
?>
        

