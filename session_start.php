<?php

//reanudamos la sesion
//validamos si esque realmente el usuario tiene una pagina activa
session_start();

if($_SESSION['cod_usu']==null){
    $_SESSION['error']='Inicie Sesion';
    header('location:http;/localhost/mauro');
    exit();
    
}
?>