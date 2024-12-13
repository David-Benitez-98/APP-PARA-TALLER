<!DOCTYPE html>
<html lang="en">
<head>
        <link rel="shortcut icon"  href=" images/mauro"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>PROMOCIONES</title>

        <?php
        require './session_start.php';
        require 'menu/css.ctp';
        ?>
    <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    </head>
<body>
<div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
      
                        <?php    $promociones = consultas::get_datos("select cod_promo from promocion where promo_fecha_fin < current_date and promo_estado <> 'ANULADO'"); ?>
<!--                        si ya vencio la promocion cambia el estado de la promo a inactiva -->
                        <?php  if (!empty($promociones)){ ?>
                                
                        <?php foreach ($promociones as $key => $value) {
                                 $sql= "update promocion set promo_estado = 'INACTIVO' where cod_promo =".$value['cod_promo']; 
                                 $res = consultas::get_datos($sql);
                             } ?>
                        
                        <?php }?>
                        
<!--                        pregunta si la fecha inicio ya empezo-->
                        
                         <?php    $promociones = consultas::get_datos("select cod_promo from promocion where promo_fecha_inicio = current_date and promo_estado <> 'ANULADO'"); ?>
                        
                        <?php  if (!empty($promociones)){ ?>
                                
                        <?php foreach ($promociones as $key => $value) {
                                 $sql= "update promocion set promo_estado = 'ACTIVO' where cod_promo =".$value['cod_promo'] ; 
                                 $res = consultas::get_datos($sql);
                             } ?>
                        
                        <?php }?>
                            

                       
                        <h3 class="page-header">LISTA DE PROMOCION 

                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar">
                                <i class="fa fa-plus"></i>
                            </a>                      
                        </h3>
                    </div>     
                    <!--Buscador-->
                    <div class="col-lg-12">
                        <div class="panel-heading">
                            <div class="input-group custom-search-form">
                                <input id="filtrar" type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" rel="tooltip" title="Buscar">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>                      
                    </div>
                </div>

                 <!-- /.row -->
                 <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Datos
                            </div>
                            <?php
                            $promociones = consultas::get_datos("select * from v_promocionn  order by cod_promo asc ");
                            if (!empty($promociones)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">USUARIO</th>                                                                            
                                                    <th class="text-center">FECHA</th>                                      
                                                    <th class="text-center">FECHA INICIO</th>                                      
                                                    <th class="text-center">FECHA FIN</th>                                      
                                                    <th class="text-center">PROMO NOMBRE</th>                                      
                                                    <th class="text-center">ESTADO</th>                                      
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($promociones as $promocione) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $promocione['cod_promo']; ?></td>
                                                        <td class="text-center"><?php echo $promocione['usu_nick']; ?></td>
                                                        <td class="text-center"><?php echo $promocione['promo_fecha']; ?></td>
                                                        <td class="text-center"><?php echo $promocione['promo_fecha_inicio']; ?></td>
                                                        <td class="text-center"><?php echo $promocione['promo_fecha_fin']; ?></td>
                                                        <td class="text-center"><?php echo $promocione['promo_descrip']; ?></td>
                                                        <td class="text-center"><?php echo $promocione['promo_estado']; ?></td>
                                                        <td class="text-center">
                                                            <a  
                                                                href="promocion_detalle.php?vdetpromo=<?php echo $promocione['cod_promo']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>


                                                            <a onclick="borrar(<?php
                                                            echo "'" . $promocione['cod_promo'] . "_" .
                                                            $promocione['cod_usu'] . "_" .
                                                            $promocione['promo_fecha_inicio'] . "_" .
                                                            $promocione['promo_fecha_fin'] . "_" .
                                                            $promocione['promo_descrip'] . "_" .
                                                            $promocione['promo_estado'] . "_" .
                                                            $promocione['promo_fecha'] . "'";
                                                            ?>)"
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Borrar"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-trash"></span></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>                         
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>No se encontraron registro....!</strong>
                                    </div>
                                <?php } ?>  
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <!-- /.panel -->

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!--registrar-->


                <div id="registrar" class="modal fade" role="dialog">
                    <div class=" modal-dialog modal-lg ">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR PROMOCIONES</strong></h4>
                            </div>
                            <?php $fecha = consultas::get_datos("select * from v_fecha"); ?>
                            <form action="promocion_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body ">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vpromo" value="0"/> 
                                    <input type="hidden" name="vusuario" 
                                           value="<?php echo $_SESSION['cod_usu']; ?>">
                        
                                    <input type="hidden" name="vestado" value="PENDIENTE">
                                    <input type="hidden" name="pagina" value="promocion_detalle.php">
                                    <span class=" col-md-1"></span>


                                    <div class="form-group">
                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>FECHA</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" name="vfecha" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                        <div class="col-md-4  " >
                                            <label  class="control-label col-md-3"><h3>FECHA/INICIO</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="fec"  onchange="validarfecha_inicio(), validarfecha_fin()" onkeyup="validarfecha_inicio(), validarfecha_fin()"
                                                   class="form-control"  name="vfechainicio" >
                                        </div>

                                    </div>
                                    <span class=" col-md-1"></span>

                              


                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>FECHA/FIN</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="fecha"  onchange="validarfecha_fin()" onkeyup="validarfecha_fin()" onkeydown="validarfecha_fin()"
                                                   class="form-control" name="vfechafin" >
                                        </div>
                                    </div>
                                    <br>
                                    <!--                                    <div class="form-group">
                                                                            <label class="col-md-2 control-label">NOMBRE PROMO:</label>
                                                                            <div class="col-xs-10 col-md-8">
                                                                                <textarea type="text" required=""
                                                                                          placeholder="Ingrese nombre de la promo"autocomplete="off" 
                                                                                          class="form-control" 
                                                                                          id="des"
                                                                                           name="vdescrip"
                                                                                          onchange="letraspromo()" 
                                                                                            onkeyup="letraspromo()"
                                                                                           rows="3"  pattern="[A-Za-z #SPACE]{4,30}" title="SOLO LETRAS !" autofocus=""></textarea>
                                                                            </div>
                                                                        </div>-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">PROMO:</label>
                                        <div class="col-md-5">
                                            <input type="text" required=""
                                                   placeholder="Ingrese nombre de la promo"  autocomplete="off"
                                                   class="form-control"
                                                   id="des"
                                                   name="vdescrip"
                                                   onchange="letraspromo()" 
                                                   onkeyup="letraspromo()"
                                                   pattern="[A-Za-z #SPACE]{4,30}" title="SOLO LETRAS !" autofocus="">
                                        </div>
                                    </div>

                                    <br>
                                    <br>



                                    <div class="modal-">
                                        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                            <i class="fa fa-close"></i> Cerrar</button>


                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-floppy-o"></i> Registrar</button>


                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!--fin-->

                <!--fin editar-->
                <!--borrar-->
                <div class="modal fade" id="delete" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title custom_align" id="Heading">Atenci&oacute;n!!!</h4>
                            </div>
                            <div class="modal-body">

                                <div class="alert alert-warning" id="confirmacion"></div>

                            </div>
                            <div class="modal-footer">
                                <a id="si" role="button" class="btn btn-primary" ><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                            </div>
                        </div>
                    </div>
                </div> 
                <!--fin-->
            </div> 
        </div> 

    <?php require 'menu/js.ctp'; ?>

    
