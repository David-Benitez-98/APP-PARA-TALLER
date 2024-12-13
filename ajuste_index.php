<!DOCTYPE html>
<html lang="en">
<head>
        <link rel="shortcut icon"  href=" images/mauro"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>AJUSTE DE STOCK</title>

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
                        <h3 class="page-header">LISTADO DE AJUSTE
<!--                            <a href="imprimir_sucursal.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a> -->
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
                            $ajustes = consultas::get_datos("SELECT * FROM v_ajuste ORDER BY cod_ajuste_stock ASC");
                            if (!empty($ajustes)) {
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
                                                    <th class="text-center">ESTADO</th>                                        
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($ajustes as $ajuste) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $ajuste['cod_ajuste_stock']; ?></td>
                                                        <td class="text-center"><?php echo $ajuste['usu_nick']; ?></td>
                                                        <td class="text-center"><?php echo $ajuste['fecha_ajuste']; ?></td>
                                                        <td class="text-center"><?php echo $ajuste['estado_ajuste']; ?></td>
                                                        <td class="text-center">
                                                                     <a  
                                                                href="ajuste_detalle_agregar.php?vdetcod=<?php echo $ajuste['cod_ajuste_stock'];?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                        
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

                <div id="registrar" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR AJUSTE</strong></h4>
                            </div>
                            <?php $fecha = consultas::get_datos("select * from v_fecha"); ?>
                            <form action="ajuste_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcod" value="0"/> 
                                      <input type="hidden" name="vusu" 
                                           value="<?php echo $_SESSION['cod_usu']; ?>">
                                        <input type="hidden" name="vestado" value="ACTIVO">
                                    <input type="hidden" name="pagina" value="ajuste_detalle_agregar.php">
                                    <span class="col-md-1"></span>
                                     <div class="form-group">
                                  <div class="col-md-4 " >
                                  <label  class="control-label col-md-2"><h3>USUARIO</h3></label>
                                            <input type="text" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" value="<?php echo $_SESSION['usu_nick'] ?>">
                                        </div>
                                             <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>FECHA</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" name="vfecha" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                        </div>
                                                                    

                                </div>

                                <div class="modal-footer">
                                    <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                        <i class="fa fa-close"></i> Cerrar</button>
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-floppy-o"></i> Registrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--fin-->
          

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


        <!--archivos js-->  
        <?php require 'menu/js.ctp'; ?>
</body>
</html>