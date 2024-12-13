<?php
require 'config/database.php';//llamar a la conexion

$sql= "select * from v_usuarios where usu_nick= '".
        $_REQUEST['usu_nick']."'"
        .   " and usu_clave=md5('".$_REQUEST['pass']."')";
        //realiza el recorrido de consulta
        $resultado = consultas::get_datos($sql);
        //reanuda una session o pregunta si existe una session activa
        session_start();
        //compara el resultado de la consulta

        //verifica si la consulta esta o no vacia
        if($resultado[0]['usu_nick']==NULL){
            //si esta vacio imprime error y es asignada a una variable 
            //$_session['error']
            $_SESSION['error']='Usuario o contraseña incorrectos';
            header('location:index.php');
            
            
        }else{
            //recupera la variable en variables de session al
            //momento de ingresar
            $_SESSION['cod_usu'] = $resultado[0]['cod_usu'];
            $_SESSION['usu_nick'] = $resultado[0]['usu_nick'];
            $_SESSION['cod_grupo'] = $resultado[0]['cod_grupo'];
            $_SESSION['contador'] = $resultado[0]['contador'];
            $_SESSION['grupo'] = $resultado[0]['gru_nomb'];
            $_SESSION['cod_suc'] = $resultado[0]['cod_suc'];
            $_SESSION['suc_descri'] = $resultado[0]['suc_descri'];
            


            header('location:menu.php');//direccionar al menu principal


        }