</body>
</html><!DOCTYPE html>
<html lang="en">
<head>
        <link rel="shortcut icon"  href=" images/mauro"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>PROMOCIONES</title>

        <?php
        require './session_start.php';
        require 'menu/css.ctp';
        ?>
    <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    </head>
<body>
<div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
      
                        <?php    $promociones = consultas::get_datos("select cod_promo from promocion where promo_fecha_fin < current_date and promo_estado <> 'ANULADO'"); ?>
<!--                        si ya vencio la promocion cambia el estado de la promo a inactiva -->
                        <?php  if (!empty($promociones)){ ?>
                                
                        <?php foreach ($promociones as $key => $value) {
                                 $sql= "update promocion set promo_estado = 'INACTIVO' where cod_promo =".$value['cod_promo']; 
                                 $res = consultas::get_datos($sql);
                             } ?>
                        
                        <?php }?>
                        
<!--                        pregunta si la fecha inicio ya empezo-->
                        
                         <?php    $promociones = consultas::get_datos("select cod_promo from promocion where promo_fecha_inicio = current_date and promo_estado <> 'ANULADO'"); ?>
                        
                        <?php  if (!empty($promociones)){ ?>
                                
                        <?php foreach ($promociones as $key => $value) {
                                 $sql= "update promocion set promo_estado = 'ACTIVO' where cod_promo =".$value['cod_promo'] ; 
                                 $res = consultas::get_datos($sql);
                             } ?>
                        
                        <?php }?>
                            

                       
                        <h3 class="page-header">LISTA DE PROMOCION 

                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar">
                                <i class="fa fa-plus"></i>
                            </a>                      
                        </h3>
                    </div>     
                    <!--Buscador-->
                    <div class="col-lg-12">
                        <div class="panel-heading">
                            <div class="input-group custom-search-form">
                                <input id="filtrar" type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" rel="tooltip" title="Buscar">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>                      
                    </div>
                </div>

                 <!-- /.row -->
                 <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Datos
                            </div>
                            <?php
                            $promociones = consultas::get_datos("select * from v_promocionn  order by cod_promo asc ");
                            if (!empty($promociones)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">USUARIO</th>                                                                            
                                                    <th class="text-center">FECHA</th>                                      
                                                    <th class="text-center">FECHA INICIO</th>                                      
                                                    <th class="text-center">FECHA FIN</th>                                      
                                                    <th class="text-center">PROMO NOMBRE</th>                                      
                                                    <th class="text-center">ESTADO</th>                                      
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($promociones as $promocione) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $promocione['cod_promo']; ?></td>
                                                        <td class="text-center"><?php echo $promocione['usu_nick']; ?></td>
                                                        <td class="text-center"><?php echo $promocione['promo_fecha']; ?></td>
                                                        <td class="text-center"><?php echo $promocione['promo_fecha_inicio']; ?></td>
                                                        <td class="text-center"><?php echo $promocione['promo_fecha_fin']; ?></td>
                                                        <td class="text-center"><?php echo $promocione['promo_descrip']; ?></td>
                                                        <td class="text-center"><?php echo $promocione['promo_estado']; ?></td>
                                                        <td class="text-center">
                                                            <a  
                                                                href="promocion_detalle.php?vdetpromo=<?php echo $promocione['cod_promo']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>


                                                            <a onclick="borrar(<?php
                                                            echo "'" . $promocione['cod_promo'] . "_" .
                                                            $promocione['cod_usu'] . "_" .
                                                            $promocione['promo_fecha_inicio'] . "_" .
                                                            $promocione['promo_fecha_fin'] . "_" .
                                                            $promocione['promo_descrip'] . "_" .
                                                            $promocione['promo_estado'] . "_" .
                                                            $promocione['promo_fecha'] . "'";
                                                            ?>)"
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Borrar"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-trash"></span></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>                         
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>No se encontraron registro....!</strong>
                                    </div>
                                <?php } ?>  
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <!-- /.panel -->

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!--registrar-->


                <div id="registrar" class="modal fade" role="dialog">
                    <div class=" modal-dialog modal-lg ">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR PROMOCIONES</strong></h4>
                            </div>
                            <?php $fecha = consultas::get_datos("select * from v_fecha"); ?>
                            <form action="promocion_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body ">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vpromo" value="0"/> 
                                    <input type="hidden" name="vusuario" 
                                           value="<?php echo $_SESSION['cod_usu']; ?>">
                        
                                    <input type="hidden" name="vestado" value="PENDIENTE">
                                    <input type="hidden" name="pagina" value="promocion_detalle.php">
                                    <span class=" col-md-1"></span>


                                    <div class="form-group">
                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>FECHA</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" name="vfecha" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                        <div class="col-md-4  " >
                                            <label  class="control-label col-md-3"><h3>FECHA/INICIO</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="fec"  onchange="validarfecha_inicio(), validarfecha_fin()" onkeyup="validarfecha_inicio(), validarfecha_fin()"
                                                   class="form-control"  name="vfechainicio" >
                                        </div>

                                    </div>
                                    <span class=" col-md-1"></span>

                              


                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>FECHA/FIN</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="fecha"  onchange="validarfecha_fin()" onkeyup="validarfecha_fin()" onkeydown="validarfecha_fin()"
                                                   class="form-control" name="vfechafin" >
                                        </div>
                                    </div>
                                    <br>
                                    <!--                                    <div class="form-group">
                                                                            <label class="col-md-2 control-label">NOMBRE PROMO:</label>
                                                                            <div class="col-xs-10 col-md-8">
                                                                                <textarea type="text" required=""
                                                                                          placeholder="Ingrese nombre de la promo"autocomplete="off" 
                                                                                          class="form-control" 
                                                                                          id="des"
                                                                                           name="vdescrip"
                                                                                          onchange="letraspromo()" 
                                                                                            onkeyup="letraspromo()"
                                                                                           rows="3"  pattern="[A-Za-z #SPACE]{4,30}" title="SOLO LETRAS !" autofocus=""></textarea>
                                                                            </div>
                                                                        </div>-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">PROMO:</label>
                                        <div class="col-md-5">
                                            <input type="text" required=""
                                                   placeholder="Ingrese nombre de la promo"  autocomplete="off"
                                                   class="form-control"
                                                   id="des"
                                                   name="vdescrip"
                                                   onchange="letraspromo()" 
                                                   onkeyup="letraspromo()"
                                                   pattern="[A-Za-z #SPACE]{4,30}" title="SOLO LETRAS !" autofocus="">
                                        </div>
                                    </div>

                                    <br>
                                    <br>



                                    <div class="modal-">
                                        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                            <i class="fa fa-close"></i> Cerrar</button>


                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-floppy-o"></i> Registrar</button>


                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!--fin-->

                <!--fin editar-->
                <!--borrar-->
                <div class="modal fade" id="delete" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title custom_align" id="Heading">Atenci&oacute;n!!!</h4>
                            </div>
                            <div class="modal-body">

                                <div class="alert alert-warning" id="confirmacion"></div>

                            </div>
                            <div class="modal-footer">
                                <a id="si" role="button" class="btn btn-primary" ><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                            </div>
                        </div>
                    </div>
                </div> 
                <!--fin-->
            </div> 
        </div> 

    <?php require 'menu/js.ctp'; ?>

    
</body>
</html>