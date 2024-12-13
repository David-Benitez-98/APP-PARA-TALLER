<?php
require './config/database.php';
session_start();
$sub = $_REQUEST['vprecio']*$_REQUEST['vcant'] ;
$sql = "SELECT sp_detorden_comp(".$_REQUEST['accion'].","
        .$_REQUEST['vdetorden'].",".$_REQUEST['varti'].","
        .$_REQUEST['vcant'].",".$_REQUEST['vprecio'].",".
        $sub.",'".$_REQUEST['vestado']."') as detordencomp";

$resultado = consultas::get_datos($sql);

//$sql_esta = "update detalle_presupuesto_compra set detpresu_estado = 'ACTIVO' where id_articulo = " .$_REQUEST['varti']. " and id_presu = " .$_REQUEST['vpresu'];
//$resultado_esta = consultas::get_datos($sql_esta);

if ($resultado[0]['detordencomp']== null) {
    $_SESSION['mensaje'] = 'Error de prceso '+$sql;
    header ('location:./'.$_REQUEST['pagina']);
}else {
    $_SESSION['mensaje'] = $resultado[0]['detordencomp']."_".$_REQUEST['accion'];
    
    header('location:./'.$_REQUEST['pagina']."?vdetorden=".
            $_REQUEST['vdetorden'].
            "&vpresu=".$_REQUEST['vpresu'].
            "&vped=".$_REQUEST['vped']);
}

//if($resultado_esta[0] == null){
//        $_SESSION['mensaje'] = 'Error de Proceso'+$sql;
//        header('location:./'.$_REQUEST['pagina']);
//        
//    }else{
////        $_SESSION['mensaje'] = "COBRO ANULADO CON EXITO_".$_REQUEST['accion'];
//        header('location:./'.$_REQUEST['pagina']);
//        
//     
//    }
?>
        
    