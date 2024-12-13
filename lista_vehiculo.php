<?php
session_start();
require './config/database.php';
$equipos = consultas::get_datos("select * from v_vehiculo_2 where datos_vehiculo like upper ('%". $_REQUEST['q']."%') or cod_vehiculo::varchar like upper ('%". $_REQUEST['q']."%')");


echo json_encode($equipos);
?>